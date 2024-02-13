<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Image;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class FandomCreate extends Component
{
    use WithFileUploads;
    #[Validate('required|image|max:10240')]
    public $cover;
    #[Validate('required|image|max:10240')]
    public $avatar;
    #[Validate('required|unique:fandoms,name|max:50')]
    public $name = '';
    #[Validate('required|max:100')]
    public $description = '';
    public $user = [];
    public function render()
    {
        return view('livewire.fandom-create');
    }
    public function createFandom()
    {
        $this->validate();

        $slug = Str::slug($this->name, '-');
        $fandom = Fandom::create([
            'name' => $this->name,
            'slug' => $slug,
            'description' => $this->description
        ]);
        $role = Role::where('name', 'Manager')->first();
        $fandom->members()->create([
            'user_id' => Auth::id(),
            'role_id' => $role->id
        ]);

        $cover_name = 'fandom/' . $slug . "/cover-" . $slug . "." . $this->cover->extension();
        $this->cover->storeAs('covers', $cover_name, 'public');
        $avatar_name = 'fandom/' . $slug . "/avatar-" . $slug . "." . $this->avatar->extension();
        $this->avatar->storeAs('avatars', $avatar_name, 'public');

        $image_cover = new Image(['url' => $cover_name]);
        $image_avatar = new Image(['url' => $avatar_name]);
        $cover = $fandom->cover()->create([]);
        $avatar = $fandom->avatar()->create([]);
        $cover->image()->save($image_cover);
        $avatar->image()->save($image_avatar);

        $this->reset(['avatar','cover','name','description']);
        $this->dispatch('alert','success','New fandom created')->to(Alert::class);
        $this->dispatch('load_fandoms');
    }
}
