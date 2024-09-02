<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UsersFandomList extends Component
{
    #[Locked]
    public $user;
    public $preferences = [];
    public function render()
    {
        $members = $this->user->members;
        return view('livewire.users-fandom-list', [
            'members' => $members,
        ]);
    }
    public function mount(User $user, $preferences)
    {
        $this->user = $user;
        $this->preferences = $preferences;
    }
    public function getListeners()
    {
        return [
            "echo-private:UsersFandomList.{$this->user->id},UserJoined" => 'loadFandomList',
            "echo-private:UsersFandomList.{$this->user->id},UserLeaved" => 'loadFandomList',
        ];
    }
    public function loadFandomList($event)
    {
        $this->user = User::find($event['user']['id']);
    }
}
