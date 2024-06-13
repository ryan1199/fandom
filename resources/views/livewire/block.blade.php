<div class="p-2 {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 rounded-lg">
    <div class="p-2 grid grid-cols-1 gap-1 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
        <h1 class="{{ 'text-[' . $preferences['color_text'] . ']' }} text-center {{'text-[calc(4px+' . $preferences['font_size'] . 'px)]' }} font-semibold select-none">Blocking</h1>
        <div class="h-fit grid grid-cols-1 gap-1">
            @foreach ($blocked_users as $blocked_user)
                <div class="w-full h-fit p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                    <div class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center select-none">
                        <img src="{{ asset('storage/avatars/'.$blocked_user->avatar->image->url) }}" alt="{{ $blocked_user->username }}" title="{{ $blocked_user->username }}" class="aspect-square w-auto h-[7vh] bg-black border-0 rounded-full object-cover" draggable="false">
                        <div class="w-full h-fit flex flex-col space-x-0 space-y-0">
                            <p class="font-bold">{{ $blocked_user->username }}</p>
                            <livewire:block-unblock-button :user1="Auth::user()" :user2="$blocked_user" :$preferences :key="rand()" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>