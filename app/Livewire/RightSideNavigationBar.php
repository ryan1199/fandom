<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RightSideNavigationBar extends Component
{
    public $open_component = false;
    #[Locked]
    public $user;
    public $preferences = [];
    public function render()
    {
        return view('livewire.right-side-navigation-bar');
    }
    #[On('load_navigation')]
    public function mount()
    {
        if(Auth::check()) {
            $this->load();
            if (session()->has('preference-' . Auth::user()->username)) {
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
                session()->put('preference-' . Auth::user()->username, $this->preferences);
            }
        }
    }
    #[On('refresh')]
    public function load()
    {
        if(Auth::check()) {
            $this->user = User::find(Auth::id());
        }
    }
    #[On('open')]
    public function open()
    {
        $this->open_component = true;
    }
    #[On('close')]
    public function close()
    {
        $this->open_component = false;
    }
}
