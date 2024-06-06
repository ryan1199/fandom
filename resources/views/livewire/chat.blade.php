<div class="p-2 {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 rounded-lg">
    <div class="p-2 grid grid-cols-1 gap-1 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
        <h1 class="{{ 'text-[' . $preferences['color_text'] . ']' }} text-center {{'text-[calc(4px+' . $preferences['font_size'] . 'px)]' }} font-semibold select-none">Chat</h1>
        <div class="h-fit grid grid-cols-1 gap-1">
            @foreach ($chats as $chat)
                <livewire:chat-details :$chat :$preferences :key="rand()"/>
            @endforeach
        </div>
    </div>
</div>