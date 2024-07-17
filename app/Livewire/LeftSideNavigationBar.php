<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class LeftSideNavigationBar extends Component
{
    #[Locked]
    public $user = null;
    public $followed_users = null;
    public $blocked_users = null;
    public $preferences = [];
    public function render()
    {
        return view('livewire.left-side-navigation-bar');
    }
    #[On('load_navigation')]
    public function mount()
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
                        'discusses'
                    ],
                    'role',
                ],
                'follows',
                'blocks'
            ])->find(Auth::id());
            $followed_user_ids = $this->user->follows->pluck('id');
            $this->followed_users = User::with([
                'profile',
                'cover' => [
                    'image',
                ],
                'avatar' => [
                    'image',
                ],
            ])->whereIn('id', $followed_user_ids)->get();
            $blocked_user_ids = $this->user->blocks->pluck('id');
            $this->blocked_users = User::with([
                'profile',
                'cover' => [
                    'image',
                ],
                'avatar' => [
                    'image',
                ],
            ])->whereIn('id', $blocked_user_ids)->get();
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
    public function chatTo($user_id)
    {
        $chat = Chat::query()->whereHas('users',function (Builder $query) use ($user_id) {
            $query->whereIn('user_id', [$this->user->id, $user_id]);
        })->first();
        if($chat == null)
        {
            $chat = new Chat();
            $chat->save();
            $chat->users()->attach([$this->user->id, $user_id]);
        }
        $this->dispatch('refresh')->to(RightSideNavigationBar::class);
        $this->dispatch('open')->to(RightSideNavigationBar::class);
        $this->dispatch('openChat', $chat->id)->to(ChatDetails::class);
    }
    public function openChat()
    {
        $this->dispatch('refresh')->to(RightSideNavigationBar::class);
        $this->dispatch('open')->to(RightSideNavigationBar::class);
    }
}
