<?php

namespace App\Livewire;

use App\Models\Fandom as ModelsFandom;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Fandom List')]
class Fandom extends Component
{
    public $fandoms;
    public $preferences = [];
    public function render()
    {
        return view('livewire.fandom');
    }
    public function mount()
    {
        $this->fandoms = ModelsFandom::with(['avatar.image', 'cover.image', 'members'])->get();
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
    }
    #[On('loadFandoms')]
    public function loadFandoms($event)
    {
        $fandom = ModelsFandom::find($event['fandom']['id']);
        $this->fandoms->push($fandom);
    }
    #[On('removeFandom')]
    public function removeFandom($event)
    {
        $this->fandoms = ModelsFandom::with(['avatar.image', 'cover.image', 'members'])->get();
    }
    public function updated($property)
    {
        if (Auth::check()) {
            session()->put('last-active-' . Auth::user()->username, now());
        }
    }
    public function getListeners()
    {
        return [
            "echo:Fandom,FandomCreated" => 'loadFandoms',
            // "echo:Fandom,FandomRemoved" => 'removeFandom',
        ];
    }
}
