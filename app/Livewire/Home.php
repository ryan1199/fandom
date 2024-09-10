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
    public $preferences = [];
    public function render()
    {
        return view('livewire.home');
    }
    public function mount()
    {
        if (Auth::check()) {
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
    }
    public function updated($property)
    {
        if (Auth::check()) {
            session()->put('last-active-' . Auth::user()->username, now());
        }
    }
}
