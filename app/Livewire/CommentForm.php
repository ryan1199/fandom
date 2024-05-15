<?php

namespace App\Livewire;

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

class CommentForm extends Component
{
    #[Locked]
    public $from;
    #[Locked]
    public $id;
    public $content = "";
    public $reply;
    public $comment = null;
    public $preferences = [];
    public function render()
    {
        return view('livewire.comment-form');
    }
    public function submitComment()
    {
        $rules = [
            'content' => 'required',
            'reply' => 'nullable|exists:comments,id'
        ];
        $validated = $this->validate(rules: $rules);
        $from = $this->from;
        $id = $this->id;
        $result = false;
        DB::transaction(function () use ($validated, $from, $id, &$result) {
            $comment = new Comment([
                'reply_to' => $validated['reply'],
                'user_id' => Auth::id()
            ]);
            $message = new Message([
                'text' => $validated['content'],
                'user_id' => Auth::id()
            ]);
            if($from == 'App\Models\Gallery') {
                $gallery = Gallery::find($id);
                $comment = $gallery->comments()->save($comment);
                $message = $comment->message()->save($message);
            } 
            if($from == 'App\Models\Post') {
                $post = Post::find($id);
                $comment = $post->comments()->save($comment);
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
            $this->dispatch('alert','success', 'Done, comment submited');
        } else {
            $this->dispatch('alert', 'error', 'Error, comment not submited');
        }
        $this->reset(['content']);
        $this->dispatch('load_comments')->to(LivewireComment::class);
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
