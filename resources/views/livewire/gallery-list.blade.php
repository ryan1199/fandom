<div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }}">
    <div class="w-full h-fit grid gap-2 grid-cols-3">
        @forelse ($galleries as $gallery)
            @if (class_basename($gallery->publish->publishable_type) === 'User')
                @livewire(UsersGalleryCard::class, ['gallery' => $gallery->id, 'user' => $gallery->publish->publishable->username, 'preferences' => $preferences], key('gallery-' . $gallery->id . '-from-gallery-page-' . rand()))
            @else
                @livewire(FandomsGalleryCard::class, ['gallery' => $gallery->id, 'fandom' => $gallery->publish->publishable->slug, 'preferences' => $preferences], key('gallery-' . $gallery->id . '-from-gallery-page-' . rand()))
            @endif
        @empty
            <div class="w-screen max-w-full h-full py-12 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    No galleries found
                </div>
            </div>
        @endforelse
    </div>
    @if ($galleries->hasPages())
        <div>{{ $galleries->links('vendor.livewire.simple-tailwind' ,['preferences' => $preferences]) }}</div>
    @endif
</div>
