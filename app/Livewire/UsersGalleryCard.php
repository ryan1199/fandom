<?php

namespace App\Livewire;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Support\Number;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UsersGalleryCard extends Component
{
    #[Locked]
    public $gallery;
    #[Locked]
    public $user;
    public $preferences = [];
    public function render()
    {
        $views = Number::abbreviate($this->gallery->view);
        $likes = Number::abbreviate($this->gallery->rates->where('like', true)->count());
        $dislikes = Number::abbreviate($this->gallery->rates->where('dislike', true)->count());
        $published = $this->gallery->publish != null ? true : false;
        if ($published) {
            $publisher = 'By ' . $this->user->username;
        } else {
            $publisher = 'Unpublished';
        }
        $hasCover = $this->user->cover != null ? true : false;
        if ($hasCover) {
            $cover = $this->user->cover->image->url;
        }
        return view('livewire.users-gallery-card', [
            'views' => $views,
            'likes' => $likes,
            'dislikes' => $dislikes,
            'published' => $published,
            'publisher' => $publisher,
            'hasCover' => $hasCover,
            'cover' => $cover,
        ]);
    }
    public function mount(Gallery $gallery, User $user, $preferences)
    {
        $this->gallery = $gallery;
        $this->user = $user;
        $this->preferences = $preferences;
    }
    // updated user profile
}
