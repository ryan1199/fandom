<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery;
use Illuminate\Support\Number;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FandomsGalleryCard extends Component
{
    #[Locked]
    public $gallery;
    #[Locked]
    public $fandom;
    public $preferences = [];
    public function render()
    {
        $views = Number::abbreviate($this->gallery->view);
        $likes = Number::abbreviate($this->gallery->rates->where('like', true)->count());
        $dislikes = Number::abbreviate($this->gallery->rates->where('dislike', true)->count());
        $published = $this->gallery->publish != null ? true : false;
        if ($published) {
            $publisher = 'By ' . $this->fandom->name;
        } else {
            $publisher = 'Unpublished';
        }
        $hasCover = $this->fandom->cover != null ? true : false;
        if ($hasCover) {
            $cover = $this->fandom->cover->image->url;
        }
        return view('livewire.fandoms-gallery-card', [
            'views' => $views,
            'likes' => $likes,
            'dislikes' => $dislikes,
            'published' => $published,
            'publisher' => $publisher,
            'hasCover' => $hasCover,
            'cover' => $cover,
        ]);
    }
    public function mount(Gallery $gallery, Fandom $fandom, $preferences)
    {
        $this->gallery = $gallery;
        $this->fandom = $fandom;
        $this->preferences = $preferences;
    }
}
