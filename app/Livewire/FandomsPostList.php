<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FandomsPostList extends Component
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

        $users = $this->fandom->members;
        $members['id'] = $users->pluck('user.id')->toArray();
        $publish_ids = Arr::pluck($this->fandom->publishes, 'id');
        if(in_array(Auth::id(), $members['id'])) {
            $posts = Post::whereHas('publish', function ($query) {
                $query->whereIn('visible', ['member', 'public']);
            })->whereIn('publish_id', $publish_ids)->where('title', 'like', $title)->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->orderBy($sort_by, $sort)->simplePaginate($limit, pageName: 'posts-page');
        } else {
            $posts = Post::whereHas('publish', function ($query) {
                $query->whereIn('visible', ['public']);
            })->whereIn('publish_id', $publish_ids)->where('title', 'like', $title)->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->orderBy($sort_by, $sort)->simplePaginate($limit, pageName: 'posts-page');
        }
        return view('livewire.fandoms-post-list', [
            'posts' => $posts,
        ]);
    }
    public function mount(Fandom $fandom, $preferences, $static)
    {
        $this->fandom = $fandom;
        $this->static = $static;
        $this->preferences = $preferences;
        $this->query['title'] = '';
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
            $this->resetPage('posts-page');
        }
    }
    public function refreshPost()
    {
        $this->query = $this->query;
        $this->resetPage('posts-page');
    }
    public function getListeners()
    {
        return [
            "echo:FandomsPostList.{$this->fandom->id},FandomsPostPublished" => 'refreshPost',
            "echo:FandomsPostList.{$this->fandom->id},FandomsPostUnpublished" => 'refreshPost',
        ];
    }
}
