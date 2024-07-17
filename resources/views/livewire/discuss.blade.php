<div class="h-fit grid grid-cols-1 gap-1 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500">
    @forelse ($discuss_ids as $discuss_id)
        @livewire(DiscussDetails::class, ['discuss' => $discuss_id, 'preferences' => $preferences], key($from . '-discuss-' . $discuss_id))
    @empty
        <p>No discusss</p>
    @endforelse
</div>