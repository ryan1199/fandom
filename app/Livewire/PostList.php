<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class PostList extends Component
{
    public $posts = [];
    public $preferences = [];
    public function render()
    {
        return view('livewire.post-list');
    }
    public function mount()
    {
        $this->posts = Post::all();
    }
    #[On('search')]
    public function search($query)
    {
        $search = $query['search'];
        $sort_by = $query['sort_by'];
        $sort = $query['sort'];
        $search_array = str_split($search);
        $search = '';
        foreach($search_array as $s){$search = $search . $s . '%';}
        $search = '%' . $search;
        if($sort_by == 'Published')
        {
            $sort_by = 'created_at';
        } if ($sort_by == 'Views') {
            $sort_by = 'view';
        } else {
            $sort_by = 'created_at';
        }
        if($sort == 'ASC')
        {
            $sort = 'ASC';
        } if ($sort == 'DESC') {
            $sort = 'DESC';
        } else {
            $sort = 'ASC';
        }
        $this->posts = Post::where('title', 'like', $search)->orderBy($sort_by, $sort)->get();
    }
}
