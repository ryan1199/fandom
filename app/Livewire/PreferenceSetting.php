<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PreferenceSetting extends Component
{
    #[Validate()]
    public $user = [];
    public $color_1 = '#000000';
    public $color_2 = '#000000';
    public $color_3 = '#000000';
    public $color_primary = '#ffffff';
    public $color_secondary = '#000000';
    public $color_text = '#000000';
    #[Locked]
    // public $available_font_families = [
    //     'Arial',
    //     'Verdana',
    //     'Tahoma',
    //     'Trebuchet MS',
    //     'Times New Roman',
    //     'Georgia',
    //     'Garamond',
    //     'Courier New',
    //     'Brush Script MT'
    // ];
    public $available_font_families = [
        'sans','serif','mono'
    ];
    // public $available_font_families = [
    //     'Arial',
    //     'Baskerville',
    //     'Bodoni MT',
    //     'Calibri',
    //     'Calisto MT',
    //     'Cambria',
    //     'Candara',
    //     'Century Gothic',
    //     'Consolas',
    //     'Copperplate',
    //     'Courier New',
    //     'Dejavu Sans',
    //     'Didot',
    //     'Franklin Gothic',
    //     'Garamond',
    //     'Georgia',
    //     'GillSans',
    //     'GoudyOld Style',
    //     'Helvetica Neue',
    //     'Impact',
    //     'Lucida Bright',
    //     'Lucida Handwriting',
    //     'Lucida Sans',
    //     'MS Sans Serif',
    //     'Optima',
    //     'Palatino',
    //     'Perpetua',
    //     'Rage',
    //     'Rockwell',
    //     'Script MT',
    //     'Segoescript',
    //     'Segoe UI',
    //     'Snell Roundhand',
    //     'Tahoma',
    //     'Trebuchet MS',
    //     'Verdana'
    // ];
    public $font_size = 16;
    public $selected_font_family = 'mono';
    public function rules()
    {
        return [
            'color_1' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'color_2' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'color_3' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'color_primary' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'color_secondary' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'color_text' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'font_size' => ['required', 'numeric', 'min:12', 'max:128'],
            'selected_font_family' => ['required', Rule::in($this->available_font_families)]
        ];
    }
    public function mount(User $user)
    {
        $this->user = $user;
        if(session()->has(Auth::user()->username . '-preference'))
        {
            $user_preference = session()->get(Auth::user()->username . '-preference');
            $this->color_1 = $user_preference['color_1'];
            $this->color_2 = $user_preference['color_2'];
            $this->color_3 = $user_preference['color_3'];
            $this->color_primary = $user_preference['color_primary'];
            $this->color_secondary = $user_preference['color_secondary'];
            $this->color_text = $user_preference['color_text'];
            $this->font_size = $user_preference['font_size'];
            $this->selected_font_family = $user_preference['selected_font_family'];
        }
    }
    public function render()
    {
        return view('livewire.preference-setting');
    }
    public function updatePreference()
    {
        // check (user['id] === Auth::id())
        $this->validate();
        session()->put($this->user['username'] . '-preference', [
            'color_1' => $this->color_1,
            'color_2' => $this->color_2,
            'color_3' => $this->color_3,
            'color_primary' => $this->color_primary,
            'color_secondary' => $this->color_secondary,
            'color_text' => $this->color_text,
            'font_size' => $this->font_size,
            'selected_font_family' => $this->selected_font_family
        ]);
        $this->reset(['color_1','color_2','color_3','color_primary','color_secondary','color_text','font_size','selected_font_family',]);
        $this->dispatch('alert', 'success', 'Done, new preferences saved')->to(Alert::class);
        $this->dispatch('load_user', $this->user['username']);
        return redirect()->route('user', $this->user)->with('success', 'Done, new preferences saved');
    }
}