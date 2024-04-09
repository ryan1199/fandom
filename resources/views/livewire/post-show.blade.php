<div
    class="w-screen h-screen max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center relative z-0">
    <livewire:alert />
    <div class="container h-fit max-h-[calc(100%-48px)] overflow-clip">
        <div
            class="container h-fit max-h-[calc(100vh-96px)] col-span-6 p-4 bg-[{{ $preferences['color_primary'] }}]/10 backdrop-blur-sm border-0 border-transparent rounded-lg overflow-clip">
            <div wire:scroll
                class="prose prose-base prose-img:mx-auto prose-img:max-w-sm container max-h-[calc(100vh-128px)] p-4 bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-lg overflow-y-auto">
                {!! $post->body !!}
                {{-- comment --}}
                {{-- <div>
                    
                </div> --}}
            </div>
        </div>
    </div>
    <x-nav :preferences="$preferences" />
</div>