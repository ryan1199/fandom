<?php

namespace App\Livewire;

use App\Mail\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Forgot Password')]
class ForgotPassword extends Component
{
    #[Validate()]
    public $email = '';
    public $preferences = [];
    public function rules()
    {
        return [
            'email' => ['required', 'email:rfc,dns', Rule::exists('users', 'email')]
        ];
    }
    public function render()
    {
        return view('livewire.forgot-password');
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
    public function sendEmailForgotPassword()
    {
        $validated = $this->validate();
        $new_ticket = Str::random(100);
        User::where('email', $validated['email'])->update([
            'ticket' => $new_ticket
        ]);
        $user = User::where('email', $validated['email'])->first();
        Mail::to($user->email)->send(new ResetPasswordRequest($user));
        return redirect()->route('home')->with('success', 'Done, now check your email');
    }
}
