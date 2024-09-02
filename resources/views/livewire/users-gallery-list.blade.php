<div class="w-full h-fit grid gap-2 grid-cols-2">
    @forelse ($galleries as $gallery)
        @livewire(GalleryCard::class, ['gallery' => $gallery->id, 'preferences' => $preferences], key('gallery-' . $gallery->id . '-' . rand()))
    @empty
        <div class="w-screen max-w-full h-fit py-12 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
            <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                No galleries found
            </div>
        </div>
    @endforelse
</div>