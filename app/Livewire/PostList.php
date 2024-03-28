<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;

class PostList extends Component
{
    public $posts = [];
    #[Locked]
    public $from = '';
    #[Locked]
    public $id;
    public $publish_on = [];
    public $preferences = [];
    public function render()
    {
        return view('livewire.post-list');
    }
    #[On('refresh_post_list')]
    public function mount($from, $id = null)
    {
        $this->from = $from;
        if ($this->from == 'post') {
            $this->publish_on = [];
            $this->posts = Post::with(['user', 'publish.publishable'])->where('user_id', Auth::id())->where('publish_id', null)->orderBy('created_at', 'asc')->get();
            $users_fandom = User::with(['members.fandom'])->where('id', Auth::id())->first();
            foreach ($users_fandom->members as $member) {
                $this->publish_on[] = [
                    'from' => 'fandom',
                    'id' => $member->fandom->id,
                    'name' => $member->fandom->name
                ];
            }
            $this->publish_on[] = [
                'from' => 'user',
                'id' => Auth::id(),
                'name' => Auth::user()->username
            ];
        }
        if ($this->from == 'fandom') {
            $this->id = $id;
            $publish_ids = Fandom::with(['publishes'])->where('id', $this->id)->first();
            $publish_ids = Arr::pluck($publish_ids->publishes, 'id');
            $this->posts = Post::with(['user', 'publish.publishable'])->whereIn('publish_id', $publish_ids)->orderBy('created_at', 'asc')->get();
        }
    }
    #[On('search')]
    public function search($query)
    {
        $search = $query['search'];
        $sort_by = $query['sort_by'];
        $sort = $query['sort'];
        $published = $query['published'] == null ? false : $query['published'];
        $search_array = str_split($search);
        $search = '';
        foreach ($search_array as $s) {
            $search = $search . $s . '%';
        }
        $search = '%' . $search;
        $sort_by = ($sort_by == 'Title') ? 'title' : 'created_at';
        $sort = ($sort == 'ASC') ? 'ASC' : 'DESC';

        if ($this->from == 'post') {
            if ($published == true) {
                $this->posts = Post::with(['user', 'publish.publishable'])->where('user_id', Auth::id())->where('title', 'like', $search)->whereNot('publish_id', null)->orderBy($sort_by, $sort)->get();
            } else {
                $this->posts = Post::with(['user', 'publish.publishable'])->where('user_id', Auth::id())->where('title', 'like', $search)->where('publish_id', null)->orderBy($sort_by, $sort)->get();
            }
        }
        if ($this->from == 'fandom') {
            $publish_ids = Fandom::with(['publishes'])->where('id', $this->id)->first();
            $publish_ids = Arr::pluck($publish_ids->publishes, 'id');
            $posts = Post::with(['user', 'publish.publishable'])->whereIn('publish_id', $publish_ids)->where('title', 'like', $search)->get();
            if ($sort_by == 'title') {
                $posts = collect($posts);
                if ($sort == 'ASC') {
                    $this->posts = $posts->sortBy('title');
                }
                if ($sort == 'DESC') {
                    $this->posts = $posts->sortByDesc('title');
                }
            }
            if ($sort_by == 'created_at') {
                $posts = collect($posts);
                if ($sort == 'ASC') {
                    $this->posts = $posts->sortBy('publish.created_at');
                }
                if ($sort == 'DESC') {
                    $this->posts = $posts->sortByDesc('publish.created_at');
                }
            }
        }
    }
}
