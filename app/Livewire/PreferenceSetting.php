<?php

namespace App\Livewire;

use App\Livewire\User as LivewireUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PreferenceSetting extends Component
{
    #[Locked]
    public $user;
    public $color_1;
    public $color_2;
    public $color_3;
    #[Locked]
    public $selected_color_scheme = 'color_scheme_2';
    #[Locked]
    public $selected_color;
    #[Locked]
    public $available_font_families = [
        'sans','serif','mono'
    ];
    public $available_color_scheme_1 = [
        'slate', 'gray', 'zinc', 'neutral', 'stone'
    ];
    public $available_color_scheme_2 = [
        'red', 'orange', 'amber', 'yellow', 'lime', 'green', 'emerald', 'teal', 'cyan', 'sky', 'blue', 'indigo', 'violet', 'purple', 'fuchsia', 'pink', 'rose'
    ];
    public $font_size = 16;
    public $selected_font_family = 'mono';
    public $dark_mode = false;
    public $current_route_name;
    public $preferences = [];
    public function rules()
    {
        return [
            // 'color_1' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            // 'color_2' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            // 'color_3' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            // 'color_primary' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            // 'color_secondary' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            // 'color_text' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'font_size' => ['required', 'numeric', 'min:11', 'max:127'],
            'selected_font_family' => ['required', Rule::in($this->available_font_families)],
            'dark_mode' => ['boolean']
        ];
    }
    public function mount(User $user, $preferences)
    {
        $this->user = $user;
        $this->preferences = $preferences;
        $this->font_size = $this->preferences['font_size'];
        $this->selected_font_family = $this->preferences['selected_font_family'];
        switch ($this->preferences['color_2']) {
            case in_array($this->preferences['color_2'], $this->available_color_scheme_1):
                $this->setColorScheme('color_scheme_1', $this->preferences['color_2']);
                break;
            case in_array($this->preferences['color_2'], $this->available_color_scheme_2):
                $this->setColorScheme('color_scheme_2', $this->preferences['color_2']);
                break;
            default:
                $this->setColorScheme('','');
                break;
        }
        $this->dark_mode = $this->preferences['dark_mode'];
        $this->current_route_name = request()->route()->getName(); //ada parameter di beberapa route
    }
    public function render()
    {
        return view('livewire.preference-setting');
    }
    public function updatePreference()
    {
        $this->authorize('update', $this->user);
        $this->validate();
        session()->put('preference-' . $this->user->username, [
            'color_1' => $this->color_1,
            'color_2' => $this->color_2,
            'color_3' => $this->color_3,
            'font_size' => $this->font_size,
            'selected_font_family' => $this->selected_font_family,
            'dark_mode' => $this->dark_mode,
        ]);
        $this->preferences = session()->get('preference-' . $this->user->username);
        $this->reset(['color_1','color_2','color_3','font_size','selected_font_family','dark_mode']);
        return redirect()->route($this->current_route_name)->with('success', 'Done, new preferences saved');
    }
    public function resetPreference()
    {
        $this->authorize('update', $this->user);
        $this->setColorScheme('','');
        session()->put(key: 'preference-' . $this->user->username, value: [
            'color_1' => $this->color_1,
            'color_2' => $this->color_2,
            'color_3' => $this->color_3,
            'font_size' => 16,
            'selected_font_family' => 'mono',
            'dark_mode' => false,
        ]);
        $this->preferences = session()->get('preference-' . $this->user->username);
        $this->mount($this->user, $this->preferences);
        return redirect()->refresh()->with('success', 'Done, your preferences are reseted');
    }
    public function setColorScheme($selected_color_scheme, $selected_color)
    {
        switch ($selected_color_scheme) {
            case 'color_scheme_1':
                $this->selected_color_scheme = $selected_color_scheme;
                if(in_array($selected_color, $this->available_color_scheme_1)) {
                    $i = array_search($selected_color, $this->available_color_scheme_1);
                    $last_element = count($this->available_color_scheme_1) - 1;
                    if($i == 0) {
                        $this->color_1 = $this->available_color_scheme_1[$last_element];
                        $this->color_2 = $this->available_color_scheme_1[$i];
                        $this->color_3 = $this->available_color_scheme_1[$i + 1];
                    }
                    if($i == $last_element) {
                        $this->color_1 = $this->available_color_scheme_1[$i - 1];
                        $this->color_2 = $this->available_color_scheme_1[$i];
                        $this->color_3 = $this->available_color_scheme_1[0];
                    }
                    if($i > 0 && $i < $last_element) {
                        $this->color_1 = $this->available_color_scheme_1[$i - 1];
                        $this->color_2 = $this->available_color_scheme_1[$i];
                        $this->color_3 = $this->available_color_scheme_1[$i + 1];
                    }
                    $this->selected_color = $this->color_2;
                }
                break;
            case 'color_scheme_2':
                $this->selected_color_scheme = $selected_color_scheme;
                if(in_array($selected_color, $this->available_color_scheme_2)) {
                    $i = array_search($selected_color, $this->available_color_scheme_2);
                    $last_element = count($this->available_color_scheme_2) - 1;
                    if($i == 0) {
                        $this->color_1 = $this->available_color_scheme_2[$last_element];
                        $this->color_2 = $this->available_color_scheme_2[$i];
                        $this->color_3 = $this->available_color_scheme_2[$i + 1];
                    }
                    if($i == $last_element) {
                        $this->color_1 = $this->available_color_scheme_2[$i - 1];
                        $this->color_2 = $this->available_color_scheme_2[$i];
                        $this->color_3 = $this->available_color_scheme_2[0];
                    }
                    if($i > 0 && $i < $last_element) {
                        $this->color_1 = $this->available_color_scheme_2[$i - 1];
                        $this->color_2 = $this->available_color_scheme_2[$i];
                        $this->color_3 = $this->available_color_scheme_2[$i + 1];
                    }
                    $this->selected_color = $this->color_2;
                }
                break;
            default:
                $this->selected_color_scheme = 'color_scheme_2';
                $last_element = count($this->available_color_scheme_2) - 1;
                $this->color_1 = $this->available_color_scheme_2[$last_element - 1];
                $this->color_2 = $this->available_color_scheme_2[$last_element];
                $this->color_3 = $this->available_color_scheme_2[0];
                $this->selected_color = $this->color_2;
                break;
        }
    }
    public function updated($property)
    {
        if(Auth::check())
        {
            session()->put('last-active-' . $this->user->username, now());
        }
    }
}