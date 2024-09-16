<?php

namespace App\Livewire;

use App\Events\NewFandomLog;
use App\Events\NewUserLog;
use App\Events\RequestClosed;
use App\Events\RequestVoted;
use App\Events\UserBanned;
use App\Events\UserJoined;
use App\Events\UserUnbanned;
use App\Models\Ban;
use App\Models\Fandom;
use App\Models\Member;
use App\Models\Publish;
use App\Models\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Illuminate\Support\Str;

class FandomsRequestCard extends Component
{
    #[Locked]
    public $request;
    #[Locked]
    public $fandom;
    public $preferences = [];
    public function render()
    {
        $request_by = $this->request->user->username;
        $total_members = $this->fandom->members->count();
        $voted = $this->request->votes()->where('user_id', Auth::id())->first();
        $voted_yes = $this->request->votes()->where('agree', true)->count();
        $voted_no = $this->request->votes()->where('disagree', true)->count();
        $unvoted = $total_members - ($voted_yes + $voted_no);
        $voted_yes_percentage = ($voted_yes / $total_members) * 100;
        $voted_no_percentage = ($voted_no / $total_members) * 100;
        $unvoted_percentage = ($unvoted / $total_members) * 100;
        return view('livewire.fandoms-request-card', [
            'request_by' => $request_by,
            'voted' => $voted,
            'voted_yes' => $voted_yes,
            'voted_no' => $voted_no,
            'unvoted' => $unvoted,
            'voted_yes_percentage' => $voted_yes_percentage,
            'voted_no_percentage' => $voted_no_percentage,
            'unvoted_percentage' => $unvoted_percentage,
        ]);
    }
    public function mount(Request $request, $preferences)
    {
        $this->request = $request;
        $this->fandom = $request->fandom;
        $this->preferences = $preferences;
    }
    public function voteYes()
    {
        $this->authorize('create', [Vote::class, $this->request]);
        if ($this->request->status == 'open') {
            $this->request->votes()->updateOrCreate(['user_id' => Auth::id()], ['agree' => true, 'disagree' => false]);
            RequestVoted::dispatch($this->request);
            $this->dispatch('alert', 'success', 'Done, you vote yes');
            $this->checkRequeststatus();
        } else {
            $this->dispatch('alert', 'error', 'Error, this request is closed');
        }
    }
    public function voteNo()
    {
        $this->authorize('create', [Vote::class, $this->request]);
        if ($this->request->status == 'open') {
            $this->request->votes()->updateOrCreate(['user_id' => Auth::id()], ['disagree' => true, 'agree' => false]);
            RequestVoted::dispatch($this->request);
            $this->dispatch('alert', 'success', 'Done, you vote no');
            $this->checkRequeststatus();
        } else {
            $this->dispatch('alert', 'error', 'Error, this request is closed');
        }
    }
    public function checkRequeststatus()
    {
        if ($this->request->votes->count() == $this->fandom->members->count()) {
            $voted_yes = $this->request->votes()->where('agree', true)->count();
            $voted_no = $this->request->votes()->where('disagree', true)->count();
            if ($voted_yes > $voted_no) {
                $this->request->update(['result' => true]);
            } elseif ($voted_yes < $voted_no) {
                $this->request->update(['result' => false]);
            } else {
                $result = [true, false];
                $this->request->update(['result' => $result[rand(0, 1)]]);
            }
            if (! $this->request->result) {
                $this->request->update(['status' => 'close']);
                RequestClosed::dispatch($this->fandom);
            }
            if ($this->request->result) {
                if ($this->request->command == null) {
                    $this->request->update(['status' => 'close']);
                    RequestClosed::dispatch($this->fandom);
                }
                if ($this->request->command != null) {
                    $request_command = Str::of($this->request->command)->explode(' ');
                    $command = $request_command[0];
                    $user = $request_command[1];
                    $user = User::where('username', $user)->first();
                    $fandom_members = $this->fandom->members;
                    $managers = $fandom_members->where('role.name', 'Manager');
                    $members = $fandom_members->where('role.name', 'Member');
                    if ($user != null) {
                        if ($command == 'promote') {
                            if (in_array($user->id, $members->pluck('user.id')->toArray())) {
                                $role = Role::where('name', 'Manager')->first();
                                $fandom = Fandom::find($this->request->fandom_id);
                                $result = false;
                                DB::transaction(function () use ($role, $user, &$result, $fandom) {
                                    $user->members()->updateOrCreate(['fandom_id' => $this->request->fandom_id], ['role_id' => $role->id]);
                                    $user->logs()->create([
                                        'message' => 'You got promoted to manager in ' . $fandom->name
                                    ]);
                                    $result = true;
                                }, 10);
                                if ($result) {
                                    $this->request->update(['status' => 'close']);
                                    $this->dispatch('alert', 'success', 'Done, ' . $user->username . ' has been promoted to manager');
                                    UserJoined::dispatch($fandom, $user);
                                    RequestClosed::dispatch($this->fandom);
                                    NewUserLog::dispatch($user);
                                } else {
                                    $this->request->update([
                                        'result' => null,
                                        'status' => 'open',
                                    ]);
                                    $this->dispatch('alert', 'error', 'Error, failed to get the result, try it again later');
                                    RequestClosed::dispatch($this->fandom);
                                }
                            } else {
                                $this->dispatch('alert', 'error', 'Error, the user is not a member');
                            }
                        }
                        if ($command == 'demote') {
                            if (in_array($user->id, $managers->pluck('user.id')->toArray())) {
                                $role = Role::where('name', 'Member')->first();
                                $fandom = Fandom::find($this->request->fandom_id);
                                $result = false;
                                DB::transaction(function () use ($role, $user, &$result, $fandom) {
                                    $user->members()->updateOrCreate(['fandom_id' => $this->request->fandom_id], ['role_id' => $role->id]);
                                    $user->logs()->create([
                                       'message' => 'You got demoted to member in '. $fandom->name
                                    ]);
                                    $result = true;
                                }, 10);
                                if ($result) {
                                    $this->request->update(['status' => 'close']);
                                    $this->dispatch('alert', 'success', 'Done, ' . $user->username . ' has been demoted to member');
                                    UserJoined::dispatch($fandom, $user);
                                    RequestClosed::dispatch($this->fandom);
                                    NewUserLog::dispatch($user);
                                } else {
                                    $this->request->update([
                                        'result' => null,
                                        'status' => 'open',
                                    ]);
                                    $this->dispatch('alert', 'error', 'Error, failed to get the result, try it again later');
                                    RequestClosed::dispatch($this->fandom);
                                }
                            } else {
                                $this->dispatch('alert', 'error', 'Error, the user is not a manager');
                            }
                        }
                        if ($command == 'ban') {
                            $posts = $user->posts;
                            $galleries = $user->galleries;
                            $fandom = Fandom::find($this->request->fandom_id);
                            $result = false;
                            $ban = DB::transaction(function () use ($posts, $galleries, $fandom, $user, &$result) {
                                foreach ($posts as $post) {
                                    if ($post->publis_id != null) {
                                        Publish::where('id', $post->publis_id)->update([
                                            'publishable_type' => 'App\Models\User',
                                            'publishable_id' => $user->id,
                                            'visible' => 'self'
                                        ]);
                                    }
                                }
                                foreach ($galleries as $gallery) {
                                    Publish::where('id', $gallery->publis_id)->update([
                                        'publishable_type' => 'App\Models\User',
                                        'publishable_id' => $user->id,
                                        'visible' => 'self'
                                    ]);
                                }
                                Member::where('user_id', $user->id)->where('fandom_id', $fandom->id)->delete();
                                return $fandom->bans()->create([
                                    'user_id' => $user->id,
                                ]);
                                $user->logs()->create([
                                    'message' => 'You got banned from '. $fandom->name
                                ]);
                                $result = true;
                            }, 10);
                            if ($result) {
                                $this->request->update(['status' => 'close']);
                                $this->dispatch('alert', 'success', 'Done, ' . $user->username . ' has been banned from ' . $fandom->name);
                                UserBanned::dispatch($this->fandom);
                                RequestClosed::dispatch($this->fandom);
                                NewUserLog::dispatch($user);
                            } else {
                                $this->request->update([
                                    'result' => null,
                                    'status' => 'open',
                                ]);
                                $this->dispatch('alert', 'error', 'Error, failed to get the result, try it again later');
                                RequestClosed::dispatch($this->fandom);
                            }
                        }
                        if ($command == 'unban') {
                            $fandom = Fandom::find($this->request->fandom_id);
                            $result = false;
                            DB::transaction(function () use ($fandom, $user, &$result) {
                                Ban::where('user_id', $user->id)->where('fandom_id', $fandom->id)->delete();
                                $user->logs()->create([
                                    'message' => 'You got unbanned from '. $fandom->name
                                ]);
                                $result = true;
                            }, 10);
                            if ($result) {
                                $this->request->update(['status' => 'close']);
                                $this->dispatch('alert', 'success', 'Done, ' . $user->username . ' has been unbanned from ' . $fandom->name);
                                UserUnbanned::dispatch($this->fandom);
                                RequestClosed::dispatch($this->fandom);
                                NewUserLog::dispatch($user);
                            } else {
                                $this->request->update([
                                    'result' => null,
                                    'status' => 'open',
                                ]);
                                $this->dispatch('alert', 'error', 'Error, failed to get the result, try it again later');
                                RequestClosed::dispatch($this->fandom);
                            }
                        }
                    } else {
                        $this->dispatch('alert', 'error', 'Error, ' . $request_command[1] . ' not found');
                    }
                }
            }
            $result = $this->request->result ? ' is accepted' : ' is rejected';
            $this->fandom->logs()->create([
                'message' => 'Request result' . $result . ' for title: ' . $this->request->title
            ]);
            NewFandomLog::dispatch($this->fandom);
        }
    }
    public function getListeners()
    {
        return [
            "echo-private:FandomsRequestCard.{$this->request->id},RequestVoted" => 'loadRequest',
            "echo:FandomsRequestCard.{$this->request->id},RequestVoted" => 'loadRequest',
        ];
    }
    public function loadRequest($event)
    {
        $this->request = Request::find($event['request']['id']);
    }
}
