<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Alert extends Component
{
    public $message = '';
    public $open = false;
    public $type = '';
    public function mount()
    {
        if(session()->has('success'))
        {
            $this->type = 'success';
            $this->message = session()->get('success');
            $this->open = true;
        }
        if(session()->has('error'))
        {
            $this->type = 'error';
            $this->message = session()->get('error');
            $this->open = true;
        }
        if(session()->has('normal'))
        {
            $this->type = 'normal';
            $this->message = session()->get('normal');
            $this->open = true;
        }
    }
    public function render()
    {
        return view('livewire.alert');
    }
    #[On('alert')]
    public function openAlert($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
        $this->open = true;
    }
    public function closeAlert()
    {
        $this->reset(['message', 'open', 'type']);
    }
}