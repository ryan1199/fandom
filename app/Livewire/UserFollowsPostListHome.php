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

class UserFollowsPostListHome extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $preferences = [];
    public function render()
    {
        $user = User::with(['follows'])->find(Auth::id());
        $user_ids = $user->follows->pluck('id');
        $user_publishes = Publish::has('post')->where('publishable_type', 'APP\Models\User')->whereIn('publishable_id', $user_ids)->whereIn('visible', ['friend', 'public'])->latest()->get();
        $user_publish_ids = $user_publishes->unique('publishable_id')->pluck('id')->toArray();
        $user_posts = Post::whereHas('publish', function (Builder $query) use ($user_publish_ids) {
            $query->whereIn('id',$user_publish_ids);
        })->get();
        $posts = $user_posts;
        $posts = Post::latest()->whereIn('publish_id', $posts->pluck('publish.id'))->simplePaginate(6, pageName: 'posts-page');
        return view('livewire.user-follows-post-list-home', [
            'posts' => $posts,
        ]);
    }
    public function mount($preferences)
    {
        $this->preferences = $preferences;
    }
}
