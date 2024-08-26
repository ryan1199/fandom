<div class="w-full h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none overflow-clip">
    <div class="w-full h-fit max-h-[100vh] px-4 sm:px-4 py-8 flex flex-col space-x-0 space-y-8 overflow-y-auto">
        <div class="w-fit max-w-xl h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
            @livewire(GallerySearch::class, ['preferences' => $preferences], key('gallery-search-for-gallery'))
        </div>
        <div class="w-fit h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
            @livewire(GalleryList::class, ['preferences' => $preferences, 'from' => 'gallery'], key('gallery-list-for-gallery'))
        </div>
    </div>
</div>