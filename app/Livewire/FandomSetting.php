<?php

namespace App\Livewire;

use App\Models\Fandom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class FandomSetting extends Component
{
    use WithFileUploads;
    public $fandom;
    public $manager;
    public $cover;
    public $avatar;
    #[Validate('required|max:100')]
    public $description = '';
    public $preferences = [];
    public function render()
    {
        return view('livewire.fandom-setting');
    }
    public function mount(Fandom $fandom, $preferences, $managers)
    {
        $this->fandom = $fandom;
        $this->preferences = $preferences;
        $this->manager = $managers;
        if(Auth::check())
        {
            $this->preferences = session()->get('preference-' . Auth::user()->username);
        } else {
            $this->preferences = [
                'color_1' => '#f97316',
                'color_2' => '#ec4899',
                'color_3' => '#6366f1',
                'color_primary' => '#ffffff',
                'color_secondary' => '#000000',
                'color_text' => '#000000',
                'font_size' => 16,
                'selected_font_family' => 'mono',
                'create_fandom_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'account_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'profile_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'preference_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ]
            ];
        }
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
        return redirect()->route('fandom-details', $fandom->name)->with('success', 'Done, fandom cover updated');
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
        return redirect()->route('fandom-details', $fandom->name)->with('success', 'Done, fandom avatar updated');
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
        return redirect()->route('fandom-details', $this->fandom->name)->with('success', 'Done, fandom description updated');
    }
}