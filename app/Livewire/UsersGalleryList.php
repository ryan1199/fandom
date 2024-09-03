<?php

namespace App\Livewire;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UsersGalleryList extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[Locked]
    public $user;
    public $preferences = [];
    public $query = [];
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

        $followed = Auth::user()->follows->contains($this->user->id);
        $publish_ids = Arr::pluck($this->user->publishes, 'id');
        if (Auth::id() == $this->user->id) {
            $galleries = Gallery::whereHas('publish', function ($query) {
                $query->whereIn('visible', ['self', 'friend', 'public']);
            })->whereIn('publish_id', $publish_ids)->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->orderBy($sort_by, $sort)->simplePaginate($limit, pageName: 'galleries-page');
        } elseif ($followed) {
            $galleries = Gallery::whereHas('publish', function ($query) {
                $query->whereIn('visible', ['friend', 'public']);
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
        return view('livewire.users-gallery-list', [
            'galleries' => $galleries,
        ]);
    }
    public function mount(User $user, $preferences)
    {
        $this->user = $user;
        $this->preferences = $preferences;
        $this->query['tags'] = '';
        $this->query['sort_by'] = 'Created';
        $this->query['sort'] = 'DESC';
        $this->query['limit'] = 5;
    }
    #[On('search')]
    public function search($query)
    {
        $this->query = $query;
        $this->resetPage('galleries-page');
    }
    public function refreshGallery()
    {
        $this->query = $this->query;
        $this->resetPage('galleries-page');
    }
    public function getListeners()
    {
        return [
            "echo-private:UsersGalleryList.{$this->user->id},UsersGalleryPublished" => 'refreshGallery',
            "echo-private:UsersGalleryList.{$this->user->id},UsersGalleryUnpublished" => 'refreshGallery',
        ];
    }
}
