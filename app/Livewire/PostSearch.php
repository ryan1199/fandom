<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class PostSearch extends Component
{
    public $title = '';
    public $tags = '';
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
    public function mount($preferences, $from = null)
    {
        $this->preferences = $preferences;
        $this->from = $from;
        $this->search();
    }
    #[On('search')]
    public function search()
    {
        if ($this->from == 'post-management') {
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
                'title' => $this->title,
                'tags' => $this->tags,
                'sort_by' => $this->sort_by,
                'sort' => $this->sort,
                'published' => $this->published
            ];
        }
        if ($this->from == 'fandom' || $this->from == 'post') {
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
                'title' => $this->title,
                'tags' => $this->tags,
                'sort_by' => $this->sort_by,
                'sort' => $this->sort,
                'published' => null
            ];
        }
        $this->dispatch('search', $query)->to(PostList::class);
    }
    public function updated($property)
    {
        $this->search();
    }
}
