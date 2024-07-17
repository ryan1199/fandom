<div class="h-fit grid grid-cols-1 gap-1 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500">
    @forelse ($chats as $chat)
        @livewire(ChatDetails::class, ['chat' => $chat->id, 'preferences' => $preferences], key('chat' . $chat->id))
    @empty
        <p>No chats</p>
    @endforelse
</div>