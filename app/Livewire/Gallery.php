<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Gallery as ModelsGallery;
use App\Models\Image;
use App\Models\Publish;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class Gallery extends Component
{
    public $preferences = [];
    public function render()
    {
        return view('livewire.gallery');
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->preferences = session()->get('preference-' . Auth::user()->username);
        } else {
            $this->preferences = [
                'color_1' => '#f97316',
                'color_2' => '#ec4899',
                'color_3' => '#6366f1',
                'color_primary' => '#ffffff',
                'color_secondary' => '#000000',
                'color_text' => '#000000',
                'font_size' => 16,
                'selected_font_family' => 'mono',
                'create_fandom_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'account_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'profile_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ],
                'preference_settings_modal_position' => [
                    'left' => 0,
                    'right' => 0,
                    'top' => 0,
                    'bottom' => 0
                ]
            ];
        }
    }
    public function createGallery()
    {
        $this->dispatch('create_gallery')->to(GalleryCreateEdit::class);
    }
    public function editGallery(ModelsGallery $gallery)
    {
        $this->authorize('update', $gallery);
        $this->dispatch('edit_gallery', $gallery)->to(GalleryCreateEdit::class);
    }
    #[On('store_gallery')]
    public function storeGallery(array $data)
    {
        $fandoms_id = [];
        $user = User::find(Auth::id());
        $users_fandom = User::with(['members.fandom'])->where('id', Auth::id())->first();
        $available_visible = ['self', 'member', 'public'];
        $visible = $data['visible'];
        foreach ($users_fandom->members as $member) {
            $fandoms_id[] = $member->fandom->id;
        }
        if (!in_array($data['visible'], $available_visible, true)) {
            $visible = 'public';
        }
        if ($data['publish_on']['from'] == 'user') {
            if ($user->id == $data['publish_on']['id']) {
                DB::transaction(function () use ($visible, $user, $data) {
                    $publish = new Publish(['visible' => $visible]);
                    $publish = $user->publishes()->save($publish);
                    $gallery = $user->galleries()->create([
                        'tags' => $data['tags'],
                        'view' => 0,
                        'publish_id' => $publish->id
                    ]);
                    $image = new Image(['url' => $data['image_name']]);
                    $gallery->image()->save($image);
                });
            }
        }
        if ($data['publish_on']['from'] == 'fandom') {
            if (in_array($data['publish_on']['id'], $fandoms_id, true)) {
                $fandom = Fandom::find($data['publish_on']['id']);
                DB::transaction(function () use ($visible, $user, $fandom, $data) {
                    $publish = new Publish(['visible' => $visible]);
                    $publish = $fandom->publishes()->save($publish);
                    $gallery = $user->galleries()->create([
                        'tags' => $data['tags'],
                        'view' => 0,
                        'publish_id' => $publish->id
                    ]);
                    $image = new Image(['url' => $data['image_name']]);
                    $gallery->image()->save($image);
                });
            }
        }
        $this->dispatch('alert', 'success', 'Success, the new image is stored')->to(Alert::class);
        $this->dispatch('refresh_gallery_list', 'gallery')->to(GalleryList::class);
    }
    #[On('update_gallery')]
    public function updatePost(ModelsGallery $gallery, array $data)
    {
        $this->authorize('update', $gallery);
        $fandoms_id = [];
        $user = User::find(Auth::id());
        $users_fandom = User::with(['members.fandom'])->where('id', Auth::id())->first();
        $available_visible = ['self', 'member', 'public'];
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
                    ModelsGallery::where('id', $gallery->id)->update([
                        'tags' => $data['tags'],
                        'publish_id' => $publish->id
                    ]);
                    Publish::where('id', $publish_id)->delete();
                });
            }
        }
        if ($data['publish_on']['from'] == 'fandom') {
            if (in_array($data['publish_on']['id'], $fandoms_id, true)) {
                $fandom = Fandom::find($data['publish_on']['id']);
                DB::transaction(function () use ($visible, $fandom, $data, $gallery) {
                    $publish_id = $gallery->publish_id;
                    $publish = new Publish(['visible' => $visible]);
                    $publish = $fandom->publishes()->save($publish);
                    ModelsGallery::where('id', $gallery->id)->update([
                        'tags' => $data['tags'],
                        'publish_id' => $publish->id
                    ]);
                    Publish::where('id', $publish_id)->delete();
                });
            }
        }
        $this->dispatch('alert', 'success', 'Success, the selected image is updated')->to(Alert::class);
        $this->dispatch('refresh_gallery_list', 'gallery')->to(GalleryList::class);
    }
    public function deleteGallery(ModelsGallery $gallery)
    {
        $this->authorize('delete', $gallery);
        $image = ModelsGallery::with('image')->find($gallery->id);
        $image = $image->image;
        Storage::delete('galleries/' . $image->url);
        DB::transaction(function () use ($gallery, $image) {
            Publish::where('id', $gallery->publish_id)->delete();
            ModelsGallery::where('id', $gallery->id)->delete();
            Image::where('id', $image->id)->delete();
        });
        $this->dispatch('alert', 'success', 'Success, the selected image is deleted')->to(Alert::class);
        $this->dispatch('refresh_gallery_list', 'gallery')->to(GalleryList::class);
    }
}
