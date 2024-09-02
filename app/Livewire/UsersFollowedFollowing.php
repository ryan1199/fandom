<?php

namespace App\Livewire;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Number;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UsersFollowedFollowing extends Component
{
    #[Locked]
    public $user;
    public $preferences = [];
    public function render()
    {
        $totalFollower = Number::abbreviate(Follow::where('other_user_id', $this->user->id)->count());
        $totalFollowing = Number::abbreviate(Follow::where('self_user_id', $this->user->id)->count());
        return view('livewire.users-followed-following', [
            'totalFollower' => $totalFollower,
            'totalFollowing' => $totalFollowing,
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
            "echo-private:UsersFollowedFollowing.{$this->user->id},UserFollowed" => 'loadFollowerAndFollowing',
            "echo-private:UsersFollowedFollowing.{$this->user->id},UserUnfollowed" => 'loadFollowerAndFollowing',
            "echo-private:UsersFollowedFollowing.{$this->user->id},UserBlocked" => 'loadFollowerAndFollowing',
        ];
    }
    public function loadFollowerAndFollowing($event)
    {
        if ($event['user1']['id'] == $this->user->id) {
            $this->user = User::find($event['user1']['id']);
        }
        if ($event['user2']['id'] == $this->user->id) {
            $this->user = User::find($event['user2']['id']);
        }
    }
}
