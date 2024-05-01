<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class FandomDetails extends Component
{
    public $fandom;
    public $members;
    public $posts;
    public $galleries;
    public $time;
    public $timeNow;
    public $timePast;
    public $preferences = [];
    public $tab = 'home';
    public function mount(Fandom $fandom)
    {
        $this->loadFandomDetails($fandom->name);
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
        // $this->time = session()->get('last-active' . Auth::user()->username);
        // session()->put('last-active' . Auth::user()->username, now());
    }
    public function render()
    {
        return view('livewire.fandom-details')->title($this->fandom->name);
    }
    #[On('load_fandom_details')]
    public function loadFandomDetails($name)
    {
        $fandom = Fandom::with(['avatar.image', 'cover.image', 'members.user.profile', 'members.user.cover.image', 'members.user.avatar.image', 'members.role', 'publishes'])->where('name', $name)->first();
        $this->fandom = $fandom;

        $posts = Post::with(['user', 'publish'])->whereIn('publish_id', $fandom->publishes->pluck('id'))->get();
        $this->posts['public'] = collect($posts)->where('publish.visible', 'public')->sortByDesc('publish.created_at')->take(5);
        $this->posts['member'] = collect($posts)->sortByDesc('publish.created_at')->take(5);

        $galleries = Gallery::with(['user', 'publish', 'image'])->whereIn('publish_id', $fandom->publishes->pluck('id'))->get();
        $this->galleries['public'] = collect($galleries)->where('publish.visible', 'public')->sortByDesc('created_at')->take(5);
        $this->galleries['member'] = collect($galleries)->sortByDesc('created_at')->take(5);

        $users = collect($fandom->members);
        $managers = $users->where('role.name', 'Manager');
        $managers_id = $managers->pluck('user.id')->toArray();
        $members = $users->where('role.name', 'Member');
        $members_id = $members->pluck('user.id')->toArray();
        $this->members['id'] = $users->pluck('user.id')->toArray();
        $this->members['manager']['id'] = $managers_id;
        $this->members['manager']['list'] = $managers;
        $this->members['member']['id'] = $members_id;
        $this->members['member']['list'] = $members;
    }
    // public function updated($property)
    // {
    //     if(Auth::check())
    //     {
    //         session()->put('last-active-' . Auth::user()->username, now());
    //     }
    // }
    // public function checkTime()
    // {
    //     $this->time = session()->get('last-active' . Auth::user()->username);
    // }
}
