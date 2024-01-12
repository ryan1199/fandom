<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class User extends Component
{
    public $setting_modal = false;
    public $account_modal = false;
    public $profile_modal = false;
    public $preference_modal = false;
    // bikin setting component
    // bikin profile component
    // bikin post component
    // ...
    public $user = [];
    public function mount(ModelsUser $user)
    {
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.user')->title(Auth::user()->username);
    }
}