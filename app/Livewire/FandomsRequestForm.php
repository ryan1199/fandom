<?php

namespace App\Livewire;

use App\Events\NewFandomLog;
use App\Events\RequestOpened;
use App\Models\Fandom;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FandomsRequestForm extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[Locked]
    public $fandom;
    public $title = '';
    public $description = '';
    public $administration = false;
    #[Locked]
    public $user;
    #[Locked]
    public $command;
    public $preferences = [];
    public function render()
    {
        $command_list_for_manager = ['demote', 'ban'];
        $command_list_for_member = ['promote', 'ban'];
        $fandom_members = $this->fandom->members;
        $managers = $this->fandom->members()->whereHas('role', function (Builder $query) {
            $query->where('name', 'Manager');
        })->with('user')->simplePaginate(5, pageName: 'managers-page');
        $members = $this->fandom->members()->whereHas('role', function (Builder $query) {
            $query->where('name', 'Member');
        })->with('user')->simplePaginate(5, pageName: 'members-page');
        $banned_users = $this->fandom->bans()->with('user')->simplePaginate(5, pageName: 'banned-users-page');
        if ($banned_users->isNotEmpty()) {
            $unbanned_users = User::whereNotIn('id', $fandom_members->pluck('user_id'))->whereNotIn('id', $banned_users->pluck('user_id'))->orderBy('username', 'ASC')->simplePaginate(5, pageName: 'unbanned-users-page');
        } else {
            $unbanned_users = User::whereNotIn('id', $fandom_members->pluck('user_id'))->orderBy('username', 'ASC')->simplePaginate(5, pageName: 'unbanned-users-page');
        }
        return view('livewire.fandoms-request-form', [
            'command_list_for_manager' => $command_list_for_manager,
            'command_list_for_member' => $command_list_for_member,
            'managers' => $managers,
            'members' => $members,
            'banned_users' => $banned_users,
            'unbanned_users' => $unbanned_users,
        ]);
    }
    public function mount(Fandom $fandom, $preferences)
    {
        $this->fandom = $fandom;
        $this->preferences = $preferences;
    }
    public function createRequest()
    {
        $this->authorize('create', [Request::class, $this->fandom]);
        $validated = Validator::make(
            [
                'title' => $this->title,
                'description' => $this->description,
            ],
            [
                'title' => ['required', 'between:5,50'],
                'description' => ['required', 'between:10,100'],
            ],
            [
                'required' => 'The :attribute must not empty',
                'between' => 'The :attribute length is between :min and :max characters',
            ],
            [
                'title' => 'Request title',
                'description' => 'Request description',
            ]
        )->validate();
        if ($this->administration) {
            if ($this->user != null && $this->command != null) {
                $this->fandom->requests()->create([
                    'title' => $this->title,
                    'description' => $this->description,
                    'command' => $this->command . ' ' .  $this->user->username,
                    'status' => 'open',
                    'user_id' => Auth::id()
                ]);
                $this->dispatch('alert', 'success', 'Done, request successfully created');
                RequestOpened::dispatch($this->fandom);
            } else {
                $this->dispatch('alert', 'error', 'User or command must not empty');
            }
        } else {
            $this->fandom->requests()->create([
                'title' => $this->title,
                'description' => $this->description,
                'status' => 'open',
                'user_id' => Auth::id()
            ]);
            $this->dispatch('alert', 'success', 'Done, request successfully created');
            RequestOpened::dispatch($this->fandom);
        }
        $this->fandom->logs()->create([
            'message' => 'New request by ' . Auth::user()->username . ' with title: ' . $this->title
        ]);
        NewFandomLog::dispatch($this->fandom);
        $this->reset(['title', 'description', 'user', 'command']);
        $this->resetPage('managers-page');
        $this->resetPage('members-page');
        $this->resetPage('banned-users-page');
        $this->resetPage('unbanned-users-page');
    }
    public function selectCommandForUser(User $user, $command)
    {
        $users = $this->fandom->members;
        $managers = $users->where('role.name', 'Manager');
        $members = $users->where('role.name', 'Member');
        $command_list = ['promote', 'demote', 'ban', 'unban'];
        $user = User::find($user->id);
        if ($user != null) {
            $user_already_in_requested = $this->fandom->requests()->where('command', 'like', '%' . $user->username . '%')->where('result', null)->where('status', 'open')->first();
            if ($user_already_in_requested == null) {
                if (in_array($user->id, $members->pluck('user.id')->toArray()) || in_array($user->id, $managers->pluck('user.id')->toArray())) {
                    $this->user = $user;
                    if (in_array($command, $command_list)) {
                        if (in_array($user->id, $managers->pluck('user.id')->toArray())) {
                            if ($command == $command_list[0]) {
                                $this->dispatch('alert', 'error', 'Cannot promote a manager');
                            } elseif ($command == $command_list[3]) {
                                $this->dispatch('alert', 'error', 'Cannot unban an unbanned user');
                            }
                        } elseif (in_array($user->id, $members->pluck('user.id')->toArray())) {
                            if ($command == $command_list[1]) {
                                $this->dispatch('alert', 'error', 'Cannot demote a member');
                            } elseif ($command == $command_list[3]) {
                                $this->dispatch('alert', 'error', 'Cannot unban an unbanned user');
                            }
                        }
                        $this->command = $command;
                    } else {
                        $this->dispatch('alert', 'error', 'Invalid command');
                    }
                } else {
                    $this->user = $user;
                    if (in_array($command, $command_list)) {
                        $banned_users = $this->fandom->bans()->with('user')->get();
                        if ($banned_users->isNotEmpty()) {
                            if (in_array($user->id, $banned_users->pluck('user_id')->toArray())) {
                                if ($command == $command_list[0]) {
                                    $this->dispatch('alert', 'error', 'Cannot promote non member user');
                                } elseif ($command == $command_list[1]) {
                                    $this->dispatch('alert', 'error', 'Cannot demote non member user');
                                } elseif ($command == $command_list[2]) {
                                    $this->dispatch('alert', 'error', 'Cannot ban a banned user');
                                }
                            } elseif (! in_array($user->id, $banned_users->pluck('user_id')->toArray())) {
                                if ($command == $command_list[0]) {
                                    $this->dispatch('alert', 'error', 'Cannot promote non member user');
                                } elseif ($command == $command_list[1]) {
                                    $this->dispatch('alert', 'error', 'Cannot demote non member user');
                                } elseif ($command == $command_list[3]) {
                                    $this->dispatch('alert', 'error', 'Cannot unban an unbanned user');
                                }
                            }
                            $this->command = $command;
                        } else {
                            if ($command == $command_list[0]) {
                                $this->dispatch('alert', 'error', 'Cannot promote non member user');
                            } elseif ($command == $command_list[1]) {
                                $this->dispatch('alert', 'error', 'Cannot demote non member user');
                            } elseif ($command == $command_list[3]) {
                                $this->dispatch('alert', 'error', 'Cannot unban an unbanned user');
                            }
                            $this->command = $command;
                        }
                    } else {
                        $this->dispatch('alert', 'error', 'Invalid command');
                    }
                }
            } else {
                $this->dispatch('alert', 'error', 'User already in a requested');
            }
        } else {
            $this->dispatch('alert', 'error', $user->username.'not found');
        }
    }
    public function getListeners()
    {
        return [
            "echo-private:FandomsRequestForm.{$this->fandom->id},UserJoined" => 'loadMember',
            "echo-private:FandomsRequestForm.{$this->fandom->id},UserLeaved" => 'loadMember',
            "echo-private:FandomsRequestForm.{$this->fandom->id},UserBanned" => 'loadMember',
            "echo-private:FandomsRequestForm.{$this->fandom->id},UserUnbanned" => 'loadMember',
        ];
    }
    public function loadMember($event)
    {
        $fandom = Fandom::find($event['fandom']['id']);
        $this->reset(['administration', 'user', 'command']);
        $this->fandom = $fandom;
        $this->resetPage('managers-page');
        $this->resetPage('members-page');
        $this->resetPage('banned-users-page');
        $this->resetPage('unbanned-users-page');
    }
}
