<div class="flex flex-col space-x-0 space-y-1">
    @forelse ($followed_users as $followed_user)
        <div wire:key="{{ 'follow-user' . $followed_user->id }}" class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center select-none">
            @if ($followed_user->avatar !== null)
                <img src="{{ asset('storage/avatars/'.$followed_user->avatar->image->url) }}" alt="{{ $followed_user->username }}" title="{{ $followed_user->username }}" class="aspect-square w-auto h-[3vh] bg-black border-0 rounded-full object-cover" draggable="false">
            @else
                <div class="aspect-square w-auto h-[3vh] bg-black border-0 rounded-full object-cover"></div>
            @endif
            <div class="w-full h-fit flex flex-row justify-between items-center">
                <a href="{{ route('user', $followed_user) }}" class="w-fit font-bold" draggable="false">{{ $followed_user->username }}</a>
                <div class="w-fit h-fit flex flex-row space-x-2 space-y-0 select-none">
                    @livewire(FollowUnfollowButton::class, ['user1' => Auth::user(), 'user2' => $followed_user, 'preferences' => $preferences], key('follow-user' . $followed_user->id))
                    <div wire:click="$parent.chatTo({{ $followed_user->id }})" class="w-fit h-full px-2 font-semibold {{ 'hover:text-[' . $preferences['color_2'] . ']' }} cursor-pointer animation-button">Chat</div>
                </div>
            </div>
        </div>
        <hr>
    @empty
        <p>No followed users</p>
        <hr>
    @endforelse
</div>