<div class="w-screen h-screen mx-auto p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-[' . $preferences['color_text'] . ']' }} relative z-0 overflow-x-clip overflow-y-auto">
    <div class="sticky top-0 z-10 select-none">
        <x-nav :preferences="$preferences" />
    </div>
    <div class="fixed mx-auto inset-x-4 top-20 z-10 select-none">
        <livewire:alert :preferences="$preferences" />
    </div>
    <div class="w-full h-fit mx-auto">
        <div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']/10' }} backdrop-blur-sm border-0 rounded-lg">
            <div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 rounded-lg">
                <div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg overflow-clip">
                    <div class="w-full sm:w-11/12 md:w-10/12 lg:w-8/12 mx-auto">
                        <div class="container prose prose-base prose-p:text-justify prose-img:mx-auto prose-img:w-[20vw] prose-img:h-[10vh] sm:prose-img:h-[15vh] md:prose-img:h-[20vh] lg:prose-img:h-[25vh] xl:prose-img:h-[30vh] prose-img:inline-block prose-img:object-cover prose-img:object-center prose-img:rounded-lg">
                            {!! $post->body !!}
                            {{-- comment --}}
                            {{-- <div>
                                
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>