<div class="w-full max-w-full h-fit flex flex-row space-x-2 space-y-0 overflow-clip overflow-x-auto">
    @foreach ($members as $member)
        @livewire(UsersFandomCard::class, ['member' => $member->id, 'fandom' => $member->fandom->slug, 'preferences' => $preferences], key('user-' . $user->id . '-fandom-list-fandom-' . $member->fandom->id . '-' . rand()))
    @endforeach
</div>