<?php

namespace App\Livewire;

use App\Models\Fandom;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FandomsRequestList extends Component
{
    #[Locked]
    public $fandom;
    public $preferences = [];
    public function render()
    {
        $requests = $this->fandom->requests()->latest()->get();
        $open_requests = $requests->where('status', 'open')->all();
        $close_requests = $requests->where('status', 'close')->all();
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
