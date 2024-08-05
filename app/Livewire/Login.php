<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Login')]
class Login extends Component
{
    #[Validate()]
    public $username = '';
    public $password = '';
    public $remember = false;
    public $preferences = [];
    public function rules()
    {
        return [
            'username' => ['required', 'alpha_dash:ascii', 'max:100'],
            'password' => ['required', Password::min(8)],
            'remember' => ['boolean']
        ];
    }
    public function render()
    {
        return view('livewire.login');
    }
    public function mount()
    {
        $this->preferences = [
            'color_1' => 'pink',
            'color_2' => 'rose',
            'color_3' => 'red',
            'font_size' => 16,
            'selected_font_family' => 'mono',
            'dark_mode' => false,
        ];
    }
    public function login(Request $request)
    {
        $validated = $this->validate();
        $validated['remember'] = $validated['remember'] === true ? true : false;
        if (Auth::attemptWhen([
            'username' => $validated['username'],
            'password' => $validated['password']
        ], function (User $user) {
            return $user->email_verified_at !== null;
        }, $validated['remember'])) {
            $request->session()->regenerate();
            if (session()->missing('preference-' . Auth::user()->username)) {
                session()->put(key: 'preference-' . Auth::user()->username, value: $this->preferences);
            }
            session()->put('last-active-' . Auth::user()->username, now());
            return redirect()->route('home')->with('success', 'Hello ' . Auth::user()->username);
        }
        $this->dispatch('alert', 'error', 'The provided credentials do not match our records or your email address is not verified')->to(Alert::class);
        $this->reset(['username', 'password', 'remember']);
    }
}
