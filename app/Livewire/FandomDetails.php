<?php

namespace App\Livewire;

use App\Models\Fandom;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class FandomDetails extends Component
{
    public $fandom;
    public $members;
    public $publishes;
    public $time;
    public $timeNow;
    public $timePast;
    public $preferences = [];
    public $tab = 'post';
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
        $fandom = Fandom::with(['avatar.image', 'cover.image', 'members.user.profile', 'members.user.cover.image', 'members.user.avatar.image', 'members.role', 'publishes.post.user'])->where('name', $name)->first();
        $this->fandom = $fandom;
        $publishes = collect($fandom->publishes)->sortByDesc('created_at');
        $this->publishes = $publishes->take(5);
        $members = collect($fandom->members)->pluck('user.id');
        $this->members = $members->toArray();
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
