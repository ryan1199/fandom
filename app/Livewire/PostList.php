<?php

namespace App\Livewire;

use App\Events\FandomsPostPublished;
use App\Events\FandomsPostUnpublished;
use App\Events\UsersPostPublished;
use App\Events\UsersPostUnpublished;
use App\Models\Fandom;
use App\Models\Post;
use App\Models\Publish;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $preferences = [];
    public $query = [];
    public function render()
    {
        $title = $this->query['title'];
        $tags = $this->query['tags'];
        $sort_by = $this->query['sort_by'];
        $sort = $this->query['sort'];
        $limit = $this->query['limit'];
        $tags = Str::squish($tags);
        $tags = Str::replace(' ', '', $tags);
        $tags = Str::of($tags)->explode(',');
        $tags = Arr::sort($tags);
        $title_array = str_split($title);
        $title = '';
        foreach ($title_array as $s) {
            $title = $title . $s . '%';
        }
        $title = '%' . $title;
        switch ($sort_by) {
            case 'Title':
                $sort_by = 'title';
                break;
            case 'View':
                $sort_by = 'view';
                break;
            default:
                $sort_by = 'created_at';
        }
        $sort = ($sort == 'ASC') ? 'ASC' : 'DESC';
        $limit = ($limit > 0) ? $limit : 5;

        $posts = Post::with(['user', 'publish.publishable'])->where('title', 'like', $title)->where(function (Builder $query) use($tags) {
            foreach($tags as $tag) {
                $query->orWhere('tags', 'like', '%'.$tag.'%');
            }
        })->whereNot('publish_id', null)->orderBy($sort_by, $sort)->get();
        if (Auth::check()) {
            $fandom_posts_member = [];
            $fandom_posts_public = [];
            $fandom_ids = collect($posts)->where('publish.publishable_type', "App\Models\Fandom")->pluck('publish.publishable_id')->unique();
            $fandoms = Fandom::with('members.user')->whereIn('id', $fandom_ids)->get();
            foreach($fandoms as $fandom) {
                $members['id'] = collect($fandom->members)->pluck('user.id')->toArray();
                if(in_array(Auth::id(), $members['id'])) {
                    $fandom_posts_member[] = $fandom->id;
                } else {
                    $fandom_posts_public[] = $fandom->id;
                }
            }
            $member_posts = collect($posts)->where('publish.publishable_type', "App\Models\Fandom")->whereIn('publish.publishable_id', $fandom_posts_member);
            $public_posts = collect($posts)->where('publish.publishable_type', "App\Models\Fandom")->whereIn('publish.publishable_id', $fandom_posts_public)->where('publish.visible', 'public');
            $final_posts_fandoms = collect([]);
            $final_posts_fandoms = $member_posts->merge($public_posts);
            $user_id_posts_friend = collect([]);
            $user_id_posts_block = collect([]);
            $user_id_posts_public = collect([]);
            $user_ids = collect($posts)->where('publish.publishable_type', "App\Models\User")->pluck('publish.publishable_id')->unique()->toArray();
            $self_user_id_position = array_search(Auth::id(), $user_ids);
            if ($self_user_id_position !== false) {
                unset($user_ids[$self_user_id_position]);
                $user_ids = array_values($user_ids);
            }
            $user = User::find(Auth::id());
            $user->load('follows');
            $user->load('blocks');
            foreach ($user->blocks as $block) {
                $user_id_posts_block->push($block->id);
            }
            foreach($user_ids as $user_id) {
                foreach ($user->follows as $follow) {
                    if($follow->id == $user_id) {
                        $user_id_posts_friend->push($user_id);
                    } else {
                        $user_id_posts_public->push($user_id);
                    }
                }
                if ($user->follows->isEmpty()) {
                    $user_id_posts_public->push($user_id);
                }
            }
            $user_id_posts_public = $user_id_posts_public->diff($user_id_posts_block);
            $user_id_posts_public->toArray();
            $user_id_posts_friend->toArray();
            $user_posts_self = collect($posts)->where('publish.publishable_type', "App\Models\User")->where('publish.publishable_id', Auth::id());
            $user_posts_friend = collect($posts)->where('publish.publishable_type', "App\Models\User")->whereIn('publish.publishable_id', $user_id_posts_friend)->whereIn('publish.visible', ['friend', 'public']);
            $user_posts_public = collect($posts)->where('publish.publishable_type', "App\Models\User")->whereIn('publish.publishable_id', $user_id_posts_public)->where('publish.visible', 'public');
            $final_posts_users = collect([]);
            $final_posts_users = $user_posts_self->merge($user_posts_public);
            $final_posts_users = $final_posts_users->merge($user_posts_friend);
            $posts = $final_posts_fandoms->merge($final_posts_users);
            $posts = Post::with(['user', 'publish.publishable'])->where('title', 'like', $title)->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->whereIn('publish_id', $posts->pluck('publish.id'))->orderBy($sort_by, $sort)->simplePaginate($limit, pageName: 'posts-page');
        } else {
            $posts = $posts->where('publish.visible', 'public');
            $posts = Post::with(['user', 'publish.publishable'])->where('title', 'like', $title)->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->whereIn('publish_id', $posts->pluck('publish.id'))->orderBy($sort_by, $sort)->simplePaginate($limit, pageName: 'posts-page');
        }
        return view('livewire.post-list', [
            'posts' => $posts
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
        $this->resetPage('posts-page');
    }
}
