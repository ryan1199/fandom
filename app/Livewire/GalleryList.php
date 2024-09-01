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
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

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
        // $this->galleries = collect([]);
        $search = $query['tags'];
        $sort_by = $query['sort_by'];
        $sort = $query['sort'];
        $search = Str::squish($search);
        $search = Str::replace(' ', '', $search);
        $search = Str::of($search)->explode(',');
        $tags = Arr::sort($search);
        $sort_by = ($sort_by == 'View') ? 'view' : 'created_at';
        $sort = ($sort == 'ASC') ? 'ASC' : 'DESC';

        if ($this->from == 'gallery-management') {
            $galleries = Gallery::with(['user', 'publish.publishable', 'image'])->where('user_id', Auth::id())->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->get();
        }
        if ($this->from == 'fandom') {
            $fandom = Fandom::with(['publishes', 'members.user'])->where('id', $this->id)->first();
            $users = collect($fandom->members);
            $members['id'] = $users->pluck('user.id')->toArray();
            $publish_ids = Arr::pluck($fandom->publishes, 'id');
            $galleries = Gallery::with(['user', 'publish.publishable', 'image'])->whereIn('publish_id', $publish_ids)->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->get();
            if(in_array(Auth::id(), $members['id'])) {
                $galleries = collect($galleries);
            } else {
                $galleries = collect($galleries)->where('publish.visible', 'public');
            }
        }
        if ($this->from == 'gallery') {
            $galleries = Gallery::with(['user', 'publish.publishable', 'image'])->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->get();
            if (Auth::check()) {
                $fandom_galleries_member = [];
                $fandom_galleries_public = [];
                $fandom_ids = collect($galleries)->where('publish.publishable_type', "App\Models\Fandom")->pluck('publish.publishable_id')->unique();
                $fandoms = Fandom::with('members.user')->whereIn('id', $fandom_ids)->get();
                foreach($fandoms as $fandom) {
                    $members['id'] = collect($fandom->members)->pluck('user.id')->toArray();
                    if(in_array(Auth::id(), $members['id'])) {
                        $fandom_galleries_member[] = $fandom->id;
                    } else {
                        $fandom_galleries_public[] = $fandom->id;
                    }
                }
                $member_galleries = collect($galleries)->where('publish.publishable_type', "App\Models\Fandom")->whereIn('publish.publishable_id', $fandom_galleries_member);
                $public_galleries = collect($galleries)->where('publish.publishable_type', "App\Models\Fandom")->whereIn('publish.publishable_id', $fandom_galleries_public)->where('publish.visible', 'public');
                $final_galleries_fandoms = collect([]);
                $final_galleries_fandoms = $member_galleries->merge($public_galleries);
                $user_id_galleries_friend = collect([]);
                $user_id_galleries_block = collect([]);
                $user_id_galleries_public = collect([]);
                $user_ids = collect($galleries)->where('publish.publishable_type', "App\Models\User")->pluck('publish.publishable_id')->unique()->toArray();
                $self_user_id_position = array_search(Auth::id(), $user_ids);
                if ($self_user_id_position !== false) {
                    unset($user_ids[$self_user_id_position]);
                    $user_ids = array_values($user_ids);
                }
                $user = User::find(Auth::id());
                $user->load('follows');
                $user->load('blocks');
                foreach ($user->blocks as $block) {
                    $user_id_galleries_block->push($block->id);
                }
                foreach($user_ids as $user_id) {
                    foreach ($user->follows as $follow) {
                        if($follow->id == $user_id) {
                            $user_id_galleries_friend->push($user_id);
                        } else {
                            $user_id_galleries_public->push($user_id);
                        }
                    }
                    if ($user->follows->isEmpty()) {
                        $user_id_galleries_public->push($user_id);
                    }
                }
                $user_id_galleries_public = $user_id_galleries_public->diff($user_id_galleries_block);
                $user_id_galleries_public->toArray();
                $user_id_galleries_friend->toArray();
                $user_galleries_self = collect($galleries)->where('publish.publishable_type', "App\Models\User")->where('publish.publishable_id', Auth::id());
                $user_galleries_friend = collect($galleries)->where('publish.publishable_type', "App\Models\User")->whereIn('publish.publishable_id', $user_id_galleries_friend)->whereIn('publish.visible', ['friend', 'public']);
                $user_galleries_public = collect($galleries)->where('publish.publishable_type', "App\Models\User")->whereIn('publish.publishable_id', $user_id_galleries_public)->where('publish.visible', 'public');
                $final_galleries_users = collect([]);
                $final_galleries_users = $user_galleries_self->merge($user_galleries_public);
                $final_galleries_users = $final_galleries_users->merge($user_galleries_friend);
                $galleries = $final_galleries_fandoms->merge($final_galleries_users);
            } else {
                $galleries = $galleries->where('publish.visible', 'public');
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
