<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Follow extends Component
{
    public $user;
    public $followed_users;
    public $preferences = [];
    public function render()
    {
        return view('livewire.follow');
    }
    public function mount(User $user, $preferences)
    {
        $this->user = $user;
        $this->preferences = $preferences;
        $this->loadFollowedUsers();
    }
    public function loadFollowedUsers()
    {
        $user = $this->user->load(['follows']);
        $this->followed_users = $user->follows->load(['profile', 'avatar.image', 'cover.image']);
    }
    public function getListeners()
    {
        return [
            "echo-private:Follow.{$this->user->id},UserFollowed" => 'loadFollowedUsers',
            "echo-private:Follow.{$this->user->id},UserUnfollowed" => 'loadFollowedUsers',
            "echo-private:Follow.{$this->user->id},UserBlocked" => 'loadFollowedUsers',
        ];
    }
}
