<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Number;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UsersPostCard extends Component
{
    #[Locked]
    public $post;
    #[Locked]
    public $user;
    public $preferences = [];
    public function render()
    {
        $views = Number::abbreviate($this->post->view);
        $likes = Number::abbreviate($this->post->rates->where('like', true)->count());
        $dislikes = Number::abbreviate($this->post->rates->where('dislike', true)->count());
        $published = $this->post->publish != null ? true : false;
        if ($published) {
            $publisher = 'By ' . $this->user->username;
        } else {
            $publisher = 'Unpublished';
        }
        $hasCover = $this->user->cover != null ? true : false;
        if ($hasCover) {
            $cover = $this->user->cover->image->url;
        }
        return view('livewire.users-post-card', [
            'views' => $views,
            'likes' => $likes,
            'dislikes' => $dislikes,
            'published' => $published,
            'publisher' => $publisher,
            'hasCover' => $hasCover,
            'cover' => $cover,
        ]);
    }
    public function mount(Post $post, User $user, $preferences)
    {
        $this->post = $post;
        $this->user = $user;
        $this->preferences = $preferences;
    }
    public function getListeners()
    {
        return [
            "echo:UsersPostCard.{$this->user->id},UserProfileUpdated" => 'loadCover',
        ];
    }
    public function loadCover($event)
    {
        $user = User::find($event['user']['id']);
        $this->user->cover->image->url = $user->cover->image->url;
    }
}
