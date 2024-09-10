<div class="w-full h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none overflow-clip">
    <div class="w-full container h-full mx-auto flex flex-col lg:flex-row space-x-0 space-y-2 lg:space-x-2 lg:space-y-0">
        <div class="w-full lg:max-w-screen-sm h-fit max-h-[30vh] lg:max-h-[100vh] lg:pb-14 p-2 overflow-y-auto">
            <div class="w-full h-fit mt-14 p-4 flex flex-col space-x-0 space-y-4 text-left {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="w-full h-fit flex flex-row justify-between items-center">
                    <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                            Gallery List
                        </span>
                    </div>
                    <svg wire:click="createGallery" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                    </svg>
                </div>
                @livewire(GalleryManagementsGallerySearch::class, ['preferences' => $preferences], key('gallery-search-for-user'))
                @livewire(GalleryManagementsGalleryList::class, ['preferences' => $preferences], key('gallery-list-for-user'))
            </div>
        </div>
        <div class="w-full h-fit max-h-[calc(100vh-30vh)] lg:max-h-[100vh] pb-14 p-2 overflow-y-auto">
            <div class="w-full h-fit lg:mt-14 p-4 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                @livewire(GalleryCreateEdit::class, ['preferences' => $preferences], key('gallery-create-edit-for-user'))
            </div>
        </div>
    </div>
</div>
