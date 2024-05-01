<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Component;

class GalleryShow extends Component
{
    public $preferences = [];
    #[Locked]
    public $gallery;
    #[Locked]
    public $recommends;
    public function render()
    {
        return view('livewire.gallery-show')->title($this->gallery->tags);
    }
    public function mount(Gallery $gallery)
    {
        if (Auth::check()) {
            $this->preferences = session()->get('preference-' . Auth::user()->username);
        } else {
            $this->preferences = [
                'color_1' => '#f97316',
                'color_2' => '#ec4899',
                'color_3' => '#6366f1',
                'color_primary' => '#ffffff',
                'color_secondary' => '#000000',
                'color_text' => '#000000',
                'font_size' => 16,
                'selected_font_family' => 'mono',
                'create_fandom_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'account_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'profile_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'preference_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ]
            ];
        }
        $this->gallery = Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable'])->find($gallery->id);
        if(class_basename($this->gallery->publish->publishable_type) === 'User') {
            $user = User::with(['publishes'])->find($this->gallery->user->id);
            $this->recommends = [
                'user' => collect(Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable'])->whereIn('publish_id', $user->publishes->pluck('id'))->get())->take(10),
                'fandom' => null
            ];
        }
        if(class_basename($this->gallery->publish->publishable_type) === 'Fandom') {
            $fandom = Fandom::with(['publishes'])->find($this->gallery->publish->publishable_id);
            $user = User::with(['publishes'])->find($this->gallery->user->id);
            $this->recommends = [
                'user' => collect(Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable'])->whereIn('publish_id', $user->publishes->pluck('id'))->get())->take(10),
                'fandom' => collect(Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable'])->whereIn('publish_id', $fandom->publishes->pluck('id'))->get())->take(10)
            ];
        }
        $tags = Str::of($this->gallery->tags)->explode(',');
        $this->recommends['tags'] = collect(Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable'])->where(function (Builder $query) use($tags) {
            foreach($tags as $tag) {
                $query->orWhere('tags', 'like', '%'.$tag.'%');
            }
        })->get())->take(10);
        Gallery::where('id', $this->gallery->id)->update([
            'view' => $this->gallery->view+1
        ]);
    }
}
