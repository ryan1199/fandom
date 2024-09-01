<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class UsersPostList extends Component
{
    #[Locked]
    public $user;
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

        $followed = Auth::user()->follows->contains($this->user->id);
        $publish_ids = Arr::pluck($this->user->publishes, 'id');
        $posts = Post::with(['user', 'publish.publishable'])->whereIn('publish_id', $publish_ids)->where('title', 'like', $title)->where(function (Builder $query) use($tags) {
            foreach($tags as $tag) {
                $query->orWhere('tags', 'like', '%'.$tag.'%');
            }
        })->orderBy($sort_by, $sort)->limit($limit)->get();
        if (Auth::id() == $this->user->id) {
            $posts = $posts;
        } elseif ($followed) {
            $posts = $posts->whereIn('publish.visible', ['friend', 'public']);
        } else {
            $posts = $posts->where('publish.visible', 'public');
        }
        return view('livewire.users-post-list', [
            'posts' => $posts,
        ]);
    }
    public function mount(User $user, $preferences)
    {
        $this->user = $user;
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
    }
    public function refreshPost()
    {
        $this->query = $this->query;
    }
    public function getListeners()
    {
        return [
            "echo-private:UsersPostList.{$this->user->id},UsersPostPublished" => 'refreshPost',
            "echo-private:UsersPostList.{$this->user->id},UsersPostUnpublished" => 'refreshPost',
        ];
    }
}
