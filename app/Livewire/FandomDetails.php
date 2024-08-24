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
    public $members;
    public $posts;
    public $galleries;
    public $discusses;
    public $openDiscusses = [];
    public $time;
    public $timeNow;
    public $timePast;
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
        // $this->time = session()->get('last-active' . Auth::user()->username);
        // session()->put('last-active' . Auth::user()->username, now());
    }
    public function render()
    {
        return view('livewire.fandom-details')->title($this->fandom->name);
    }
    #[On('load_fandom_details')]
    public function loadFandomDetails($name)
    {
        $fandom = Fandom::with(['avatar.image', 'cover.image', 'members.user.profile', 'members.user.cover.image', 'members.user.avatar.image', 'members.role', 'publishes', 'discusses' => function($query) {
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
        $discuss_ids = collect();
        foreach($this->discusses as $discuss) {
            $discuss_ids->push($discuss->id);
        }
        $this->openDiscusses = array_fill_keys($discuss_ids->toArray(), false);

        $users = collect($fandom->members);
        $managers = $users->where('role.name', 'Manager');
        $managers_id = $managers->pluck('user.id')->toArray();
        $members = $users->where('role.name', 'Member');
        $members_id = $members->pluck('user.id')->toArray();
        $this->members['id'] = $users->pluck('user.id')->toArray();
        $this->members['manager']['id'] = $managers_id;
        $this->members['manager']['list'] = $managers;
        $this->members['member']['id'] = $members_id;
        $this->members['member']['list'] = $members;
        $this->dispatch('search')->to(GallerySearch::class);
        $this->dispatch('search')->to(PostSearch::class);
        $this->dispatch('load_latest_messages')->to(LivewireDiscuss::class);
    }
    public function join()
    {
        if(in_array(Auth::id(), $this->members['id'])) {
            $this->dispatch('alert', 'error', 'Failed, you are already joined in this fandom')->to(Alert::class);
        } else {
            $role = Role::where('name', 'Member')->first();
            $this->fandom->members()->create([
                'user_id' => Auth::id(),
                'role_id' => $role->id
            ]);
            $this->loadFandomDetails($this->fandom->name);
            $this->dispatch('alert', 'success', 'Done, now you are part of this fandom')->to(Alert::class);
        }
    }
    public function leave()
    {
        if(in_array(Auth::id(), $this->members['id'])) {
            $this->fandom->members()->where('user_id', Auth::id())->delete();
            $this->loadFandomDetails($this->fandom->name);
            $this->dispatch('alert', 'success', 'Done, now you are no longer part of this fandom, hope you find a new one');
        } else {
            $this->dispatch('alert', 'error', 'Failed, you are not part of this fandom');
        }
    }
    public function getListeners()
    {
        return [
            "echo-private:FandomDetails.{$this->fandom->id},DeleteDiscussion" => 'loadDiscussion',
            "echo-private:FandomDetails.{$this->fandom->id},CreateDiscussion" => 'loadDiscussion',
            "echo-private:FandomDetails.{$this->fandom->id},FandomUpdated" => 'loadUpdatedFandom',
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
    public function loadUpdatedFandom()
    {
        $this->loadFandomDetails($this->fandom->name);
    }
    // public function updated($property)
    // {
    //     if(Auth::check())
    //     {
    //         session()->put('last-active-' . Auth::user()->username, now());
    //     }
    // }
    // public function checkTime()
    // {
    //     $this->time = session()->get('last-active' . Auth::user()->username);
    // }
}
