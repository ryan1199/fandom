<?php

namespace App\Livewire;

use App\Models\Follow;
use App\Models\Gallery;
use App\Models\Post;
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
    public $user;
    public $state = false;
    public $tab = 'image';
    public $galleries;
    public $posts;
    public $friendlist_id = [];
    public $chats;
    public $followed_users;
    public $blocked_users;
    public $followers;
    public $following;
    public $preferences = [];
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount(ModelsUser $user)
    {
        $this->loadUser($user->username);
        if (session()->has('preference-' . Auth::user()->username)) {
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
            session()->put('preference-' . Auth::user()->username, $this->preferences);
        }
    }
    public function render()
    {
        return view('livewire.user')->title(Auth::user()->username);
    }
    #[On('load_user')]
    public function loadUser($username)
    {
        $user = ModelsUser::with([
            'profile', 'avatar.image', 'cover.image', 'members.fandom', 'members.role', 'publishes', 'chats.messages.user', 'chats.users', 'follows'
        ])->where('username', $username)->first();

        $this->user = $user;
        $this->state = true;
        $galleries = collect(Gallery::with(['user', 'publish', 'image'])->whereIn('publish_id', $user->publishes->pluck('id'))->get());
        $posts = collect(Post::with(['user', 'publish'])->whereIn('publish_id', $user->publishes->pluck('id'))->get());
        $this->galleries['self'] = $galleries;
        $this->galleries['public'] = collect($galleries)->where('publish.visible', 'public');
        $this->posts['self'] = $posts;
        $this->posts['friend'] = collect($posts)->whereIn('publish.visible', ['friend', 'public']);
        $this->posts['public'] = collect($posts)->where('publish.visible', 'public');
        $this->chats = $this->user->chats;
        $this->followed_users = $this->user->follows;
        $this->blocked_users = $this->user->blocks;
        $this->loadFollowersAndFollowing();

        $this->reset('state');
    }
    public function loadFollowersAndFollowing()
    {
        $this->followers = Follow::where('other_user_id', $this->user->id)->get()->count();
        $this->following = Follow::where('self_user_id', $this->user->id)->get()->count();
    }
    public function getListeners()
    {
        return [
            "echo-private:User.{$this->user->id},UserFollowed" => 'loadFollowersAndFollowing',
            "echo-private:User.{$this->user->id},UserUnfollowed" => 'loadFollowersAndFollowing',
            "echo-private:User.{$this->user->id},UserBlocked" => 'loadFollowersAndFollowing',
        ];
    }
    public function updatedState($value)
    {
        $this->dispatch('refreshComponent')->self();
    }
    public function updated($property)
    {
        if (Auth::check()) {
            session()->put('last-active-' . Auth::user()->username, now());
        }
    }
}
