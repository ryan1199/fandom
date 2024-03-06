<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class PostCreateEdit extends Component
{
    public $preferences = [];
    public $mode = 'create';
    public function render()
    {
        return view('livewire.post-create-edit');
    }
    public function mount()
    {
        
    }
    #[On('create_post')]
    public function createPost()
    {
        $this->mode = 'create';
        dd('create post from post create edit');
    }
}
