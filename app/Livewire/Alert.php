<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Alert extends Component
{
    public $message = '';
    public $open = false;
    public $type = '';
    public $preferences = [];
    public function mount()
    {
        if (session()->has('success')) {
            $this->type = 'success';
            $this->message = session()->get('success');
            $this->open = true;
        }
        if (session()->has('error')) {
            $this->type = 'error';
            $this->message = session()->get('error');
            $this->open = true;
        }
        if (session()->has('normal')) {
            $this->type = 'normal';
            $this->message = session()->get('normal');
            $this->open = true;
        }
        if (Auth::check()) {
            $this->preferences = session()->get('preference-' . Auth::user()->username);
        } else {
            $this->preferences = [
                'color_1' => '#f97316',
                'color_2' => '#ec4899',
                'color_3' => '#6366f1',
                'color_primary' => '#ffffff',
                'color_secondary' => '#000000',
                'color_text' => '#000000',
                'font_size' => 16,
                'selected_font_family' => 'mono',
                'create_fandom_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'account_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'profile_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'preference_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ]
            ];
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
