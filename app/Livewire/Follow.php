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
    public function mount($user, $followed_users, $preferences)
    {
        $this->user = $user;
        $user_ids = $followed_users->pluck('id');
        $this->followed_users = User::with(['profile', 'avatar.image', 'cover.image'])->whereIn('id', $user_ids)->get();
        $this->preferences = $preferences;
    }
    public function loadFollowedUsers()
    {
        $users = User::with(['follows'])->find(Auth::id());
        $followed_users = $users->follows;
        $user_ids = $followed_users->pluck('id');
        $this->followed_users = User::with(['profile', 'avatar.image', 'cover.image'])->whereIn('id', $user_ids)->get();
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
