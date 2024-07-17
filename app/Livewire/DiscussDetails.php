<?php

namespace App\Livewire;

use App\Events\DeleteDiscussion;
use App\Events\ResetDiscussion;
use App\Models\Discuss;
use App\Models\Fandom;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class DiscussDetails extends Component
{
    #[Locked]
    public $discuss;
    public $openDiscuss = false;
    public $messages;
    #[Locked]
    public $fandom;
    public $managers = [];
    public $preferences = [];
    public function render()
    {
        return view('livewire.discuss-details');
    }
    public function mount(Discuss $discuss, $preferences)
    {
        $this->discuss = $discuss;
        $this->loadLatestMessages();
        $this->fandom = $discuss->fandom;
        $members = collect($this->fandom->members);
        $managers = $members->where('role.name', 'Manager');
        $this->managers = $managers->pluck('user.id')->toArray();
        $this->preferences = $preferences;
    }
    public function loadLatestMessages()
    {
        $this->messages = collect($this->discuss->messages)->reverse();
    }
    public function deleteDiscuss()
    {
        $this->authorize('delete', [Discuss::class, $this->discuss, $this->fandom]);
        $status = false;
        DB::transaction(function () use (&$status) {
            $this->discuss->messages()->delete();
            $this->discuss->delete();
            $status = true;
        });
        if($status) {
            $this->dispatch('alert','success', 'Done, the discuss has been deleted');
            DeleteDiscussion::dispatch($this->fandom);
        } else {
            $this->dispatch('alert','error', 'Error, the discuss has not been deleted');
        }
    }
    public function resetDiscuss()
    {
        $this->authorize('reset', [Discuss::class, $this->discuss, $this->fandom]);
        $status = false;
        DB::transaction(function () use (&$status) {
            $this->discuss->messages()->delete();
            $status = true;
        });
        if($status) {
            $this->dispatch('alert','success', 'Done, the discuss has been reset');
            ResetDiscussion::dispatch($this->discuss);
        } else {
            $this->dispatch('alert','error', 'Error, the discuss has not been reseted');
        }
    }
    public function getListeners()
    {
        return [
            "echo-private:NewDiscussionMessage.{$this->discuss->id},NewDiscussionMessage" => 'newMessage',
            "echo-private:ResetDiscussion.{$this->discuss->id},ResetDiscussion" => 'loadLatestMessages',
        ];
    }
    public function newMessage($event)
    {
        $message = Message::with(['user'])->find($event['message']['id']);
        $this->messages->prepend($message);
    }
    #[On('openDiscuss')]
    public function openDiscuss($discuss_id) {
        if($discuss_id == $this->discuss->id) {
            $this->openDiscuss = ! $this->openDiscuss;
        }
    }
}
