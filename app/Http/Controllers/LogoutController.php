<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function process(Request $request)
    {
        if(Auth::check())
        {
            Auth::logout();
            $request->session()->regenerateToken();
            session()->flash('success', 'Done, you are loged out');
            return redirect()->route('home');
        } else {
            return redirect()->route('login.view');
        }
    }
}
