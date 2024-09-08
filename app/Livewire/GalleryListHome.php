<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Publish;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Number;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class GalleryListHome extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $preferences = [];
    public function render()
    {
        $user_ids = User::pluck('id');
        $fandom_ids = Fandom::pluck('id');
        $user_publishes = Publish::has('gallery')->where('publishable_type', 'APP\Models\User')->whereIn('publishable_id', $user_ids)->where('visible', 'public')->latest()->get();
        $user_publish_ids = $user_publishes->unique('publishable_id')->pluck('id')->toArray();
        $user_galleries = Gallery::whereHas('publish', function (Builder $query) use ($user_publish_ids) {
            $query->whereIn('id',$user_publish_ids);
        })->get();
        $fandom_publishes = Publish::has('gallery')->where('publishable_type', 'APP\Models\Fandom')->whereIn('publishable_id', $fandom_ids)->where('visible', 'public')->latest()->get();
        $fandom_publish_ids = $fandom_publishes->unique('publishable_id')->pluck('id')->toArray();
        $fandom_galleries = Gallery::whereHas('publish', function (Builder $query) use ($fandom_publish_ids) {
            $query->whereIn('id',$fandom_publish_ids);
        })->get();
        $galleries = $user_galleries->merge($fandom_galleries);
        $galleries = Gallery::latest()->whereIn('publish_id', $galleries->pluck('publish.id'))->simplePaginate(6, pageName: 'galleries-page');
        return view('livewire.gallery-list-home', [
            'galleries' => $galleries,
        ]);
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
    }
}
