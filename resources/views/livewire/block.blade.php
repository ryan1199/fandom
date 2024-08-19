<div class="flex flex-col space-x-0 space-y-2">
    @forelse ($blocked_users as $blocked_user)
        <div wire:key="{{ 'user-' . $user->id . '-block-user-' . $blocked_user->id }}" class="w-full h-fit p-2 flex flex-row space-x-2 space-y-0 items-start {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none">
            <div class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center self-center">
                @if ($blocked_user->avatar !== null)
                    <img src="{{ asset('storage/avatars/'.$blocked_user->avatar->image->url) }}" alt="{{ $blocked_user->username }}" title="{{ $blocked_user->username }}" class="aspect-square w-auto h-[3vh] rounded-full object-cover" draggable="false">
                @else
                    <div class="aspect-square w-auto h-[3vh] bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} rounded-full object-cover"></div>
                @endif
                <a href="{{ route('user', $blocked_user) }}" class="w-fit font-bold line-clamp-3" draggable="false">{{ $blocked_user->username }}</a>
            </div>
            @livewire(BlockUnblockButton::class, ['user1' => Auth::user()->username, 'user2' => $blocked_user->username, 'preferences' => $preferences], key('user-' . $user->id . '-block-unblock-button-for-user-' . $blocked_user->id))
        </div>
    @empty
        <div class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none">
            <p>No blocked users</p>
        </div>
    @endforelse
</div>