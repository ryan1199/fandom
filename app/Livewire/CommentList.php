<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Attributes\On;
use Livewire\Component;

class CommentList extends Component
{
    public $comments;
    public $from;
    public $id;
    public $reply = null;
    public $preferences = [];
    public function render()
    {
        return view('livewire.comment-list');
    }
    public function mount($preferences, $from, $id, $reply)
    {
        $this->preferences = $preferences;
        $this->from = $from;
        $this->id = $id;
        $this->reply = $reply;
        $this->loadComment();
    }
    #[On('load_comment')]
    public function loadComment()
    {
        if($this->reply == null) {
            $this->comments = Comment::with(['user.cover.image', 'user.avatar.image', 'message'])->where('commentable_id', $this->id)->where('reply_to', null)->get();
        } else {
            $this->comments = Comment::with(['user.cover.image', 'user.avatar.image', 'message'])->where('commentable_id', $this->id)->where('reply_to', $this->reply)->get();
        }
    }
}
