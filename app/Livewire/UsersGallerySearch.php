<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UsersGallerySearch extends Component
{
    #[Locked]
    public $user;
    public $tags = '';
    public $sort_by = 'View';
    public $sort = 'ASC';
    public $limit = 5;
    #[Locked]
    public $sort_by_available = ['View', 'Created'];
    #[Locked]
    public $sort_available = ['ASC', 'DESC'];
    public $preferences = [];
    public function render()
    {
        return view('livewire.users-gallery-search');
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
            'tags' => $this->tags,
            'sort_by' => $this->sort_by,
            'sort' => $this->sort,
            'limit' => $this->limit
        ];
        $this->dispatch('search', $query)->to(UsersGalleryList::class);
    }
    public function updated($property)
    {
        $this->search();
    }
    public function getListeners()
    {
        return [
            "echo-private:UsersGallerySearch.{$this->user->id},UsersGalleryPublished" => 'search',
            "echo-private:UsersGallerySearch.{$this->user->id},UsersGalleryUnpublished" => 'search',
        ];
    }
}
