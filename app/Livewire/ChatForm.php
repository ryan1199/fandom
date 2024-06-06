<?php

namespace App\Livewire;

use App\Events\NewChatMessage;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Illuminate\Support\Str;

class ChatForm extends Component
{
    #[Locked]
    public $user1;
    #[Locked]
    public $user2;
    public $content = '';
    public $preferences = [];
    public function render()
    {
        return view('livewire.chat-form');
    }
    public function submitChat()
    {
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
        $this->reset('content');
        if ($result) {
            NewChatMessage::dispatch($chat, $message);
            $this->dispatch('alert','success', 'Done, your message has been sent');
        } else {
            $this->dispatch('alert', 'error', 'Error, your message not sent');
        }
    }
}
