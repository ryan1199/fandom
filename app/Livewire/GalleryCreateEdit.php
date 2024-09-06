<?php

namespace App\Livewire;

use App\Events\FandomsGalleryPublished;
use App\Events\UsersGalleryPublished;
use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Publish;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class GalleryCreateEdit extends Component
{
    use WithFileUploads;
    public $preferences = [];
    #[Locked]
    public $id;
    #[Locked]
    public $mode = 'create';
    public $image;
    public $tags = '';
    public $publish_on;
    public $visible;
    #[Locked]
    public $available_publish_on;
    #[Locked]
    public $available_visible;
    public function render()
    {
        return view('livewire.gallery-create-edit');
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
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
        $this->available_publish_on[] = [
            'from' => 'user',
            'data' => $user
        ];
        foreach ($fandoms as $fandom) {
            $this->available_publish_on[] = [
                'from' => 'fandom',
                'data' => $fandom
            ];
        }
        $this->available_visible = ['self', 'friend', 'member', 'public'];
        $this->publish_on = [
            'from' => $this->available_publish_on[0]['from'],
            'id' => $this->available_publish_on[0]['data']->id,
            'name' => $this->available_publish_on[0]['data']->username
        ];
        $this->visible = $this->available_visible[3];
    }
    #[On('create_gallery')]
    public function createGallery()
    {
        $this->resetExcept(['preferences']);
        $this->mount($this->preferences);
        $this->mode = 'create';
    }
    #[On('edit_gallery')]
    public function editGallery(Gallery $gallery)
    {
        $this->authorize('update', $gallery);
        $this->mode = 'edit';
        $this->id = $gallery->id;
        $this->tags = $gallery->tags;
        $gallery = Gallery::with(['publish.publishable'])->find($gallery->id);
        if(class_basename($gallery->publish->publishable_type) === 'User')
        {   
            $this->setUploadLocation('user', $gallery->publish->publishable->id, $gallery->publish->publishable->username, $gallery->publish->visible);
        }
        if(class_basename($gallery->publish->publishable_type) === 'Fandom')
        {   
            $this->setUploadLocation('fandom', $gallery->publish->publishable->id, $gallery->publish->publishable->name, $gallery->publish->visible);
        }
    }
    public function saveGallery()
    {
        if ($this->mode == 'create') {
            $validated = Validator::make(
                [
                    'publish_on' => $this->publish_on,
                    'visible' => $this->visible,
                    'image' => $this->image,
                    'tags' => $this->tags
                ],
                [
                    'publish_on' => ['required', 'array:from,id,name'],
                    'visible' => ['required', Rule::in($this->available_visible)],
                    'image' => ['required', 'image', 'max:10240'],
                    'tags' => ['required', 'between:1,100']
                ],
                [
                    'required' => 'The :attribute must not empty',
                    'between' => 'The :attribute length is between :min and :max characters',
                    'max' => 'The :attribute max size is :max MB',
                    'array' => 'The :attribute key is not exists',
                    'in' => 'The :attribute value is not exists',
                    'image' => 'The :attribute only accept image file type'
                ],
                [
                    'publish_on' => 'publish on',
                    'visible' => 'visible',
                    'image' => 'gallery image',
                    'tags' => 'gallery tags'
                ]
            )->validate();
            $tags = Str::remove(' ', $this->tags);
            $tags = explode(',', $tags);
            $tags = Arr::sort($tags);
            $tags = Arr::join($tags, ',');
            $image_name = Str::random(100) . "." . $this->image->extension();
            $this->image->storeAs('galleries', $image_name, 'public');
            $data = [
                'publish_on' => $this->publish_on,
                'visible' => $this->visible,
                'image_name' => $image_name,
                'tags' => $tags
            ];
            $this->storeGallery($data);
        }
        if ($this->mode == 'edit') {
            if ($this->id != null) {
                $gallery = Gallery::find($this->id);
                $this->authorize('update', $gallery);
            }
            $validated = Validator::make(
                [
                    'publish_on' => $this->publish_on,
                    'visible' => $this->visible,
                    'tags' => $this->tags
                ],
                [
                    'publish_on' => ['required', 'array:from,id,name'],
                    'visible' => ['required', Rule::in($this->available_visible)],
                    'tags' => ['required', 'between:1,100']
                ],
                [
                    'required' => 'The :attribute must not empty',
                    'between' => 'The :attribute length is between :min and :max characters',
                    'array' => 'The :attribute key is not exists',
                    'in' => 'The :attribute value is not exists'
                ],
                [
                    'publish_on' => 'publish on',
                    'visible' => 'visible',
                    'tags' => 'gallery tags'
                ]
            )->validate();
            $tags = Str::remove(' ', $this->tags);
            $tags = explode(',', $tags);
            $tags = Arr::sort($tags);
            $tags = Arr::join($tags, ',');
            $data = [
                'publish_on' => $this->publish_on,
                'visible' => $this->visible,
                'tags' => $tags
            ];
            $this->updateGallery($gallery, $data);
        }
        $this->resetExcept(['preferences', 'available_publish_on', 'available_visible', 'publish_on', 'visible']);
    }
    protected function storeGallery(array $data)
    {
        $fandoms_id = [];
        $user = User::find(Auth::id());
        $users_fandom = User::with(['members.fandom'])->where('id', Auth::id())->first();
        $available_visible = ['self', 'friend', 'member', 'public'];
        $visible = $data['visible'];
        foreach ($users_fandom->members as $member) {
            $fandoms_id[] = $member->fandom->id;
        }
        if (!in_array($data['visible'], $available_visible, true)) {
            $visible = 'public';
        }
        $slug = 'G-' . Auth::user()->username . '-' . now()->year . now()->month . now()->day . '-';
        $galleries = Gallery::where('slug', 'like', '%' . $slug . '%')->get();
        if ($galleries->count() > 0) {
            $slug.= $galleries->count() + 1;
        } else {
            $slug.= '1';
        }
        if ($data['publish_on']['from'] == 'user') {
            if ($user->id == $data['publish_on']['id']) {
                DB::transaction(function () use ($visible, $user, $data, $slug) {
                    $publish = new Publish(['visible' => $visible]);
                    $publish = $user->publishes()->save($publish);
                    $gallery = $user->galleries()->create([
                        'slug' => $slug,
                        'tags' => $data['tags'],
                        'view' => 0,
                        'publish_id' => $publish->id
                    ]);
                    $image = new Image(['url' => $data['image_name']]);
                    $gallery->image()->save($image);
                });
                UsersGalleryPublished::dispatch($user);
            }
        }
        if ($data['publish_on']['from'] == 'fandom') {
            if (in_array($data['publish_on']['id'], $fandoms_id, true)) {
                $fandom = Fandom::find($data['publish_on']['id']);
                DB::transaction(function () use ($visible, $user, $fandom, $data, $slug) {
                    $publish = new Publish(['visible' => $visible]);
                    $publish = $fandom->publishes()->save($publish);
                    $gallery = $user->galleries()->create([
                        'slug' => $slug,
                        'tags' => $data['tags'],
                        'view' => 0,
                        'publish_id' => $publish->id
                    ]);
                    $image = new Image(['url' => $data['image_name']]);
                    $gallery->image()->save($image);
                });
                FandomsGalleryPublished::dispatch($fandom);
            }
        }
        $this->dispatch('alert', 'success', 'Success, the new image is stored')->to(Alert::class);
        $this->dispatch('search')->to(GalleryManagementsGallerySearch::class);
    }
    protected function updateGallery(Gallery $gallery, array $data)
    {
        $this->authorize('update', $gallery);
        $fandoms_id = [];
        $user = User::find(Auth::id());
        $users_fandom = User::with(['members.fandom'])->where('id', Auth::id())->first();
        $available_visible = ['self', 'friend', 'member', 'public'];
        $visible = $data['visible'];
        foreach ($users_fandom->members as $member) {
            $fandoms_id[] = $member->fandom->id;
        }
        if (!in_array($data['visible'], $available_visible, true)) {
            $visible = 'public';
        }
        if ($data['publish_on']['from'] == 'user') {
            if ($user->id == $data['publish_on']['id']) {
                DB::transaction(function () use ($visible, $user, $data, $gallery) {
                    $publish_id = $gallery->publish_id;
                    $publish = new Publish(['visible' => $visible]);
                    $publish = $user->publishes()->save($publish);
                    Gallery::where('id', $gallery->id)->update([
                        'tags' => $data['tags'],
                        'publish_id' => $publish->id
                    ]);
                    Publish::where('id', $publish_id)->delete();
                });
                UsersGalleryPublished::dispatch($user);
            }
        }
        if ($data['publish_on']['from'] == 'fandom') {
            if (in_array($data['publish_on']['id'], $fandoms_id, true)) {
                $fandom = Fandom::find($data['publish_on']['id']);
                DB::transaction(function () use ($visible, $fandom, $data, $gallery) {
                    $publish_id = $gallery->publish_id;
                    $publish = new Publish(['visible' => $visible]);
                    $publish = $fandom->publishes()->save($publish);
                    Gallery::where('id', $gallery->id)->update([
                        'tags' => $data['tags'],
                        'publish_id' => $publish->id
                    ]);
                    Publish::where('id', $publish_id)->delete();
                });
                FandomsGalleryPublished::dispatch($fandom);
            }
        }
        $this->dispatch('alert', 'success', 'Success, the selected image is updated')->to(Alert::class);
        $this->dispatch('search')->to(GalleryManagementsGallerySearch::class);
    }
    public function setUploadLocation($from, $id, $name, $visible)
    {
        $this->publish_on = [
            'from' => $from,
            'id' => $id,
            'name' => $name
        ];
        $this->visible = $visible;
    }
    public function updatedImage()
    {
        $this->resetValidation('image');
    }
}
