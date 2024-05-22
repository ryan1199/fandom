<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class GalleryList extends Component
{
    public $galleries = [];
    #[Locked]
    public $from = '';
    #[Locked]
    public $id;
    public $preferences = [];
    public function render()
    {
        return view('livewire.gallery-list');
    }
    #[On('refresh_gallery_list')]
    public function mount($from, $id = null)
    {
        $this->from = $from;
        $this->id = $id;
        $this->dispatch('search')->to(GallerySearch::class);
    }
    #[On('search')]
    public function search($query)
    {
        $search = $query['search'];
        $sort_by = $query['sort_by'];
        $sort = $query['sort'];
        $search_array = str_split($search);
        $search = '';
        foreach ($search_array as $s) {
            $search = $search . $s . '%';
        }
        $search = '%' . $search;
        $sort_by = ($sort_by == 'View') ? 'view' : 'created_at';
        $sort = ($sort == 'ASC') ? 'ASC' : 'DESC';

        if ($this->from == 'gallery') {
            $galleries = Gallery::with(['user', 'publish.publishable', 'image'])->where('user_id', Auth::id())->where('tags', 'like', $search)->get();
        }
        if ($this->from == 'fandom') {
            $fandom = Fandom::with(['publishes', 'members.user'])->where('id', $this->id)->first();
            $users = collect($fandom->members);
            $members['id'] = $users->pluck('user.id')->toArray();
            $publish_ids = Arr::pluck($fandom->publishes, 'id');
            $galleries = Gallery::with(['user', 'publish.publishable', 'image'])->whereIn('publish_id', $publish_ids)->where('tags', 'like', $search)->get();
            if(in_array(Auth::id(), $members['id'])) {
                $galleries = collect($galleries);
            } else {
                $galleries = collect($galleries)->where('publish.visible', 'public');
            }
        }
        if ($sort_by == 'view') {
            if ($sort == 'ASC') {
                $galleries = $galleries->sortBy('view');
            }
            if ($sort == 'DESC') {
                $galleries = $galleries->sortByDesc('view');
            }
        }
        if ($sort_by == 'created_at') {
            if ($sort == 'ASC') {
                $galleries = $galleries->sortBy('publish.created_at');
            }
            if ($sort == 'DESC') {
                $galleries = $galleries->sortByDesc('publish.created_at');
            }
        }
        $this->galleries = $galleries->values()->all();
    }
}
