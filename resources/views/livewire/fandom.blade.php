<div class="w-full max-w-[calc(100vw-24rem)] h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none overflow-clip">
    <div class="w-full h-screen max-h-[100vh] p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 grid-flow-row-dense auto-rows-max auto-cols-max gap-4 overflow-y-auto">
        @forelse ($fandoms as $fandom)
            @livewire(FandomList::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key('fandom-list-fandom-' . $fandom->id))
        @empty
            <div class="w-full h-fit p-4 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    No fandom has been created
                </div>
            </div>
        @endforelse
    </div>
</div>