<div class="w-screen h-screen p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-[' . $preferences['color_text'] . ']' }} relative z-0 overflow-x-clip overflow-y-auto">
    <div class="sticky top-0 z-10 select-none">
        <x-nav :preferences="$preferences" />
    </div>
    <div class="fixed mx-auto inset-x-4 top-20 z-10 select-none">
        <livewire:alert :preferences="$preferences" />
    </div>
    <div class="w-full h-fit flex flex-col lg:flex-row space-x-0 space-y-2 lg:space-x-2 lg:space-y-0 relative">
        <div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']/10' }} backdrop-blur-sm border-0 rounded-lg">
            <div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 rounded-lg">
                <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['color_text'] . ']' }} text-left {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
                    <div class="w-full h-fit flex flex-row justify-between items-center">
                        <div class="font-semibold">Image List</div>
                        <svg wire:click="createGallery" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <livewire:gallery-search :preferences="$preferences" from="user" />
                    <div class="max-h-[25vh] lg:max-h-full overflow-y-auto">
                        <livewire:gallery-list :preferences="$preferences" from="gallery" />
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky top-0 w-full h-fit max-w-screen-lg p-2 {{ 'bg-[' . $preferences['color_primary'] . ']/10' }} backdrop-blur-sm border-0 rounded-lg">
            <div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 rounded-lg">
                <livewire:gallery-create-edit :preferences="$preferences" />
            </div>
        </div>
    </div>
</div>
