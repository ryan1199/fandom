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
        if ($this->from == 'gallery') {
            $this->galleries = Gallery::with(['user', 'publish.publishable', 'image'])->where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();
        }
        if ($this->from == 'fandom') {
            $this->id = $id;
            $publish_ids = Fandom::with(['publishes'])->where('id', $this->id)->first();
            $publish_ids = Arr::pluck($publish_ids->publishes, 'id');
            $this->galleries = Gallery::with(['user', 'publish.publishable'])->whereIn('publish_id', $publish_ids)->orderBy('created_at', 'asc')->get();
        }
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
            $this->galleries = Post::with(['user', 'publish.publishable'])->where('user_id', Auth::id())->where('tags', 'like', $search)->orderBy($sort_by, $sort)->get();
        }
        if ($this->from == 'fandom') {
            $publish_ids = Fandom::with(['publishes'])->where('id', $this->id)->first();
            $publish_ids = Arr::pluck($publish_ids->publishes, 'id');
            $galleries = Gallery::with(['user', 'publish.publishable'])->whereIn('publish_id', $publish_ids)->where('tags', 'like', $search)->get();
            if ($sort_by == 'view') {
                $galleries = collect($galleries);
                if ($sort == 'ASC') {
                    $this->galleries = $galleries->sortBy('view');
                }
                if ($sort == 'DESC') {
                    $this->galleries = $galleries->sortByDesc('view');
                }
            }
            if ($sort_by == 'created_at') {
                $galleries = collect($galleries);
                if ($sort == 'ASC') {
                    $this->galleries = $galleries->sortBy('publish.created_at');
                }
                if ($sort == 'DESC') {
                    $this->galleries = $galleries->sortByDesc('publish.created_at');
                }
            }
        }
    }
}
