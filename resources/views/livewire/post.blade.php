<div class="w-full h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none overflow-y-auto">
    <div class="w-full container h-fit mx-auto mt-14 px-4 sm:px-4 py-8 flex flex-col space-x-0 space-y-8">
        <div class="w-full max-w-xl h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
            @livewire(PostSearch::class, ['preferences' => $preferences], key('post-search-for-post'))
        </div>
        <div class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
            @livewire(PostList::class, ['preferences' => $preferences], key('post-list-for-post'))
        </div>
    </div>
</div>