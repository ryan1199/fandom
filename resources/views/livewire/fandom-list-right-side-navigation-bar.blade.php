<div class="flex flex-col space-x-0 space-y-1">
    @livewire(Discuss::class, ['discuss_ids' => $discusses->pluck('id'), 'preferences' => $preferences, 'from' => 'user-' . $user->id . '-fandom-' . $fandom->id . '-fandom-list-right-side-navigation-bar'], key('user-' . $user->id . '-fandom-' . $fandom->id . "-fandom-list-right-side-navigation-bar"))
</div>