<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery as ModelsGallery;
use App\Models\Image;
use App\Models\Publish;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

#[Title('Gallery Management')]
class GalleryManagement extends Component
{
    public $preferences = [];
    public function render()
    {
        return view('livewire.gallery-management');
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
    public function createGallery()
    {
        $this->dispatch('create_gallery')->to(GalleryCreateEdit::class);
    }
}
