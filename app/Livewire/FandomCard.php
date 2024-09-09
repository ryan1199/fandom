<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Post;
use Illuminate\Support\Number;
use Livewire\Component;

class FandomCard extends Component
{
    public $fandom;
    public $preferences = [];
    public function render()
    {
        $cover = $this->fandom->cover->image->url;
        $name = $this->fandom->name;
        $description = $this->fandom->description;
        $totalMembers = Number::abbreviate(count($this->fandom->members));
        $fandom_publish_ids = $this->fandom->publishes->pluck('id')->toArray();
        $totalGalleries = Number::abbreviate(Gallery::whereIn('publish_id', $fandom_publish_ids)->count());
        $totalPosts = Number::abbreviate(Post::whereIn('publish_id', $fandom_publish_ids)->count());
        return view('livewire.fandom-card', [
            'cover' => $cover,
            'name' => $name,
            'description' => $description,
            'totalMembers' => $totalMembers,
            'totalGalleries' => $totalGalleries,
            'totalPosts' => $totalPosts,
        ]);
    }
    public function mount(Fandom $fandom, $preferences)
    {
        $this->fandom = $fandom;
        $this->preferences = $preferences;
    }
    public function loadUpdatedFandom($event)
    {
        $fandom = Fandom::find($event['fandom']['id']);
        $this->fandom = $fandom;
        $this->fandom->cover->image->url = $fandom->cover->image->url;
    }
    public function getListeners()
    {
        return [
            "echo:FandomCard.{$this->fandom->id},FandomUpdated" => 'loadUpdatedFandom',
        ];
    }
}
