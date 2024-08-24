<?php

namespace App\Livewire;

use App\Events\UserProfileUpdated;
use App\Livewire\User as LivewireUser;
use App\Models\Avatar;
use App\Models\Cover;
use App\Models\Image;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileSetting extends Component
{
    use WithFileUploads;
    public $cover;
    public $avatar;
    public $status = '';
    public $description = '';
    #[Locked]
    public $user;
    public $preferences = [];

    public function mount(User $user, $preferences)
    {
        $this->user = $user;
        $this->preferences = $preferences;
    }
    public function render()
    {
        return view('livewire.profile-setting');
    }
    public function updatedCover($value)
    {
        $this->authorize('update', $this->user);
        $validated = Validator::make(data: [
            'cover' => $this->cover
        ], rules: [
            'cover' => 'required|image|max:10240'
        ])->validate();
        Storage::deleteDirectory('covers/' . $this->user->username);
        $cover_name = $this->user->username . "/cover-" . $this->user->username . '-' . rand() . "." . $this->cover->extension();
        $this->cover->storeAs('covers', $cover_name, 'public');

        DB::transaction(function () use ($cover_name) {
            $image = new Image(['url' => $cover_name]);
            if ($this->user->cover === null) {
                $cover = $this->user->cover()->create([]);
            } else {
                $cover = $this->user->cover;
            }
            $cover->image()->delete();
            $cover->image()->save($image);
            Profile::where('user_id', $this->user->id)->update([
                'cover_id' => $cover->id,
            ]);
        });
        $this->reset(['cover']);
        $this->dispatch('alert', 'success', 'Done, profile saved')->to(Alert::class);
        UserProfileUpdated::dispatch($this->user);
    }
    public function updatedAvatar($value)
    {
        $this->authorize('update', $this->user);
        $validated = Validator::make(data: [
            'avatar' => $this->avatar
        ], rules: [
            'avatar' => 'required|image|max:10240'
        ]);
        Storage::deleteDirectory('avatars/' . $this->user->username);
        $avatar_name = $this->user->username . "/avatar-" . $this->user->username . '-' . rand() . "." . $this->avatar->extension();
        $this->avatar->storeAs('avatars', $avatar_name, 'public');
        DB::transaction(function () use ($avatar_name) {
            $image = new Image(['url' => $avatar_name]);
            if ($this->user->avatar === null) {
                $avatar = $this->user->avatar()->create([]);
            } else {
                $avatar = $this->user->avatar;
            }
            $avatar->image()->delete();
            $avatar->image()->save($image);
            Profile::where('user_id', $this->user->id)->update([
                'avatar_id' => $avatar->id,
            ]);
        });
        $this->reset(['avatar']);
        $this->dispatch('alert', 'success', 'Done, profile saved')->to(Alert::class);
        UserProfileUpdated::dispatch($this->user);
    }
    public function updatedStatus($value)
    {
        $this->authorize('update', $this->user);
        $validated = Validator::make(data: [
            'status' => $this->status
        ], rules: [
            'status' => 'required|max:100'
        ])->validate();
        Profile::where('user_id', $this->user->id)->update([
            'status' => clean(Str::of($validated['status'])->markdown()),
        ]);
        $this->reset(['status']);
        $this->dispatch('alert', 'success', 'Done, profile saved')->to(Alert::class);
        UserProfileUpdated::dispatch($this->user);
    }
    public function updatedDescription($value)
    {
        $this->authorize('update', $this->user);
        $validated = Validator::make(data: [
            'description' => $this->description
        ], rules: [
            'description' => 'required|max:500'
        ])->validate();
        Profile::where('user_id', $this->user->id)->update([
            'description' => clean(Str::of($validated['description'])->markdown()),
        ]);
        $this->reset(['description']);
        $this->dispatch('alert', 'success', 'Done, profile saved')->to(Alert::class);
        UserProfileUpdated::dispatch($this->user);
    }
    public function updated($property)
    {
        if (Auth::check()) {
            session()->put('last-active-' . $this->user->username, now());
        }
    }
}
