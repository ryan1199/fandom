<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\Publish;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
class Home extends Component
{
    #[Locked]
    public $fandoms;
    #[Locked]
    public $galleries;
    #[Locked]
    public $posts;
    #[Locked]
    public $userFollowedUsers;
    #[Locked]
    public $userFandoms;
    public $preferences = [];
    public function render()
    {
        return view('livewire.home');
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->preferences = session()->get('preference-' . Auth::user()->username);
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
        $this->userFollowedUsers = collect([]);
        $this->userFandoms = collect([]);
        $this->loadFandoms();
        $this->loadPosts();
        $this->loadGalleries();
        if (Auth::check()) {
            $this->loadUserFollowedUsers();
            $this->loadUserFandoms();
        }
    }
    public function resetFandoms()
    {
        $this->fandoms = collect([]);
    }
    public function loadFandoms()
    {
        $this->fandoms = Fandom::orderBy('name', 'ASC')->get();
    }
    public function loadGalleries()
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
        $this->galleries = $user_galleries->merge($fandom_galleries);
    }
    public function loadPosts()
    {
        $user_ids = User::pluck('id');
        $fandom_ids = Fandom::pluck('id');
        $user_publishes = Publish::has('post')->where('publishable_type', 'APP\Models\User')->whereIn('publishable_id', $user_ids)->where('visible', 'public')->latest()->get();
        $user_publish_ids = $user_publishes->unique('publishable_id')->pluck('id')->toArray();
        $user_posts = Post::whereHas('publish', function (Builder $query) use ($user_publish_ids) {
            $query->whereIn('id',$user_publish_ids);
        })->get();
        $fandom_publishes = Publish::has('post')->where('publishable_type', 'APP\Models\Fandom')->whereIn('publishable_id', $fandom_ids)->where('visible', 'public')->latest()->get();
        $fandom_publish_ids = $fandom_publishes->unique('publishable_id')->pluck('id')->toArray();
        $fandom_posts = Post::whereHas('publish', function (Builder $query) use ($fandom_publish_ids) {
            $query->whereIn('id',$fandom_publish_ids);
        })->get();
        $this->posts = $user_posts->merge($fandom_posts);
    }
    public function loadUserFollowedUsers()
    {
        // only for authenticated users
        $user = User::find(Auth::id());
        $user->load(['follows']);
        $user_followed_user_ids = $user->follows->pluck('id');
        if ($user_followed_user_ids->isNotEmpty()) {
            $user_publishes = Publish::has('post')->where('publishable_type', 'APP\Models\User')->whereIn('publishable_id', $user_followed_user_ids)->whereIn('visible', ['public', 'friend'])->latest()->take(5)->get();
            $user_publish_ids = $user_publishes->pluck('id')->toArray();
            $user_posts = Post::whereHas('publish', function (Builder $query) use ($user_publish_ids) {
                $query->whereIn('id',$user_publish_ids);
            })->get();
            $this->userFollowedUsers['post'] = $user_posts;
            $user_publishes = Publish::has('gallery')->where('publishable_type', 'APP\Models\User')->whereIn('publishable_id', $user_followed_user_ids)->whereIn('visible', ['public', 'friend'])->latest()->take(5)->get();
            $user_publish_ids = $user_publishes->pluck('id')->toArray();
            $user_galleries = Gallery::whereHas('publish', function (Builder $query) use ($user_publish_ids) {
                $query->whereIn('id',$user_publish_ids);
            })->get();
            $this->userFollowedUsers['gallery'] = $user_galleries;
        }
    }
    public function loadUserFandoms()
    {
        // only for authenticated users
        $user = User::find(Auth::id());
        $user->load(['members']);
        $user_fandom_ids = $user->members->pluck('fandom_id');
        if ($user_fandom_ids->isNotEmpty()) {
            $fandom_publishes = Publish::has('post')->where('publishable_type', 'APP\Models\Fandom')->whereIn('publishable_id', $user_fandom_ids)->whereIn('visible', ['public', 'member'])->latest()->take(5)->get();
            $fandom_publish_ids = $fandom_publishes->pluck('id')->toArray();
            $fandom_posts = Post::whereHas('publish', function (Builder $query) use ($fandom_publish_ids) {
                $query->whereIn('id',$fandom_publish_ids);
            })->get();
            $this->userFandoms['post'] = $fandom_posts;
            $fandom_publishes = Publish::has('gallery')->where('publishable_type', 'APP\Models\Fandom')->whereIn('publishable_id', $user_fandom_ids)->whereIn('visible', ['public', 'member'])->latest()->take(5)->get();
            $fandom_publish_ids = $fandom_publishes->pluck('id')->toArray();
            $fandom_galleries = Gallery::whereHas('publish', function (Builder $query) use ($fandom_publish_ids) {
                $query->whereIn('id',$fandom_publish_ids);
            })->get();
            $this->userFandoms['gallery'] = $fandom_galleries;
        }
    }
    public function updated($property)
    {
        if (Auth::check()) {
            session()->put('last-active-' . Auth::user()->username, now());
        }
    }
    // listener for new created fandom or deleted fandom
}
