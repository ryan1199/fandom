<div x-data="{ open_chat: @entangle('open_chat').live }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
    <div x-on:click="open_chat = ! open_chat"  class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center select-none">
        <img src="{{ asset('storage/avatars/'.$user->avatar->image->url) }}" alt="{{ $user->username }}" title="{{ $user->username }}" class="aspect-square w-auto h-[7vh] bg-black border-0 rounded-full object-cover" draggable="false">
        <div class="flex flex-col space-x-0 space-y-0">
            <p class="font-bold">{{ $user->username }}</p>
            <div x-cloak x-show="!open_chat" class="font-thin line-clamp-1 prose">
                {!! $chat->messages->last()->text !!}
            </div>
        </div>
    </div>
    <div x-cloak x-show="open_chat" class="w-full h-fit flex flex-col space-x-0 space-y-1 relative">
        <div class="w-full h-fit max-h-[calc(30vh)] flex flex-col-reverse space-x-0 space-y-1 space-y-reverse overflow-x-clip overflow-y-auto">
            @foreach ($messages as $message)
                @if ($message->user->id == Auth::id())
                    <div class="w-2/3 h-fit p-1 self-end border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                        <p>{{ $message->user->username }}</p>
                        <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                        <div class="prose prose-sm w-full h-fit">
                            {!! $message->text !!}
                        </div>
                    </div>
                @else
                    <div class="w-2/3 h-fit p-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                        <p>{{ $message->user->username }}</p>
                        <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                        <div class="prose prose-sm w-full h-fit">
                            {!! $message->text !!}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="sticky bottom-0">
            <livewire:chat-form :user1="Auth::user()" :user2="$user" :$preferences />
        </div>
    </div>
</div>