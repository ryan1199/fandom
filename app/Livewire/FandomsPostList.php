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

class FandomsPostList extends Component
{
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
        $posts = Post::with(['user', 'publish.publishable'])->whereIn('publish_id', $publish_ids)->where('title', 'like', $title)->where(function (Builder $query) use($tags) {
            foreach($tags as $tag) {
                $query->orWhere('tags', 'like', '%'.$tag.'%');
            }
        })->orderBy($sort_by, $sort)->limit($limit)->get();
        if(in_array(Auth::id(), $members['id'])) {
            $posts = $posts;
        } else {
            $posts = $posts->where('publish.visible', 'public');
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
        $this->query['sort_by'] = 'Title';
        $this->query['sort'] = 'DESC';
        $this->query['limit'] = 5;
    }
    #[On('search')]
    public function search($query)
    {
        if (!$this->static) {
            $this->query = $query;
        }
    }
    public function refreshPost()
    {
        $this->query = $this->query;
    }
    public function getListeners()
    {
        return [
            "echo:FandomsPostList.{$this->fandom->id},FandomsPostPublished" => 'refreshPost',
            "echo:FandomsPostList.{$this->fandom->id},FandomsPostUnpublished" => 'refreshPost',
        ];
    }
}
