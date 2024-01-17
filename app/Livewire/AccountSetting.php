<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AccountSetting extends Component
{
    public $user = [];
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
    public function mount(User $user)
    {
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.account-setting');
    }
    public function updateAccount()
    {
        // check (user['id] === Auth::id())
        $validated = $this->validate();
        User::where('id', $this->user['id'])->update([
            'password' => Hash::make($validated['password'])
        ]);
        $this->reset(['password','password_confirmation']);
        $this->dispatch('alert', 'success', 'Done, new changes saved')->to(Alert::class);
        $this->dispatch('load_user', $this->user['username']);
    }
}