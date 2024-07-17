<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RightSideNavigationBar extends Component
{
    public $open_component = false;
    #[Locked]
    public $user = null;
    public $preferences = [];
    public function render()
    {
        return view('livewire.right-side-navigation-bar');
    }
    #[On('load_navigation')]
    public function mount()
    {
        if(Auth::check()) {
            $this->load();

            $this->preferences = session()->get('preference-' . $this->user->username);
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
            ];
        }
    }
    #[On('refresh')]
    public function load()
    {
        if(Auth::check()) {
            $this->user = User::with([
                'profile',
                'cover' => [
                    'image',
                ],
                'avatar' => [
                    'image',
                ],
                'members' => [
                    'fandom' => [
                        'discusses' => [
                            'messages' => [
                                'user' => [
                                    'cover' => [
                                        'image'
                                    ],
                                    'avatar' => [
                                        'image'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'role',
                ],
                'chats' => [
                    'messages' => [
                        'user',
                    ],
                    'users'
                ],
            ])->find(Auth::id());
        }
    }
    #[On('open')]
    public function open()
    {
        $this->open_component = true;
    }
    #[On('close')]
    public function close()
    {
        $this->open_component = false;
    }
}
