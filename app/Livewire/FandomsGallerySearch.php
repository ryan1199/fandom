<?php

namespace App\Livewire;

use App\Models\Fandom;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FandomsGallerySearch extends Component
{
    #[Locked]
    public $fandom;
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
        return view('livewire.fandoms-gallery-search');
    }
    public function mount(Fandom $fandom, $preferences)
    {
        $this->fandom = $fandom;
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
        $this->dispatch('search', $query)->to(FandomsGalleryList::class);
    }
    public function updated($property)
    {
        $this->search();
    }
    public function getListeners()
    {
        return [
            "echo:FandomsGallerySearch.{$this->fandom->id},FandomsGalleryPublished" => 'search',
            "echo:FandomsGallerySearch.{$this->fandom->id},FandomsGalleryUnpublished" => 'search',
        ];
    }
}
