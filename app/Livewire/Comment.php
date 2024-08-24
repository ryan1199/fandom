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
    public $post;
    #[Locked]
    public $gallery;
    #[Locked]
    public $available_sorting = ['Latest', 'Old', 'Like', 'Dislike'];
    public $sorting = 'Latest';
    public $preferences = [];
    public function render()
    {
        return view('livewire.comment');
    }
    public function mount($preferences, $post = null, $gallery = null)
    {
        $this->preferences = $preferences;
        $this->post = $post;
        $this->gallery = $gallery;
        $this->loadComments();
    }
    public function loadComments()
    {
        if ($this->post != null) {
            $this->post->load(['comments']);
            $this->comments = $this->post->comments->load(['user.cover.image', 'user.avatar.image', 'message', 'rates.user']);
        }
        if ($this->gallery != null) {
            $this->gallery->load(['comments']);
            $this->comments = $this->gallery->comments->load(['user.cover.image', 'user.avatar.image', 'message', 'rates.user']);
        }
        // $this->comments = ModelsComment::with(['user.cover.image', 'user.avatar.image', 'message', 'rates.user'])->where('commentable_id', $this->id)->where('commentable_type', $this->from)->get();
        $this->sortComments();
    }
    public function loadMissingComments()
    {
        if ($this->post != null) {
            $this->post->loadMissing(['comments']);
            $this->comments = $this->post->comments->loadMissing(['user.cover.image', 'user.avatar.image', 'message', 'rates.user']);
        }
        if ($this->gallery != null) {
            $this->gallery->loadMissing(['comments']);
            $this->comments = $this->gallery->comments->loadMissing(['user.cover.image', 'user.avatar.image', 'message', 'rates.user']);
        }
        $this->sortComments();
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
    #[On('delete_comment')]
    public function deleteComment($id)
    {
        $comment = ModelsComment::find($id);
        $this->authorize('delete', $comment);
        Message::where('messageable_type', "App\Models\Comment")->where('messageable_id', $id)->update([
            'text' => "<p><em>deleted comment</em></p>"
        ]);
        $this->dispatch('alert','success', 'Done, you delete the comment');
        $this->loadComments();
    }
    public function updatedSorting()
    {
        if(in_array($this->sorting, $this->available_sorting)) {
            $this->sortComments();
        } else {
            $this->dispatch('alert','error', 'Error, invalid sorting');
        }
    }
    public function sortComments()
    {
        switch($this->sorting) {
            case 'Latest':
                $sorted_comments = collect($this->comments)->sortByDesc('created_at');
                break;
            case 'Old':
                $sorted_comments = collect($this->comments)->sortBy('created_at');
                break;
            case 'Like':
                $sorted_comments = collect($this->comments)->sortByDesc(function (ModelsComment $comment) {
                    return $comment->rates->sum('like');
                });
                break;
            case 'Dislike':
                $sorted_comments = collect($this->comments)->sortByDesc(function (ModelsComment $comment) {
                    return $comment->rates->sum('dislike');
                });
                break;
        }
        $this->comments = $sorted_comments->values()->all();
    }
    public function getListeners()
    {
        if ($this->post != null) {
            return [
                "echo-private:Comment.{$this->post->id},NewPostComment" => 'loadMissingComments',
            ];
        }
        if ($this->gallery!= null) {
            return [
                "echo-private:Comment.{$this->gallery->id},NewGalleryComment" => 'loadMissingComments',
            ];
        }
    }
}
