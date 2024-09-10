<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Post as ModelsPost;
use App\Models\Publish;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Post Management')]
class PostManagement extends Component
{
    public $preferences = [];
    public function render()
    {
        return view('livewire.post-management');
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
    public function createPost()
    {
        $this->dispatch('create_post')->to(PostCreateEdit::class);
    }
}
