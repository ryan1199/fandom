<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Publish;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserFandomsPostListHome extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $preferences = [];
    public function render()
    {
        $user = User::with(['members.fandom'])->find(Auth::id());
        $fandom_ids = [];
        foreach ($user->members as $member) {
            $fandom_ids[] = $member->fandom->id;
        }
        $fandom_publishes = Publish::has('post')->where('publishable_type', 'APP\Models\Fandom')->whereIn('publishable_id', $fandom_ids)->whereIn('visible', ['member', 'public'])->latest()->get();
        $fandom_publish_ids = $fandom_publishes->unique('publishable_id')->pluck('id')->toArray();
        $fandom_posts = Post::whereHas('publish', function (Builder $query) use ($fandom_publish_ids) {
            $query->whereIn('id',$fandom_publish_ids);
        })->get();
        $posts = $fandom_posts;
        $posts = Post::latest()->whereIn('publish_id', $posts->pluck('publish.id'))->simplePaginate(6, pageName: 'posts-page');
        return view('livewire.user-fandoms-post-list-home', [
            'posts' => $posts,
        ]);
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
    }
}
