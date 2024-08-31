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
    public $publish;
    public $views;
    public $likes;
    public $dislikes;
    public $comments;
    public $publisher;
    public $preferences = [];
    public function render()
    {
        return view('livewire.post-card');
    }
    public function mount(Post $post, $preferences)
    {
        $this->post = Post::with(['user.profile','user.avatar.image','user.cover.image','publish.publishable','comments','rates.user'])->find($post->id);
        $this->publish = $this->post->publish;
        $this->views = Number::abbreviate($this->post->view);
        $this->likes = Number::abbreviate(collect($post->rates)->where('like', true)->count());
        $this->dislikes = Number::abbreviate(collect($post->rates)->where('dislike', true)->count());
        if ($post->publish != null) {
            if (class_basename($post->publish->publishable) == 'User') {
                $this->publisher = $this->post->publish->publishable->username;
            } else {
                $this->publisher = $this->post->publish->publishable->name;
            }
        } else {
            $this->publisher = 'Unknown';
        }
        $this->preferences = $preferences;
    }
}
