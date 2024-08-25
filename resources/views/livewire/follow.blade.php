<div class="flex flex-col space-x-0 space-y-2">
    @forelse ($followed_users as $followed_user)
        <div wire:key="{{ 'user-' . $user->id . '-follow-user-' . $followed_user->id }}" class="w-full h-fit p-2 flex flex-row space-x-2 space-y-0 justify-between items-start {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none">
            <div class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center self-center">
                @if ($followed_user->avatar !== null)
                    <img src="{{ asset('storage/avatars/'.$followed_user->avatar->image->url) }}" alt="{{ $followed_user->username }}" title="{{ $followed_user->username }}" class="aspect-square w-auto h-[3vh] rounded-full object-cover" draggable="false">
                @else
                    <div class="w-auto h-[3vh] aspect-square bg-gradient-to-r {{ 'from-' . $preferences['color_2'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_2'] . '-900' }} rounded-full">
                        <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                    </div>
                @endif
                <a wire:navigate href="{{ route('user', $followed_user) }}" class="w-fit font-bold line-clamp-3" draggable="false">{{ $followed_user->username }}</a>
            </div>
            <div class="w-fit h-fit flex flex-row space-x-2 space-y-0 select-none">
                @livewire(FollowUnfollowButton::class, ['user1' => Auth::user()->username, 'user2' => $followed_user->username, 'preferences' => $preferences], key('user-' . $user->id . '-follow-unfollow-button-for-user-' . $followed_user->id))
                <div wire:click="$parent.chatTo({{ $followed_user->id }})" class="w-fit h-full p-2 font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">Chat</div>
            </div>
        </div>
    @empty
        <div class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none">
            <p>No followed users</p>
        </div>
    @endforelse
</div>