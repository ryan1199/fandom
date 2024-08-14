<?php

namespace App\Livewire;

use App\Models\Fandom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class FandomSetting extends Component
{
    use WithFileUploads;
    #[Locked]
    public $fandom;
    public $cover;
    public $avatar;
    #[Validate('required|max:500')]
    public $description = '';
    public $current_route_name = null;
    public $current_route_parameter = null;
    public $preferences = [];
    public function render()
    {
        return view('livewire.fandom-setting');
    }
    public function mount(Fandom $fandom, $preferences)
    {
        $this->fandom = $fandom;
        $this->preferences = $preferences;
        $this->setCurrentRoute();
    }
    public function updatedCover($value)
    {
        $this->authorize('update', $this->fandom);

        $validated = Validator::make(data: [
            'cover' => $this->cover
        ], rules: [
            'cover' => 'required|image|max:10240'
        ])->validate();
        
        $fandom = Fandom::with(['cover.image'])->find($this->fandom->id);
        Storage::delete('covers/' . $fandom->cover->image->url);

        $cover_name = 'fandom/' . $fandom->slug . "/cover-" . $fandom->slug . "." . $this->cover->extension();
        $fandom->cover->image()->update([
            'url' => $cover_name
        ]);
        $this->cover->storeAs('covers', $cover_name, 'public');

        $this->reset(['cover']);
        $this->loadPage(['status' => 'success', 'message' => 'Done, fandom cover has been updated']);
    }
    public function updatedAvatar($value)
    {
        $this->authorize('update', $this->fandom);

        $validated = Validator::make(data: [
            'avatar' => $this->avatar
        ], rules: [
            'avatar' => 'required|image|max:10240'
        ])->validate();
        
        $fandom = Fandom::with(['avatar.image'])->find($this->fandom->id);
        Storage::delete('avatars/' . $fandom->avatar->image->url);

        $avatar_name = 'fandom/' . $fandom->slug . "/avatar-" . $fandom->slug . "." . $this->avatar->extension();
        $fandom->avatar->image()->update([
            'url' => $avatar_name
        ]);
        $this->avatar->storeAs('avatars', $avatar_name, 'public');

        $this->reset(['avatar']);
        $this->loadPage(['status' => 'success', 'message' => 'Done, fandom avatar has been updated']);
    }
    public function updatedDescription($value)
    {
        $this->authorize('update', $this->fandom);

        $validated = Validator::make(data: [
            'description' => $this->description
        ], rules: [
            'description' => 'required|max:100'
        ])->validate();

        Fandom::where('id', $this->fandom->id)->update([
            'description' => $this->description
        ]);

        $this->reset(['description']);
        $this->loadPage(['status' => 'success', 'message' => 'Done, fandom description has been updated']);
    }
    public function setCurrentRoute()
    {
        $this->current_route_name = request()->route()->getName();
        if ($this->current_route_name == 'fandom-details') {
            $this->current_route_parameter = request()->route('fandom');
        }
        if ($this->current_route_name == 'user') {
            $this->current_route_parameter = request()->route('user');
        }
        if ($this->current_route_name == 'post.show') {
            $this->current_route_parameter = request()->route('post');
        }
        if ($this->current_route_name == 'gallery.show') {
            $this->current_route_parameter = request()->route('gallery');
        }
    }
    public function loadPage($alert)
    {
        if($this->current_route_parameter != null) {
            return redirect()->route($this->current_route_name, $this->current_route_parameter)->with($alert['status'], $alert['message']);
        } else {
            return redirect()->route($this->current_route_name)->with($alert['status'], $alert['message']);
        }
    }
}
