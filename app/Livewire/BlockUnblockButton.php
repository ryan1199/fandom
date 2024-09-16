<?php

namespace App\Livewire;

use App\Events\UserBlocked;
use App\Events\UserUnblocked;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
    public function mount(User $user1, User $user2, $preferences)
    {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->checkBlocking();
        $this->preferences = $preferences;
    }
    public function block()
    {
        if($this->blocked) {
            $this->unblock();
        } else {
            $result = false;
            DB::transaction(function () use (&$result) {
                $this->user1->blocks()->attach($this->user2->id);
                $this->user1->follows()->detach($this->user2->id);
                $this->user1->logs()->create([
                    'message' => 'You block '. $this->user2->username
                ]);
                $this->user2->logs()->create([
                    'message' => $this->user1->username . ' blocks you'
                ]);
                $result = true;
            });
            if ($result) {
                UserBlocked::dispatch($this->user1, $this->user2);
                $this->dispatch('alert', 'success', 'Successfully block ' . $this->user2->username);
            } else {
                $this->dispatch('alert', 'error', 'Error, failed to block ' . $this->user2->username . ', please try again later');
            }
        }
        $this->checkBlocking();
    }
    public function unblock()
    {
        if(! $this->blocked) {
            $this->block();
        } else {
            $result = false;
            DB::transaction(function () use (&$result) {
                $this->user1->blocks()->detach($this->user2->id);
                $this->user1->logs()->create([
                    'message' => 'You unblock '. $this->user2->username
                ]);
                $this->user2->logs()->create([
                    'message' => $this->user1->username . ' unblocks you'
                ]);
                $result = true;
            });
            if ($result) {
                UserUnblocked::dispatch($this->user1, $this->user2);
                $this->dispatch('alert', 'success', 'Successfully unblock ' . $this->user2->username);
            } else {
                $this->dispatch('alert', 'error', 'Error, failed to unblock ' . $this->user2->username . ', please try again later');
            }
        }
        $this->checkBlocking();
    }
    public function checkBlocking()
    {
        $this->blocked = $this->user1->blocks->contains($this->user2->id);
    }
    public function loadBlocking()
    {
        $this->mount($this->user1, $this->user2, $this->preferences);
    }
    public function getListeners()
    {
        return [
            "echo-private:BlockUnblockButton.{$this->user1->id}.{$this->user2->id},UserFollowed" => 'loadBlocking',
            "echo-private:BlockUnblockButton.{$this->user1->id}.{$this->user2->id},UserUnblocked" => 'loadBlocking',
        ];
    }
}
