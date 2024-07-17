<div class="flex flex-col space-x-0 space-y-1">
    @forelse ($blocked_users as $blocked_user)
        <div wire:key="{{ 'block-user' . $blocked_user->id }}" class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center select-none">
            @if ($blocked_user->avatar !== null)
                <img src="{{ asset('storage/avatars/'.$blocked_user->avatar->image->url) }}" alt="{{ $blocked_user->username }}" title="{{ $blocked_user->username }}" class="aspect-square w-auto h-[3vh] bg-black border-0 rounded-full object-cover" draggable="false">
            @else
                <div class="aspect-square w-auto h-[3vh] bg-black border-0 rounded-full object-cover"></div>
            @endif
            <div class="w-full h-fit flex flex-row justify-between items-center">
                <a href="{{ route('user', $blocked_user) }}" class="w-fit font-bold" draggable="false">{{ $blocked_user->username }}</a>
                @livewire(BlockUnblockButton::class, ['user1' => Auth::user(), 'user2' => $blocked_user, 'preferences' => $preferences], key('block-user' . $blocked_user->id))
            </div>
        </div>
        <hr>
    @empty
        <p>No blocked users</p>
        <hr>
    @endforelse
</div>