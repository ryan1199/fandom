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
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class GalleryList extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $preferences = [];
    public $query = [];
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

        $galleries = Gallery::with(['user', 'publish.publishable', 'image'])->where(function (Builder $query) use($tags) {
            foreach($tags as $tag) {
                $query->orWhere('tags', 'like', '%'.$tag.'%');
            }
        })->orderBy($sort_by, $sort)->get();
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
            $galleries = Gallery::with(['user', 'publish.publishable', 'image'])->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->whereIn('publish_id', $galleries->pluck('publish.id'))->orderBy($sort_by, $sort)->simplePaginate($limit, pageName: 'galleries-page');
        } else {
            $galleries = $galleries->where('publish.visible', 'public');
            $galleries = Gallery::with(['user', 'publish.publishable', 'image'])->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->whereIn('publish_id', $galleries->pluck('publish.id'))->orderBy($sort_by, $sort)->simplePaginate($limit, pageName: 'galleries-page');
        }
        return view('livewire.gallery-list', [
            'galleries' => $galleries
        ]);
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
        $this->query['title'] = '';
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
}
