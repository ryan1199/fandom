<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Component;

class CommentForm extends Component
{
    #[Locked]
    public $from;
    #[Locked]
    public $id;
    public $content = "";
    public $reply = null;
    public $preferences = [];
    public function render()
    {
        return view('livewire.comment-form');
    }
    public function mount($preferences, $from, $id, $reply)
    {
        $this->preferences = $preferences;
        $this->from = $from;
        $this->id = $id;
        $this->reply = $reply;
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
        DB::transaction(function () use ($validated, $from, $id) {
            $comment = new Comment([
                'reply_to' => $validated['reply'],
                'user_id' => Auth::id()
            ]);
            $message = new Message([
                'text' => $validated['content'],
                'user_id' => Auth::id()
            ]);
            if($from == 'gallery') {
                $gallery = Gallery::find($id);
                $comment = $gallery->comments()->save($comment);
                $message = $comment->message()->save($message);
            } 
            if($from == 'post') {
                $post = Post::find($id);
                $comment = $post->comments()->save($comment);
                $message = $comment->message()->save($message);
            }
            if($validated['reply'] != null) {
                Comment::where('id', $validated['reply'])->update([
                    'replied' => true
                ]);
            }
        });
        $this->reset(['content']);
        $this->dispatch('alert', 'success', 'Done, comment submited');
        $this->dispatch('load_comment')->to(CommentList::class);
    }
}
