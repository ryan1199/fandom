<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Post;
use Illuminate\Support\Number;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FandomsPostCard extends Component
{
    #[Locked]
    public $post;
    #[Locked]
    public $fandom;
    public $preferences = [];
    public function render()
    {
        $views = Number::abbreviate($this->post->view);
        $likes = Number::abbreviate($this->post->rates->where('like', true)->count());
        $dislikes = Number::abbreviate($this->post->rates->where('dislike', true)->count());
        $published = $this->post->publish != null ? true : false;
        if ($published) {
            $publisher = 'By ' . $this->fandom->name;
        } else {
            $publisher = 'Unpublished';
        }
        $hasCover = $this->fandom->cover != null ? true : false;
        if ($hasCover) {
            $cover = $this->fandom->cover->image->url;
        }
        return view('livewire.fandoms-post-card', [
            'views' => $views,
            'likes' => $likes,
            'dislikes' => $dislikes,
            'published' => $published,
            'publisher' => $publisher,
            'hasCover' => $hasCover,
            'cover' => $cover,
        ]);
    }
    public function mount(Post $post, Fandom $fandom, $preferences)
    {
        $this->post = $post;
        $this->fandom = $fandom;
        $this->preferences = $preferences;
    }
    public function getListeners()
    {
        return [
            "echo:FandomsPostCard.{$this->fandom->id},FandomUpdated" => 'loadCover',
        ];
    }
    public function loadCover($event)
    {
        $fandom = Fandom::find($event['fandom']['id']);
        $this->fandom->cover->image->url = $fandom->cover->image->url;
    }
}
