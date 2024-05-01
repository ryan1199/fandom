<?php

namespace App\Livewire;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
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
    public function mount()
    {
        $users_fandom = User::with(['members.fandom'])->where('id', Auth::id())->first();
        foreach ($users_fandom->members as $member) {
            $this->available_publish_on[] = [
                'from' => 'fandom',
                'id' => $member->fandom->id,
                'name' => $member->fandom->name
            ];
        }
        $this->available_publish_on[] = [
            'from' => 'user',
            'id' => Auth::id(),
            'name' => Auth::user()->username
        ];
        $this->available_visible = ['self', 'member', 'public'];
        $this->publish_on = $this->available_publish_on[0];
        $this->visible = $this->available_visible[2];
    }
    #[On('create_gallery')]
    public function createGallery()
    {
        $this->resetExcept(['preferences']);
        $this->mount();
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
            $this->setUploadLocation('User', $gallery->publish->publishable->id, $gallery->publish->publishable->username, $gallery->publish->visible);
        }
        if(class_basename($gallery->publish->publishable_type) === 'Fandom')
        {   
            $this->setUploadLocation('Fandom', $gallery->publish->publishable->id, $gallery->publish->publishable->name, $gallery->publish->visible);
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
            $this->dispatch('store_gallery', $data);
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
            $this->dispatch('update_gallery', $gallery, $data);
        }
        $this->resetExcept(['preferences', 'available_publish_on', 'available_visible', 'publish_on', 'visible']);
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
}
