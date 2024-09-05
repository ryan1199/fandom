<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UsersPostSearch extends Component
{
    #[Locked]
    public $user;
    public $title = '';
    public $tags = '';
    public $sort_by = 'Title';
    public $sort = 'ASC';
    public $limit = 5;
    #[Locked]
    public $sort_by_available = ['Title', 'View', 'Created'];
    #[Locked]
    public $sort_available = ['ASC', 'DESC'];
    public $preferences = [];
    public function render()
    {
        return view('livewire.users-post-search');
    }
    public function mount(User $user, $preferences)
    {
        $this->user = $user;
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
            'title' => $this->title,
            'tags' => $this->tags,
            'sort_by' => $this->sort_by,
            'sort' => $this->sort,
            'limit' => $this->limit
        ];
        $this->dispatch('search', $query)->to(UsersPostList::class);
    }
    public function updated($property)
    {
        $this->search();
    }
    public function getListeners()
    {
        return [
            "echo-private:UsersPostSearch.{$this->user->id},UsersPostPublished" => 'search',
            "echo-private:UsersPostSearch.{$this->user->id},UsersPostUnpublished" => 'search',
        ];
    }
}
