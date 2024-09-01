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
    public function mount($preferences, $from, $id = null)
    {
        $this->preferences = $preferences;
        $this->from = $from;
        $this->id = $id;
        if ($this->from == 'post-management') {
            $this->loadPublishOn();
        }
        $this->dispatch('search')->to(PostSearch::class);
    }
    #[On('search')]
    public function search($query)
    {
        $title = $query['title'];
        $tags = $query['tags'];
        $sort_by = $query['sort_by'];
        $sort = $query['sort'];
        $published = $query['published'] == null ? false : $query['published'];
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
        $sort_by = ($sort_by == 'Title') ? 'title' : 'created_at';
        $sort = ($sort == 'ASC') ? 'ASC' : 'DESC';

        if ($this->from == 'post-management') {
            if ($published == true) {
                $posts = Post::with(['user', 'publish.publishable'])->where('user_id', Auth::id())->where('title', 'like', $title)->where(function (Builder $query) use($tags) {
                    foreach($tags as $tag) {
                        $query->orWhere('tags', 'like', '%'.$tag.'%');
                    }
                })->whereNot('publish_id', null)->orderBy($sort_by, $sort)->get();
            } else {
                $posts = Post::with(['user', 'publish.publishable'])->where('user_id', Auth::id())->where('title', 'like', $title)->where(function (Builder $query) use($tags) {
                    foreach($tags as $tag) {
                        $query->orWhere('tags', 'like', '%'.$tag.'%');
                    }
                })->where('publish_id', null)->orderBy($sort_by, $sort)->get();
            }
        }
        if ($this->from == 'fandom') {
            $fandom = Fandom::with(['publishes', 'members.user'])->where('id', $this->id)->first();
            $users = collect($fandom->members);
            $members['id'] = $users->pluck('user.id')->toArray();
            $publish_ids = Arr::pluck($fandom->publishes, 'id');
            $posts = Post::with(['user', 'publish.publishable'])->whereIn('publish_id', $publish_ids)->where('title', 'like', $title)->where(function (Builder $query) use($tags) {
                foreach($tags as $tag) {
                    $query->orWhere('tags', 'like', '%'.$tag.'%');
                }
            })->orderBy($sort_by, $sort)->get();
            if(in_array(Auth::id(), $members['id'])) {
                $posts = collect($posts);
            } else {
                $posts = collect($posts)->where('publish.visible', 'public');
            }
        }
        if ($this->from == 'post') {
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
            } else {
                $posts = $posts->where('publish.visible', 'public');
            }
        }
        // if ($sort_by == 'title') {
        //     if ($sort == 'ASC') {
        //         $posts = $posts->sortBy('title');
        //     }
        //     if ($sort == 'DESC') {
        //         $posts = $posts->sortByDesc('title');
        //     }
        // }
        // if ($sort_by == 'created_at') {
        //     if ($sort == 'ASC') {
        //         $posts = $posts->sortBy('publish.created_at');
        //     }
        //     if ($sort == 'DESC') {
        //         $posts = $posts->sortByDesc('publish.created_at');
        //     }
        // }
        // $this->posts = $posts->values()->all();
        $this->posts = $posts;
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
            if (class_basename($post->publish->publishable_type) === 'User') {
                $user = User::find($post->publish->publishable_id);
                DB::transaction(function () use ($post, &$result) {
                    Publish::where('id', $post->publish_id)->delete();
                    Post::where('id', $post->id)->delete();
                    $result = true;
                });
                UsersPostUnpublished::dispatch($user);
            } else {
                $fandom = Fandom::find($post->publish->publishable_id);
                DB::transaction(function () use ($post, &$result) {
                    Publish::where('id', $post->publish_id)->delete();
                    Post::where('id', $post->id)->delete();
                    $result = true;
                });
                FandomsPostUnpublished::dispatch($fandom);
            }
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
        if ($from == 'post-management') {
            if ($user->id == $id) {
                DB::transaction(function () use ($visible, $user, $post) {
                    $publish = new Publish(['visible' => $visible]);
                    $publish = $user->publishes()->save($publish);
                    Post::where('id', $post->id)->update(['publish_id' => $publish->id]);
                });
                $this->dispatch('alert', 'success', 'Success, the selected post is published on user ' . $user->username)->to(Alert::class);
                UsersPostPublished::dispatch($user);
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
                FandomsPostPublished::dispatch($fandom);
            }
        }
        $this->dispatch('search')->to(PostSearch::class);
    }
    public function unpublishPost(Post $post)
    {
        $this->authorize('owner', $post);
        if ($post->publish_id != null) {
            if (class_basename($post->publish->publishable_type) === 'User') {
                $user = User::find($post->publish->publishable_id);
                DB::transaction(function () use ($post) {
                    $publish_id = $post->publish_id;
                    $post->update([
                        'publish_id' => null
                    ]);
                    Publish::where('id', $publish_id)->delete();
                });
                UsersPostUnpublished::dispatch($user);
            } else {
                $fandom = Fandom::find($post->publish->publishable_id);
                DB::transaction(function () use ($post) {
                    $publish_id = $post->publish_id;
                    $post->update([
                        'publish_id' => null
                    ]);
                    Publish::where('id', $publish_id)->delete();
                });
                FandomsPostUnpublished::dispatch($fandom);
            }
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
            'from' => 'post-management',
            'data' => $user
        ];
    }
}
