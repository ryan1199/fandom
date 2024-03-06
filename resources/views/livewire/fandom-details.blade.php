<div class="w-screen h-screen max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center relative z-0">
    <livewire:alert/>
    <div class="container h-fit max-h-[calc(100%-48px)] overflow-clip">
        <div class="w-full h-fit grid grid-cols-12 grid-flow-row-dense auto-rows-max auto-cols-max gap-4 order-0 border-transparent rounded-lg">
            <div class="w-full h-fit max-h-[calc(100%-48px)] col-span-3 bg-black border-0 border-transparent rounded-lg overflow-clip">

            </div>
            <div class="w-full h-fit max-h-[calc(100vh-96px)] col-span-6 p-4 bg-[{{ $preferences['color_primary'] }}]/10 backdrop-blur-sm border-0 border-transparent rounded-lg overflow-clip">
                <div wire:scroll class="w-full h-fit max-h-[calc(100vh-128px)] border-0 border-transparent rounded-lg overflow-y-auto">
                    <div x-data="{ tab: @entangle('tab').live }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-black border-0 border-transparent rounded-lg">
                        <div class="w-full h-fit relative rounded-lg overflow-clip">
                            <img src="{{ asset('storage/covers/'.$fandom->cover->image->url) }}" alt="Cover image {{ $fandom->name }}" title="Cover image {{ $fandom->name }}" class="w-full h-full max-h-[calc(15vh)] sm:max-h-[calc(30vh)] object-cover block rounded-lg">
                            <div class="absolute left-0 top-0 w-full h-full max-h-[calc(15vh)] sm:max-h-[calc(30vh)]">
                                <div class="w-full h-full p-4 flex flex-col justify-center items-center space-x-0 space-y-4">
                                    <img src="{{ asset('storage/avatars/'.$fandom->avatar->image->url) }}" alt="Avatar image {{ $fandom->name }}" title="Avatar image {{ $fandom->name }}" class="block w-auto h-full max-h-[70%] aspect-square object-cover border-0 border-transparent rounded-full">
                                    <div class="w-full h-fit p-2 bg-white border-0 border-transparent rounded-lg">
                                        <h1 class="w-full text-[{{ $preferences['color_text'] }}] text-center text-[calc({{'4px+' . $preferences['font_size'] . 'px' }})] font-semibold">{{ $fandom->name }}</h1>
                                        <p class="w-full text-[{{ $preferences['color_text'] }}] text-center text-[calc({{$preferences['font_size'] . 'px'}})]">{{ $fandom->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full h-fit bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-lg">
                            <div class="flex flex-row">
                                <div x-on:click="tab = 'home'" class="p-4">Home</div>
                                <div x-on:click="tab = 'post'" class="p-4">Post</div>
                                <div x-on:click="tab = 'galery'" class="p-4">Galery</div>
                            </div>
                        </div>
                        <div class="w-full h-fit bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-lg">
                            <div x-cloak x-show="tab == 'home'" class="w-full h-fit flex flex-col space-x-0 space-y-2">
                                <div>
                                    <div class="p-1">Recent Posts</div>
                                    <div class="border-x-0 border-y border-black">
                                        <div class="w-5/12 h-fit p-1 m-1 border border-[{{ $preferences['color_secondary'] }}] rounded-lg inline-block">
                                            <h1>Title</h1>
                                            <div class="flex flex-col">
                                                <p>By you</p>
                                                <p class="text-right">Published 5 minutes ago</p>
                                            </div>
                                        </div>
                                        <div class="w-5/12 h-fit p-1 m-1 border border-[{{ $preferences['color_secondary'] }}] rounded-lg inline-block">
                                            <h1>Title</h1>
                                            <div class="flex flex-col">
                                                <p>By you</p>
                                                <p class="text-right">Published 5 minutes ago</p>
                                            </div>
                                        </div>
                                        <div class="w-5/12 h-fit p-1 m-1 border border-[{{ $preferences['color_secondary'] }}] rounded-lg inline-block">
                                            <h1>Title</h1>
                                            <div class="flex flex-col">
                                                <p>By you</p>
                                                <p class="text-right">Published 5 minutes ago</p>
                                            </div>
                                        </div>
                                        <div class="w-5/12 h-fit p-1 m-1 border border-[{{ $preferences['color_secondary'] }}] rounded-lg inline-block">
                                            <h1>Title</h1>
                                            <div class="flex flex-col">
                                                <p>By you</p>
                                                <p class="text-right">Published 5 minutes ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="p-1">New In Galery</div>
                                    <div class="border-x-0 border-y border-black">
                                        <div class="w-1/5 h-fit m-1 aspect-square bg-black inline-block"></div>
                                        <div class="w-1/5 h-fit m-1 aspect-square bg-black inline-block"></div>
                                        <div class="w-1/5 h-fit m-1 aspect-square bg-black inline-block"></div>
                                        <div class="w-1/5 h-fit m-1 aspect-square bg-black inline-block"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex flex-row justify-between items-center">
                                        <div>Votes</div>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                        </svg>                                          
                                    </div>
                                    <div class="border-x-0 border-y border-black">
                                        <div>
                                            <div>Created by you</div>
                                            <div>1. Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque aperiam beatae harum saepe! Dolorem quos hic ducimus ullam quibusdam, dolorum reiciendis, excepturi tempore error labore dicta. Sapiente reiciendis ad in.</div>
                                            <div class="flex flex-row justify-between">
                                                <div>No</div>
                                                <div>Yes</div>
                                            </div>
                                            <div>You vote yes</div>
                                        </div>
                                        <div>
                                            <div>Created by you</div>
                                            <div>2. Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut vero minus doloremque velit, quisquam illum rerum nihil ea delectus officiis laudantium sunt porro voluptatum cum eius hic fugit optio! Eius?</div>
                                            <div class="flex flex-row justify-between">
                                                <div>No</div>
                                                <div>Yes</div>
                                            </div>
                                            <div>You vote yes</div>
                                        </div>
                                        <div>
                                            <div>Created by you</div>
                                            <div>3. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quasi, corporis facere beatae eaque consectetur culpa deserunt, recusandae dolorem perferendis, praesentium sapiente ab vitae nostrum sint iusto similique cupiditate voluptas odio!</div>
                                            <div class="flex flex-row justify-between">
                                                <div>No</div>
                                                <div>Yes</div>
                                            </div>
                                            <div>You vote yes</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div x-cloak x-show="tab == 'post'">
                                <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2">
                                    <div class="w-full h-fit flex flex-row justify-between items-center">
                                        <div>Post</div>
                                        <a wire:navigate.hover href="{{ route('post') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </div>
                                    <livewire:post-search :preferences="$preferences"/>
                                    <livewire:post-list :preferences="$preferences"/>
                                </div>
                            </div>
                            <div x-cloak x-show="tab == 'galery'" class="p-4">Galery</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full h-fit max-h-[calc(100%-48px)] col-span-3 bg-black border-0 border-transparent rounded-lg overflow-clip">

                <p class="text-black">{{ $time->diffForHumans() }}</p>
            </div>
        </div>
    </div>
    <x-nav :preferences="$preferences"/>
</div>