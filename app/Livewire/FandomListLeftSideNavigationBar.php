<?php

namespace App\Livewire;

use App\Models\Discuss;
use App\Models\Fandom;
use App\Models\Member;
use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FandomListLeftSideNavigationBar extends Component
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
        return view('livewire.fandom-list-left-side-navigation-bar');
    }
    public function mount(Fandom $fandom, Member $member, User $user, $preferences)
    {
        $this->fandom = $fandom;
        $this->member = $member;
        $this->user = $user;
        $this->preferences = $preferences;
        $this->loadDiscusses();
    }
    public function discussTo($discuss_id)
    {
        $this->dispatch('refresh')->to(RightSideNavigationBar::class);
        $this->dispatch('open')->to(RightSideNavigationBar::class);
        $this->dispatch('openDiscuss', $discuss_id)->to(DiscussDetails::class);
    }
    public function getListeners()
    {
        return [
            "echo-private:DeleteDiscussion.{$this->fandom->id},DeleteDiscussion" => 'loadDiscusses',
            "echo-private:CreateDiscussion.{$this->fandom->id},CreateDiscussion" => 'loadDiscusses',
        ];
    }
    public function loadDiscusses()
    {
        if($this->member->role->name == "Manager") {
            $this->discusses = Discuss::where('fandom_id', $this->fandom->id)->get();
        } elseif($this->member->role->name == "Member") {
            $this->discusses = Discuss::where('fandom_id', $this->fandom->id)->whereIn('visible', ['member', 'public'])->get();
        }
    }
}
