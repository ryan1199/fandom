<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Block extends Component
{
    public $user;
    public $blocked_users;
    public $preferences = [];
    public function render()
    {
        return view('livewire.block');
    }
    public function mount(User $user, $preferences)
    {
        $this->user = $user;
        $this->preferences = $preferences;
        $this->loadBlockedUsers();
    }
    public function loadBlockedUsers()
    {
        $user = $this->user->load(['blocks']);
        $this->blocked_users = $user->blocks->load(['profile', 'avatar.image', 'cover.image']);
    }
    public function getListeners()
    {
        return [
            "echo-private:Block.{$this->user->id},UserBlocked" => 'loadBlockedUsers',
            "echo-private:Block.{$this->user->id},UserUnblocked" => 'loadBlockedUsers',
            "echo-private:Block.{$this->user->id},UserFollowed" => 'loadBlockedUsers',
        ];
    }
}
