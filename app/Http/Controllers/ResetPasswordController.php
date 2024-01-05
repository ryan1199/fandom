<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
    public function view()
    {
        return view('reset_password');
    }
    public function sendEmailResetPassword(Request $request)
    {
        $validator = Validator::make(data: $request->all(), rules: [
            'email' => ['required', 'email:rfc,dns', Rule::exists('users', 'email')],
        ]);
        if($validator->fails())
        {
            return redirect()->route('reset-password.view')->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();
        $new_ticket = Str::random(100);
        User::where('email', $validated['email'])->update([
            'ticket' => $new_ticket
        ]);
        $user = User::where('email', $validated['email'])->first();
        Mail::to($user->email)->send(new ResetPasswordRequest($user));
        session()->flash('success', 'Done, check your email');
        return redirect()->route('home');
    }
    public function newPassword()
    {
        return view('new_password');
    }
    public function updatePassword(Request $request)
    {
        $validator = Validator::make(data: $request->all(), rules: [
            'password' => ['required', 'confirmed', Password::min(8), 'max:100'],
            'password_confirmation' => ['required', 'same:password'],
        ])->validate();
        $validated = $validator;
        User::where('ticket', $request->ticket)->update([
            'password' => Hash::make($validated['password']),
            'ticket' => null
        ]);
        session()->flash('success', 'Done, new password saved');
        return redirect()->route('home');
    }
}
