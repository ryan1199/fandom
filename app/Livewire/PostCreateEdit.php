<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class PostCreateEdit extends Component
{
    public $preferences = [];
    #[Locked]
    public $id;
    #[Locked]
    public $mode = 'create';
    public $title = '';
    public $description = '';
    public $tags = '';
    public $raw_body = '# New Post';
    public $body = '';
    #[Locked]
    public $galleries;
    public $startPosition;
    public $endPosition;
    public function render()
    {
        return view('livewire.post-create-edit');
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
        if(session()->has('temporary-post-' . Auth::user()->username)) {
            $post = session()->get('temporary-post-'. Auth::user()->username);
            $this->id = $post['id'];
            $this->title = $post['title'];
            $this->description = $post['description'];
            $this->tags = $post['tags'];
            $this->raw_body = $post['raw_body'];
            $this->mode = $post['mode'];
        }
        $this->toMarkdown();
        $this->cleanMarkdown();
        $user = User::with(['members.fandom.publishes.gallery', 'publishes.gallery'])->find(Auth::id());
        $fandoms = collect($user->members->pluck('fandom'));
        $fandoms = Fandom::with('publishes.gallery')->whereIn('id', $fandoms->pluck('id'))->get();
        $fandom_publish_ids = collect();
        $user_publish_ids = collect();
        foreach($fandoms as $fandom) {
            $fandom_publish_ids->push($fandom->publishes->pluck('id'));
        }
        $user_publish_ids->push($user->publishes->pluck('id'));
        $publish_ids = $fandom_publish_ids->concat($user_publish_ids);
        $publish_ids = $publish_ids->flatten();
        $publish_ids = $publish_ids->unique();
        $this->galleries = Gallery::with(['user', 'publish', 'image'])->whereIn('publish_id', $publish_ids)->get();
        $this->startPosition = Str::of($this->raw_body)->length();
        $this->endPosition = $this->startPosition;
    }
    #[On('create_post')]
    public function createPost()
    {
        $this->resetExcept(['preferences', 'galleries']);
        $this->mode = 'create';
        $this->startPosition = Str::of($this->raw_body)->length();
        $this->endPosition = $this->startPosition;
    }
    #[On('edit_post')]
    public function editPost(Post $post)
    {
        $this->authorize('update', $post);
        $this->mode = 'edit';
        $this->id = $post->id;
        $this->title = $post->title;
        $this->description = $post->description;
        $this->body = $post->body;
        $this->raw_body = $post->raw_body;
        $this->tags = $post->tags;
    }
    public function savePost()
    {
        if ($this->id != null) {
            $post = Post::find($this->id);
            $this->authorize('update', $post);
        }
        $validated = Validator::make(
            [
                'title' => $this->title,
                'description' => $this->description,
                'tags' => $this->tags,
                'raw_body' => $this->raw_body
            ],
            [
                'title' => ['required', 'between:5,50'],
                'description' => ['required', 'between:10,100'],
                'tags' => ['required', 'between:1,100'],
                'raw_body' => ['max:4294967295']
            ],
            [
                'required' => 'The :attribute must not empty',
                'between' => 'The :attribute length is between :min and :max characters',
                'unique' => 'The :attribute must unique',
                'max' => 'The :attribute max length is :max characters'
            ],
            [
                'title' => 'post title',
                'description' => 'post description',
                'tags' => 'post tags',
                'raw_body' => 'post content'
            ]
        )->validate();
        $this->toMarkdown();
        $this->cleanMarkdown();
        $title = $this->title;
        $slug = 'P-' . Auth::user()->username . '-' . now()->year . now()->month . now()->day . '-';
        $posts = Post::where('slug', 'like', '%' . $slug . '%')->get();
        if ($posts->count() > 0) {
            $slug.= $posts->count() + 1;
        } else {
            $slug.= '1';
        }
        $description = $this->description;
        $body = $this->body;
        $raw_body = $this->raw_body;
        $tags = Str::remove(' ', $this->tags);
        $tags = explode(',', $tags);
        $tags = Arr::sort($tags);
        $tags = Arr::join($tags, ',');
        $data = [
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            'body' => $body,
            'raw_body' => $raw_body,
            'tags' => $tags
        ];
        if ($this->mode == 'create') {
            $this->storePost($data);
        } elseif ($this->mode == 'edit') {
            $post = Post::find($this->id);
            $this->updatePost($post, $data);
        }
        $this->resetExcept(['preferences', 'galleries']);
        session()->forget('temporary-post-' . Auth::user()->username);
    }
    public function toMarkdown()
    {
        $this->body = Str::of($this->raw_body)->markdown();
    }
    public function cleanMarkdown()
    {
        $this->body = clean($this->body);
    }
    public function updatedRawbody()
    {
        $this->toMarkdown();
    }
    public function addImage($url)
    {
        $image_url_list = collect($this->galleries)->pluck('image.url')->toArray();
        if(in_array($url, $image_url_list))
        {
            $url = asset('storage/galleries/' . $url);
            $image = '![' . $url . '](' . $url . ')';
            $this->raw_body = Str::of($this->raw_body)->substrReplace("\n" . $image . "\n", $this->startPosition, $this->endPosition - $this->startPosition);
            $this->toMarkdown();
        } else {
            $this->dispatch('alert', 'error', 'The selected image is unavailable')->to(Alert::class);
        }
    }
    public function savePostTemporary()
    {
        if($this->mode == 'create') {
            $temporary_post = [
                'id' => null,
                'title' => $this->title,
                'description' => $this->description,
                'raw_body' => $this->raw_body,
                'tags' => $this->tags,
                'mode' => $this->mode,
            ];
        } else {
            $temporary_post = [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
                'raw_body' => $this->raw_body,
                'tags' => $this->tags,
                'mode' => $this->mode,
            ];
        }
        session()->put('temporary-post-' . Auth::user()->username, $temporary_post);
        $this->dispatch('alert', 'success', 'Saved as temporary post');
    }
    protected function storePost(array $data)
    {
        $user = User::find(Auth::id());
        $user->posts()->create([
            'publish_id' => null,
            'title' => $data['title'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'body' => $data['body'],
            'raw_body' => $data['raw_body'],
            'tags' => $data['tags'],
            'view' => 0,
        ]);
        $this->dispatch('alert', 'success', 'Success, the new post is stored')->to(Alert::class);
        $this->dispatch('search')->to(PostManagementsPostSearch::class);
    }
    protected function updatePost(Post $post, array $data)
    {
        $this->authorize('update', $post);
        $post->update([
            'publish_id' => $post->publish_id,
            'title' => $data['title'],
            'description' => $data['description'],
            'body' => $data['body'],
            'raw_body' => $data['raw_body'],
            'tags' => $data['tags'],
            'view' => $post->view,
        ]);
        $this->dispatch('alert', 'success', 'Success, the selected post is updated')->to(Alert::class);
        $this->dispatch('search')->to(PostManagementsPostSearch::class);
    }
}
