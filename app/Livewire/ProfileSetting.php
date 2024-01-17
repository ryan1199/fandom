<?php

namespace App\Livewire;

use App\Livewire\User as LivewireUser;
use App\Models\Avatar;
use App\Models\Cover;
use App\Models\Image;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileSetting extends Component
{
    use WithFileUploads;
    #[Validate('required|image|max:10240')]
    public $cover;
    #[Validate('required|image|max:10240')]
    public $avatar;
    #[Validate('required|max:50')]
    public $status = '';
    #[Validate('required|max:100')]
    public $description = '';
    public $user = [];
    
    public function mount(User $user)
    {
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.profile-setting');
    }
    public function updatedCover($value)
    {
        $validated = Validator::make(data:[
            'cover' => $this->cover
        ], rules:[
            'cover' => 'required|image|max:10240'
        ])->validate();
        // check (user['id] === Auth::id())
        $user = User::where('id', $this->user['id'])->first();
        Storage::deleteDirectory('covers/' . $user->username);
        $cover_name = $user->username . "/cover-" . $user->username . "." . $this->cover->extension();
        $this->cover->storeAs('covers', $cover_name, 'public');
        $image = new Image(['url' => $cover_name]);
        $cover = Cover::firstOrCreate(
            ['user_id' => $user->id],
            ['created_at' => now(), 'updated_at' => now()],
        );
        $cover->image()->delete();
        $cover->image()->save($image);
        Profile::where('user_id', $user->id)->update([
            'cover_id' => $cover->id,
        ]);
        $this->reset(['cover']);
        $this->dispatch('alert', 'success', 'Done, profile saved')->to(Alert::class);
        $this->dispatch('load_user', $user->username);
    }
    public function updatedAvatar($value)
    {
        $validated = Validator::make(data:[
            'avatar' => $this->avatar
        ], rules:[
            'avatar' => 'required|image|max:10240'
        ]);
        $user = User::where('id', $this->user['id'])->first();
        Storage::deleteDirectory('avatars/' . $user->username);
        $avatar_name = $user->username . "/avatar-" . $user->username . "." . $this->avatar->extension();
        $this->avatar->storeAs('avatars', $avatar_name, 'public');
        $image = new Image(['url' => $avatar_name]);
        $avatar = Avatar::firstOrCreate(
            ['user_id' => $user->id],
            ['created_at' => now(), 'updated_at' => now()],
        );
        $avatar->image()->delete();
        $avatar->image()->save($image);
        Profile::where('user_id', $user->id)->update([
            'avatar_id' => $avatar->id,
        ]);
        $this->reset(['avatar']);
        $this->dispatch('alert', 'success', 'Done, profile saved')->to(Alert::class);
        $this->dispatch('load_user', $user->username);
    }
    public function updatedStatus($value)
    {
        $validated = Validator::make(data:[
            'status' => $this->status
        ], rules:[
            'status' => 'required|max:50'
        ])->validate();
        $user = User::where('id', $this->user['id'])->first();
        Profile::where('user_id', $user->id)->update([
            'status' => $validated['status'],
        ]);
        $this->reset(['status']);
        $this->dispatch('alert', 'success', 'Done, profile saved')->to(Alert::class);
        $this->dispatch('load_user', $user->username);
    }
    public function updatedDescription($value)
    {
        $validated = Validator::make(data:[
            'description' => $this->description
        ], rules:[
            'description' => 'required|max:100'
        ])->validate();
        $user = User::where('id', $this->user['id'])->first();
        Profile::where('user_id', $user->id)->update([
            'description' => $validated['description'],
        ]);
        $this->reset(['description']);
        $this->dispatch('alert', 'success', 'Done, profile saved')->to(Alert::class);
        $this->dispatch('load_user', $user->username);
    }
}