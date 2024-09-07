<?php

namespace App\Livewire;

use App\Events\RequestOpened;
use App\Models\Fandom;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FandomsRequestForm extends Component
{
    #[Locked]
    public $fandom;
    public $title = '';
    public $description = '';
    public $preferences = [];
    public function render()
    {
        return view('livewire.fandoms-request-form');
    }
    public function mount(Fandom $fandom, $preferences)
    {
        $this->fandom = $fandom;
        $this->preferences = $preferences;
    }
    public function createRequest()
    {
        $this->authorize('create', [Request::class, $this->fandom]);
        $validated = Validator::make(
            [
                'title' => $this->title,
                'description' => $this->description,
            ],
            [
                'title' => ['required', 'between:5,50'],
                'description' => ['required', 'between:10,100'],
            ],
            [
                'required' => 'The :attribute must not empty',
                'between' => 'The :attribute length is between :min and :max characters',
            ],
            [
                'title' => 'Request title',
                'description' => 'Request description',
            ]
        )->validate();
        $this->fandom->requests()->create([
            'title' => $this->title,
            'description' => $this->description,
            'status' => 'open',
            'user_id' => Auth::id()
        ]);
        $this->title = '';
        $this->description = '';
        $this->dispatch('alert', 'success', 'Done, request successfully created');
        RequestOpened::dispatch($this->fandom);
    }
}
