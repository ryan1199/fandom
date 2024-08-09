<div class="flex flex-col space-x-0 space-y-1">
    @livewire(Discuss::class, ['discuss_ids' => $discusses->pluck('id'), 'preferences' => $preferences, 'from' => 'fandom-list-right-side-navigation-bar'], key("fandom-list-right-side-navigation-bar"))
</div>