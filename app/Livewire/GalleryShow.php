<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class GalleryShow extends Component
{
    #[Locked]
    public $gallery;
    #[Locked]
    public $recommends = [
        'user' => null,
        'fandom' => null,
        'tags' => null
    ];
    public $totalLikes;
    public $totalDislikes;
    public $totalComments;
    public $preferences = [];
    public function render()
    {
        return view('livewire.gallery-show')->title($this->gallery->tags);
    }
    public function mount(Gallery $gallery)
    {
        $this->authorize('view', $gallery);
        if (Auth::check()) {
            $this->preferences = session()->get('preference-' . Auth::user()->username);
            Gallery::where('id', $gallery->id)->update([
                'view' => $gallery->view+1
            ]);
        } else {
            $this->preferences = [
                'color_1' => 'pink',
                'color_2' => 'rose',
                'color_3' => 'red',
                'font_size' => 16,
                'selected_font_family' => 'mono',
                'dark_mode' => false,
            ];
        }
        $this->loadGallery($gallery);
        $this->loadRecommendations();
    }
    public function loadGallery(Gallery $gallery)
    {
        $this->gallery = Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable','comments','rates.user'])->find($gallery->id);
        $this->totalLikes = Number::abbreviate(collect($gallery->rates)->where('like', true)->count());
        $this->totalDislikes = Number::abbreviate(collect($gallery->rates)->where('dislike', true)->count());
        $this->totalComments = Number::abbreviate($gallery->comments->count());
    }
    public function loadRecommendations()
    {
        if(Auth::check()) {
            if(class_basename($this->gallery->publish->publishable_type) === 'User') {
                if(Auth::id() == $this->gallery->user->id) {
                    // all visible
                    $user = User::with(['publishes'])->find($this->gallery->user->id);
                } else {
                    // friend or public visibility
                    $user = User::find(Auth::id());
                    $user->load('follows');
                    $followed_user = false;
                    foreach ($user->follows as $follow) {
                        if($follow->id == $this->gallery->user->id) {
                            $followed_user = true;
                            break;
                        }
                    }
                    if($followed_user) {
                        $user = User::with(['publishes' => function ($query) {
                            $query->where('visible', 'friend')->orWhere('visible', 'public');
                        }])->find($this->gallery->user->id);
                    } else {
                        $user = User::with(['publishes' => function ($query) {
                            $query->where('visible', 'public');
                        }])->find($this->gallery->user->id);
                    }
                }
                $this->recommends['user'] = collect(Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable'])->whereIn('publish_id', $user->publishes->pluck('id'))->get())->shuffle()->take(10);
                $this->recommends['user'] = $this->recommends['user']->isEmpty() ? null : $this->recommends['user'];
            }
            if(class_basename($this->gallery->publish->publishable_type) === 'Fandom') {
                $fandom = Fandom::with(['publishes', 'members.user'])->find($this->gallery->publish->publishable_id);
                $users = collect($fandom->members);
                $members['id'] = $users->pluck('user.id')->toArray();
                $galleries = collect(Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable'])->whereIn('publish_id', $fandom->publishes->pluck('id'))->get())->shuffle()->take(10);
                if(in_array(Auth::id(), $members['id'])) {
                    $this->recommends['fandom'] = collect($galleries);
                } else {
                    $this->recommends['fandom'] = collect($galleries)->where('publish.visible', 'public');
                }
                $this->recommends['fandom'] = $this->recommends['fandom']->isEmpty() ? null : $this->recommends['fandom'];
                if(Auth::id() == $this->gallery->user->id) {
                    $user = User::with(['publishes'])->find($this->gallery->user->id);
                } else {
                    $user = User::find(Auth::id());
                    $user->load('follows');
                    $followed_user = false;
                    foreach ($user->follows as $follow) {
                        if($follow->id == $this->gallery->user->id) {
                            $followed_user = true;
                            break;
                        }
                    }
                    if($followed_user) {
                        $user = User::with(['publishes' => function ($query) {
                            $query->where('visible', 'friend')->orWhere('visible', 'public');
                        }])->find($this->gallery->user->id);
                    } else {
                        $user = User::with(['publishes' => function ($query) {
                            $query->where('visible', 'public');
                        }])->find($this->gallery->user->id);
                    }
                }
                $this->recommends['user'] = collect(Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable'])->whereIn('publish_id', $user->publishes->pluck('id'))->get())->shuffle()->take(10);
                $this->recommends['user'] = $this->recommends['user']->isEmpty() ? null : $this->recommends['user'];
            }
            $tags = Str::of($this->gallery->tags)->explode(',');
            $galleries = Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable'])->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->get();
            $fandom_galleries_member = [];
            $fandom_galleries_public = [];
            $fandom_ids = collect($galleries)->where('publish.publishable_type', "App\Models\Fandom")->pluck('publish.publishable_id')->unique();
            $fandoms = Fandom::with('members.user')->whereIn('id', $fandom_ids)->get();
            foreach($fandoms as $fandom) {
                $members['id'] = collect($fandom->members)->pluck('user.id')->toArray();
                if(in_array(Auth::id(), $members['id'])) {
                    $fandom_galleries_member[] = $fandom->id;
                } else {
                    $fandom_galleries_public[] = $fandom->id;
                }
            }
            $member_galleries = collect($galleries)->where('publish.publishable_type', "App\Models\Fandom")->whereIn('publish.publishable_id', $fandom_galleries_member);
            $public_galleries = collect($galleries)->where('publish.publishable_type', "App\Models\Fandom")->whereIn('publish.publishable_id', $fandom_galleries_public)->where('publish.visible', 'public');
            $final_galleries = collect([]);
            $final_galleries = $member_galleries->merge($public_galleries);
            $final_galleries = $final_galleries->shuffle()->take(10);
            $this->recommends['tags'] = $final_galleries;
            $user_id_galleries_friend = [];
            $user_id_galleries_public = [];
            $user_ids = collect($galleries)->where('publish.publishable_type', "App\Models\User")->pluck('publish.publishable_id')->unique()->toArray();
            if(!in_array(Auth::id(), $user_ids)) {
                $user = User::find(Auth::id());
                $user->load('follows');
                foreach ($user->follows as $follow) {
                    foreach($user_ids as $user_id) {
                        if($follow->id == $user_id) {
                            $user_id_galleries_friend[] = $user_id;
                        } else {
                            $user_id_galleries_public[] = $user_id;
                        }
                    }
                }
            }
            $user_galleries_self = collect($galleries)->where('publish.publishable_type', "App\Models\User")->where('publish.publishable_id', Auth::id());
            $user_galleries_friend = collect($galleries)->where('publish.publishable_type', "App\Models\User")->whereIn('publish.publishable_id', $user_id_galleries_friend)->whereIn('publish.visible', ['friend', 'public']);
            $user_galleries_public = collect($galleries)->where('publish.publishable_type', "App\Models\User")->whereIn('publish.publishable_id', $user_id_galleries_public)->where('publish.visible', 'public');
            $final_galleries = collect([]);
            $final_galleries = $user_galleries_self->merge($user_galleries_public);
            $final_galleries = $final_galleries->merge($user_galleries_friend);
            $final_galleries = $final_galleries->shuffle()->take(10);
            $this->recommends['tags'] = $this->recommends['tags']->merge($final_galleries);
            $this->recommends['tags'] = $this->recommends['tags']->shuffle()->take(10);
            $this->recommends['tags'] = $this->recommends['tags']->isEmpty() ? null : $this->recommends['tags'];
        } else {
            if(class_basename($this->gallery->publish->publishable_type) === 'User') {
                $user = User::with(['publishes' => function ($query) {
                    $query->where('visible', 'public');
                }])->find($this->gallery->user->id);
                $this->recommends['user'] = collect(Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable'])->whereIn('publish_id', $user->publishes->pluck('id'))->get())->shuffle()->take(10);
                $this->recommends['user'] = $this->recommends['user']->isEmpty() ? null : $this->recommends['user'];
            }
            if(class_basename($this->gallery->publish->publishable_type) === 'Fandom') {
                $fandom = Fandom::with(['publishes', 'members.user'])->find($this->gallery->publish->publishable_id);
                $users = collect($fandom->members);
                $galleries = collect(Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable'])->whereIn('publish_id', $fandom->publishes->pluck('id'))->get())->shuffle()->take(10);
                $this->recommends['fandom'] = collect($galleries)->where('publish.visible', 'public');
                $this->recommends['fandom'] = $this->recommends['fandom']->isEmpty() ? null : $this->recommends['fandom'];
                $user = User::with(['publishes' => function ($query) {
                    $query->where('visible', 'public');
                }])->find($this->gallery->user->id);
                $this->recommends['user'] = collect(Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable'])->whereIn('publish_id', $user->publishes->pluck('id'))->get())->shuffle()->take(10);
                $this->recommends['user'] = $this->recommends['user']->isEmpty() ? null : $this->recommends['user'];
            }
            $tags = Str::of($this->gallery->tags)->explode(',');
            $galleries = Gallery::with(['image','user.profile','user.avatar.image','user.cover.image','publish.publishable'])->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->get();
            $fandom_ids = collect($galleries)->where('publish.publishable_type', "App\Models\Fandom")->pluck('publish.publishable_id')->unique();
            $public_galleries = collect($galleries)->where('publish.publishable_type', "App\Models\Fandom")->whereIn('publish.publishable_id', $fandom_ids)->where('publish.visible', 'public');
            $final_galleries = $public_galleries->shuffle()->take(10);
            $this->recommends['tags'] = $final_galleries;
            $user_ids = collect($galleries)->where('publish.publishable_type', "App\Models\User")->pluck('publish.publishable_id')->unique();
            $user_galleries_public = collect($galleries)->where('publish.publishable_type', "App\Models\User")->whereIn('publish.publishable_id', $user_ids)->where('publish.visible', 'public');
            $final_galleries = $user_galleries_public->shuffle()->take(10);
            $this->recommends['tags'] = $this->recommends['tags']->merge($final_galleries);
            $this->recommends['tags'] = $this->recommends['tags']->shuffle()->take(10);
            $this->recommends['tags'] = $this->recommends['tags']->isEmpty() ? null : $this->recommends['tags'];
        }
    }
    #[On('like_gallery')]
    public function likeGallery()
    {
        $rate = Rate::where('rateable_type', "App\Models\Gallery")->where('rateable_id', $this->gallery->id)->where('user_id', Auth::id())->first();
        if($rate == null) {
            DB::transaction(function () use ($rate) {
                $rate = new Rate([
                    'user_id' => Auth::id(),
                    'like' => true,
                    'dislike' => false
                ]);
                $gallery = Gallery::find($this->gallery->id);
                $gallery->rates()->save($rate);
            });
            $this->dispatch('alert','success', 'Done, you liked this gallery');
        } else {
            if ($rate->dislike == true) {
                Rate::where('id', $rate->id)->update([
                    'like' => true,
                    'dislike' => false
                ]);
                $this->dispatch('alert','success', 'Done, you liked this gallery');
            } else {
                $this->dispatch('alert','error', 'Error, you already liked this gallery');
            }
        }
        $this->loadGallery($this->gallery);
    }
    #[On('dislike_gallery')]
    public function dislikeGallery()
    {
        $rate = Rate::where('rateable_type', "App\Models\Gallery")->where('rateable_id', $this->gallery->id)->where('user_id', Auth::id())->first();
        if($rate == null) {
            DB::transaction(function () use ($rate) {
                $rate = new Rate([
                    'user_id' => Auth::id(),
                    'like' => false,
                    'dislike' => true
                ]);
                $gallery = Gallery::find($this->gallery->id);
                $gallery->rates()->save($rate);
            });
            $this->dispatch('alert','success', 'Done, you disliked this gallery');
        } else {
            if($rate->like == true) {
                Rate::where('id', $rate->id)->update([
                    'like' => false,
                    'dislike' => true
                ]);
                $this->dispatch('alert','success', 'Done, you disliked this gallery');
            } else {
                $this->dispatch('alert','error', 'Error, you already disliked this gallery');
            }
        }
        $this->loadGallery($this->gallery);
    }
}
