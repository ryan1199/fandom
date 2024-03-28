<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;

class PostSearch extends Component
{
    public $search = '';
    public $sort_by = 'Title';
    public $sort = 'ASC';
    #[Locked]
    public $sort_by_available = ['Title', 'Created'];
    #[Locked]
    public $sort_available = ['ASC', 'DESC'];
    public $published = false;
    public $from;
    public $preferences = [];
    public function render()
    {
        return view('livewire.post-search');
    }
    public function mount($from = null)
    {
        $this->from = $from;
    }
    public function updated($property)
    {
        if ($this->from == 'user') {
            $validated = Validator::make(
                [
                    'sort_by' => $this->sort_by,
                    'sort' => $this->sort,
                    'published' => $this->published
                ],
                [
                    'sort_by' => Rule::in($this->sort_by_available),
                    'sort' => Rule::in($this->sort_available),
                    'published' => 'boolean'
                ],
                [
                    'in' => 'Please choose one from the available for the :attribute value',
                    'boolean' => 'Please checked or unchecked the :attribute'
                ],
                [
                    'sort_by' => 'Sort By',
                    'sort' => 'Sort',
                    'published' => 'Published'
                ]
            )->validate();
            $query = [
                'search' => $this->search,
                'sort_by' => $this->sort_by,
                'sort' => $this->sort,
                'published' => $this->published
            ];
        }
        if ($this->from == 'fandom') {
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
                'sort' => $this->sort,
                'published' => null
            ];
        }
        $this->dispatch('search', $query)->to(PostList::class);
    }
}
