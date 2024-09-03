<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FandomsGalleryList extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[Locked]
    public $fandom;
    public $preferences = [];
    public $query = [];
    #[Locked]
    public $static = true;
    public function render()
    {
        $search = $this->query['tags'];
        $sort_by = $this->query['sort_by'];
        $sort = $this->query['sort'];
        $limit = $this->query['limit'];
        $search = Str::squish($search);
        $search = Str::replace(' ', '', $search);
        $search = Str::of($search)->explode(',');
        $tags = Arr::sort($search);
        $sort_by = ($sort_by == 'View') ? 'view' : 'created_at';
        $sort = ($sort == 'ASC') ? 'ASC' : 'DESC';
        $limit = ($limit > 0) ? $limit : 5;

        $users = $this->fandom->members;
        $members['id'] = $users->pluck('user.id')->toArray();
        $publish_ids = Arr::pluck($this->fandom->publishes, 'id');
        if(in_array(Auth::id(), $members['id'])) {
            $galleries = Gallery::whereHas('publish', function ($query) {
                $query->whereIn('visible', ['member', 'public']);
            })->whereIn('publish_id', $publish_ids)->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->orderBy($sort_by, $sort)->simplePaginate($limit, pageName: 'galleries-page');
        } else {
            $galleries = Gallery::whereHas('publish', function ($query) {
                $query->whereIn('visible', ['public']);
            })->whereIn('publish_id', $publish_ids)->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->orderBy($sort_by, $sort)->simplePaginate($limit, pageName: 'galleries-page');
        }
        return view('livewire.fandoms-gallery-list', [
            'galleries' => $galleries,
        ]);
    }
    public function mount(Fandom $fandom, $preferences, $static)
    {
        $this->fandom = $fandom;
        $this->static = $static;
        $this->preferences = $preferences;
        $this->query['tags'] = '';
        $this->query['sort_by'] = 'Created';
        $this->query['sort'] = 'DESC';
        $this->query['limit'] = 5;
    }
    #[On('search')]
    public function search($query)
    {
        if (!$this->static) {
            $this->query = $query;
            $this->resetPage('galleries-page');
        }
    }
    public function refreshGallery()
    {
        $this->query = $this->query;
        $this->resetPage('galleries-page');
    }
    public function getListeners()
    {
        return [
            "echo:FandomsGalleryList.{$this->fandom->id},FandomsGalleryPublished" => 'refreshGallery',
            "echo:FandomsGalleryList.{$this->fandom->id},FandomsGalleryUnpublished" => 'refreshGallery',
        ];
    }
}
