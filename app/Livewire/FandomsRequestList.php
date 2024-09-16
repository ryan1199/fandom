<?php

namespace App\Livewire;

use App\Models\Fandom;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FandomsRequestList extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[Locked]
    public $fandom;
    public $preferences = [];
    public function render()
    {
        $open_requests = $this->fandom->requests()->where('status', 'open')->latest()->simplePaginate(5, pageName: 'open-requests-page');
        $close_requests = $this->fandom->requests()->where('status', 'close')->latest()->simplePaginate(5, pageName: 'close-requests-page');
        return view('livewire.fandoms-request-list', [
            'open_requests' => $open_requests,
            'close_requests' => $close_requests,
        ]);
    }
    public function mount(Fandom $fandom, $preferences)
    {
        $this->fandom = $fandom;
        $this->preferences = $preferences;
    }
    public function getListeners()
    {
        return [
            "echo-private:FandomsRequestList.{$this->fandom->id},RequestClosed" => 'loadRequests',
            "echo:FandomsRequestList.{$this->fandom->id},RequestClosed" => 'loadRequests',
            "echo-private:FandomsRequestList.{$this->fandom->id},RequestOpened" => 'loadRequests',
            "echo:FandomsRequestList.{$this->fandom->id},RequestOpened" => 'loadRequests',
        ];
    }
    public function loadRequests($event)
    {
        $this->fandom = Fandom::find($event['fandom']['id']);
    }
}
