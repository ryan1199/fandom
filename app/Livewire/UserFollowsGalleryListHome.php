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

class UserFollowsGalleryListHome extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $preferences = [];
    public function render()
    {
        $user = User::with(['follows'])->find(Auth::id());
        $user_ids = $user->follows->pluck('id');
        $user_publishes = Publish::has('gallery')->where('publishable_type', 'APP\Models\User')->whereIn('publishable_id', $user_ids)->whereIn('visible', ['friend', 'public'])->latest()->get();
        $user_publish_ids = $user_publishes->unique('publishable_id')->pluck('id')->toArray();
        $user_galleries = Gallery::whereHas('publish', function (Builder $query) use ($user_publish_ids) {
            $query->whereIn('id',$user_publish_ids);
        })->get();
        $galleries = $user_galleries;
        $galleries = Gallery::latest()->whereIn('publish_id', $galleries->pluck('publish.id'))->simplePaginate(6, pageName: 'galleries-page');
        return view('livewire.user-follows-gallery-list-home', [
            'galleries' => $galleries,
        ]);
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
    }
}
