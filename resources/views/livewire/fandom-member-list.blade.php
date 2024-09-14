<div class="w-full h-fit flex flex-col space-x-0 space-y-4">
    {{-- manager --}}
    <div class="w-full h-fit p-1 flex flex-col space-x-0 space-y-1 border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
        <h3 class="text-center">Managers</h3>
        <hr class="{{ 'border-' . $preferences['color_2'] . '-200' }}">
        <div class="flex flex-row flex-wrap">
            @forelse ($managers as $manager)
                <a wire:key="{{ 'fandom-' . $fandom->id . '-user-manager-' . rand() }}" wire:navigate href="{{ route('user', $manager->user) }}" class="w-fit m-1 p-2 flex flex-row space-x-2 space-y-0 justify-start items-center {{ 'bg-' . $preferences['color_2'] . '-100' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} group {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" title="{{ $manager->user->username }}" draggable="false">
                    @if ($manager->user->avatar != null)
                        <img src="{{ asset('storage/avatars/' . $manager->user->avatar->image->url) }}" alt="{{ $manager->user->username }}" class="w-10 h-10 object-cover object-center rounded-full" draggable="false">
                    @else
                        <div class="w-10 h-auto aspect-square bg-gradient-to-r {{ 'from-' . $preferences['color_2'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_2'] . '-900' }} rounded-full">
                            <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                        </div>
                    @endif
                    <p class="font-semibold {{ 'group-hover:text-' . $preferences['color_2'] . '-500' }} animation">{{ $manager->user->username }}</p>
                </a>
            @empty
                This fandom has no managers
            @endforelse
        </div>
    </div>
    {{-- member --}}
    <div class="w-full h-fit p-1 flex flex-col space-x-0 space-y-1 border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
        <h3 class="text-center">Members</h3>
        <hr class="{{ 'border-' . $preferences['color_2'] . '-200' }}">
        <div class="flex flex-row flex-wrap">
            @forelse ($members as $member)
                <a wire:key="{{ 'fandom-' . $fandom->id . '-user-member-' . rand() }}" wire:navigate href="{{ route('user', $member->user) }}" class="w-fit m-1 p-2 flex flex-row space-x-2 space-y-0 justify-start items-center {{ 'bg-' . $preferences['color_2'] . '-100' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} group {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" title="{{ $member->user->username }}" draggable="false">
                    @if ($member->user->avatar != null)
                        <img src="{{ asset('storage/avatars/' . $member->user->avatar->image->url) }}" alt="{{ $member->user->username }}" class="w-10 h-10 object-cover object-center rounded-full" draggable="false">
                    @else
                        <div class="w-10 h-auto aspect-square bg-gradient-to-r {{ 'from-' . $preferences['color_2'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_2'] . '-900' }} rounded-full">
                            <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                        </div>
                    @endif
                    <p class="font-semibold {{ 'group-hover:text-' . $preferences['color_2'] . '-500' }} animation">{{ $member->user->username }}</p>
                </a>
            @empty
                <p>This fandom has no members</p>
            @endforelse
        </div>
    </div>
    {{-- ban --}}
    <div class="w-full h-fit p-1 flex flex-col space-x-0 space-y-1 border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
        <h3 class="text-center">Banned Users</h3>
        <hr class="{{ 'border-' . $preferences['color_2'] . '-200' }}">
        <div class="flex flex-row flex-wrap">
            @forelse ($bans as $ban)
                <a wire:key="{{ 'fandom-' . $fandom->id . '-user-member-' . rand() }}" wire:navigate href="{{ route('user', $ban->user) }}" class="w-fit m-1 p-2 flex flex-row space-x-2 space-y-0 justify-start items-center {{ 'bg-' . $preferences['color_2'] . '-100' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} group {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" title="{{ $ban->user->username }}" draggable="false">
                    @if ($ban->user->avatar != null)
                        <img src="{{ asset('storage/avatars/' . $ban->user->avatar->image->url) }}" alt="{{ $ban->user->username }}" class="w-10 h-10 object-cover object-center rounded-full" draggable="false">
                    @else
                        <div class="w-10 h-auto aspect-square bg-gradient-to-r {{ 'from-' . $preferences['color_2'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_2'] . '-900' }} rounded-full">
                            <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                        </div>
                    @endif
                    <p class="font-semibold {{ 'group-hover:text-' . $preferences['color_2'] . '-500' }} animation">{{ $ban->user->username }}</p>
                </a>
            @empty
                <p>This fandom has no banned users</p>
            @endforelse
        </div>
    </div>
</div>