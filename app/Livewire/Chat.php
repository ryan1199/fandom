<?php

namespace App\Livewire;

use App\Models\Chat as ModelsChat;
use App\Models\ChatUser;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chat extends Component
{
    public $chats;
    public $preferences = [];
    public function render()
    {
        return view('livewire.chat');
    }
}
