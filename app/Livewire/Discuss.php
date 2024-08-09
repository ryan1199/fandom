<?php

namespace App\Livewire;

use App\Events\DeleteDiscussion;
use App\Events\NewDiscussionMessage;
use App\Events\ResetDiscussion;
use App\Models\Discuss as ModelsDiscuss;
use App\Models\Fandom;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Discuss extends Component
{
    #[Reactive]
    public $discuss_ids;
    public $preferences = [];
    public $from;
    public function render()
    {
        return view('livewire.discuss');
    }
    public function mount($discuss_ids, $preferences, $from)
    {
        $this->discuss_ids = $discuss_ids;
        $this->preferences = $preferences;
        $this->from = $from;
    }
}
