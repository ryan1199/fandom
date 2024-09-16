<?php

namespace App\Livewire;

use App\Events\NewFandomLog;
use App\Events\NewUserLog;
use App\Events\UserJoined;
use App\Events\UserLeaved;
use App\Models\Fandom;
use App\Models\Role;
use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FandomJoinLeaveButton extends Component
{
    #[Locked]
    public $fandom;
    #[Locked]
    public $user;
    #[Locked]
    public $members = [];
    public $preferences = [];
    public function render()
    {
        return view('livewire.fandom-join-leave-button');
    }
    public function mount(Fandom $fandom, User $user, $preferences)
    {
        $this->fandom = $fandom;
        $this->user = $user;
        $users = $fandom->members;
        $this->members = $users->pluck('user.id')->toArray();
        $this->preferences = $preferences;
    }
    public function join()
    {
        if(in_array($this->user->id, $this->members)) {
            $this->dispatch('alert', 'error', 'Failed, you are already joined in this fandom')->to(Alert::class);
        } else {
            $role = Role::where('name', 'Member')->first();
            $this->fandom->members()->create([
                'user_id' => $this->user->id,
                'role_id' => $role->id
            ]);
            $this->members[] = $this->user->id;
            $this->fandom->logs()->create([
                'message' => $this->user->username . ' joins to ' . $this->fandom->name
            ]);
            $this->user->logs()->create([
                'message' => 'You join to ' . $this->fandom->name
            ]);
            UserJoined::dispatch($this->fandom, $this->user);
            NewFandomLog::dispatch($this->fandom);
            NewUserLog::dispatch($this->user);
            $this->dispatch('alert', 'success', 'Done, now you are part of this fandom')->to(Alert::class);
        }
    }
    public function leave()
    {
        if(in_array($this->user->id, $this->members)) {
            $this->fandom->members()->where('user_id', $this->user->id)->delete();
            $members = [];
            foreach ($this->members as $member) {
                if($member!= $this->user->id) {
                    $members[] = $member;
                }
            }
            $this->members = $members;
            $this->fandom->logs()->create([
                'message' => $this->user->username . ' leaves from ' . $this->fandom->name
            ]);
            $this->user->logs()->create([
                'message' => 'You leave from ' . $this->fandom->name
            ]);
            UserLeaved::dispatch($this->fandom, $this->user);
            NewFandomLog::dispatch($this->fandom);
            NewUserLog::dispatch($this->user);
            $this->dispatch('alert', 'success', 'Done, now you are no longer part of this fandom, hope you find a new one');
        } else {
            $this->dispatch('alert', 'error', 'Failed, you are not part of this fandom');
        }
    }
}
