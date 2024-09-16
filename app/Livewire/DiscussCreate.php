<?php

namespace App\Livewire;

use App\Events\CreateDiscussion;
use App\Events\NewFandomLog;
use App\Models\Discuss;
use App\Models\Fandom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;

class DiscussCreate extends Component
{
    #[Locked]
    public $fandom;
    public $name = '';
    public $visible = 'public';
    #[Locked]
    public $available_visible = ['public', 'member', 'manager'];
    public $preferences = [];
    public function render()
    {
        return view('livewire.discuss-create');
    }
    public function mount(Fandom $fandom, $preferences)
    {
        $this->fandom = $fandom;
        $this->preferences = $preferences;
    }
    public function createDiscussion()
    {
        $this->authorize('create', [Discuss::class, $this->fandom]);
        $validated = Validator::make(
            [
                'name' => $this->name,
                'visible' => $this->visible
            ], [
                'name' => 'required|max:50',
                'visible' => ['required', Rule::in($this->available_visible)]
            ], [
                'required' => 'Please provide a :attribute',
                'max' => 'Maximum length of the provided :attribute is :max characters',
                'in' => 'Please choose one from the available for the :attribute value'
            ], [
                'name' => 'discussion name',
                'visible' => 'discussion visibility'
            ]
        )->validate();
        $user = User::find(Auth::id());
        $result = false;
        DB::transaction(function () use ($validated, $user, &$result) {
            $discuss = Discuss::create([
                'name' => $validated['name'],
                'visible' => $validated['visible'],
                'fandom_id' => $this->fandom->id
            ]);
            $this->fandom->logs()->create([
                'message' => $user->username . ' create a discussion with name: ' . $validated['name'] . ' and visibility: ' . $validated['visible']
            ]);
            $result = true;
        });
        $this->reset('name');
        $this->resetValidation();
        if ($result) {
            $this->dispatch('alert', 'success', 'Done, new discussion has been created');
            CreateDiscussion::dispatch($this->fandom);
            NewFandomLog::dispatch($this->fandom);
        } else {
            $this->dispatch('alert', 'error', 'Error, discussion not created, please try again later');
        }
    }
    public function updated()
    {
        $this->resetValidation();
    }
}
