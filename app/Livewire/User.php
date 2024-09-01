<?php

namespace App\Livewire;

use App\Events\NewChat;
use App\Models\Chat;
use App\Models\Follow;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\User as ModelsUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class User extends Component
{
    public $setting_modal = false;
    public $account_modal = false;
    public $profile_modal = false;
    public $preference_modal = false;
    #[Locked]
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
    public $profile;
    public $cover;
    public $avatar;
    public $preferences = [];
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount(ModelsUser $user)
    {
        $this->loadUser($user->username);
        if (session()->has('preference-' . Auth::user()->username)) {
            $this->preferences = session()->get('preference-' . Auth::user()->username);
        } else {
            $this->preferences = [
                'color_1' => 'pink',
                'color_2' => 'rose',
                'color_3' => 'red',
                'font_size' => 16,
                'selected_font_family' => 'mono',
                'dark_mode' => false,
            ];
            session()->put('preference-' . Auth::user()->username, $this->preferences);
        }
    }
    public function render()
    {
        return view('livewire.user')->title($this->user->username);
    }
    #[On('load_user')]
    public function loadUser($username)
    {
        $this->user = ModelsUser::with([
            'profile', 'avatar.image', 'cover.image', 'members.fandom', 'members.role', 'publishes', 'chats.messages.user', 'chats.users', 'follows', 'blocks'
        ])->where('username', $username)->first();
        $this->state = true;

        $galleries = Gallery::with(['user', 'publish', 'image'])->whereIn('publish_id', $this->user->publishes->pluck('id'))->get();
        $posts = Post::with(['user', 'publish'])->whereIn('publish_id', $this->user->publishes->pluck('id'))->get();
        $this->galleries['self'] = $galleries;
        $this->galleries['friend'] = $galleries->whereIn('publish.visible', ['friend', 'public']);
        $this->galleries['public'] = $galleries->where('publish.visible', 'public');
        $this->posts['self'] = $posts;
        $this->posts['friend'] = $posts->whereIn('publish.visible', ['friend', 'public']);
        $this->posts['public'] = $posts->where('publish.visible', 'public');

        $this->chats = $this->user->chats;
        $this->followed_users = $this->user->follows;
        $this->blocked_users = $this->user->blocks;
        // $this->loadProfile();
        $this->profile = $this->user->profile;
        $this->cover = $this->user->cover;
        $this->avatar = $this->user->avatar;
        $this->loadFollowersAndFollowing();
        $this->state = false;
    }
    public function loadProfile()
    {
        $user = ModelsUser::with([
            'profile',
            'cover' => [
                'image'
            ],
            'avatar' => [
                'image'
            ],
        ])->find($this->user->id);
        $this->profile = $user->profile;
        $this->cover = $user->cover;
        $this->avatar = $user->avatar;
    }
    public function loadFollowersAndFollowing()
    {
        $this->followers = Number::abbreviate(Follow::where('other_user_id', $this->user->id)->get()->count());
        $this->following = Number::abbreviate(Follow::where('self_user_id', $this->user->id)->get()->count());
    }
    public function loadPosts($event)
    {
        $user = ModelsUser::find($event['user']['id']);
        $posts = Post::with(['user', 'publish'])->whereIn('publish_id', $user->publishes->pluck('id'))->get();
        $this->posts['self'] = $posts;
        $this->posts['friend'] = $posts->whereIn('publish.visible', ['friend', 'public']);
        $this->posts['public'] = $posts->where('publish.visible', 'public');
    }
    public function loadGalleries($event)
    {
        $user = ModelsUser::find($event['user']['id']);
        $galleries = Gallery::with(['user', 'publish', 'image'])->whereIn('publish_id', $user->publishes->pluck('id'))->get();
        $this->galleries['self'] = $galleries;
        $this->galleries['friend'] = $galleries->whereIn('publish.visible', ['friend', 'public']);
        $this->galleries['public'] = $galleries->where('publish.visible', 'public');
    }
    public function chatTo()
    {
        $chats = Chat::query()->whereHas('users',function (Builder $query) {
            $query->where('user_id', $this->user->id);
        })->get();
        $chat_id = null;
        if($chats->isNotEmpty()) {
            $user_ids = collect();
            foreach($chats as $chat) {
                $user_ids = ($chat->users->pluck('id'));
                $user_ids->flatten();
                if($user_ids->containsStrict(Auth::id())) {
                    $chat_id = $chat->id;
                } else {
                    $new_chat = new Chat();
                    $new_chat->save();
                    $new_chat->users()->attach([$this->user->id, Auth::id()]);
                    $chat_id = $new_chat->id;
                }
            }
        } 
        if($chats->isEmpty()) {
            $chat = new Chat();
            $chat->save();
            $chat->users()->attach([$this->user->id, Auth::id()]);
            $chat_id = $chat->id;
        }
        NewChat::dispatch($this->user, Auth::user());
        $this->dispatch('open')->to(RightSideNavigationBar::class);
        $this->dispatch('openChat', $chat_id)->to(ChatDetails::class);
    }
    public function getListeners()
    {
        return [
            "echo-private:User.{$this->user->id},UserFollowed" => 'loadFollowersAndFollowing',
            "echo-private:User.{$this->user->id},UserUnfollowed" => 'loadFollowersAndFollowing',
            "echo-private:User.{$this->user->id},UserBlocked" => 'loadFollowersAndFollowing',
            "echo-private:User.{$this->user->id},UserProfileUpdated" => 'loadProfile',
            "echo-private:User.{$this->user->id},UsersPostPublished" => 'loadPosts',
            "echo-private:User.{$this->user->id},UsersPostUnpublished" => 'loadPosts',
            "echo-private:User.{$this->user->id},UsersGalleryPublished" => 'loadGalleries',
            "echo-private:User.{$this->user->id},UsersGalleryUnpublished" => 'loadGalleries',
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
