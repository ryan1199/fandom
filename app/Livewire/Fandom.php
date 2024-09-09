<?php

namespace App\Livewire;

use App\Models\Fandom as ModelsFandom;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Title('Fandom List')]
class Fandom extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $preferences = [];
    public function render()
    {
        $fandoms = ModelsFandom::latest()->simplePaginate(12, pageName: 'fandoms-page');
        return view('livewire.fandom', [
            'fandoms' => $fandoms,
        ]);
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
    }
    #[On('loadFandoms')]
    public function loadFandoms($event)
    {
        // $fandom = ModelsFandom::find($event['fandom']['id']);
        // $this->fandoms->push($fandom);
        $this->render();
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
