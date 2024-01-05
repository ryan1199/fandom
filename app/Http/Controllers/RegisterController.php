<?php

namespace App\Http\Controllers;

use App\Mail\VerificationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function view()
    {
        if(Auth::check())
        {
            return redirect()->route('home');
        } else {
            return view('register');
        }
    }
    public function process(Request $request)
    {
        $validator = Validator::make(data: $request->all(), rules: [
            'username' => ['required','alpha_dash:ascii','max:100', Rule::unique('users', 'username')],
            'email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', Password::min(8), 'max:100'],
            'password_confirmation' => ['required', 'same:password'],
        ]);
        if($validator->fails())
        {
            return redirect()->route('register.view')->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'ticket' => Str::random(100),
        ]);
        Mail::to($user->email)->send(new VerificationRequest($user));
        session()->flash('success', 'Done, please check your email, we send you email varification link');
        return redirect()->route('home');
    }
}
