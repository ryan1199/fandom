<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UsersProfile extends Component
{
    #[Locked]
    public $user;
    public $preferences = [];
    public function render()
    {
        $profile = $this->user->profile;
        $cover = $this->user->cover;
        $avatar = $this->user->avatar;
        return view('livewire.users-profile', [
            'profile' => $profile,
            'cover' => $cover,
            'avatar' => $avatar,
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
            "echo-private:UsersProfile.{$this->user->id},UserProfileUpdated" => 'loadProfile',
        ];
    }
    public function loadProfile($event)
    {
        $this->user = User::find($event['user']['id']);
    }
}
