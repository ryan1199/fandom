<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function view()
    {
        if(Auth::check())
        {
            return redirect()->route('home');
        } else {
            return view('login');
        }
    }
    public function process(Request $request)
    {
        $validator = Validator::make(data: $request->all(), rules: [
            'username' => ['required','alpha_dash:ascii','max:100'],
            'password' => ['required', Password::min(8)],
            'remember' => ['boolean']
        ]);
        if($validator->fails())
        {
            return redirect()->route('login.view')->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();
        $validated['remember'] = true ? true : false;
        if(Auth::attemptWhen([
            'username' => $validated['username'], 
            'password' => $validated['password']
        ], function (User $user) {
            return $user->email_verified_at !== null;
        }, $validated['remember']))
        {
            $request->session()->regenerate();
            session()->flash('success', 'Hi ' . Auth::user()->name);
            return redirect()->route('home');
        }
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records or you not yet verify your email address'
        ])->withInput();
    }
}
