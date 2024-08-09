<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Post;
use App\Models\Publish;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $this->id = $id;
        if ($this->from == 'post') {
            $this->loadPublishOn();
        }
        $this->dispatch('search')->to(PostSearch::class);
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
                $posts = Post::with(['user', 'publish.publishable'])->where('user_id', Auth::id())->where('title', 'like', $search)->whereNot('publish_id', null)->get();
            } else {
                $posts = Post::with(['user', 'publish.publishable'])->where('user_id', Auth::id())->where('title', 'like', $search)->where('publish_id', null)->get();
            }
        }
        if ($this->from == 'fandom') {
            $fandom = Fandom::with(['publishes', 'members.user'])->where('id', $this->id)->first();
            $users = collect($fandom->members);
            $members['id'] = $users->pluck('user.id')->toArray();
            $publish_ids = Arr::pluck($fandom->publishes, 'id');
            $posts = Post::with(['user', 'publish.publishable'])->whereIn('publish_id', $publish_ids)->where('title', 'like', $search)->get();
            if(in_array(Auth::id(), $members['id'])) {
                $posts = collect($posts);
            } else {
                $posts = collect($posts)->where('publish.visible', 'public');
            }
        }
        if ($sort_by == 'title') {
            if ($sort == 'ASC') {
                $posts = $posts->sortBy('title');
            }
            if ($sort == 'DESC') {
                $posts = $posts->sortByDesc('title');
            }
        }
        if ($sort_by == 'created_at') {
            if ($sort == 'ASC') {
                $posts = $posts->sortBy('publish.created_at');
            }
            if ($sort == 'DESC') {
                $posts = $posts->sortByDesc('publish.created_at');
            }
        }
        $this->posts = $posts->values()->all();
    }
    public function editPost(Post $post)
    {
        $this->authorize('update', $post);
        $this->dispatch('edit_post', $post)->to(PostCreateEdit::class);
    }
    public function deletePost(Post $post)
    {
        $this->authorize('delete', $post);
        $post_id = $post->id;
        $result = false;
        if ($post->publish_id != null) {
            DB::transaction(function () use ($post, &$result) {
                Publish::where('id', $post->publish_id)->delete();
                Post::where('id', $post->id)->delete();
                $result = true;
            });
        } else {
            Post::where('id', $post->id)->delete();
            $result = true;
        }
        if ($result == true) {
            $i = 0;
            foreach($this->posts as $post) {
                if($post->id == $post_id) {
                    Arr::forget($this->posts, $i);
                }
                $i++;
            }
            $this->dispatch('alert', 'success', 'Success, the selected post is deleted')->to(Alert::class);
            $this->dispatch('search')->to(PostSearch::class);
        } 
        if($result == false) {
            $this->dispatch('alert', 'error', 'Failed, the selected post is not deleted')->to(Alert::class);
        }
    }
    public function publishPost(Post $post, $from, $id, $visible)
    {
        $this->authorize('owner', $post);
        $fandoms_id = [];
        $user = User::find(Auth::id());
        $users_fandom = User::with(['members.fandom'])->where('id', Auth::id())->first();
        $available_visible = ['self', 'friend', 'member', 'public'];
        foreach ($users_fandom->members as $member) {
            $fandoms_id[] = $member->fandom->id;
        }
        if (!in_array($visible, $available_visible, true)) {
            $visible = 'public';
        }
        if ($from == 'user') {
            if ($user->id == $id) {
                DB::transaction(function () use ($visible, $user, $post) {
                    $publish = new Publish(['visible' => $visible]);
                    $publish = $user->publishes()->save($publish);
                    Post::where('id', $post->id)->update(['publish_id' => $publish->id]);
                });
                $this->dispatch('alert', 'success', 'Success, the selected post is published on user ' . $user->username)->to(Alert::class);
            }
        }
        if ($from == 'fandom') {
            if (in_array($id, $fandoms_id, true)) {
                $fandom = Fandom::find($id);
                DB::transaction(function () use ($visible, $fandom, $post) {
                    $publish = new Publish(['visible' => $visible]);
                    $publish = $fandom->publishes()->save($publish);
                    Post::where('id', $post->id)->update(['publish_id' => $publish->id]);
                });
                $this->dispatch('alert', 'success', 'Success, the selected post is published on fandom ' . $fandom->name)->to(Alert::class);
            }
        }
        $this->dispatch('search')->to(PostSearch::class);
    }
    public function unpublishPost(Post $post)
    {
        $this->authorize('owner', $post);
        if ($post->publish_id != null) {
            DB::transaction(function () use ($post) {
                $publish_id = $post->publish_id;
                $post->update([
                    'publish_id' => null
                ]);
                Publish::where('id', $publish_id)->delete();
            });
            $this->dispatch('alert', 'success', 'Success, the selected post is unpublished')->to(Alert::class);
        } else {
            $this->dispatch('alert', 'error', 'Failed, the selected post is not published')->to(Alert::class);
        }
        $this->dispatch('search')->to(PostSearch::class);
    }
    private function loadPublishOn()
    {
        $this->publish_on = [];
        $users_fandom = User::with(['members.fandom'])->where('id', Auth::id())->first();
        $fandom_ids = $users_fandom->members->pluck('fandom.id');
        $fandoms = Fandom::with([
            'cover' => [
                'image'
            ],
            'avatar' => [
                'image'
            ],
        ])->whereIn('id', $fandom_ids)->get();
        $user = User::with([
            'profile',
            'cover' => [
                'image'
            ],
            'avatar' => [
                'image'
            ],
        ])->find(Auth::id());
        foreach($fandoms as $fandom) {
            $this->publish_on[] = [
                'from' => 'fandom',
                'data' => $fandom
            ];
        }
        $this->publish_on[] = [
            'from' => 'user',
            'data' => $user
        ];
    }
}
