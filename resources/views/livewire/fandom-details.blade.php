<div class="w-screen h-screen max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center relative z-0">
    <livewire:alert/>
    <div class="container h-fit max-h-[calc(100%-48px)] overflow-clip">
        <div class="w-full h-fit p-2 grid grid-cols-12 grid-flow-row-dense auto-rows-max auto-cols-max gap-2 bg-white border-0 border-transparent rounded-lg">
            <div class="w-full h-fit max-h-[calc(100%-96px)] col-span-3 bg-black border-0 border-transparent rounded-lg overflow-clip">

            </div>
            <div class="w-full h-fit max-h-[calc(100%-96px)] col-span-6 p-2 bg-black border-0 border-transparent rounded-lg overflow-clip">
                <div wire:scroll class="w-full h-fit max-h-[calc(100%-96px)] border-0 border-transparent rounded-lg overflow-y-auto">
                    <div class="w-full h-fit flex flex-col space-x-0 space-y-2 bg-black border-0 border-transparent rounded-lg">
                        <div class="w-full h-full max-h-[calc(15vh-8px)] sm:max-h-[calc(30vh-8px)] relative rounded-lg overflow-clip">
                            <img src="{{ asset('storage/covers/'.$fandom->cover->image->url) }}" alt="Cover image {{ $fandom->name }}" title="Cover image {{ $fandom->name }}" class="w-full h-full object-cover block rounded-lg">
                            <img src="{{ asset('storage/avatars/'.$fandom->avatar->image->url) }}" alt="Avatar image {{ $fandom->name }}" title="Avatar image {{ $fandom->name }}" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-full max-h-[90%] aspect-square object-cover border-0 border-transparent rounded-full">
                        </div>
                        <div class="w-full h-fit p-2 bg-white border-0 border-transparent rounded-lg">
                            <h1 class="w-fit text-[{{ session()->get('preference-' . Auth::user()->username)['color_text'] }}] text-center text-[calc({{'4px+' . session()->get('preference-' . Auth::user()->username)['font_size'] . 'px' }})] font-semibold">{{ $fandom->name }}</h1>
                            <p class="text-[{{ session()->get('preference-' . Auth::user()->username)['color_text'] }}] text-[calc({{session()->get('preference-' . Auth::user()->username)['font_size'] . 'px'}})]">{{ $fandom->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full h-fit max-h-[calc(100%-96px)] col-span-3 bg-black border-0 border-transparent rounded-lg overflow-clip">

                <p class="text-black">{{ $time->diffForHumans() }}</p>
            </div>
        </div>
    </div>
    <x-nav :preferences="$preferences"/>
</div>