<div class="w-screen h-screen max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center relative z-0">
    <livewire:alert/>
    @auth
        <div class="container h-fit max-h-[calc(100%-48px)] overflow-clip">
            <div class="w-full h-fit p-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] opacity-90 backdrop-blur-sm border-0 border-transparent rounded-lg">
                <div wire:scroll class="w-full h-screen max-h-[calc(100vh-96px)] pr-1 grid grid-cols-3 grid-flow-row-dense gap-2 overflow-y-scroll overflow-x-clip">
                    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] border-0 border-transparent rounded-lg">
                        <div class="bg-gradient-to-tr from-[{{ session()->get(Auth::user()->username . '-preference')['color_1'] }}] via-[{{ session()->get(Auth::user()->username . '-preference')['color_2'] }}] to-[{{ session()->get(Auth::user()->username . '-preference')['color_3'] }}]">
                            <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-full max-h-[30vh] object-cover block">
                        </div>
                        <div class="w-full h-hit p-2 text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-center bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-black rounded-lg">
                            <h1>Home page</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ipsam excepturi perferendis libero. Explicabo quaerat vel placeat quos neque vero voluptatem maxime illum rem necessitatibus reprehenderit, deserunt est voluptatum perspiciatis?</p>
                        </div>
                    </div>
                    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] border-0 border-transparent rounded-lg">
                        <div class="bg-gradient-to-tr from-[{{ session()->get(Auth::user()->username . '-preference')['color_1'] }}] via-[{{ session()->get(Auth::user()->username . '-preference')['color_2'] }}] to-[{{ session()->get(Auth::user()->username . '-preference')['color_3'] }}]">
                            <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-full max-h-[30vh] object-cover block">
                        </div>
                        <div class="w-full h-hit p-2 text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-center bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-black rounded-lg">
                            <h1>Home page</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ipsam excepturi perferendis libero. Explicabo quaerat vel placeat quos neque vero voluptatem maxime illum rem necessitatibus reprehenderit, deserunt est voluptatum perspiciatis?</p>
                        </div>
                    </div>
                    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] border-0 border-transparent rounded-lg">
                        <div class="bg-gradient-to-tr from-[{{ session()->get(Auth::user()->username . '-preference')['color_1'] }}] via-[{{ session()->get(Auth::user()->username . '-preference')['color_2'] }}] to-[{{ session()->get(Auth::user()->username . '-preference')['color_3'] }}]">
                            <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-full max-h-[30vh] object-cover block">
                        </div>
                        <div class="w-full h-hit p-2 text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-center bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-black rounded-lg">
                            <h1>Home page</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ipsam excepturi perferendis libero. Explicabo quaerat vel placeat quos neque vero voluptatem maxime illum rem necessitatibus reprehenderit, deserunt est voluptatum perspiciatis?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
    @guest
        <div class="container h-fit max-h-[calc(100%-48px)] overflow-clip">
            <div class="w-full h-fit p-2 bg-gray-50/90 backdrop-blur-sm border-0 border-transparent rounded-lg">
                <div wire:scroll class="w-full h-screen max-h-[calc(100vh-96px)] pr-1 grid grid-cols-3 grid-flow-row-dense gap-2 overflow-y-scroll overflow-x-clip">
                    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-black border-0 border-transparent rounded-lg">
                        <div class="bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500">
                            <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-full max-h-[30vh] object-cover block">
                        </div>
                        <div class="w-full h-hit p-2 text-black text-center bg-white border border-black rounded-lg">
                            <h1>Home page</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ipsam excepturi perferendis libero. Explicabo quaerat vel placeat quos neque vero voluptatem maxime illum rem necessitatibus reprehenderit, deserunt est voluptatum perspiciatis?</p>
                        </div>
                    </div>
                    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-black border-0 border-transparent rounded-lg">
                        <div class="bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500">
                            <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-full max-h-[30vh] object-cover block">
                        </div>
                        <div class="w-full h-hit p-2 text-black text-center bg-white border border-black rounded-lg">
                            <h1>Home page</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ipsam excepturi perferendis libero. Explicabo quaerat vel placeat quos neque vero voluptatem maxime illum rem necessitatibus reprehenderit, deserunt est voluptatum perspiciatis?</p>
                        </div>
                    </div>
                    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-black border-0 border-transparent rounded-lg">
                        <div class="bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500">
                            <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-full max-h-[30vh] object-cover block">
                        </div>
                        <div class="w-full h-hit p-2 text-black text-center bg-white border border-black rounded-lg">
                            <h1>Home page</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ipsam excepturi perferendis libero. Explicabo quaerat vel placeat quos neque vero voluptatem maxime illum rem necessitatibus reprehenderit, deserunt est voluptatum perspiciatis?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
    <x-nav/>
</div>