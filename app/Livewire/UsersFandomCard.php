<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Member;
use Livewire\Component;

class UsersFandomCard extends Component
{
    public $member;
    public $fandom;
    public $preferences = [];
    public function render()
    {
        $role = $this->member->role->name;
        $cover = $this->fandom->cover->image->url;
        $name = $this->fandom->name;
        $description = $this->fandom->description;
        return view('livewire.users-fandom-card', [
            'role' => $role,
            'cover' => $cover,
            'name' => $name,
            'description' => $description,
        ]);
    }
    public function mount(Member $member, Fandom $fandom, $preferences)
    {
        $this->member = $member;
        $this->fandom = $fandom;
        $this->preferences = $preferences;
    }
    public function loadUpdatedFandom($event)
    {
        $fandom = Fandom::find($event['fandom']['id']);
        $this->fandom = $fandom;
        $this->fandom->cover->image->url = $fandom->cover->image->url;
    }
    public function getListeners()
    {
        return [
            "echo:UsersFandomCard.{$this->fandom->id},FandomUpdated" => 'loadUpdatedFandom',
        ];
    }
}
