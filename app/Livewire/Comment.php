<?php

namespace App\Livewire;

use App\Models\Comment as ModelsComment;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Comment extends Component
{
    public $comments;
    #[Locked]
    public $from;
    #[Locked]
    public $id;
    public $preferences = [];
    public function render()
    {
        return view('livewire.comment');
    }
    public function mount($preferences, $from, $id)
    {
        $this->preferences = $preferences;
        $this->from = $from;
        $this->id = $id;
    }
}
