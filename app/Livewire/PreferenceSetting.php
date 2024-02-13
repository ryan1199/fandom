<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
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
    public $available_font_families = [
        'sans','serif','mono'
    ];
    public $font_size = 16;
    public $selected_font_family = 'mono';
    public $preferences = [];
    public $create_fandom_modal_position = [];
    public $account_settings_modal_position = [];
    public $profile_settings_modal_position = [];
    public $preference_settings_modal_position = [];
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
    public function mount(User $user, $preferences)
    {
        $this->user = $user;
        $this->preferences = $preferences;
        $this->color_1 = $this->preferences['color_1'];
        $this->color_2 = $this->preferences['color_2'];
        $this->color_3 = $this->preferences['color_3'];
        $this->color_primary = $this->preferences['color_primary'];
        $this->color_secondary = $this->preferences['color_secondary'];
        $this->color_text = $this->preferences['color_text'];
        $this->font_size = $this->preferences['font_size'];
        $this->selected_font_family = $this->preferences['selected_font_family'];
        $this->create_fandom_modal_position = $this->preferences['create_fandom_modal_position'];
        $this->account_settings_modal_position = $this->preferences['account_settings_modal_position'];
        $this->profile_settings_modal_position = $this->preferences['profile_settings_modal_position'];
        $this->preference_settings_modal_position = $this->preferences['preference_settings_modal_position'];
    }
    public function render()
    {
        return view('livewire.preference-setting');
    }
    public function updatePreference()
    {
        $user = User::where('id', $this->user['id'])->first();
        $this->authorize('update', $user);

        $this->validate();

        session()->put('preference-' . $this->user['username'], [
            'color_1' => $this->color_1,
            'color_2' => $this->color_2,
            'color_3' => $this->color_3,
            'color_primary' => $this->color_primary,
            'color_secondary' => $this->color_secondary,
            'color_text' => $this->color_text,
            'font_size' => $this->font_size,
            'selected_font_family' => $this->selected_font_family,
            'create_fandom_modal_position' => $this->create_fandom_modal_position,
            'account_settings_modal_position' => $this->account_settings_modal_position,
            'profile_settings_modal_position' => $this->profile_settings_modal_position,
            'preference_settings_modal_position' => $this->preference_settings_modal_position
        ]);

        $this->reset(['color_1','color_2','color_3','color_primary','color_secondary','color_text','font_size','selected_font_family',]);
        $this->dispatch('load_user', $this->user['username']);
        return redirect()->route('user', $this->user)->with('success', 'Done, new preferences saved');
    }
    public function resetPreference()
    {
        $user = User::where('id', $this->user['id'])->first();
        $this->authorize('update', $user);

        session()->put(key: 'preference-' . Auth::user()->username, value: [
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
        ]);

        $this->dispatch('load_user', $this->user['username']);
        return redirect()->route('user', $this->user)->with('success', 'Done, your preferences are reseted');
    }
    public function updated($property)
    {
        if(Auth::check())
        {
            session()->put('last-active-' . Auth::user()->username, now());
        }
    }
    #[On('save_preference_settings_modal_position')]
    public function savePreferenceSettingsModalPosition($data)
    {
        $data['left'] = is_int($data['left']) ? $data['left'] : 0;
        $data['right'] = is_int($data['right']) ? $data['right'] : 0;
        $data['top'] = is_int($data['top']) ? $data['top'] : 0;
        $data['bottom'] = is_int($data['bottom']) ? $data['bottom'] : 0;
        $data['left'] = ($data['left'] >= 0) ? $data['left'] : 0;
        $data['right'] = ($data['right'] >= 0) ? $data['right'] : 0;
        $data['top'] = ($data['top'] >= 0) ? $data['top'] : 0;
        $data['bottom'] = ($data['bottom'] >= 0) ? $data['bottom'] : 0;
        $this->preference_settings_modal_position = [
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
            'create_fandom_modal_position' => $preferences['create_fandom_modal_position'],
            'account_settings_modal_position' => $preferences['account_settings_modal_position'],
            'profile_settings_modal_position' => $preferences['profile_settings_modal_position'],
            'preference_settings_modal_position' => [
                'left' => $data['left'],
                'right' => $data['right'],
                'top' => $data['top'],
                'bottom' => $data['bottom']
            ]
        ]);
        $this->preferences = session()->get('preference-' . Auth::user()->username);
    }
}