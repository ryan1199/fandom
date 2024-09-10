<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FandomSearch extends Component
{
    public $name = '';
    public $sort_by = 'Name';
    public $sort = 'ASC';
    public $limit = 12;
    #[Locked]
    public $sort_by_available = ['Name', 'Created'];
    #[Locked]
    public $sort_available = ['ASC', 'DESC'];
    public $preferences = [];
    public function render()
    {
        return view('livewire.fandom-search');
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
    }
    public function search()
    {
        $validated = Validator::make(
            [
                'sort_by' => $this->sort_by,
                'sort' => $this->sort,
                'limit' => $this->limit
            ],
            [
                'sort_by' => Rule::in($this->sort_by_available),
                'sort' => Rule::in($this->sort_available),
                'limit' => ['between:1,10']
            ],
            [
                'in' => 'Please choose one from the available for the :attribute value'
            ],
            [
                'sort_by' => 'Sort By',
                'sort' => 'Sort',
                'limit' => 'Limit',
            ]
        )->validate();
        $query = [
            'name' => $this->name,
            'sort_by' => $this->sort_by,
            'sort' => $this->sort,
            'limit' => $this->limit
        ];
        $this->dispatch('search', $query)->to(Fandom::class);
    }
    public function updated($property)
    {
        $this->search();
    }
    public function getListeners()
    {
        return [
            "echo:FandomSearch,FandomCreated" => 'search',
            // "echo:FandomSearch,FandomRemoved" => 'search',
        ];
    }
}
