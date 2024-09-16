<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UsersLog extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $user;
    public $preferences = [];
    public function render()
    {
        $logs = $this->user->logs()->orderBy('created_at', 'desc')->simplePaginate(5, pageName: 'logs-page');
        return view('livewire.users-log', [
            'logs' => $logs,
        ]);
    }
    public function mount(User $user, $preferences)
    {
        $this->user = $user;
        $this->preferences = $preferences;
    }
    public function getListeners()
    {
        return [
            "echo-private:UsersLog.{$this->user->id},NewUserLog" => 'loadLog',
        ];
    }
    public function loadLog($event)
    {
        $this->user = User::with('logs')->find($event['user']['id']);
    }
}
