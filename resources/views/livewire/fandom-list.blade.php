<div class="w-full h-fit flex flex-col space-x-0 space-y-4">
    <div class="w-full max-w-full h-fit grid grid-cols-3 gap-4">
        @forelse ($fandoms as $fandom)
            @livewire(FandomCard::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key('public-fandom-card-for-fandom-' . $fandom->id . '-' . rand()))
        @empty
            <div class="w-screen max-w-full h-screen max-h-40 p-4 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    No fandoms found
                </div>
            </div>
        @endforelse
    </div>
    @if ($fandoms->hasPages())
        <div>{{ $fandoms->links('vendor.livewire.simple-tailwind' ,['preferences' => $preferences]) }}</div>
    @endif
</div>