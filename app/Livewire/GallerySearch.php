<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class GallerySearch extends Component
{
    public $search = '';
    public $sort_by = 'View';
    public $sort = 'ASC';
    #[Locked]
    public $sort_by_available = ['View', 'Created'];
    #[Locked]
    public $sort_available = ['ASC', 'DESC'];
    public $preferences = [];
    public function render()
    {
        return view('livewire.gallery-search');
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
        $this->search();
    }
    #[On('search')]
    public function search()
    {
        $validated = Validator::make(
            [
                'sort_by' => $this->sort_by,
                'sort' => $this->sort
            ],
            [
                'sort_by' => Rule::in($this->sort_by_available),
                'sort' => Rule::in($this->sort_available)
            ],
            [
                'in' => 'Please choose one from the available for the :attribute value'
            ],
            [
                'sort_by' => 'Sort By',
                'sort' => 'Sort'
            ]
        )->validate();
        $query = [
            'search' => $this->search,
            'sort_by' => $this->sort_by,
            'sort' => $this->sort
        ];
        $this->dispatch('search', $query)->to(GalleryList::class);
    }
    public function updated($property)
    {
        $this->search();
    }
}
