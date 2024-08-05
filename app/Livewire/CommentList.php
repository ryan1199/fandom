<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class CommentList extends Component
{
    public $comments;
    public $reply = null;
    public $preferences = [];
    public function render()
    {
        $child_comments = collect($this->comments)->where('reply_to', $this->reply);
        $comments = $this->comments;
        return view('livewire.comment-list', compact('child_comments', 'comments'));
    }
}
