<?php

namespace App\Livewire;

use App\Models\Fandom;
use Livewire\Component;

class FandomProfile extends Component
{
    public $fandom;
    public $preferences = [];
    public function render()
    {
        return view('livewire.fandom-profile');
    }
    public function mount(Fandom $fandom, $preferences)
    {
        $this->fandom = $fandom;
        $this->preferences = $preferences;
    }
    public function getListeners()
    {
        return [
            "echo-private:FandomProfile.{$this->fandom->id},FandomUpdated" => 'loadUpdatedFandom',
            "echo:FandomProfile.{$this->fandom->id},FandomUpdated" => 'loadUpdatedFandom',
        ];
    }
    public function loadUpdatedFandom($event)
    {
        $this->fandom = Fandom::find($event['fandom']['id']);
    }
}
