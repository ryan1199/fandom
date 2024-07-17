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
                'content' =>'required|max:500'
            ], [
                'required' => 'The :attribute can not be empty',
                'max' => 'The maximum length of the :attribute is :max characters'
            ], [
                'content' => 'message',
            ]
        )->validate();
        $chat = '';
        $message = '';
        $result = false;
        DB::transaction(function () use ($validated, &$chat, &$message, &$result) {
            $chat = Chat::query()->whereHas('users',function (Builder $query) {
                $query->whereIn('user_id', [$this->user1->id, $this->user2->id]);
            })->first();
            if($chat == null)
            {
                $chat = new Chat();
                $chat->save();
                $chat->users()->attach([$this->user1->id, $this->user2->id]);
            }
            $content = Str::of($validated['content'])->markdown();
            $content = clean($content);
            $message = $chat->messages()->create([
                'text' => $content,
                'user_id' => $this->user1->id
            ]);
            $result = true;
        });
        if ($result) {
            NewChatMessage::dispatch($chat, $message);
            $this->dispatch('alert','success', 'Done, your message has been sent');
        } else {
            $this->dispatch('alert', 'error', 'Error, your message not sent');
        }
        $this->reset('content');
        $this->resetValidation();
    }
}
