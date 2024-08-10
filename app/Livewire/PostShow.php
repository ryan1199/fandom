<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Rate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class PostShow extends Component
{
    public $preferences = [];
    #[Locked]
    public $post;
    public function render()
    {
        return view('livewire.post-show')->title($this->post->title);
    }
    public function mount(Post $post)
    {
        if (Auth::check()) {
            $this->authorize('view', $post);
            $this->preferences = session()->get('preference-' . Auth::user()->username);
        } else {
            $this->preferences = [
                'color_1' => 'pink',
                'color_2' => 'rose',
                'color_3' => 'red',
                'font_size' => 16,
                'selected_font_family' => 'mono',
                'dark_mode' => false,
            ];
        }
        Post::where('id', $post->id)->update([
            'view' => $post->view+1
        ]);
        $this->loadPost($post);
    }
    public function loadPost(Post $post)
    {
        $this->post = Post::with(['user.profile','user.avatar.image','user.cover.image','publish.publishable','comments','rates.user'])->find($post->id);
    }
    #[On('like_post')]
    public function likePost()
    {
        $rate = Rate::where('rateable_type', "App\Models\Post")->where('rateable_id', $this->post->id)->where('user_id', Auth::id())->first();
        if($rate == null) {
            DB::transaction(function () use ($rate) {
                $rate = new Rate([
                    'user_id' => Auth::id(),
                    'like' => true,
                    'dislike' => false
                ]);
                $post = Post::find($this->post->id);
                $post->rates()->save($rate);
            });
            $this->dispatch('alert','success', 'Done, you liked this post');
        } else {
            if ($rate->dislike == true) {
                Rate::where('id', $rate->id)->update([
                    'like' => true,
                    'dislike' => false
                ]);
                $this->dispatch('alert','success', 'Done, you liked this post');
            } else {
                $this->dispatch('alert','error', 'Error, you already liked this post');
            }
        }
        $this->loadPost($this->post);
    }
    #[On('dislike_post')]
    public function dislikePost()
    {
        $rate = Rate::where('rateable_type', "App\Models\Post")->where('rateable_id', $this->post->id)->where('user_id', Auth::id())->first();
        if($rate == null) {
            DB::transaction(function () use ($rate) {
                $rate = new Rate([
                    'user_id' => Auth::id(),
                    'like' => false,
                    'dislike' => true
                ]);
                $post = Post::find($this->post->id);
                $post->rates()->save($rate);
            });
            $this->dispatch('alert','success', 'Done, you disliked this post');
        } else {
            if($rate->like == true) {
                Rate::where('id', $rate->id)->update([
                    'like' => false,
                    'dislike' => true
                ]);
                $this->dispatch('alert','success', 'Done, you disliked this post');
            } else {
                $this->dispatch('alert','error', 'Error, you already disliked this post');
            }
        }
        $this->loadPost($this->post);
    }
}
