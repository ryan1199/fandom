<?php

namespace App\Livewire;

use Illuminate\Support\Number;
use Livewire\Component;

class CommentDetails extends Component
{
    public $comment;
    public $comments;
    public $totalLikes;
    public $totalDislikes;
    public $totalComments;
    public $reply;
    public $preferences = [];
    public function render()
    {
        return view('livewire.comment-details');
    }
    public function mount($comment, $comments, $reply, $preferences)
    {
        $this->comment = $comment;
        $this->comments = $comments;
        $this->reply = $reply;
        $this->totalLikes = Number::abbreviate(collect($comment->rates)->where('like', true)->count());
        $this->totalDislikes = Number::abbreviate(collect($comment->rates)->where('dislike', true)->count());
        $this->totalComments = Number::abbreviate($comment->replied);
        $this->preferences = $preferences;
    }
}
