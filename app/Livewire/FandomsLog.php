<?php

namespace App\Livewire;

use App\Models\Fandom;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FandomsLog extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $fandom;
    public $preferences = [];
    public function render()
    {
        $logs = $this->fandom->logs()->orderBy('created_at', 'desc')->simplePaginate(5, pageName: 'logs-page');
        return view('livewire.fandoms-log', [
            'logs' => $logs,
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
            "echo-private:FandomsLog.{$this->fandom->id},NewFandomLog" => 'loadLog',
        ];
    }
    public function loadLog($event)
    {
        $this->fandom = Fandom::with('logs')->find($event['fandom']['id']);
    }
}
