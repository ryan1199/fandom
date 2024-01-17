<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class User extends Component
{
    public $setting_modal = false;
    public $account_modal = false;
    public $profile_modal = false;
    public $preference_modal = false;
    public $user = [];
    public $state = false;
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function mount(ModelsUser $user)
    {
        $this->loadUser($user->username);
    }
    public function render()
    {
        return view('livewire.user')->title(Auth::user()->username);
    }
    #[On('load_user')]
    public function loadUser($username)
    {
        // dd($username);
        $user = ModelsUser::where('username', $username)->with([
            'profile','avatar.image','cover.image'
        ])->first();
        $this->user = $user;
        $this->state = true;
        $this->reset('state');
    }
    public function updatedState($value)
    {
        $this->dispatch('refreshComponent')->self();
    }
}