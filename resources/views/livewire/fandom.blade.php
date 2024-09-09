<div class="w-full h-screen max-h-[100vh] pb-14 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none overflow-clip">
    <div class="w-full container h-screen max-h-[100vh] mx-auto flex flex-col space-x-0 space-y-4 overflow-y-auto">
        <div class="w-full h-fit mt-14 p-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 grid-flow-row-dense auto-rows-max auto-cols-max gap-4">
            @forelse ($fandoms as $fandom)
                @livewire(FandomCard::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key('fandom-list-fandom-' . $fandom->id . '-' . rand()))
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
</div>