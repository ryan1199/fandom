<?php

namespace App\Livewire;

use Livewire\Component;

class PostSearch extends Component
{
    public $search = '';
    public $sort_by = 'Published';
    public $sort = 'ASC';
    public $preferences = [];
    public function render()
    {
        return view('livewire.post-search');
    }
    public function updated($property)
    {
        // dd([
        //     'search' => $this->search,
        //     'sort_by' => $this->sort_by,
        //     'sort' => $this->sort
        // ]);
        $query = [
            'search' => $this->search,
            'sort_by' => $this->sort_by,
            'sort' => $this->sort
        ];
        $this->dispatch('search', $query)->to(PostList::class);
    }
}
