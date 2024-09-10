<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Post;
use Illuminate\Support\Number;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FandomList extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $preferences = [];
    public function render()
    {
        $fandoms = Fandom::inRandomOrder()->simplePaginate(6, pageName: 'fandoms-page');
        return view('livewire.fandom-list', [
            'fandoms' => $fandoms,
        ]);
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
    }
}
