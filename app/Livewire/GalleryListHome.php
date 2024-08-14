<?php

namespace App\Livewire;

use App\Models\Gallery;
use Illuminate\Support\Number;
use Livewire\Component;

class GalleryListHome extends Component
{
    public $gallery;
    public $views;
    public $likes;
    public $dislikes;
    public $comments;
    public $publisher;
    public $preferences = [];
    public function render()
    {
        return view('livewire.gallery-list-home');
    }
    public function mount(Gallery $gallery, $preferences)
    {
        $this->gallery = Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable','comments','rates.user'])->find($gallery->id);
        $this->views = Number::abbreviate($this->gallery->view);
        $this->likes = Number::abbreviate($this->gallery->rates()->where('like', 1)->get()->count());
        $this->dislikes = Number::abbreviate($this->gallery->rates()->where('dislike', 1)->get()->count());
        if (class_basename($gallery->publish->publishable) == 'User') {
            $this->publisher = $this->gallery->publish->publishable->username;
        } else {
            $this->publisher = $this->gallery->publish->publishable->name;
        }
        $this->preferences = $preferences;
    }
}
