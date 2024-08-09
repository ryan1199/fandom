<div class="w-full h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-500' }} {{ 'bg-' . $preferences['color_2'] . '-50' }} select-none overflow-clip">
    <div class="w-full h-fit flex flex-col lg:flex-row space-x-0 space-y-2 lg:space-x-0 lg:space-y-0">
        <div class="w-full lg:max-w-screen-sm h-fit max-h-[25vh] lg:max-h-[100vh] p-2 pb-0 lg:pb-2 pr-2 lg:pr-1 overflow-y-auto">
            <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 text-left {{ 'bg-' . $preferences['color_2'] . '-100' }} rounded-lg">
                <div class="w-full h-fit flex flex-row justify-between items-center">
                    <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                          Post List
                        </span>
                    </div>
                    <svg wire:click="createPost" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                    </svg>
                </div>
                @livewire(PostSearch::class, ['preferences' => $preferences, 'from' => 'user'])
                @livewire(PostList::class, ['preferences' => $preferences, 'from' => 'post'])
            </div>
        </div>
        @livewire(PostCreateEdit::class, ['preferences' => $preferences])
    </div>
</div>