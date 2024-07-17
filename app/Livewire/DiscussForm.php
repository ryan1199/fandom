<?php

namespace App\Livewire;

use App\Events\NewDiscussionMessage;
use App\Models\Discuss;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Locked;
use Livewire\Component;

class DiscussForm extends Component
{
    #[Locked]
    public $discuss;
    public $content;
    public $raw_content;
    #[Locked]
    public $fandom;
    public $preferences = [];
    public function render()
    {
        return view('livewire.discuss-form');
    }
    public function mount(Discuss $discuss, $preferences)
    {
        $this->discuss = $discuss;
        $this->fandom = $discuss->fandom;
        $this->preferences = $preferences;
    }
    public function submitDiscuss()
    {
        $this->authorize('submit', [Discuss::class, $this->discuss, $this->fandom]);
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
        $result = false;
        $message = Str::of($validated['content'])->markdown();
        $message = clean($message);
        DB::transaction(function () use (&$message, &$result) {
            $message = $this->discuss->messages()->create([
                'text' => $message,
                'user_id' => Auth::id()
            ]);
            $result = true;
        });
        $this->reset('content', 'raw_content');
        $this->resetValidation();
        if($result) {
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
}
