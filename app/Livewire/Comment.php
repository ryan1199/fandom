<?php

namespace App\Livewire;

use App\Models\Comment as ModelsComment;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Post;
use App\Models\Rate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
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
        $this->loadComments();
    }
    #[On('load_comments')]
    public function loadComments()
    {
        $this->comments = ModelsComment::with(['user.cover.image', 'user.avatar.image', 'message', 'rates.user'])->where('commentable_id', $this->id)->where('commentable_type', $this->from)->get();
    }
    #[On('like_comment')]
    public function likeComment($id)
    {
        $rate = Rate::where('rateable_type', "App\Models\Comment")->where('rateable_id', $id)->where('user_id', Auth::id())->first();
        if($rate == null) {
            DB::transaction(function () use ($rate, $id) {
                $rate = new Rate([
                    'user_id' => Auth::id(),
                    'like' => true,
                    'dislike' => false
                ]);
                $comment = ModelsComment::find($id);
                $comment->rates()->save($rate);
            });
            $this->dispatch('alert','success', 'Done, you liked this comment');
        } else {
            if ($rate->dislike == true) {
                Rate::where('id', $rate->id)->update([
                    'like' => true,
                    'dislike' => false
                ]);
                $this->dispatch('alert','success', 'Done, you liked this comment');
            } else {
                $this->dispatch('alert','error', 'Error, you already liked this comment');
            }
        }
        $this->loadComments();
    }
    #[On('dislike_comment')]
    public function dislikeComment($id)
    {
        $rate = Rate::where('rateable_type', "App\Models\Comment")->where('rateable_id', $id)->where('user_id', Auth::id())->first();
        if($rate == null) {
            DB::transaction(function () use ($rate, $id) {
                $rate = new Rate([
                    'user_id' => Auth::id(),
                    'like' => false,
                    'dislike' => true
                ]);
                $comment = ModelsComment::find($id);
                $comment->rates()->save($rate);
            });
            $this->dispatch('alert','success', 'Done, you disliked this comment');
        } else {
            if($rate->like == true) {
                Rate::where('id', $rate->id)->update([
                    'like' => false,
                    'dislike' => true
                ]);
                $this->dispatch('alert','success', 'Done, you disliked this comment');
            } else {
                $this->dispatch('alert','error', 'Error, you already disliked this comment');
            }
        }
        $this->loadComments();
    }
}
