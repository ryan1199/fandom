<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Number;
use Livewire\Attributes\Locked;
use Livewire\Component;

class PostCard extends Component
{
    #[Locked]
    public $post;
    public $views;
    public $likes;
    public $dislikes;
    public $comments;
    public $preferences = [];
    public function render()
    {
        return view('livewire.post-card');
    }
    public function mount(Post $post, $preferences)
    {
        $this->post = Post::with(['user.profile','user.avatar.image','user.cover.image','publish.publishable','comments','rates.user'])->find($post->id);
        $this->views = Number::abbreviate($this->post->view);
        $this->likes = Number::abbreviate(collect($post->rates)->where('like', true)->count());
        $this->dislikes = Number::abbreviate(collect($post->rates)->where('dislike', true)->count());
        $this->preferences = $preferences;
    }
}
