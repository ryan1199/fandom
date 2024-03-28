<?php

namespace App\Livewire;

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
    public $user;
    public $preferences = [];
    public $profile_settings_modal_position = [];

    public function mount(User $user, $preferences)
    {
        $this->user = $user;
        $this->preferences = $preferences;
        $this->profile_settings_modal_position = $this->preferences['profile_settings_modal_position'];
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
        
        $user = User::with('cover')->where('id', $this->user->id)->first();
        Storage::deleteDirectory('covers/' . $user->username);

        $cover_name = $user->username . "/cover-" . $user->username . "." . $this->cover->extension();
        $this->cover->storeAs('covers', $cover_name, 'public');

        DB::transaction(function () use ($cover_name, $user) {
            $image = new Image(['url' => $cover_name]);
            if ($user->cover === null) {
                $cover = $user->cover()->create([]);
            } else {
                $cover = $user->cover;
            }
            $cover->image()->delete();
            $cover->image()->save($image);
            Profile::where('user_id', $user->id)->update([
                'cover_id' => $cover->id,
            ]);
        });

        $this->reset(['cover']);
        $this->dispatch('alert', 'success', 'Done, profile saved')->to(Alert::class);
        $this->dispatch('load_user', $user->username)->to(LivewireUser::class);
    }
    public function updatedAvatar($value)
    {
        $this->authorize('update', $this->user);

        $validated = Validator::make(data: [
            'avatar' => $this->avatar
        ], rules: [
            'avatar' => 'required|image|max:10240'
        ]);
        
        $user = User::with('avatar')->where('id', $this->user->id)->first();
        Storage::deleteDirectory('avatars/' . $user->username);

        $avatar_name = $user->username . "/avatar-" . $user->username . "." . $this->avatar->extension();
        $this->avatar->storeAs('avatars', $avatar_name, 'public');

        DB::transaction(function () use ($avatar_name, $user) {
            $image = new Image(['url' => $avatar_name]);
            if ($user->avatar === null) {
                $avatar = $user->avatar()->create([]);
            } else {
                $avatar = $user->avatar;
            }
            $avatar->image()->delete();
            $avatar->image()->save($image);
            Profile::where('user_id', $user->id)->update([
                'avatar_id' => $avatar->id,
            ]);
        });

        $this->reset(['avatar']);
        $this->dispatch('alert', 'success', 'Done, profile saved')->to(Alert::class);
        $this->dispatch('load_user', $user->username)->to(LivewireUser::class);
    }
    public function updatedStatus($value)
    {
        $this->authorize('update', $this->user);

        $validated = Validator::make(data: [
            'status' => $this->status
        ], rules: [
            'status' => 'required|max:50'
        ])->validate();
        
        $user = User::where('id', $this->user->id)->first();
        Profile::where('user_id', $user->id)->update([
            'status' => $validated['status'],
        ]);

        $this->reset(['status']);
        $this->dispatch('alert', 'success', 'Done, profile saved')->to(Alert::class);
        $this->dispatch('load_user', $user->username)->to(LivewireUser::class);
    }
    public function updatedDescription($value)
    {
        $this->authorize('update', $this->user);

        $validated = Validator::make(data: [
            'description' => $this->description
        ], rules: [
            'description' => 'required|max:100'
        ])->validate();
        
        $user = User::where('id', $this->user->id)->first();
        Profile::where('user_id', $user->id)->update([
            'description' => $validated['description'],
        ]);

        $this->reset(['description']);
        $this->dispatch('alert', 'success', 'Done, profile saved')->to(Alert::class);
        $this->dispatch('load_user', $user->username)->to(LivewireUser::class);
    }
    public function updated($property)
    {
        if (Auth::check()) {
            session()->put('last-active-' . $this->user->username, now());
        }
    }
    #[On('save_profile_settings_modal_position')]
    public function saveProfileSettingsModalPosition($data)
    {
        $data['left'] = is_int($data['left']) ? $data['left'] : 0;
        $data['right'] = is_int($data['right']) ? $data['right'] : 0;
        $data['top'] = is_int($data['top']) ? $data['top'] : 0;
        $data['bottom'] = is_int($data['bottom']) ? $data['bottom'] : 0;
        $data['left'] = ($data['left'] >= 0) ? $data['left'] : 0;
        $data['right'] = ($data['right'] >= 0) ? $data['right'] : 0;
        $data['top'] = ($data['top'] >= 0) ? $data['top'] : 0;
        $data['bottom'] = ($data['bottom'] >= 0) ? $data['bottom'] : 0;
        $this->profile_settings_modal_position = [
            'left' => $data['left'],
            'right' => $data['right'],
            'top' => $data['top'],
            'bottom' => $data['bottom']
        ];
        $preferences = session()->get('preference-' . $this->user->username);
        session()->put('preference-' . $this->user->username, [
            'color_1' => $preferences['color_1'],
            'color_2' => $preferences['color_2'],
            'color_3' => $preferences['color_3'],
            'color_primary' => $preferences['color_primary'],
            'color_secondary' => $preferences['color_secondary'],
            'color_text' => $preferences['color_text'],
            'font_size' => $preferences['font_size'],
            'selected_font_family' => $preferences['selected_font_family'],
            'create_fandom_modal_position' => $preferences['create_fandom_modal_position'],
            'account_settings_modal_position' => $preferences['account_settings_modal_position'],
            'profile_settings_modal_position' => [
                'left' => $data['left'],
                'right' => $data['right'],
                'top' => $data['top'],
                'bottom' => $data['bottom']
            ],
            'preference_settings_modal_position' => $preferences['preference_settings_modal_position']
        ]);
        $this->preferences = session()->get('preference-' . $this->user->username);
        $this->mount($this->user, $this->preferences);
    }
}
