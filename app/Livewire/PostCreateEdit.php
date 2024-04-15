<?php

namespace App\Livewire;

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
    public function render()
    {
        return view('livewire.post-create-edit');
    }
    public function mount()
    {
        $this->toMarkdown();
        $this->cleanMarkdown();
        $user = User::with(['members.fandom.publishes.gallery', 'publishes.gallery'])->find(Auth::id());
        $fandoms = collect($user->members->pluck('fandom'));
        $publishes = [];
        foreach ($fandoms as $fandom) {
            $publishes[] = $fandom->publishes->pluck('id');
        }
        $publishes[] = $user->publishes->pluck('gallery.id');
        $publishes = Arr::collapse($publishes);
        $this->galleries = Gallery::with(['user', 'publish', 'image'])->whereIn('publish_id', $publishes)->get();
    }
    #[On('create_post')]
    public function createPost()
    {
        $this->resetExcept(['preferences', 'galleries']);
        $this->mode = 'create';
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
            $validation_for_title = ['required', 'between:5,50', Rule::unique('posts', 'title')->ignore($this->id)];
        } else {
            $validation_for_title = ['required', 'between:5,50', Rule::unique('posts', 'title')];
        }
        $validated = Validator::make(
            [
                'title' => $this->title,
                'description' => $this->description,
                'tags' => $this->tags,
                'raw_body' => $this->raw_body
            ],
            [
                'title' => $validation_for_title,
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
        $slug = Str::slug($title);
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
            $this->dispatch('store_post', $data);
        } elseif ($this->mode == 'edit') {
            $post = Post::find($this->id);
            $this->dispatch('update_post', $post, $data);
        }
        $this->resetExcept(['preferences', 'galleries']);
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
        $this->body = Str::of($this->raw_body)->markdown();
    }
}
