<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\ChatUser;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChatDetails extends Component
{
    public $chat;
    public $messages;
    public $open_chat = false;
    public $user;
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
    }
    public function getListeners()
    {
        return [
            "echo-private:NewChatMessage.{$this->chat->id},NewChatMessage" => 'newMessage',
        ];
    }
    public function newMessage($event)
    {
        $message = Message::with(['user'])->find($event['message']['id']);
        $this->messages->prepend($message);
    }
}
