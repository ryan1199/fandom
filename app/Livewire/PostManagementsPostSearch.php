<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class PostManagementsPostSearch extends Component
{
    public $title = '';
    public $tags = '';
    public $sort_by = 'Title';
    public $sort = 'ASC';
    public $limit = 5;
    #[Locked]
    public $sort_by_available = ['Title', 'View', 'Created'];
    #[Locked]
    public $sort_available = ['ASC', 'DESC'];
    public $published = false;
    public $preferences = [];
    public function render()
    {
        return view('livewire.post-managements-post-search');
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
                'sort' => $this->sort,
                'published' => $this->published,
                'limit' => $this->limit
            ],
            [
                'sort_by' => Rule::in($this->sort_by_available),
                'sort' => Rule::in($this->sort_available),
                'published' => 'boolean',
                'limit' => ['between:1,10']
            ],
            [
                'in' => 'Please choose one from the available for the :attribute value',
                'boolean' => 'Please checked or unchecked the :attribute'
            ],
            [
                'sort_by' => 'Sort By',
                'sort' => 'Sort',
                'published' => 'Published',
                'limit' => 'Limit',
            ]
        )->validate();
        $query = [
            'title' => $this->title,
            'tags' => $this->tags,
            'sort_by' => $this->sort_by,
            'sort' => $this->sort,
            'published' => $this->published,
            'limit' => $this->limit
        ];
        $this->dispatch('search', $query)->to(PostManagementsPostList::class);
    }
    public function updated($property)
    {
        $this->search();
    }
}
