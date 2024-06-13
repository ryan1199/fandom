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
    public function mount($user, $blocked_users, $preferences)
    {
        $this->user = $user;
        $user_ids = $blocked_users->pluck('id');
        $this->blocked_users = User::with(['profile', 'avatar.image', 'cover.image'])->whereIn('id', $user_ids)->get();
        $this->preferences = $preferences;
    }
    public function loadBlockedUsers()
    {
        $users = User::with(['blocks'])->find(Auth::id());
        $blocked_users = $users->blocks;
        $user_ids = $blocked_users->pluck('id');
        $this->blocked_users = User::with(['profile', 'avatar.image', 'cover.image'])->whereIn('id', $user_ids)->get();
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
