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
    public function rules()
    {
        return [
            'email' => ['required', 'email:rfc,dns', Rule::exists('users', 'email')]
        ];
    }
    public function mount($ticket = null)
    {
        if($ticket !== null)
        {
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
        if($verified_user)
        {
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
