<?php

namespace App\Livewire;

use App\Models\Fandom;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Fandom List')]
class FandomList extends Component
{
    public $create_fandom_modal = false;
    public $preferences = [];
    public $fandoms;
    public function render()
    {
        return view('livewire.fandom-list');
    }
    public function mount()
    {
        $this->fandoms = Fandom::with(['avatar.image', 'cover.image', 'members'])->get();
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
        $fandom = Fandom::find($event['fandom']['id']);
        $this->fandoms->push($fandom);
    }
    #[On('removeFandom')]
    public function removeFandom($event)
    {
        $this->fandoms = Fandom::with(['avatar.image', 'cover.image', 'members'])->get();
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
            "echo:FandomList,FandomCreated" => 'loadFandoms',
            // "echo:FandomList,FandomRemoved" => 'removeFandom',
        ];
    }
}
