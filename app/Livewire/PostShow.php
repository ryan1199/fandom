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
        if(Auth::check()) {
            $this->authorize('view', $post);
        }
        if (Auth::check()) {
            $this->preferences = session()->get('preference-' . Auth::user()->username);
        } else {
            $this->preferences = [
                'color_1' => '#f97316',
                'color_2' => '#ec4899',
                'color_3' => '#6366f1',
                'color_primary' => '#ffffff',
                'color_secondary' => '#000000',
                'color_text' => '#000000',
                'font_size' => 16,
                'selected_font_family' => 'mono',
                'create_fandom_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'account_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'profile_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'preference_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ]
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
    public function likepost()
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
    public function dislikepost()
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
