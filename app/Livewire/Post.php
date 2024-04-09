<?php

namespace App\Livewire;

use App\Models\Fandom;
use App\Models\Post as ModelsPost;
use App\Models\Publish;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Post')]
class Post extends Component
{
    public $preferences = [];
    public function render()
    {
        return view('livewire.post');
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
    public function createPost()
    {
        $this->dispatch('create_post')->to(PostCreateEdit::class);
    }
    public function editPost(ModelsPost $post)
    {
        $this->authorize('update', $post);
        $this->dispatch('edit_post', $post)->to(PostCreateEdit::class);
    }
    #[On('store_post')]
    public function storePost(array $data)
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
        $this->dispatch('refresh_post_list', 'post')->to(PostList::class);
    }
    #[On('update_post')]
    public function updatePost(ModelsPost $post, array $data)
    {
        $this->authorize('update', $post);
        $post->update([
            'publish_id' => $post->publish_id,
            'title' => $data['title'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'body' => $data['body'],
            'raw_body' => $data['raw_body'],
            'tags' => $data['tags'],
            'view' => $post->view,
        ]);
        $this->dispatch('alert', 'success', 'Success, the selected post is updated')->to(Alert::class);
        // $this->dispatch('refresh_post_list', 'post')->to(PostList::class);
        $this->dispatch('search')->to(PostSearch::class);
    }
    public function deletePost(ModelsPost $post)
    {
        $this->authorize('delete', $post);
        if ($post->publish_id != null) {
            DB::transaction(function ($post) {
                Publish::where('id', $post->publish_id)->delete();
                ModelsPost::where('id', $post->id)->delete();
            });
        } else {
            ModelsPost::where('id', $post->id)->delete();
        }
        $this->dispatch('alert', 'success', 'Success, the selected post is deleted')->to(Alert::class);
        $this->dispatch('refresh_post_list', 'post')->to(PostList::class);
    }
    public function publishPost(ModelsPost $post, $from, $id, $visible)
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
                    ModelsPost::where('id', $post->id)->update(['publish_id' => $publish->id]);
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
                    ModelsPost::where('id', $post->id)->update(['publish_id' => $publish->id]);
                });
                $this->dispatch('alert', 'success', 'Success, the selected post is published on fandom ' . $fandom->name)->to(Alert::class);
            }
        }
        $this->dispatch('refresh_post_list', 'post')->to(PostList::class);
    }
    public function unpublishPost(ModelsPost $post)
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
            $this->dispatch('alert', 'error', 'Fail, the selected post is not published')->to(Alert::class);
        }
        $this->dispatch('refresh_post_list', 'post')->to(PostList::class);
    }
}
