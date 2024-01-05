<?php

namespace App\Http\Controllers;

use App\Mail\VerificationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    public function view()
    {
        return view('verification');
    }
    public function sendEmailVerification(Request $request)
    {
        $validator = Validator::make(data: $request->all(), rules: [
            'email' => ['required', 'email:rfc,dns', Rule::exists('users', 'email')],
        ]);
        if($validator->fails())
        {
            return redirect()->route('verification.view')->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();
        $new_ticket = Str::random(100);
        User::where('email', $validated['email'])->update([
            'ticket' => $new_ticket,
        ]);
        $user = User::where('email', $validated['email'])->first();
        Mail::to($user->email)->send(new VerificationRequest($user));
        session()->flash('success', 'Done, check your email');
        return redirect()->route('home');
    }
    public function verifyEmail()
    {
        $ticket = request()->route('ticket');
        User::where('ticket', $ticket)->update([
            'ticket' => null,
            'email_verified_at' => now(),
        ]);
        session()->flash('success', 'Done, you are verified');
        return redirect()->route('home');
    }
}
