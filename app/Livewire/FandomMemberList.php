<?php

namespace App\Livewire;

use App\Models\Fandom;
use Livewire\Component;

class FandomMemberList extends Component
{
    public $fandom;
    public $managers;
    public $members;
    public $bans;
    public $preferences= [];
    public function render()
    {
        return view('livewire.fandom-member-list');
    }
    public function mount(Fandom $fandom, $preferences)
    {
        $this->fandom = $fandom;
        $users = $fandom->members;
        $managers = $users->where('role.name', 'Manager');
        $members = $users->where('role.name', 'Member');
        $this->managers = $managers;
        $this->members = $members;
        $this->bans = $fandom->bans;
        $this->preferences = $preferences;
    }
    public function getListeners()
    {
        return [
            "echo:FandomMemberList.{$this->fandom->id},UserJoined" => 'loadMember',
            "echo:FandomMemberList.{$this->fandom->id},UserLeaved" => 'loadMember',
            "echo:FandomMemberList.{$this->fandom->id},UserBanned" => 'loadBan',
            "echo:FandomMemberList.{$this->fandom->id},UserUnbanned" => 'loadBan',
        ];
    }
    public function loadMember($event)
    {
        $fandom = Fandom::find($event['fandom']['id']);
        $users = $fandom->members;
        $managers = $users->where('role.name', 'Manager');
        $members = $users->where('role.name', 'Member');
        $this->managers = $managers;
        $this->members = $members;
    }
    public function loadBan($event)
    {
        $fandom = Fandom::find($event['fandom']['id']);
        $this->bans = $fandom->bans;
    }
}
