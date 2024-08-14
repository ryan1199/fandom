<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Post;
use Illuminate\Support\Number;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FandomList extends Component
{
    #[Locked]
    public $fandom;
    public $totalMembers;
    public $totalGalleries;
    public $totalPosts;
    public $preferences = [];
    public function render()
    {
        return view('livewire.fandom-list');
    }
    public function mount(Fandom $fandom, $preferences)
    {
        $this->fandom = Fandom::with([
            'avatar' => [
                'image'
            ],
            'cover' => [
                'image'
            ],
            'members' => [
                'user' => [
                    'profile',
                    'cover' => [
                        'image'
                    ],
                    'avatar' => [
                        'image'
                    ],
                ],
                'role'
            ],
        ])->find($fandom->id);
        $this->preferences = $preferences;
        $this->getTotalMembers();
        $this->getTotalGalleries();
        $this->getTotalPosts();
    }
    public function getTotalMembers()
    {
        $this->totalMembers = Number::abbreviate(count($this->fandom->members));
    }
    public function getTotalGalleries()
    {
        $this->fandom->load('publishes');
        $fandom_publish_ids = $this->fandom->publishes->pluck('id')->toArray();
        $this->totalGalleries = Number::abbreviate(Gallery::whereIn('publish_id', $fandom_publish_ids)->count());
    }
    public function getTotalPosts()
    {
        $this->fandom->load('publishes');
        $fandom_publish_ids = $this->fandom->publishes->pluck('id')->toArray();
        $this->totalPosts = Number::abbreviate(Post::whereIn('publish_id', $fandom_publish_ids)->count());
    }
}
