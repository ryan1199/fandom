<div class="w-full h-screen max-h-[100vh] pb-14 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none overflow-y-auto">
    <div class="w-full container h-fit mx-auto mt-14 p-2 flex flex-col space-x-0 space-y-4">
        <div class="w-full max-w-xl h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
            @livewire(GallerySearch::class, ['preferences' => $preferences], key('gallery-search-for-gallery'))
        </div>
        <div class="w-fit h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
            @livewire(GalleryList::class, ['preferences' => $preferences], key('gallery-list-for-gallery'))
        </div>
    </div>
</div>