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
    #[Validate()]
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
            Mail::to($user->email)->send(new VerificationRequest($user));
            return redirect()->route('home')->with('success', 'Done, now you need to verify your email address, check your email address');
        }
    }
}
