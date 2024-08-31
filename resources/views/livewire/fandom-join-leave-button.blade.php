<div class="relative">
    <svg x-on:click="open_leave_join_button = ! open_leave_join_button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 bg-inherit {{ 'text-' . $preferences['color_2'] . '-100' }} border {{ 'border-' . $preferences['color_2'] . '-100' }} rounded-full">
        <path fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" clip-rule="evenodd" />
    </svg>
    @if (in_array(Auth::id(), $members))
        <div wire:click="leave" wire:confirm="Are you sure you want to leave this fandom?" x-cloak x-show="open_leave_join_button" class="absolute -top-1 -right-[72px] w-fit h-fit mx-auto px-2 py-1 bg-inherit border {{ 'border-' . $preferences['color_2'] . '-100' }} rounded-full select-none cursor-pointer">Leave</div>
    @else
        <div wire:click="join" wire:confirm="Are you sure you want to join this fandom?" x-cloak x-show="open_leave_join_button" class="absolute -top-1 -right-[72px] w-fit h-fit mx-auto px-2 py-1 bg-inherit border {{ 'border-' . $preferences['color_2'] . '-100' }} rounded-full select-none cursor-pointer">Join</div>
    @endif
</div>