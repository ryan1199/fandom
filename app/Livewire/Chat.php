<?php

namespace App\Livewire;

use App\Models\Chat as ModelsChat;
use App\Models\ChatUser;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Chat extends Component
{
    #[Locked]
    public $user;
    public $chats;
    public $preferences = [];
    public function render()
    {
        return view('livewire.chat');
    }
    public function mount(User $user, $preferences)
    {
        $this->user = $user;
        $this->preferences = $preferences;
        $this->loadChats();
    }
    public function getListeners()
    {
        return [
            "echo-private:Chat.{$this->user->id},NewChatMessage" => 'loadChats',
            "echo-private:Chat.{$this->user->id},NewChat" => 'loadChats',
        ];
    }
    public function loadChats()
    {
        $user = User::with(['chats' => function ($query) {
            $query->orderByDesc('updated_at');
        }])->find($this->user->id);
        $this->chats = $user->chats;
    }
}
