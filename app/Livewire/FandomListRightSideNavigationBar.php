<?php

namespace App\Livewire;

use App\Models\Discuss;
use App\Models\Fandom;
use App\Models\Member;
use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FandomListRightSideNavigationBar extends Component
{
    #[Locked]
    public $user;
    #[Locked]
    public $fandom;
    #[Locked]
    public $member;
    public $discusses;
    public $preferences = [];
    public function render()
    {
        return view('livewire.fandom-list-right-side-navigation-bar');
    }
    public function mount(Fandom $fandom, Member $member, User $user, $preferences)
    {
        $this->fandom = $fandom;
        $this->member = $member;
        $this->user = $user;
        $this->preferences = $preferences;
        $this->loadDiscusses();
    }
    public function getListeners()
    {
        return [
            "echo-private:FandomListRightSideNavigationBar.{$this->fandom->id},DeleteDiscussion" => 'loadDiscusses',
            "echo-private:FandomListRightSideNavigationBar.{$this->fandom->id},CreateDiscussion" => 'loadDiscusses',
            "echo-private:FandomListRightSideNavigationBar.{$this->fandom->id},NewDiscussionMessage" => 'loadDiscusses',
        ];
    }
    public function loadDiscusses()
    {
        if($this->member->role->name == "Manager") {
            $this->discusses = Discuss::where('fandom_id', $this->fandom->id)->orderByDesc('updated_at')->get();
        } elseif($this->member->role->name == "Member") {
            $this->discusses = Discuss::where('fandom_id', $this->fandom->id)->whereIn('visible', ['member', 'public'])->orderByDesc('updated_at')->get();
        }
    }
}
