<?php

namespace App\Livewire;

use App\Events\NewGalleryComment;
use App\Events\NewPostComment;
use App\Livewire\Comment as LivewireComment;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class CommentForm extends Component
{
    #[Locked]
    public $post;
    #[Locked]
    public $gallery;
    public $content = "";
    public $reply;
    public $comment = null;
    public $preferences = [];
    public function render()
    {
        return view('livewire.comment-form');
    }
    public function mount($preferences, $post = null, $gallery = null, $reply = null)
    {
        $this->preferences = $preferences;
        $this->post = $post;
        $this->gallery = $gallery;
        $this->reply = $reply;
    }
    public function submitComment()
    {
        $rules = [
            'content' => 'required',
            'reply' => 'nullable|exists:comments,id'
        ];
        $validated = $this->validate(rules: $rules);
        $result = false;
        DB::transaction(function () use ($validated, &$result) {
            $comment = new Comment([
                'reply_to' => $validated['reply'],
                'user_id' => Auth::id()
            ]);
            $content = Str::of($validated['content'])->markdown();
            $content = clean($content);
            $message = new Message([
                'text' => $content,
                'user_id' => Auth::id()
            ]);
            if($this->post != null) {
                $comment = $this->post->comments()->save($comment);
                $message = $comment->message()->save($message);
            }
            if($this->gallery != null) {
                $comment = $this->gallery->comments()->save($comment);
                $message = $comment->message()->save($message);
            }
            if($validated['reply'] != null) {
                $comment = Comment::find($validated['reply']);
                Comment::where('id', $validated['reply'])->update([
                    'replied' => $comment->replied + 1
                ]);
            }
            $result = true;
        });
        if ($result) {
            if ($this->post != null) {
                NewPostComment::dispatch($this->post);
            }
            if ($this->gallery!= null) {
                NewGalleryComment::dispatch($this->gallery);
            }
            $this->dispatch('alert','success', 'Done, comment submited');
        } else {
            $this->dispatch('alert', 'error', 'Error, comment not submited');
        }
        $this->reset(['content']);
    }
    #[On('reply_comment')]
    public function replyComment($id)
    {
        $this->comment = Comment::with(['user.cover.image', 'user.avatar.image', 'message', 'rates.user'])->find($id);
        $this->reply = $id;
        $this->content = $this->comment->user->username . ' ';
    }
    public function cancelReply()
    {
        $this->comment = null;
        $this->reply = null;
        $this->content = "";
    }
}
