<?php

namespace App\Livewire;

use App\Events\NewChatMessage;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Reactive;

class ChatForm extends Component
{
    #[Locked]
    public $user1;
    #[Locked]
    public $user2;
    #[Reactive]
    public $user_ids = [];
    public $content = '';
    public $preferences = [];
    public function render()
    {
        return view('livewire.chat-form');
    }
    public function mount(User $user1, User $user2, $user_ids, $preferences)
    {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->user_ids = $user_ids;
        $this->preferences = $preferences;
    }
    public function submitChat()
    {
        $this->authorize('submit', [Chat::class, $this->user_ids]);
        $validated = Validator::make(
            [
                'content' => $this->content
            ], [
                'content' =>'required|max:10000'
            ], [
                'required' => 'The :attribute can not be empty',
                'max' => 'The maximum length of the :attribute is :max characters'
            ], [
                'content' => 'message',
            ]
        )->validate();
        $selected_chat = '';
        $message = '';
        $result = false;
        DB::transaction(function () use ($validated, &$selected_chat, &$message, &$result) {
            $chats = Chat::query()->whereHas('users',function (Builder $query) {
                $query->where('user_id', $this->user2->id);
            })->get();
            if($chats->isNotEmpty()) {
                $user_ids = collect();
                foreach($chats as $chat) {
                    $user_ids = ($chat->users->pluck('id'));
                    $user_ids->flatten();
                    if($user_ids->containsStrict($this->user1->id)) {
                        $selected_chat = $chat;
                    } else {
                        $selected_chat = new Chat();
                        $selected_chat->save();
                        $selected_chat->users()->attach([$this->user2->id, $this->user1->id]);
                    }
                }
            } 
            if($chats->isEmpty()) {
                $selected_chat = new Chat();
                $selected_chat->save();
                $selected_chat->users()->attach([$this->user2->id, $this->user1->id]);
            }
            $content = Str::of($validated['content'])->markdown();
            $content = clean($content);
            $message = $selected_chat->messages()->create([
                'text' => $content,
                'user_id' => $this->user1->id
            ]);
            $selected_chat->touch();
            $result = true;
        });
        if ($result) {
            NewChatMessage::dispatch($selected_chat, $message, $this->user1, $this->user2);
            $this->dispatch('alert','success', 'Done, your message has been sent');
        } else {
            $this->dispatch('alert', 'error', 'Error, your message not sent');
        }
        $this->reset('content');
        $this->resetValidation();
    }
}
