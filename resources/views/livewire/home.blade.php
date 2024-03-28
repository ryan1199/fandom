<div
    class="w-screen h-screen max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center relative z-0">
    <livewire:alert />
    <div class="container h-fit max-h-[calc(100%-48px)] overflow-clip">
        <div
            class="w-full h-fit p-2 bg-[{{ $preferences['color_primary'] }}]/90 backdrop-blur-sm border-0 border-transparent rounded-lg">
            <div wire:scroll
                class="w-full h-screen max-h-[calc(100vh-96px)] pr-1 grid grid-cols-3 grid-flow-row-dense gap-2 overflow-y-scroll overflow-x-clip">
                <div
                    class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg">
                    <div
                        class="bg-gradient-to-tr from-[{{ $preferences['color_1'] }}] via-[{{ $preferences['color_2'] }}] to-[{{ $preferences['color_3'] }}]">
                        <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image"
                            class="w-full h-full max-h-[30vh] object-cover block">
                    </div>
                    <div
                        class="w-full h-hit p-2 text-[{{ $preferences['color_text'] }}] text-center bg-[{{ $preferences['color_primary'] }}] border border-black rounded-lg">
                        <h1>Home page</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ipsam excepturi perferendis
                            libero. Explicabo quaerat vel placeat quos neque vero voluptatem maxime illum rem
                            necessitatibus reprehenderit, deserunt est voluptatum perspiciatis?</p>
                    </div>
                </div>
                <div
                    class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg">
                    <div
                        class="bg-gradient-to-tr from-[{{ $preferences['color_1'] }}] via-[{{ $preferences['color_2'] }}] to-[{{ $preferences['color_3'] }}]">
                        <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image"
                            class="w-full h-full max-h-[30vh] object-cover block">
                    </div>
                    <div
                        class="w-full h-hit p-2 text-[{{ $preferences['color_text'] }}] text-center bg-[{{ $preferences['color_primary'] }}] border border-black rounded-lg">
                        <h1>Home page</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ipsam excepturi perferendis
                            libero. Explicabo quaerat vel placeat quos neque vero voluptatem maxime illum rem
                            necessitatibus reprehenderit, deserunt est voluptatum perspiciatis?</p>
                    </div>
                </div>
                <div
                    class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg">
                    <div
                        class="bg-gradient-to-tr from-[{{ $preferences['color_1'] }}] via-[{{ $preferences['color_2'] }}] to-[{{ $preferences['color_3'] }}]">
                        <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image"
                            class="w-full h-full max-h-[30vh] object-cover block">
                    </div>
                    <div
                        class="w-full h-hit p-2 text-[{{ $preferences['color_text'] }}] text-center bg-[{{ $preferences['color_primary'] }}] border border-black rounded-lg">
                        <h1>Home page</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ipsam excepturi perferendis
                            libero. Explicabo quaerat vel placeat quos neque vero voluptatem maxime illum rem
                            necessitatibus reprehenderit, deserunt est voluptatum perspiciatis?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-nav :preferences="$preferences" />
</div>