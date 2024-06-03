<?php

namespace App\Livewire;

use App\Events\CreateDiscussion;
use App\Models\Discuss;
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
    public $available_visible = ['public', 'member', 'manager'];
    public $managers = [];
    public $preferences = [];
    public function render()
    {
        return view('livewire.discuss-create');
    }
    public function createDiscussion()
    {
        $this->authorize('create', [Discuss::class, $this->managers]);
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
        $discuss = Discuss::create([
            'name' => $validated['name'],
            'visible' => $validated['visible'],
            'fandom_id' => $this->fandom->id
        ]);
        $this->reset('name');
        $this->resetValidation();
        $this->dispatch('alert', 'success', 'Done, new discussion has been created');
        CreateDiscussion::dispatch($this->fandom);
        $this->dispatch('load_fandom_details', $this->fandom->name);
    }
    public function updated()
    {
        $this->resetValidation();
    }
}
