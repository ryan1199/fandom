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
    public function rules()
    {
        return [
            'username' => ['required','alpha_dash:ascii','max:100'],
            'password' => ['required', Password::min(8)],
            'remember' => ['boolean']
        ];
    }
    public function render()
    {
        return view('livewire.login');
    }
    public function login(Request $request)
    {
        $validated = $this->validate();
        $validated['remember'] = $validated['remember'] === true ? true : false;
        if(Auth::attemptWhen([
            'username' => $validated['username'], 
            'password' => $validated['password']
        ], function (User $user) {
            return $user->email_verified_at !== null;
        }, $validated['remember']))
        {
            $request->session()->regenerate();
            if(session()->missing(Auth::user()->username . '-preference'))
            {
                session()->put(key: Auth::user()->username . '-preference', value: [
                    'color_1' => '#9090ff',
                    'color_2' => '#bbbbff',
                    'color_3' => '#c8c8ff',
                    'color_primary' => '#ffffff',
                    'color_secondary' => '#000000',
                    'color_text' => '#000000',
                    'font_size' => 16,
                    'selected_font_family' => 'mono'
                ]);
            }
            return redirect()->route('home')->with('success', 'Hello ' . Auth::user()->username);
        }
        $this->dispatch('alert', 'error', 'The provided credentials do not match our records or your email address is not verified')->to(Alert::class);
        $this->reset(['username', 'password', 'remember']);
    }
}
