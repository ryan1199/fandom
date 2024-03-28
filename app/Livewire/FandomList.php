<?php

namespace App\Livewire;

use App\Models\Fandom;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Fandom List')]
class FandomList extends Component
{
    public $create_fandom_modal = false;
    public $create_fandom_modal_position = [];
    public $preferences = [];
    public $fandoms = [];
    public function render()
    {
        return view('livewire.fandom-list');
    }
    public function mount()
    {
        $this->loadFandoms();
        if (Auth::check()) {
            $this->preferences = session()->get('preference-' . Auth::user()->username);
            $this->create_fandom_modal_position = $this->preferences['create_fandom_modal_position'];
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
    #[On('load_fandoms')]
    public function loadFandoms()
    {
        $this->fandoms = Fandom::with(['avatar.image', 'cover.image', 'members'])->get();
    }
    public function updated($property)
    {
        if (Auth::check()) {
            session()->put('last-active-' . Auth::user()->username, now());
        }
    }
    #[On('save_create_fandom_modal_position')]
    public function saveCreateFandomModalPosition($data)
    {
        $data['left'] = is_int($data['left']) ? $data['left'] : 0;
        $data['right'] = is_int($data['right']) ? $data['right'] : 0;
        $data['top'] = is_int($data['top']) ? $data['top'] : 0;
        $data['bottom'] = is_int($data['bottom']) ? $data['bottom'] : 0;
        $data['left'] = ($data['left'] >= 0) ? $data['left'] : 0;
        $data['right'] = ($data['right'] >= 0) ? $data['right'] : 0;
        $data['top'] = ($data['top'] >= 0) ? $data['top'] : 0;
        $data['bottom'] = ($data['bottom'] >= 0) ? $data['bottom'] : 0;
        $this->create_fandom_modal_position = [
            'left' => $data['left'],
            'right' => $data['right'],
            'top' => $data['top'],
            'bottom' => $data['bottom']
        ];
        $preferences = session()->get('preference-' . Auth::user()->username);
        session()->put('preference-' . Auth::user()->username, [
            'color_1' => $preferences['color_1'],
            'color_2' => $preferences['color_2'],
            'color_3' => $preferences['color_3'],
            'color_primary' => $preferences['color_primary'],
            'color_secondary' => $preferences['color_secondary'],
            'color_text' => $preferences['color_text'],
            'font_size' => $preferences['font_size'],
            'selected_font_family' => $preferences['selected_font_family'],
            'create_fandom_modal_position' => [
                'left' => $data['left'],
                'right' => $data['right'],
                'top' => $data['top'],
                'bottom' => $data['bottom']
            ],
            'account_settings_modal_position' => $preferences['account_settings_modal_position'],
            'profile_settings_modal_position' => $preferences['profile_settings_modal_position'],
            'preference_settings_modal_position' => $preferences['preference_settings_modal_position']
        ]);
        $this->preferences = session()->get('preference-' . Auth::user()->username);
    }
}
