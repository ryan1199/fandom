<?php

namespace App\Livewire;

use App\Events\RequestClosed;
use App\Events\RequestVoted;
use App\Models\Request;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FandomsRequestCard extends Component
{
    #[Locked]
    public $request;
    #[Locked]
    public $fandom;
    public $preferences = [];
    public function render()
    {
        $request_by = $this->request->user->username;
        $total_members = $this->fandom->members->count();
        $voted = $this->request->votes()->where('user_id', Auth::id())->first();
        $voted_yes = $this->request->votes()->where('agree', true)->count();
        $voted_no = $this->request->votes()->where('disagree', true)->count();
        $unvoted = $total_members - ($voted_yes + $voted_no);
        $voted_yes_percentage = ($voted_yes / $total_members) * 100;
        $voted_no_percentage = ($voted_no / $total_members) * 100;
        $unvoted_percentage = ($unvoted / $total_members) * 100;
        return view('livewire.fandoms-request-card', [
            'request_by' => $request_by,
            'voted' => $voted,
            'voted_yes' => $voted_yes,
            'voted_no' => $voted_no,
            'unvoted' => $unvoted,
            'voted_yes_percentage' => $voted_yes_percentage,
            'voted_no_percentage' => $voted_no_percentage,
            'unvoted_percentage' => $unvoted_percentage,
        ]);
    }
    public function mount(Request $request, $preferences)
    {
        $this->request = $request;
        $this->fandom = $request->fandom;
        $this->preferences = $preferences;
    }
    public function voteYes()
    {
        $this->authorize('create', [Vote::class, $this->request]);
        if ($this->request->status == 'open') {
            $this->request->votes()->updateOrCreate(['user_id' => Auth::id()], ['agree' => true, 'disagree' => false]);
            RequestVoted::dispatch($this->request);
            $this->dispatch('alert', 'success', 'Done, you vote yes');
            $this->checkRequeststatus();
        } else {
            $this->dispatch('alert', 'error', 'Error, this request is closed');
        }
    }
    public function voteNo()
    {
        $this->authorize('create', [Vote::class, $this->request]);
        if ($this->request->status == 'open') {
            $this->request->votes()->updateOrCreate(['user_id' => Auth::id()], ['disagree' => true, 'agree' => false]);
            RequestVoted::dispatch($this->request);
            $this->dispatch('alert', 'success', 'Done, you vote no');
            $this->checkRequeststatus();
        } else {
            $this->dispatch('alert', 'error', 'Error, this request is closed');
        }
    }
    public function checkRequeststatus()
    {
        if ($this->request->votes->count() == $this->fandom->members->count()) {
            $this->request->update(['status' => 'close']);
            RequestClosed::dispatch($this->fandom);
        }
    }
    public function getListeners()
    {
        return [
            "echo-private:FandomsRequestCard.{$this->request->id},RequestVoted" => 'loadRequest',
            "echo:FandomsRequestCard.{$this->request->id},RequestVoted" => 'loadRequest',
        ];
    }
    public function loadRequest($event)
    {
        $this->request = Request::find($event['request']['id']);
    }
}
