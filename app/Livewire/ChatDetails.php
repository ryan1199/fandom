<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\ChatUser;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class ChatDetails extends Component
{
    #[Locked]
    public $chat;
    public $messages;
    public $openChat = false;
    #[Locked]
    public $user;
    #[Locked]
    public $user_ids = [];
    public $preferences = [];
    public function render()
    {
        return view('livewire.chat-details');
    }
    public function mount(Chat $chat, $preferences)
    {
        $this->chat = $chat;
        $this->messages = collect($this->chat->messages)->reverse();
        $this->user = $this->chat->users->where('id', '!=', Auth::id())->first();
        $this->preferences = $preferences;
        $this->user_ids = $this->chat->users->pluck('id')->toArray();
    }
    public function getListeners()
    {
        return [
            "echo-private:ChatDetails.{$this->chat->id},NewChatMessage" => 'newMessage',
        ];
    }
    public function newMessage($event)
    {
        $message = Message::with(['user'])->find($event['message']['id']);
        $this->messages->prepend($message);
    }
    #[On('openChat')]
    public function openChat($chat_id) {
        if($chat_id == $this->chat->id) {
            $this->openChat = ! $this->openChat;
        }
    }
}
