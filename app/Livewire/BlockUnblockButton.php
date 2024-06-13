<?php

namespace App\Livewire;

use App\Events\UserBlocked;
use App\Events\UserUnblocked;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class BlockUnblockButton extends Component
{
    public $user1;
    public $user2;
    public $blocked = false;
    public $preferences = [];
    public function render()
    {
        return view('livewire.block-unblock-button');
    }
    public function mount($user1, $user2, $preferences)
    {
        $this->user1 = User::find($user1->id);
        $this->user2 = User::find($user2->id);
        $this->checkBlocking();
        $this->preferences = $preferences;
    }
    public function block()
    {
        $this->checkBlocking();
        if($this->blocked) {
            $this->unblock();
        } else {
            $this->user1->blocks()->attach($this->user2->id);
            $this->user1->follows()->detach($this->user2->id);
            $this->loadBlocking();
            UserBlocked::dispatch($this->user1, $this->user2);
            $this->dispatch('alert', 'success', 'Successfully block ' . $this->user2->username);
        }
    }
    public function unblock()
    {
        $this->checkBlocking();
        if(! $this->blocked) {
            $this->block();
        } else {
            $this->user1->blocks()->detach($this->user2->id);
            $this->loadBlocking();
            UserUnblocked::dispatch($this->user1, $this->user2);
            $this->dispatch('alert', 'success', 'Successfully unblock ' . $this->user2->username);
        }
    }
    public function checkBlocking()
    {
        $this->blocked = $this->user1->blocks->contains($this->user2->id);
    }
    public function loadBlocking()
    {
        $this->mount($this->user1, $this->user2, $this->preferences);
    }
    public function testLoadBlocking()
    {
        dd('yes');
    }
    public function getListeners()
    {
        return [
            "echo-private:BlockUnblockButton.{$this->user1->id}.{$this->user2->id},UserFollowed" => 'loadBlocking',
            "echo-private:BlockUnblockButton.{$this->user1->id}.{$this->user2->id},UserUnblocked" => 'loadBlocking',
        ];
    }
}
