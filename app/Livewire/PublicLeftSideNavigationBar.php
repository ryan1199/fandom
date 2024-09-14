<?php

namespace App\Livewire;

use Livewire\Component;

class PublicLeftSideNavigationBar extends Component
{
    public $preferences = [];
    public function render()
    {
        return view('livewire.public-left-side-navigation-bar');
    }
    public function mount()
    {
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
