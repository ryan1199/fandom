<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('New Password')]
class NewPassword extends Component
{
    #[Validate()]
    public $ticket = null;
    public $password = '';
    public $password_confirmation = '';
    public $preferences = [];
    public function rules()
    {
        return [
            'password' => ['required', 'confirmed', Password::min(8), 'max:100'],
            'password_confirmation' => ['required', 'same:password']
        ];
    }
    public function mount($ticket)
    {
        $this->ticket = $ticket;
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
    public function render()
    {
        return view('livewire.new-password');
    }
    public function newPassword()
    {
        $validated = $this->validate();
        User::where('ticket', $this->ticket)->update([
            'password' => Hash::make($validated['password']),
            'ticket' => null
        ]);
        return redirect()->route('login')->with('success', 'Done, new password saved');
    }
}
