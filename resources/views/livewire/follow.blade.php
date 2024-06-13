<div class="p-2 {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 rounded-lg">
    <div class="p-2 grid grid-cols-1 gap-1 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
        <h1 class="{{ 'text-[' . $preferences['color_text'] . ']' }} text-center {{'text-[calc(4px+' . $preferences['font_size'] . 'px)]' }} font-semibold select-none">Following</h1>
        <div class="h-fit grid grid-cols-1 gap-1">
            @foreach ($followed_users as $followed_user)
                <div class="w-full h-fit p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                    <div class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center select-none">
                        <img src="{{ asset('storage/avatars/'.$followed_user->avatar->image->url) }}" alt="{{ $followed_user->username }}" title="{{ $followed_user->username }}" class="aspect-square w-auto h-[7vh] bg-black border-0 rounded-full object-cover" draggable="false">
                        <div class="w-full h-fit flex flex-col space-x-0 space-y-0">
                            <p class="font-bold">{{ $followed_user->username }}</p>
                            <div x-data="{ open_chat: false }" class="w-full h-fit flex flex-col space-x-0 space-y-2">
                                <div class="w-fit h-fit flex flex-row space-x-2 space-y-0 select-none">
                                    <livewire:follow-unfollow-button :user1="Auth::user()" :user2="$followed_user" :$preferences :key="rand()" />
                                    <div x-on:click="open_chat = ! open_chat" class="w-fit h-full p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg cursor-pointer">Chat</div>
                                </div>
                                <div x-cloak x-show="open_chat">
                                    <livewire:chat-form :user1="Auth::user()" :user2="$followed_user" :$preferences />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>