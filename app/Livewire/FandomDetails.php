<?php

namespace App\Livewire;

use App\Livewire\Discuss as LivewireDiscuss;
use App\Models\Discuss;
use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class FandomDetails extends Component
{
    public $fandom;
    public $managers = [];
    public $members = [];
    public $discusses;
    public $preferences = [];
    public $tab = 'home';
    public $openFandomsRequestForm = false;
    public function mount(Fandom $fandom)
    {
        $this->loadFandomDetails($fandom->name);
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
    public function render()
    {
        return view('livewire.fandom-details')->title($this->fandom->name);
    }
    public function loadFandomDetails($name)
    {
        $fandom = Fandom::with(['discusses' => function($query) {
            $query->where('visible', '=', 'public');
        }])->where('name', $name)->first();
        $this->fandom = $fandom;

        $this->discusses = $fandom->discusses;

        $users = $fandom->members;
        $managers = $users->where('role.name', 'Manager');
        $managers_id = $managers->pluck('user.id')->toArray();
        $this->members = $users->pluck('user.id')->toArray();
        $this->managers = $managers_id;
    }
    public function getListeners()
    {
        return [
            "echo-private:FandomDetails.{$this->fandom->id},DeleteDiscussion" => 'loadDiscussion',
            "echo-private:FandomDetails.{$this->fandom->id},CreateDiscussion" => 'loadDiscussion',
            "echo-private:FandomDetails.{$this->fandom->id},UserJoined" => 'loadMembers',
            "echo-private:FandomDetails.{$this->fandom->id},UserLeaved" => 'loadMembers',
        ];
    }
    public function loadDiscussion($event)
    {
        $name = $event['fandom']['name'];
        $fandom = Fandom::with(['discusses' => function($query) {
            $query->where('visible', '=', 'public');
        }])->where('name', $name)->first();
        $this->discusses = $fandom->discusses;
    }
    public function loadMembers($event)
    {
        $fandom = Fandom::find($event['fandom']['id']);
        $users = $fandom->members;
        $managers = $users->where('role.name', 'Manager');
        $managers_id = $managers->pluck('user.id')->toArray();
        $this->members = $users->pluck('user.id')->toArray();
        $this->managers = $managers_id;
    }
}
