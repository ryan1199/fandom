<?php

namespace App\Livewire;

use App\Models\Fandom as ModelsFandom;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Title('Fandom List')]
class Fandom extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $preferences = [];
    public $query = [];
    public function render()
    {
        $name = $this->query['name'];
        $sort_by = $this->query['sort_by'];
        $sort = $this->query['sort'];
        $limit = $this->query['limit'];
        $name_array = str_split($name);
        $name = '';
        foreach ($name_array as $s) {
            $name = $name . $s . '%';
        }
        $name = '%' . $name;
        switch ($sort_by) {
            case 'Name':
                $sort_by = 'name';
                break;
            default:
                $sort_by = 'created_at';
        }
        $sort = ($sort == 'ASC') ? 'ASC' : 'DESC';
        $limit = ($limit > 0) ? $limit : 5;
        
        $fandoms = ModelsFandom::where('name', 'like', $name)->orderBy($sort_by, $sort)->simplePaginate($limit, pageName: 'fandoms-page');
        return view('livewire.fandom', [
            'fandoms' => $fandoms,
        ]);
    }
    public function mount()
    {
        if (Auth::check()) {
            if (session()->has('preference-' . Auth::user()->username)) {
                $this->preferences = session()->get('preference-' . Auth::user()->username);
            } else {
                $this->preferences = [
                    'color_1' => 'pink',
                    'color_2' => 'rose',
                    'color_3' => 'red',
                    'font_size' => 16,
                    'selected_font_family' => 'mono',
                    'dark_mode' => false,
                ];
                session()->put('preference-' . Auth::user()->username, $this->preferences);
            }
        } else {
            $this->preferences = [
                'color_1' => 'pink',
                'color_2' => 'rose',
                'color_3' => 'red',
                'font_size' => 16,
                'selected_font_family' => 'mono',
                'dark_mode' => false,
            ];
        }
        $this->query['name'] = '';
        $this->query['sort_by'] = 'Name';
        $this->query['sort'] = 'DESC';
        $this->query['limit'] = 12;
    }
    #[On('search')]
    public function search($query)
    {
        $this->query = $query;
        $this->resetPage('fandoms-page');
    }
    public function updated($property)
    {
        if (Auth::check()) {
            session()->put('last-active-' . Auth::user()->username, now());
        }
    }
}
