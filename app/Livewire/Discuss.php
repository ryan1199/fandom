<?php

namespace App\Livewire;

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
    public $messages = [];
    public $content;
    public $raw_content;
    #[Locked]
    public $managers = [];
    #[Locked]
    public $members = [];
    public $preferences = [];
    public function render()
    {
        $this->messages = $this->discuss->messages()->with(['user.cover.image', 'user.avatar.image'])->orderByDesc('created_at')->get();
        // dd($this->messages);
        // $messages = collect($this->messages)->reverse()->values()->all();
        $messages = collect($this->messages);
        // $this->messages = collect($this->messages)->reverse()->values()->all();
        return view('livewire.discuss', [
            'messages' => $messages
        ]);
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
            $this->discuss->messages()->create([
                'text' => $message,
                'user_id' => Auth::id()
            ]);
            $this->reset('content', 'raw_content');
            $this->resetValidation();
            $this->dispatch('alert', 'success', 'Done, your message has been sent');
            $this->loadLatestMessages();
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
        $this->messages = collect($this->messages)->reverse();;
    }
    public function deleteDiscuss()
    {
        $status = false;
        DB::transaction(function () use (&$status) {
            $this->discuss->messages()->delete();
            $this->discuss->delete();
            $status = true;
        });
        if($status) {
            $fandom = Fandom::find($this->discuss->fandom_id);
            $this->dispatch('alert','success', 'Done, the discuss has been deleted');
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
        } else {
            $this->dispatch('alert','error', 'Error, the discuss has not been reseted');
        }
    }
}
