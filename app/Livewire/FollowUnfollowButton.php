<?php

namespace App\Livewire;

use App\Events\NewUserLog;
use App\Events\UserFollowed;
use App\Events\UserUnfollowed;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class FollowUnfollowButton extends Component
{
    public $user1;
    public $user2;
    public $followed = false;
    public $preferences = [];
    public function render()
    {
        return view('livewire.follow-unfollow-button');
    }
    public function mount(User $user1, User $user2, $preferences)
    {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->checkFollowing();
        $this->preferences = $preferences;
    }
    public function follow()
    {
        if($this->followed) {
            $this->unfollow();
        } else {
            $result = false;
            DB::transaction(function () use (&$result) {
                $this->user1->follows()->attach($this->user2->id);
                $this->user1->blocks()->detach($this->user2->id);
                $this->user1->logs()->create([
                    'message' => 'You follow '. $this->user2->username
                ]);
                $this->user2->logs()->create([
                    'message' => $this->user1->username . ' follows you'
                ]);
                $result = true;
            });
            if ($result) {
                UserFollowed::dispatch($this->user1, $this->user2);
                NewUserLog::dispatch($this->user1);
                NewUserLog::dispatch($this->user2);
                $this->dispatch('alert', 'success', 'Successfully follow ' . $this->user2->username);
            } else {
                $this->dispatch('alert', 'error', 'Error, failed to follow ' . $this->user2->username . ' , please try again later');
            }
        }
        $this->checkFollowing();
    }
    public function unfollow()
    {
        if(! $this->followed) {
            $this->follow();
        } else {
            $result = false;
            DB::transaction(function () use (&$result) {
                $this->user1->follows()->detach($this->user2->id);
                $this->user1->logs()->create([
                    'message' => 'You unfollow '. $this->user2->username
                ]);
                $this->user2->logs()->create([
                    'message' => $this->user1->username . ' unfollows you'
                ]);
                $result = true;
            });
            if ($result) {
                UserUnfollowed::dispatch($this->user1, $this->user2);
                NewUserLog::dispatch($this->user1);
                NewUserLog::dispatch($this->user2);
                $this->dispatch('alert', 'success', 'Successfully unfollow ' . $this->user2->username);
            } else {
                $this->dispatch('alert', 'error', 'Error, failed to unfollow ' . $this->user2->username . ' , please try again later');
            }
        }
        $this->checkFollowing();
    }
    public function checkFollowing()
    {
        $this->followed = $this->user1->follows->contains($this->user2->id);
    }
    public function loadFollowing()
    {
        $this->mount($this->user1, $this->user2, $this->preferences);
    }
    public function getListeners()
    {
        return [
            "echo-private:FollowUnfollowButton.{$this->user1->id}.{$this->user2->id},UserBlocked" => 'loadFollowing',
            "echo-private:FollowUnfollowButton.{$this->user1->id}.{$this->user2->id},UserUnfollowed" => 'loadFollowing',
        ];
    }
}
