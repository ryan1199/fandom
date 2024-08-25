<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Publish;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
    public function mount($preferences, $from, $id = null)
    {
        $this->preferences = $preferences;
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

        if ($this->from == 'gallery-management') {
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
    public function editGallery(Gallery $gallery)
    {
        $this->authorize('update', $gallery);
        $this->dispatch('edit_gallery', $gallery)->to(GalleryCreateEdit::class);
    }
    public function deleteGallery(Gallery $gallery) {
        $this->authorize('delete', $gallery);
        $id = $gallery->id;
        $image = $gallery->image;
        $result = false;
        DB::transaction(function () use ($gallery, $image, &$result) {
            Publish::where('id', $gallery->publish_id)->delete();
            Gallery::where('id', $gallery->id)->delete();
            Image::where('id', $image->id)->delete();
            $result = true;
        });
        if($result) {
            Storage::delete('galleries/' . $image->url);
            $i = 0;
            foreach($this->galleries as $gallery) {
                if($gallery->id == $id) {
                    Arr::forget($this->galleries, $i);
                }
                $i++;
            }
            $this->dispatch('alert', 'success', 'Success, the selected image is deleted')->to(Alert::class);
        }
    }
}
