<?php

namespace App\Livewire;

use App\Events\FandomsPostPublished;
use App\Events\FandomsPostUnpublished;
use App\Events\NewFandomLog;
use App\Events\NewUserLog;
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
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PostManagementsPostList extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $publish_on = [];
    public $query = [];
    public $preferences = [];
    public function render()
    {
        $title = $this->query['title'];
        $tags = $this->query['tags'];
        $sort_by = $this->query['sort_by'];
        $sort = $this->query['sort'];
        $published = $this->query['published'] == null ? false : $this->query['published'];
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

        if ($published == true) {
            $posts = Post::with(['user', 'publish.publishable'])->where('user_id', Auth::id())->where('title', 'like', $title)->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->whereNot('publish_id', null)->orderBy($sort_by, $sort)->simplePaginate($limit, pageName: 'posts-page');
        } else {
            $posts = Post::with(['user', 'publish.publishable'])->where('user_id', Auth::id())->where('title', 'like', $title)->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->where('publish_id', null)->orderBy($sort_by, $sort)->simplePaginate($limit, pageName: 'posts-page');
        }
        return view('livewire.post-managements-post-list', [
            'posts' => $posts,
        ]);
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
        $this->query['title'] = '';
        $this->query['tags'] = '';
        $this->query['sort_by'] = 'Title';
        $this->query['sort'] = 'DESC';
        $this->query['published'] = null;
        $this->query['limit'] = 5;
        $this->loadPublishOn();
    }
    #[On('search')]
    public function search($query)
    {
        $this->query = $query;
        $this->resetPage('posts-page');
    }
    public function editPost(Post $post)
    {
        $this->authorize('update', $post);
        $this->dispatch('edit_post', $post)->to(PostCreateEdit::class);
    }
    public function deletePost(Post $post)
    {
        $this->authorize('delete', $post);
        $result = false;
        if ($post->publish_id != null) {
            if (class_basename($post->publish->publishable_type) === 'User') {
                $user = User::find($post->publish->publishable_id);
                DB::transaction(function () use ($post, &$result, $user) {
                    Publish::where('id', $post->publish_id)->delete();
                    Post::where('id', $post->id)->delete();
                    $user->logs()->create([
                        'message' => 'You delete a post with title: ' . $post->title
                    ]);
                    $result = true;
                });
                UsersPostUnpublished::dispatch($user);
                NewUserLog::dispatch($user);
            } else {
                $fandom = Fandom::find($post->publish->publishable_id);
                $user = User::find($post->user_id);
                DB::transaction(function () use ($post, &$result, $fandom, $user) {
                    Publish::where('id', $post->publish_id)->delete();
                    Post::where('id', $post->id)->delete();
                    $fandom->logs()->create([
                       'message' => $user->username . ' delete a post with title: ' . $post->title
                    ]);
                    $result = true;
                });
                FandomsPostUnpublished::dispatch($fandom);
                NewFandomLog::dispatch($fandom);
            }
        } else {
            $user = User::find($post->user_id);
            DB::transaction(function () use ($post, &$result, $user) {
                Post::where('id', $post->id)->delete();
                $user->logs()->create([
                   'message' => 'You delete a post with title: ' . $post->title
                ]);
                $result = true;
            });
            NewUserLog::dispatch($user);
        }
        if ($result == true) {
            $this->dispatch('alert', 'success', 'Success, the selected post is deleted')->to(Alert::class);
            $this->dispatch('search')->to(PostManagementsPostSearch::class);
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
        foreach ($users_fandom->members as $member) {
            $fandoms_id[] = $member->fandom->id;
        }
        if ($from == 'user') {
            if ($user->id == $id) {
                $available_visible = ['self', 'friend', 'public'];
                if (!in_array($visible, $available_visible, true)) {
                    $visible = 'public';
                }
                DB::transaction(function () use ($visible, $user, $post) {
                    $publish = new Publish(['visible' => $visible]);
                    $publish = $user->publishes()->save($publish);
                    Post::where('id', $post->id)->update([
                        'publish_id' => $publish->id,
                        'created_at' => $publish->created_at
                    ]);
                    $user->logs()->create([
                        'message' => 'You publish a post with title: ' . $post->title
                    ]);
                });
                $this->dispatch('alert', 'success', 'Success, the selected post is published on user ' . $user->username)->to(Alert::class);
                UsersPostPublished::dispatch($user);
                NewUserLog::dispatch($user);
            }
        }
        if ($from == 'fandom') {
            if (in_array($id, $fandoms_id, true)) {
                $available_visible = ['member', 'public'];
                if (!in_array($visible, $available_visible, true)) {
                    $visible = 'public';
                }
                $fandom = Fandom::find($id);
                DB::transaction(function () use ($visible, $fandom, $post, $user) {
                    $publish = new Publish(['visible' => $visible]);
                    $publish = $fandom->publishes()->save($publish);
                    Post::where('id', $post->id)->update([
                        'publish_id' => $publish->id,
                        'created_at' => $publish->created_at
                    ]);
                    $fandom->logs()->create([
                        'message' => $user->username . ' publish a post with title: ' . $post->title
                    ]);
                });
                $this->dispatch('alert', 'success', 'Success, the selected post is published on fandom ' . $fandom->name)->to(Alert::class);
                FandomsPostPublished::dispatch($fandom);
                NewFandomLog::dispatch($fandom);
            }
        }
        if ($from == 'user' || $from == 'fandom') {
            $this->dispatch('search')->to(PostManagementsPostSearch::class);
        } else {
            $this->dispatch('alert', 'error', 'Publish failed')->to(Alert::class);
        }
    }
    public function unpublishPost(Post $post)
    {
        $this->authorize('owner', $post);
        if ($post->publish_id != null) {
            if (class_basename($post->publish->publishable_type) === 'User') {
                $user = User::find($post->publish->publishable_id);
                DB::transaction(function () use ($post, $user) {
                    $publish_id = $post->publish_id;
                    $post->update([
                        'publish_id' => null
                    ]);
                    Publish::where('id', $publish_id)->delete();
                    $user->logs()->create([
                       'message' => 'You unpublish a post with title: ' . $post->title
                    ]);
                });
                UsersPostUnpublished::dispatch($user);
                NewUserLog::dispatch($user);
            } else {
                $fandom = Fandom::find($post->publish->publishable_id);
                $user = User::find($post->user_id);
                DB::transaction(function () use ($post, $fandom, $user) {
                    $publish_id = $post->publish_id;
                    $post->update([
                        'publish_id' => null
                    ]);
                    Publish::where('id', $publish_id)->delete();
                    $fandom->logs()->create([
                       'message' => $user->username . ' unpublish a post with title: ' . $post->title
                    ]);
                });
                FandomsPostUnpublished::dispatch($fandom);
                NewFandomLog::dispatch($fandom);
            }
            $this->dispatch('alert', 'success', 'Success, the selected post is unpublished')->to(Alert::class);
        } else {
            $this->dispatch('alert', 'error', 'Failed, the selected post is not published')->to(Alert::class);
        }
        $this->dispatch('search')->to(PostManagementsPostSearch::class);
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
