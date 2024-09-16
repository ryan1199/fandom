<?php

namespace App\Livewire;

use App\Livewire\User as LivewireUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AccountSetting extends Component
{
    #[Locked]
    public $user;
    public $preferences = [];
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
    }
    public function render()
    {
        return view('livewire.account-setting');
    }
    public function updateAccount()
    {
        $this->authorize('update', $this->user);
        $validated = $this->validate();
        User::where('id', $this->user->id)->update([
            'password' => Hash::make($validated['password'])
        ]);
        $this->reset(['password', 'password_confirmation']);
        $this->dispatch('alert', 'success', 'Done, new changes saved')->to(Alert::class);
        $this->dispatch('load_user', $this->user->username)->to(LivewireUser::class);
    }
    public function deleteAccount()
    {
        $this->authorize('delete', $this->user);
        dd('yes from account');
        // delete all related
        session()->forget('preference-' . $this->user->username);
    }
}
