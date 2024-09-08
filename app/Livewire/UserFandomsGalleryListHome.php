<?php

namespace App\Livewire;

use App\Models\Gallery;
use App\Models\Publish;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserFandomsGalleryListHome extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $preferences = [];
    public function render()
    {
        $user = User::with(['members.fandom'])->find(Auth::id());
        $fandom_ids = [];
        foreach ($user->members as $member) {
            $fandom_ids[] = $member->fandom->id;
        }
        $fandom_publishes = Publish::has('gallery')->where('publishable_type', 'APP\Models\Fandom')->whereIn('publishable_id', $fandom_ids)->whereIn('visible', ['member', 'public'])->latest()->get();
        $fandom_publish_ids = $fandom_publishes->unique('publishable_id')->pluck('id')->toArray();
        $fandom_galleries = Gallery::whereHas('publish', function (Builder $query) use ($fandom_publish_ids) {
            $query->whereIn('id',$fandom_publish_ids);
        })->get();
        $galleries = $fandom_galleries;
        $galleries = Gallery::latest()->whereIn('publish_id', $galleries->pluck('publish.id'))->simplePaginate(6, pageName: 'galleries-page');
        return view('livewire.user-fandoms-gallery-list-home', [
            'galleries' => $galleries,
        ]);
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
    }
}
