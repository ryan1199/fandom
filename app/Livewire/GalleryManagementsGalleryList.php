<?php

namespace App\Livewire;

use App\Events\FandomsGalleryUnpublished;
use App\Events\UsersGalleryUnpublished;
use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Publish;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class GalleryManagementsGalleryList extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $publish_on = [];
    public $query = [];
    public $preferences = [];
    public function render()
    {
        $tags = $this->query['tags'];
        $sort_by = $this->query['sort_by'];
        $sort = $this->query['sort'];
        $limit = $this->query['limit'];
        $tags = Str::squish($tags);
        $tags = Str::replace(' ', '', $tags);
        $tags = Str::of($tags)->explode(',');
        $tags = Arr::sort($tags);
        switch ($sort_by) {
            case 'View':
                $sort_by = 'view';
                break;
            default:
                $sort_by = 'created_at';
        }
        $sort = ($sort == 'ASC') ? 'ASC' : 'DESC';
        $limit = ($limit > 0) ? $limit : 5;

        $galleries = Gallery::with(['user', 'publish.publishable', 'image'])->where('user_id', Auth::id())->where(function (Builder $query) use($tags) {
            foreach($tags as $tag) {
                $query->orWhere('tags', 'like', '%'.$tag.'%');
            }
        })->orderBy($sort_by, $sort)->simplePaginate($limit, pageName: 'galleries-page');
        return view('livewire.gallery-managements-gallery-list', [
            'galleries' => $galleries,
        ]);
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
        $this->query['tags'] = '';
        $this->query['sort_by'] = 'Title';
        $this->query['sort'] = 'DESC';
        $this->query['limit'] = 5;
    }
    #[On('search')]
    public function search($query)
    {
        $this->query = $query;
        $this->resetPage('galleries-page');
    }
    public function editGallery(Gallery $gallery)
    {
        $this->authorize('update', $gallery);
        $this->dispatch('edit_gallery', $gallery)->to(GalleryCreateEdit::class);
    }
    public function deleteGallery(Gallery $gallery) {
        $this->authorize('delete', $gallery);
        $image = $gallery->image;
        $result = false;
        if (class_basename($gallery->publish->publishable_type) === 'User') {
            $user = User::find($gallery->publish->publishable_id);
            DB::transaction(function () use ($gallery, $image, &$result) {
                Publish::where('id', $gallery->publish_id)->delete();
                Gallery::where('id', $gallery->id)->delete();
                Image::where('id', $image->id)->delete();
                $result = true;
            });
            UsersGalleryUnpublished::dispatch($user);
        } else {
            $fandom = Fandom::find($gallery->publish->publishable_id);
            DB::transaction(function () use ($gallery, $image, &$result) {
                Publish::where('id', $gallery->publish_id)->delete();
                Gallery::where('id', $gallery->id)->delete();
                Image::where('id', $image->id)->delete();
                $result = true;
            });
            FandomsGalleryUnpublished::dispatch($fandom);
        }
        if($result) {
            Storage::delete('galleries/' . $image->url);
            $this->dispatch('search')->to(GalleryManagementsGallerySearch::class);
            $this->dispatch('alert', 'success', 'Success, the selected image is deleted')->to(Alert::class);
        }
    }
}
