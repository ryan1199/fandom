<?php

namespace App\Livewire;

use App\Events\RequestOpened;
use App\Models\Fandom;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FandomsRequestForm extends Component
{
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
        $command_list_for_manager = ['demote', 'banned'];
        $command_list_for_member = ['promote', 'banned'];
        $managers = $this->fandom->members()->whereHas('role', function (Builder $query) {
            $query->where('name', 'Manager');
        })->with('user')->get();
        $members = $this->fandom->members()->whereHas('role', function (Builder $query) {
            $query->where('name', 'Member');
        })->with('user')->get();
        return view('livewire.fandoms-request-form', [
            'command_list_for_manager' => $command_list_for_manager,
            'command_list_for_member' => $command_list_for_member,
            'managers' => $managers,
            'members' => $members,
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
                $this->title = '';
                $this->description = '';
                $this->user = null;
                $this->command = null;
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
            $this->title = '';
            $this->description = '';
        }
        $this->dispatch('alert', 'success', 'Done, request successfully created');
        RequestOpened::dispatch($this->fandom);
    }
    public function selectCommandForUser(User $user, $command)
    {
        $users = $this->fandom->members;
        $managers = $users->where('role.name', 'Manager');
        $members = $users->where('role.name', 'Member');
        $command_list = ['promote', 'demote', 'banned'];
        if (in_array($user->id, $members->pluck('user.id')->toArray()) || in_array($user->id, $managers->pluck('user.id')->toArray())) {
            $this->user = $user;
            if (in_array($command, $command_list)) {
                if ($command == $command_list[0] && in_array($user->id, $managers->pluck('user.id')->toArray())) {
                    $this->dispatch('alert', 'error', 'Cannot promote a manager');
                } elseif ($command == $command_list[1] && in_array($user->id, $members->pluck('user.id')->toArray())) {
                    $this->dispatch('alert', 'error', 'Cannot demote a member');
                }
                $this->command = $command;
            } else {
                $this->dispatch('alert', 'error', 'Invalid command');
            }
        } else {
            $this->dispatch('alert', 'error', $user->username . ' is not a member of this fandom');
        }
    }
    public function getListeners()
    {
        return [
            "echo-private:FandomsRequestForm.{$this->fandom->id},UserJoined" => 'loadMember',
            "echo-private:FandomsRequestForm.{$this->fandom->id},UserLeaved" => 'loadMember',
        ];
    }
    public function loadMember($event)
    {
        $fandom = Fandom::find($event['fandom']['id']);
        $this->reset(['administration', 'user', 'command']);
        $this->fandom = $fandom;
    }
}
