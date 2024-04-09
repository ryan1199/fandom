<div
    class="w-screen h-screen max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center relative z-0">
    <livewire:alert />
    <div class="w-full h-fit max-h-[calc(100%-48px)] flex flex-col 2xl:flex-row space-x-4 space-y-0">
        <div
            class="w-full h-fit p-4 bg-[{{ $preferences['color_primary'] }}]/10 backdrop-blur-sm border-0 border-transparent rounded-lg">
            <div
                class="w-full h-fit p-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg overflow-clip">
                <div wire:scroll
                    class="w-full h-hit max-h-[calc(100vh-160px)] p-2 flex flex-col space-x-0 space-y-2 overflow-y-auto overflow-x-clip text-[{{ $preferences['color_text'] }}] text-left bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-lg">
                    <div class="w-full h-fit flex flex-row justify-between items-center">
                        <div>Image List</div>
                        <svg wire:click="createGallery" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <livewire:gallery-search :preferences="$preferences" from="user" />
                    <livewire:gallery-list :preferences="$preferences" from="gallery" />
                </div>
            </div>
        </div>
        <div
            class="w-full h-fit max-w-screen-sm p-4 bg-[{{ $preferences['color_primary'] }}]/10 backdrop-blur-sm border-0 border-transparent rounded-lg">
            <div
                class="w-full h-fit p-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg overflow-clip">
                <livewire:gallery-create-edit :preferences="$preferences" />
            </div>
        </div>
    </div>
    <x-nav :preferences="$preferences" />
</div>