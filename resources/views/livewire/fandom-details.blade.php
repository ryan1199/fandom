<div class="container h-full mx-auto p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-[' . $preferences['color_text'] . ']' }} relative z-0">
    <div class="select-none">
        <x-nav :preferences="$preferences" />
    </div>
    <div class="fixed mx-auto inset-x-4 top-20 z-10">
        <livewire:alert :preferences="$preferences" />
    </div>
    <div class="w-full h-fit grid grid-cols-12 grid-flow-row-dense auto-rows-max auto-cols-max gap-2 border-0 rounded-lg relative">
        {{-- fandom details --}}
        <div class="w-full h-fit col-span-12 lg:col-span-6 p-2 {{ 'bg-[' . $preferences['color_primary'] . ']/10' }} backdrop-blur-sm border-0 rounded-lg">
            <div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 rounded-lg">
                <div x-data="{ tab: @entangle('tab').live }" class="w-full h-fit flex flex-col space-x-0 space-y-2 border-0 rounded-lg">
                    {{-- header --}}
                    <div class="w-full h-[30vh] relative rounded-lg">
                        <img src="{{ asset('storage/covers/' . $fandom->cover->image->url) }}"
                            alt="Cover image {{ $fandom->name }}" title="Cover image {{ $fandom->name }}"
                            class="w-full h-[30vh] object-cover block rounded-lg select-none" draggable="false">
                        <div class="absolute left-0 top-0 w-full h-[30vh]">
                            <div class="w-full h-[30vh] p-4 flex flex-col justify-center items-center space-x-0 space-y-4">
                                <img src="{{ asset('storage/avatars/' . $fandom->avatar->image->url) }}"
                                    alt="Avatar image {{ $fandom->name }}" title="Avatar image {{ $fandom->name }}"
                                    class="block w-auto h-[50%] aspect-square object-cover border-0 rounded-full select-none"
                                    draggable="false">
                                <div class="w-full h-fit max-h-[15vh] p-2 {{ 'bg-[' . $preferences['color_primary'] . ']/70' }} backdrop-blur-sm border-0 rounded-lg overflow-clip">
                                    <div x-data="{ open: false }" class="flex flex-row space-x-1 space-y-0 justify-center items-center">
                                        <h1 class="w-fit {{ 'text-[' . $preferences['color_text'] . ']' }} text-center {{ 'text-[calc(4px+' . $preferences['font_size'] . 'px)]' }} font-semibold">{{ $fandom->name }}</h1>
                                        @auth
                                            <span class="relative">
                                                <svg x-on:click="open = ! open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 bg-inherit border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-full">
                                                    <path fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" clip-rule="evenodd" />
                                                </svg>
                                                @if (in_array(Auth::id(), $members['id']))
                                                    <div wire:click="leave" wire:confirm="Are you sure you want to leave this fandom?" x-cloak x-show="open" class="absolute -top-1 -right-[72px] w-fit h-fit mx-auto px-2 py-1 bg-inherit border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-full select-none cursor-pointer">Leave</div>
                                                @else
                                                    <div wire:click="join" wire:confirm="Are you sure you want to join this fandom?" x-cloak x-show="open" class="absolute -top-1 -right-[72px] w-fit h-fit mx-auto px-2 py-1 bg-inherit border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-full select-none cursor-pointer">Join</div>
                                                @endif
                                            </span>
                                        @endauth
                                    </div>
                                    <div class="w-fit max-w-full h-fit max-h-[10vh] mx-auto mt-1 text-left overflow-clip overflow-y-auto">
                                        <p class="{{ 'text-[' . $preferences['color_text'] . ']' }} {{ 'text-[calc(' . $preferences['font_size'] . 'px)]'}}">{{ $fandom->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- nav --}}
                    <div class="w-full h-fit {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg select-none">
                        <div class="flex flex-row overflow-x-auto overflow-y-clip">
                            <div x-on:click="tab = 'home'" class="p-4 cursor-pointer">Home</div>
                            <div x-on:click="tab = 'post'" class="p-4 cursor-pointer">Post</div>
                            <div x-on:click="tab = 'galery'" class="p-4 cursor-pointer">Galery</div>
                            <div x-on:click="tab = 'user'" class="p-4 cursor-pointer">User</div>
                            @if (in_array(Auth::id(), $members['manager']['id']))
                                <div x-on:click="tab = 'setting'" class="p-4 cursor-pointer">Setting</div>
                            @endif
                        </div>
                    </div>
                    {{-- content --}}
                    <div class="w-full h-fit {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
                        <div x-cloak x-show="tab == 'home'" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2">
                            {{-- post --}}
                            <div class="flex flex-col space-x-0 space-y-2">
                                <div class="font-semibold">Recent Posts</div>
                                <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                                    @if (in_array(Auth::id(), $members['id']))
                                        @foreach ($posts['member'] as $post)
                                            <div class="w-full h-fit p-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                                <h1><a href="{{ route('post.show', $post) }}" class="cursor-pointer" draggable="false">{{ $post->title }}</a></h1>
                                                <div class="flex flex-col">
                                                    <p>By {{ $post->user->username }}</p>
                                                    <p class="text-right">Published {{ $post->publish->created_at->diffForHumans(['options' => null]) }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        @foreach ($posts['public'] as $post)
                                            <div class="w-full h-fit p-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                                <h1><a href="{{ route('post.show', $post) }}" class="cursor-pointer" draggable="false">{{ $post->title }}</a></h1>
                                                <div class="flex flex-col">
                                                    <p>By {{ $post->user->username }}</p>
                                                    <p class="text-right">Published {{ $post->publish->created_at->diffForHumans(['options' => null]) }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            {{-- galery --}}
                            <div class="flex flex-col space-x-0 space-y-2">
                                <div class="font-semibold">New In Galery</div>
                                <div class="w-full h-fit grid gap-2 grid-cols-3">
                                    @if (in_array(Auth::id(), $members['id']))
                                        @foreach ($galleries['member'] as $gallery)
                                            <div class="w-full h-fit p-1 flex flex-col space-x-0 space-y-2 justify-between border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                                <div class="flex flex-col space-x-0 space-y-2">
                                                    <a href="{{ route('gallery.show', $gallery) }}" draggable="false">
                                                        <img src="{{ asset('storage/galleries/' . $gallery->image->url) }}"
                                                            alt="{{ asset('storage/galleries/' . $gallery->image->url) }}"
                                                            draggable="false" class="w-full h-40 object-cover rounded-lg">
                                                    </a>
                                                    <div class="flex flex-col">
                                                        <p>By {{ $gallery->user->username }}</p>
                                                        <p class="text-right">Uploaded {{ $gallery->publish->created_at->diffForHumans(['options' => null]) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        @foreach ($galleries['public'] as $gallery)
                                            <div class="w-full h-fit p-1 flex flex-col space-x-0 space-y-2 justify-between border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                                <div class="flex flex-col space-x-0 space-y-2">
                                                    <a href="{{ route('gallery.show', $gallery) }}" draggable="false">
                                                        <img src="{{ asset('storage/galleries/' . $gallery->image->url) }}"
                                                            alt="{{ asset('storage/galleries/' . $gallery->image->url) }}"
                                                            draggable="false" class="w-full h-40 object-cover rounded-lg">
                                                    </a>
                                                    <div class="flex flex-col">
                                                        <p>By {{ $gallery->user->username }}</p>
                                                        <p class="text-right">Uploaded {{ $gallery->publish->created_at->diffForHumans(['options' => null]) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            {{-- votes --}}
                            <div class="flex flex-col space-x-0 space-y-2">
                                <div class="flex flex-row justify-between items-center">
                                    <div class="font-semibold">Votes</div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="border-x-0 border-y {{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                                    @for ($i = 0; $i < 5; $i++) 
                                        <div>
                                            <div>Created by you</div>
                                            <div>{{ $i+1 }}. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                Doloremque
                                                aperiam beatae harum saepe! Dolorem quos hic ducimus ullam quibusdam,
                                                dolorum reiciendis, excepturi tempore error labore dicta. Sapiente
                                                reiciendis ad in.
                                            </div>
                                            <div class="flex flex-row justify-between">
                                                <div>No</div>
                                                <div>Yes</div>
                                            </div>
                                            <div>You vote yes</div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div x-cloak x-show="tab == 'post'" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2">
                            <div class="w-full h-fit flex flex-row justify-between items-center">
                                <div class="font-semibold">Post</div>
                                @auth
                                    @if (in_array(Auth::id(), $members['id']))
                                        <a wire:navigate.hover href="{{ route('post') }}" draggable="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endif
                                @endauth
                            </div>
                            <livewire:post-search :preferences="$preferences" from="fandom" />
                            <livewire:post-list :preferences="$preferences" from="fandom" id="{{ $fandom->id }}" />
                        </div>
                        <div x-cloak x-show="tab == 'galery'" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2">
                            <div class="w-full h-fit flex flex-row justify-between items-center">
                                <div class="font-semibold">Gallery</div>
                                @auth
                                    @if (in_array(Auth::id(), $members['id']))
                                        <a wire:navigate.hover href="{{ route('gallery') }}" draggable="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endif
                                @endauth
                            </div>
                            <livewire:gallery-search :preferences="$preferences" from="fandom" />
                            <livewire:gallery-list :preferences="$preferences" from="fandom" id="{{ $fandom->id }}" />
                        </div>
                        <div x-cloak x-show="tab == 'user'" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2">
                            <div class="font-semibold">User</div>
                            {{-- manager --}}
                            <div class="w-full h-fit p-1 flex flex-col space-x-0 space-y-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                <h3 class="{{ 'text-[' . $preferences['color_text'] . ']' }} text-center {{ 'text-[' . $preferences['font_size'] . 'px]' }} font-normal">Managers</h3>
                                <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                                <div class="flex flex-row flex-wrap">
                                    @foreach ($members['manager']['list'] as $manager)
                                        <div class="w-fit m-1">
                                            <a href="{{ route('user', $manager->user) }}" class="p-2 flex flex-row space-x-2 space-y-0 justify-start items-center {{ 'text-[' . $preferences['color_text'] . ']' }} {{ 'text-[' . $preferences['font_size'] . 'px]' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg" draggable="false">
                                                <img src="{{ asset('storage/avatars/' . $manager->user->avatar->image->url) }}" alt="{{ $manager->user->username }}" class="w-10 h-10 object-cover object-center rounded-full" draggable="false">
                                                <p>{{ $manager->user->username }}</p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- member --}}
                            <div class="w-full h-fit p-1 flex flex-col space-x-0 space-y-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                <h3 class="{{ 'text-[' . $preferences['color_text'] . ']' }} text-center {{ 'text-[' . $preferences['font_size'] . 'px]' }} font-normal">Members</h3>
                                <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                                <div class="flex flex-row flex-wrap">
                                    @foreach ($members['member']['list'] as $member)
                                        <div class="w-fit m-1">
                                            <a href="{{ route('user', $member->user) }}" class="p-2 flex flex-row space-x-2 space-y-0 justify-start items-center {{ 'text-[' . $preferences['color_text'] . ']' }} {{ 'text-[' . $preferences['font_size'] . 'px]' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg" draggable="false">
                                                <img src="{{ asset('storage/avatars/' . $member->user->avatar->image->url) }}" alt="{{ $member->user->username }}" class="w-10 h-10 object-cover object-center rounded-full" draggable="false">
                                                <p>{{ $member->user->username }}</p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if (in_array(Auth::id(), $members['manager']['id']))
                            <div x-cloak x-show="tab == 'setting'">
                                <livewire:fandom-setting :fandom="$fandom" :preferences="$preferences" :managers="$members['manager']['id']" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- discusses --}}
        <div class="sticky top-0 w-full h-[100vh] col-span-12 lg:col-span-6 flex flex-col space-x-0 space-y-2">
            <div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']/10' }} backdrop-blur-sm border-0 rounded-lg">
                <div class="w-full h-fit border-0 rounded-lg">
                    <div
                    @if (in_array(Auth::id(), $members['manager']['id']))
                        x-data="{ openDiscussCreateComponent: false }"
                    @endif
                     class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 rounded-lg">
                        <div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg relative">
                            <h2 class="{{ 'text-[' . $preferences['color_text'] . ']' }} text-center {{ 'text-[calc(2px+' . $preferences['font_size'] . 'px)]' }} font-medium">Discusses</h2>
                            @if (in_array(Auth::id(), $members['manager']['id']))
                                <div x-on:click="openDiscussCreateComponent = ! openDiscussCreateComponent" class="size-8 p-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg absolute right-1.5 inset-y-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        @if (in_array(Auth::id(), $members['manager']['id']))
                            <div x-cloak x-show="openDiscussCreateComponent">
                                <livewire:discuss-create :fandom="$fandom" :preferences="$preferences" :managers="$members['manager']['id']" />
                            </div>
                        @endif
                        @foreach ($fandom->discusses as $discuss)
                            @switch($discuss->visible)
                                @case('manager')
                                    @if (in_array(Auth::id(), $members['manager']['id']))
                                        <div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
                                            <div x-data="{ open: true }" class="w-full h-fit p-1 flex flex-col space-x-0 space-y-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                                <h3 x-on:click="open = ! open" class="{{ 'text-[' . $preferences['color_text'] . ']' }} text-center {{ 'text-[' . $preferences['font_size'] . 'px]' }} font-normal select-none">{{ $discuss->name }}</h3>
                                                <div x-cloak x-show="open" class="w-full h-fit max-h-[calc(100vh)] flex flex-col space-x-0 space-y-1 overflow-x-clip overflow-y-auto relative">
                                                    <div class="grid grid-cols-3 gap-1">
                                                        @for ($i = 0; $i < 3; $i++) 
                                                            <div class="p-1 col-span-2 border rounded-lg">
                                                                <p>User1</p>
                                                                <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                            </div>
                                                            <div class="p-1 col-span-2 col-start-2 border rounded-lg">
                                                                <p class="text-right">User2</p>
                                                                <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                    <form class="w-full h-fit flex flex-row space-x-1 space-y-0 items-center sticky bottom-0 {{ 'bg-[' . $preferences['color_primary'] . ']' }}">
                                                        <input type="text" placeholder="Your message" title="Your message" class="form-input w-full h-fit border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                                        <button type="submit" title="Send your message"
                                                            class="w-fit h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                                <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @break
                                @case('member')
                                    @if (in_array(Auth::id(), $members['member']['id']) || in_array(Auth::id(), $members['manager']['id']))
                                        <div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
                                            <div x-data="{ open: true }" class="w-full h-fit p-1 flex flex-col space-x-0 space-y-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                                <h3 x-on:click="open = ! open" class="{{ 'text-[' . $preferences['color_text'] . ']' }} text-center {{ 'text-[' . $preferences['font_size'] . 'px]' }} font-normal">{{ $discuss->name }}</h3>
                                                <div x-cloak x-show="open" class="w-full h-fit max-h-[calc(100vh)] flex flex-col space-x-0 space-y-1 overflow-x-clip overflow-y-auto relative">
                                                    <div class="grid grid-cols-3 gap-1">
                                                        @for ($i = 0; $i < 3; $i++) 
                                                            <div class="p-1 col-span-2 border rounded-lg">
                                                                <p>User1</p>
                                                                <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                            </div>
                                                            <div class="p-1 col-span-2 col-start-2 border rounded-lg">
                                                                <p class="text-right">User2</p>
                                                                <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                    <form class="w-full h-fit flex flex-row space-x-1 space-y-0 items-center sticky bottom-0 {{ 'bg-[' . $preferences['color_primary'] . ']' }}">
                                                        <input type="text" placeholder="Your message" title="Your message" class="form-input w-full h-fit border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                                        <button type="submit" title="Send your message" class="w-fit h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                                <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @break
                                @default
                                    <div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
                                        <div x-data="{ open: true }" class="w-full h-fit p-1 flex flex-col space-x-0 space-y-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                            <h3 x-on:click="open = ! open" class="{{ 'text-[' . $preferences['color_text'] . ']' }} text-center {{ 'text-[' . $preferences['font_size'] . 'px]' }} font-normal">{{ $discuss->name }}</h3>
                                            <div x-cloak x-show="open" class="w-full h-fit max-h-[calc(100vh)] flex flex-col space-x-0 space-y-1 overflow-x-clip overflow-y-auto relative">
                                                <div class="grid grid-cols-3 gap-1">
                                                    @for ($i = 0; $i < 3; $i++) 
                                                        <div class="p-1 col-span-2 border rounded-lg">
                                                            <p>User1</p>
                                                            <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                        </div>
                                                        <div class="p-1 col-span-2 col-start-2 border rounded-lg">
                                                            <p class="text-right">User2</p>
                                                            <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                        </div>
                                                    @endfor
                                                </div>
                                                <form class="w-full h-fit flex flex-row space-x-1 space-y-0 items-center sticky bottom-0 {{ 'bg-[' . $preferences['color_primary'] . ']' }}">
                                                    <input type="text" placeholder="Your message" title="Your message" class="form-input w-full h-fit border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                                    <button type="submit" title="Send your message" class="w-fit h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                            <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            @endswitch
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
