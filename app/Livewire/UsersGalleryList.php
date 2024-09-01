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

class UsersGalleryList extends Component
{
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
        $galleries = Gallery::with(['user', 'publish.publishable', 'image'])->whereIn('publish_id', $publish_ids)->where(function (Builder $query) use($tags) {
            foreach($tags as $tag) {
                $query->orWhere('tags', 'like', '%'.$tag.'%');
            }
        })->orderBy($sort_by, $sort)->limit($limit)->get();
        if (Auth::id() == $this->user->id) {
            $galleries = $galleries;
        } elseif ($followed) {
            $galleries = $galleries->whereIn('publish.visible', ['friend', 'public']);
        } else {
            $galleries = $galleries->where('publish.visible', 'public');
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
    }
    public function refreshGallery()
    {
        $this->query = $this->query;
    }
    public function getListeners()
    {
        return [
            "echo-private:UsersGalleryList.{$this->user->id},UsersGalleryPublished" => 'refreshGallery',
            "echo-private:UsersGalleryList.{$this->user->id},UsersGalleryUnpublished" => 'refreshGallery',
        ];
    }
}
