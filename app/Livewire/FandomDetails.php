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
    public $posts;
    public $galleries;
    public $discusses;
    public $preferences = [];
    public $tab = 'home';
    public function mount(Fandom $fandom)
    {
        $this->loadFandomDetails($fandom->name);
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
    public function render()
    {
        return view('livewire.fandom-details')->title($this->fandom->name);
    }
    public function loadFandomDetails($name)
    {
        $fandom = Fandom::with(['publishes', 'discusses' => function($query) {
            $query->where('visible', '=', 'public');
        }])->where('name', $name)->first();
        $this->fandom = $fandom;

        $posts = Post::with(['user', 'publish'])->whereIn('publish_id', $fandom->publishes->pluck('id'))->get();
        $this->posts['public'] = collect($posts)->where('publish.visible', 'public')->sortByDesc('publish.created_at')->take(5);
        $this->posts['member'] = collect($posts)->sortByDesc('publish.created_at')->take(5);

        $galleries = Gallery::with(['user', 'publish', 'image'])->whereIn('publish_id', $fandom->publishes->pluck('id'))->get();
        $this->galleries['public'] = collect($galleries)->where('publish.visible', 'public')->sortByDesc('created_at')->take(5);
        $this->galleries['member'] = collect($galleries)->sortByDesc('created_at')->take(5);

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
    public function loadPosts($event)
    {
        $fandom = Fandom::find($event['fandom']['id']);
        $posts = Post::with(['user', 'publish'])->whereIn('publish_id', $fandom->publishes->pluck('id'))->get();
        $this->posts['public'] = collect($posts)->where('publish.visible', 'public')->sortByDesc('publish.created_at')->take(5);
        $this->posts['member'] = collect($posts)->sortByDesc('publish.created_at')->take(5);
    }
    public function loadGalleries($event)
    {
        $fandom = Fandom::find($event['fandom']['id']);
        $galleries = Gallery::with(['user', 'publish', 'image'])->whereIn('publish_id', $fandom->publishes->pluck('id'))->get();
        $this->galleries['public'] = collect($galleries)->where('publish.visible', 'public')->sortByDesc('created_at')->take(5);
        $this->galleries['member'] = collect($galleries)->sortByDesc('created_at')->take(5);
    }
}
