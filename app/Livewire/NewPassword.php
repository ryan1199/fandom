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
