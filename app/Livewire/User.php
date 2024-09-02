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
    #[Locked]
    public $user;
    public $state = false;
    public $tab = 'image';
    public $chats;
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
            'members.fandom', 'members.role', 'chats.messages.user', 'chats.users'
        ])->where('username', $username)->first();
        $this->state = true;

        $this->chats = $this->user->chats;
        $this->state = false;
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
