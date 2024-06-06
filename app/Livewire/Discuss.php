<?php

namespace App\Livewire;

use App\Events\DeleteDiscussion;
use App\Events\NewDiscussionMessage;
use App\Events\ResetDiscussion;
use App\Models\Discuss as ModelsDiscuss;
use App\Models\Fandom;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class Discuss extends Component
{
    public ModelsDiscuss $discuss;
    #[Locked]
    public $messages;
    public $content;
    public $raw_content;
    #[Locked]
    public $managers = [];
    #[Locked]
    public $members = [];
    public $preferences = [];
    public function render()
    {
        return view('livewire.discuss');
    }
    public function mount(ModelsDiscuss $discuss, $preferences, $managers, $members)
    {
        $this->discuss = $discuss;
        $this->preferences = $preferences;
        $this->managers = $managers;
        $this->members = $members;
        $this->loadLatestMessages();
    }
    public function submitMessage()
    {
        $access = false;
        if($this->discuss->visible == 'manager' && in_array(Auth::id(), $this->managers)) {
            $access = true;
        }
        if($this->discuss->visible =='member' && (in_array(Auth::id(), $this->members) || in_array(Auth::id(), $this->managers))) {
            $access = true;
        }
        if($this->discuss->visible =='public') {
            $access = true;
        }
        if($access) {
            $validated = Validator::make(
                [
                    'content' => $this->content
                ], [
                    'content' =>'required|max:500'
                ], [
                    'required' => 'The :attribute can not be empty',
                    'max' => 'The maximum length of the :attribute is :max characters'
                ], [
                    'content' => 'discuss message',
                ]
            )->validate();
            $message = Str::of($validated['content'])->markdown();
            $message = clean($message);
            $message = $this->discuss->messages()->create([
                'text' => $message,
                'user_id' => Auth::id()
            ]);
            $this->reset('content', 'raw_content');
            $this->resetValidation();
            $this->dispatch('alert', 'success', 'Done, your message has been sent');
            NewDiscussionMessage::dispatch($this->discuss, $message);
        } else {
            $this->dispatch('alert', 'error', 'Error, you can not send this message');
        }
    }
    public function updatedContent()
    {
        $message = Str::of($this->content)->markdown();
        $message = clean($message);
        $this->raw_content = $message;
        $this->resetValidation();
    }
    #[On('load_latest_messages')]
    public function loadLatestMessages()
    {
        $this->messages = $this->discuss->messages()->with(['user.cover.image', 'user.avatar.image'])->get();
        $this->messages = collect($this->messages)->reverse();
    }
    public function deleteDiscuss()
    {
        $fandom = Fandom::find($this->discuss->fandom_id);
        $status = false;
        DB::transaction(function () use (&$status) {
            $this->discuss->messages()->delete();
            $this->discuss->delete();
            $status = true;
        });
        if($status) {
            $this->dispatch('alert','success', 'Done, the discuss has been deleted');
            DeleteDiscussion::dispatch($fandom);
            $this->dispatch('load_fandom_details', $fandom->name);
        } else {
            $this->dispatch('alert','error', 'Error, the discuss has not been deleted');
        }
    }
    public function resetDiscuss()
    {
        $status = false;
        DB::transaction(function () use (&$status) {
            $this->discuss->messages()->delete();
            $status = true;
        });
        if($status) {
            $this->dispatch('alert','success', 'Done, the discuss has been reset');
            ResetDiscussion::dispatch($this->discuss);
        } else {
            $this->dispatch('alert','error', 'Error, the discuss has not been reseted');
        }
    }
    public function getListeners()
    {
        return [
            "echo-private:NewDiscussionMessage.{$this->discuss->id},NewDiscussionMessage" => 'newMessage',
            "echo-private:ResetDiscussion.{$this->discuss->id},ResetDiscussion" => 'loadLatestMessages',
        ];
    }
    public function newMessage($event)
    {
        $message = Message::with(['user'])->find($event['message']['id']);
        $this->messages->prepend($message);
    }
}
