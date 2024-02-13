<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AccountSetting extends Component
{
    public $user = [];
    public $preferences = [];
    public $account_settings_modal_position = [];
    #[Validate()]
    public $password = '';
    public $password_confirmation = '';

    public function rules()
    {
        return [
            'password' => ['required', 'confirmed', Password::min(8), 'max:100'],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }
    public function mount(User $user, $preferences)
    {
        $this->user = $user;
        $this->preferences = $preferences;
        $this->account_settings_modal_position = $this->preferences['account_settings_modal_position'];
    }
    public function render()
    {
        return view('livewire.account-setting');
    }
    public function updateAccount()
    {
        $user = User::where('id', $this->user['id'])->first();
        $this->authorize('update', $user);

        $validated = $this->validate();

        User::where('id', $this->user['id'])->update([
            'password' => Hash::make($validated['password'])
        ]);
        
        $this->reset(['password','password_confirmation']);
        $this->dispatch('alert', 'success', 'Done, new changes saved')->to(Alert::class);
        $this->dispatch('load_user', $this->user['username']);
    }
    public function deleteAccount()
    {
        $user = User::where('id', $this->user['id'])->first();
        $this->authorize('update', $user);
        dd('yes from account');
        session()->forget('preference-' . Auth::user()->username);
    }
    public function updated($property)
    {
        if(Auth::check())
        {
            session()->put('last-active-' . Auth::user()->username, now());
        }
    }
    #[On('save_account_settings_modal_position')]
    public function saveAccountSettingsModalPosition($data)
    {
        $data['left'] = is_int($data['left']) ? $data['left'] : 0;
        $data['right'] = is_int($data['right']) ? $data['right'] : 0;
        $data['top'] = is_int($data['top']) ? $data['top'] : 0;
        $data['bottom'] = is_int($data['bottom']) ? $data['bottom'] : 0;
        $data['left'] = ($data['left'] >= 0) ? $data['left'] : 0;
        $data['right'] = ($data['right'] >= 0) ? $data['right'] : 0;
        $data['top'] = ($data['top'] >= 0) ? $data['top'] : 0;
        $data['bottom'] = ($data['bottom'] >= 0) ? $data['bottom'] : 0;
        $this->account_settings_modal_position = [
            'left' => $data['left'],
            'right' => $data['right'],
            'top' => $data['top'],
            'bottom' => $data['bottom']
        ];
        $preferences = session()->get('preference-' . Auth::user()->username);
        session()->put('preference-' . Auth::user()->username, [
            'color_1' => $preferences['color_1'],
            'color_2' => $preferences['color_2'],
            'color_3' => $preferences['color_3'],
            'color_primary' => $preferences['color_primary'],
            'color_secondary' => $preferences['color_secondary'],
            'color_text' => $preferences['color_text'],
            'font_size' => $preferences['font_size'],
            'selected_font_family' => $preferences['selected_font_family'],
            'create_fandom_modal_position' => $preferences['create_fandom_modal_position'],
            'account_settings_modal_position' => [
                'left' => $data['left'],
                'right' => $data['right'],
                'top' => $data['top'],
                'bottom' => $data['bottom']
            ],
            'profile_settings_modal_position' => $preferences['profile_settings_modal_position'],
            'preference_settings_modal_position' => $preferences['preference_settings_modal_position']
        ]);
        $this->preferences = session()->get('preference-' . Auth::user()->username);
    }
}