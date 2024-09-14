<?php

namespace App\Livewire;

use App\Mail\VerificationRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Register')]
class Register extends Component
{
    public $username = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $preferences = [];
    public function rules()
    {
        return [
            'username' => ['required', 'alpha_dash:ascii', 'max:100', Rule::unique('users', 'username')],
            'email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', Password::min(8), 'max:100'],
            'password_confirmation' => ['required', 'same:password'],
        ];
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
    public function render()
    {
        return view('livewire.register');
    }
    public function register()
    {
        $validated = $this->validate();
        $user = null;
        DB::transaction(function () use ($validated, &$user) {
            $user = User::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'ticket' => Str::random(100),
            ]);
            Profile::create([
                'user_id' => $user->id
            ]);
        });
        if ($user != null) {
            Mail::to($user->email)->queue(new VerificationRequest($user));
            return redirect()->route('home')->with('success', 'Done, now you need to verify your email address, check your email address');
        }
    }
}
