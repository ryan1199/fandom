<?php

namespace App\Livewire;

use App\Events\FandomCreated;
use App\Events\NewFandomLog;
use App\Events\NewUserLog;
use App\Events\UserJoined;
use App\Models\Discuss;
use App\Models\Fandom;
use App\Models\Image;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

#[Title('Fandom Create')]
class FandomCreate extends Component
{
    use WithFileUploads;
    #[Validate('required|image|max:10240')]
    public $cover;
    #[Validate('required|image|max:10240')]
    public $avatar;
    #[Validate('required|unique:fandoms,name|max:50')]
    public $name = '';
    #[Validate('required|max:500')]
    public $description = '';
    public $preferences = [];
    public function render()
    {
        return view('livewire.fandom-create');
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
    }
    public function createFandom()
    {
        $this->validate();
        $result = false;
        $fandom = DB::transaction(function() use (&$result) {
            $slug = Str::slug($this->name, '-');
            $fandom = Fandom::create([
                'name' => $this->name,
                'slug' => $slug,
                'description' => $this->description
            ]);
            $role = Role::where('name', 'Manager')->first();
            $fandom->members()->create([
                'user_id' => Auth::id(),
                'role_id' => $role->id
            ]);
            Discuss::createMany([
                [
                    'name' => 'Public',
                    'visible' => 'public',
                    'fandom_id' => $fandom->id
                ], [
                    'name' => 'Member',
                    'visible' => 'member',
                    'fandom_id' => $fandom->id
                ], [
                    'name' => 'Manager',
                    'visible' => 'manager',
                    'fandom_id' => $fandom->id
                ]
            ]);
            $cover_name = 'fandom/' . $slug . "/" . $this->cover->hashName();
            $this->cover->storeAs('covers', $cover_name, 'public');
            $avatar_name = 'fandom/' . $slug . "/" . $this->avatar->hashName();
            $this->avatar->storeAs('avatars', $avatar_name, 'public');
            $image_cover = new Image(['url' => $cover_name]);
            $image_avatar = new Image(['url' => $avatar_name]);
            $cover = $fandom->cover()->create([]);
            $avatar = $fandom->avatar()->create([]);
            $cover->image()->save($image_cover);
            $avatar->image()->save($image_avatar);
            $result = true;
            return $fandom;
        }, 10);
        if ($result) {
            $user = User::find(Auth::id());
            $fandom->logs()->create([
                'message' => 'Created by ' . $user->username
            ]);
            $user->logs()->create([
                'message' => 'You create a fandom with name: ' . $fandom->name
            ]);
            $this->reset(['avatar','cover','name','description']);
            $this->dispatch('alert','success','New fandom created')->to(Alert::class);
            FandomCreated::dispatch($fandom);
            UserJoined::dispatch($fandom, Auth::user());
            NewFandomLog::dispatch($fandom);
            NewUserLog::dispatch($user);
        } else {
            $this->dispatch('alert', 'error', 'Error, fandom not created');
        }
    }
}
