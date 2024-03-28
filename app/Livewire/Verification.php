<?php

namespace App\Livewire;

use App\Mail\VerificationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Verification')]
class Verification extends Component
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
    public function mount($ticket = null)
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
        if ($ticket !== null) {
            User::where('ticket', $ticket)->update([
                'ticket' => null,
                'email_verified_at' => now(),
            ]);
            return redirect()->route('login')->with('success', 'Done, you are now verified');
        }
    }
    public function render()
    {
        return view('livewire.verification');
    }
    public function sendEmailVerification()
    {
        $validated = $this->validate();
        $verified_user = User::whereNot('email_verified_at', null)->first();
        if ($verified_user) {
            $this->reset('email');
            $this->dispatch('alert', 'error', 'The provided email is already verified')->to(Alert::class);
        } else {
            $new_ticket = Str::random(100);
            User::where('email', $validated['email'])->update([
                'ticket' => $new_ticket,
            ]);
            $user = User::where('email', $validated['email'])->first();
            Mail::to($user->email)->send(new VerificationRequest($user));
            return redirect()->route('home')->with('success', 'Done, now check your email');
        }
    }
}
