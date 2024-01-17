<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
class Home extends Component
{
    public function render()
    {
        // $user_preference = session()->get(Auth::user()->username . '-preference');
        // dd($user_preference);
        // return view('livewire.home', data:[
        //     'color_1' => $user_preference['color_1'],
        //     'color_2' => $user_preference['color_2'],
        //     'color_3' => $user_preference['color_3'],
        //     'color_primary' => $user_preference['color_primary'],
        //     'color_secondary' => $user_preference['color_secondary'],
        //     'selected_font_family' => $user_preference['selected_font_family'],
        // ]);
        return view('livewire.home');
    }
}