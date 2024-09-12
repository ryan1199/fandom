<?php

namespace App\Livewire;

use App\Events\NewChat;
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
    public $preferences = [];
    public function render()
    {
        return view('livewire.left-side-navigation-bar');
    }
    #[On('load_navigation')]
    public function mount()
    {
        if(Auth::check()) {
            $this->load();
            if (session()->has('preference-' . Auth::user()->username)) {
                $this->preferences = session()->get('preference-' . Auth::user()->username);
            } else {
                $this->preferences = session()->get('preference-global');
                session()->put('preference-' . Auth::user()->username, $this->preferences);
            }
        } else {
            $this->preferences = [
                'color_1' => 'pink',
                'color_2' => 'rose',
                'color_3' => 'red',
                'font_size' => 16,
                'selected_font_family' => 'mono',
                'dark_mode' => false,
            ];
            session()->put('preference-global', $this->preferences);
        }
    }
    public function chatTo($user_id)
    {
        $user = User::find($user_id);
        if($user != null) {
            $chats = Chat::query()->whereHas('users',function (Builder $query) use ($user_id) {
                $query->where('user_id', $user_id);
            })->get();
            $selected_chat = '';
            if($chats->isNotEmpty()) {
                $user_ids = collect();
                foreach($chats as $chat) {
                    $user_ids = ($chat->users->pluck('id'));
                    $user_ids->flatten();
                    if($user_ids->containsStrict($this->user->id)) {
                        $selected_chat = $chat;
                    } else {
                        $selected_chat = new Chat();
                        $selected_chat->save();
                        $selected_chat->users()->attach([$user_id, $this->user->id]);
                    }
                }
            } 
            if($chats->isEmpty()) {
                $selected_chat = new Chat();
                $selected_chat->save();
                $selected_chat->users()->attach([$user_id, $this->user->id]);
            }
            NewChat::dispatch($user, $this->user);
            $this->dispatch('open')->to(RightSideNavigationBar::class);
            $this->dispatch('openChat', $selected_chat->id)->to(ChatDetails::class);
        } else {
            $this->dispatch('error', 'User not found');
        }
    }
    public function openChat()
    {
        $this->dispatch('open')->to(RightSideNavigationBar::class);
    }
    public function load()
    {
        if(Auth::check()) {
            $this->user = User::with([
                'members' => [
                    'fandom',
                ],
            ])->find(Auth::id());
        }
    }
    public function getListeners()
    {
        return [
            "echo-private:LeftSideNavigationBar.{$this->user->id},UserJoined" => 'loadFandoms',
            "echo-private:LeftSideNavigationBar.{$this->user->id},UserLeaved" => 'loadFandoms',
        ];
    }
    public function loadFandoms($event)
    {
        if(Auth::check()) {
            $this->user = User::with([
                'members' => [
                    'fandom',
                ],
            ])->find($event['user']['id']);
        }
    }
}
