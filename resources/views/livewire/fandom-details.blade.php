<div class="w-full h-screen {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }}">
    <div class="w-full h-screen p-2 grid grid-cols-12 grid-flow-row-dense auto-rows-max auto-cols-max gap-2">
        {{-- fandom details --}}
        <div class="w-full h-fit max-h-[calc(100vh-16px)] col-span-12 lg:col-span-6 shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg overflow-y-auto">
            <div x-data="{ tab: @entangle('tab').live }" class="w-full h-fit p-4 flex flex-col space-x-0 space-y-4 rounded-lg">
                {{-- header --}}
                <div style="background-image: url('{{ asset('storage/covers/' . $fandom->cover->image->url) }}')" class="w-full h-fit bg-cover bg-no-repeat bg-center rounded-lg">
                    <div class="w-full h-fit p-4 flex flex-col justify-center items-center space-x-0 space-y-4">
                        <img src="{{ asset('storage/avatars/' . $fandom->avatar->image->url) }}" alt="Avatar image {{ $fandom->name }}" title="Avatar image {{ $fandom->name }}" class="p-2 w-auto h-40 aspect-square object-cover {{ 'bg-' . $preferences['color_2'] . '-50/10' }} backdrop-blur-sm shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-full select-none" draggable="false">
                        <div class="w-full h-fit p-2 {{ 'text-' . $preferences['color_2'] . '-100' }} {{ 'bg-' . $preferences['color_2'] . '-50/10' }} backdrop-blur-xl {{ 'selection:bg-' . $preferences['color_2'] . '-50' }} {{ 'selection:text-' . $preferences['color_2'] . '-500' }} rounded-lg overflow-clip">
                            <div x-data="{ open_leave_join_button: false }" class="flex flex-row space-x-1 space-y-0 justify-center items-center">
                                <h1 class="w-fit max-w-full p-2 text-nowrap text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-semibold overflow-x-auto">{{ $fandom->name }}</h1>
                                @auth
                                    <span class="relative">
                                        <svg x-on:click="open_leave_join_button = ! open_leave_join_button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 bg-inherit {{ 'text-' . $preferences['color_2'] . '-100' }} border {{ 'border-' . $preferences['color_2'] . '-100' }} rounded-full">
                                            <path fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" clip-rule="evenodd" />
                                        </svg>
                                        @if (in_array(Auth::id(), $members['id']))
                                            <div wire:click="leave" wire:confirm="Are you sure you want to leave this fandom?" x-cloak x-show="open_leave_join_button" class="absolute -top-1 -right-[72px] w-fit h-fit mx-auto px-2 py-1 bg-inherit border {{ 'border-' . $preferences['color_2'] . '-100' }} rounded-full select-none cursor-pointer">Leave</div>
                                        @else
                                            <div wire:click="join" wire:confirm="Are you sure you want to join this fandom?" x-cloak x-show="open_leave_join_button" class="absolute -top-1 -right-[72px] w-fit h-fit mx-auto px-2 py-1 bg-inherit border {{ 'border-' . $preferences['color_2'] . '-100' }} rounded-full select-none cursor-pointer">Join</div>
                                        @endif
                                    </span>
                                @endauth
                            </div>
                            <div class="w-fit max-w-full h-fit max-h-40 mx-auto p-2 text-left overflow-clip overflow-y-auto">
                                <p>{{ $fandom->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- nav --}}
                <div class="">
                    <div class="w-full h-fit {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none">
                        <div class="w-fit max-w-full flex flex-row text-nowrap overflow-x-auto overflow-y-clip">
                            <div :class="tab == 'home' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="tab = 'home'" class="p-4 font-semibold cursor-pointer">Home</div>
                            <div :class="tab == 'post' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="tab = 'post'" class="p-4 font-semibold cursor-pointer">Post</div>
                            <div :class="tab == 'gallery' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="tab = 'gallery'" class="p-4 font-semibold cursor-pointer">Galery</div>
                            <div :class="tab == 'user' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="tab = 'user'" class="p-4 font-semibold cursor-pointer">User</div>
                            @if (in_array(Auth::id(), $members['manager']['id']))
                                <div :class="tab == 'setting' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="tab = 'setting'" class="p-4 font-semibold cursor-pointer">Setting</div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- content --}}
                <div class="w-full h-fit {{ 'selection:bg-' . $preferences['color_2'] . '-500' }} {{ 'selection:text-' . $preferences['color_2'] . '-50' }}">
                    <div x-transition x-cloak x-show="tab == 'home'" class="w-full h-fit flex flex-col space-x-0 space-y-4">
                        {{-- post --}}
                        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                                  Recent Posts
                                </span>
                            </div>
                            <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                                @if (in_array(Auth::id(), $members['id']))
                                    @forelse ($posts['member'] as $post)
                                        <a wire:key="{{ 'fandom-' . $fandom->id . '-post-member-' . $loop->index }}" href="{{ route('post.show', $post) }}" class="w-full h-fit p-2 border {{ 'border-' . $preferences['color_2'] . '-200' }} group {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer animation" draggable="false">
                                            <h1 class="font-semibold {{ 'group-hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation">{{ $post->title }}</h1>
                                            <p class="text-right {{ 'group-hover:text-' . $preferences['color_2'] . '-500' }} animation">Published {{ $post->publish->created_at->diffForHumans(['options' => null]) }}</p>
                                        </a>
                                    @empty
                                        <p class="text-nowrap">No posts have been published</p>
                                    @endforelse
                                @else
                                    @forelse ($posts['public'] as $post)
                                        <a wire:key="{{ 'fandom-' . $fandom->id . '-post-public-' . $loop->index }}" href="{{ route('post.show', $post) }}" class="w-full h-fit p-2 border {{ 'border-' . $preferences['color_2'] . '-200' }} group {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer animation" draggable="false">
                                            <h1 class="font-semibold {{ 'group-hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation">{{ $post->title }}</h1>
                                            <p class="text-right {{ 'group-hover:text-' . $preferences['color_2'] . '-500' }} animation">Published {{ $post->publish->created_at->diffForHumans(['options' => null]) }}</p>
                                        </a>
                                    @empty
                                        <p class="text-nowrap">No posts have been published</p>
                                    @endforelse
                                @endif
                            </div>
                        </div>
                        {{-- gallery --}}
                        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                                  New In Gallery
                                </span>
                            </div>
                            <div class="w-full h-fit grid gap-2 grid-cols-3">
                                @if (in_array(Auth::id(), $members['id']))
                                    @forelse ($galleries['member'] as $gallery)
                                        <div wire:key="{{ 'fandom-' . $fandom->id . '-gallery-member-' . $gallery->id }}" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-between border {{ 'border-' . $preferences['color_2'] . '-200' }} group {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation">
                                            <div class="flex flex-col space-x-0 space-y-2">
                                                <a href="{{ route('gallery.show', $gallery) }}" draggable="false">
                                                    <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}" class="w-full h-40 object-cover object-center rounded-lg" draggable="false">
                                                </a>
                                                <p class="text-left {{ 'group-hover:text-' . $preferences['color_2'] . '-500' }} animation"><span class="font-semibold">Uploaded</span> by {{ $gallery->user->username }} {{ $gallery->created_at->diffForHumans(['options' => null]) }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-nowrap">No images have been published</p>
                                    @endforelse
                                @else
                                    @forelse ($galleries['public'] as $gallery)
                                        <div wire:key="{{ 'fandom-' . $fandom->id . '-gallery-public' . $gallery->id }}" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-between border {{ 'border-' . $preferences['color_2'] . '-200' }} group {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation">
                                            <div class="flex flex-col space-x-0 space-y-2">
                                                <a href="{{ route('gallery.show', $gallery) }}" draggable="false">
                                                    <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}" class="w-full h-40 object-cover object-center rounded-lg" draggable="false">
                                                </a>
                                                <p class="text-left {{ 'group-hover:text-' . $preferences['color_2'] . '-500' }} animation"><span class="font-semibold">Uploaded</span> by {{ $gallery->user->username }} {{ $gallery->created_at->diffForHumans(['options' => null]) }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-nowrap">No images have been published</p>
                                    @endforelse
                                @endif
                            </div>
                        </div>
                        {{-- votes --}}
                        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="flex flex-row justify-between items-center">
                                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                                      Votes
                                    </span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                                {{-- 2 tabs: on progress and complete --}}
                                @for ($i = 0; $i < 5; $i++) 
                                    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                                        <div>Created by name</div>
                                        <div>{{ $i+1 }}. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Doloremque
                                            aperiam beatae harum saepe! Dolorem quos hic ducimus ullam quibusdam,
                                            dolorum reiciendis, excepturi tempore error labore dicta. Sapiente
                                            reiciendis ad in.
                                        </div>
                                        <div class="flex flex-row justify-between">
                                            <div>No</div>
                                            <div>Yes</div>
                                            {{-- bar percentage between yes and no --}}
                                        </div>
                                        <div>You vote yes</div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div x-transition x-cloak x-show="tab == 'post'" class="w-full h-fit">
                        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="w-full h-fit flex flex-row justify-between items-center">
                                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                                      Post
                                    </span>
                                </div>
                                @auth
                                    @if (in_array(Auth::id(), $members['id']))
                                        <a wire:navigate.hover href="{{ route('post-management') }}" draggable="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                                                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endif
                                @endauth
                            </div>
                            @livewire(PostSearch::class, ['preferences' => $preferences, 'from' => 'fandom'], key('post-search-for-fandom-', $fandom->id))
                            @livewire(PostList::class, ['preferences' => $preferences, 'from' => 'fandom', 'id' => $fandom->id], key('post-list-for-fandom-', $fandom->id))
                        </div>
                    </div>
                    <div x-transition x-cloak x-show="tab == 'gallery'" class="w-full h-fit">
                        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="w-full h-fit flex flex-row justify-between items-center">
                                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                                      Gallery
                                    </span>
                                </div>
                                @auth
                                    @if (in_array(Auth::id(), $members['id']))
                                        <a wire:navigate.hover href="{{ route('gallery-management') }}" draggable="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                                                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endif
                                @endauth
                            </div>
                            @livewire(GallerySearch::class, ['preferences' => $preferences], key('gallery-search-for-fandom-', $fandom->id))
                            @livewire(GalleryList::class, ['preferences' => $preferences, 'from' => 'fandom', 'id' => $fandom->id], key('gallery-list-for-fandom-', $fandom->id))
                        </div>
                    </div>
                    <div x-transition x-cloak x-show="tab == 'user'" class="w-full h-fit">
                        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                                  User
                                </span>
                            </div>
                            <div class="w-full h-fit flex flex-col space-x-0 space-y-4">
                                {{-- manager --}}
                                <div class="w-full h-fit p-1 flex flex-col space-x-0 space-y-1 border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                                    <h3 class="text-center">Managers</h3>
                                    <hr class="{{ 'border-' . $preferences['color_2'] . '-200' }}">
                                    <div class="flex flex-row flex-wrap">
                                        @forelse ($members['manager']['list'] as $manager)
                                            <a wire:key="{{ 'fandom-' . $fandom->id . '-user-manager-' . $loop->index }}" href="{{ route('user', $manager->user) }}" class="w-fit m-1 p-2 flex flex-row space-x-2 space-y-0 justify-start items-center {{ 'bg-' . $preferences['color_2'] . '-100' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} group {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" title="{{ $manager->user->username }}" draggable="false">
                                                @if ($manager->user->avatar != null)
                                                    <img src="{{ asset('storage/avatars/' . $manager->user->avatar->image->url) }}" alt="{{ $manager->user->username }}" class="w-10 h-10 object-cover object-center rounded-full" draggable="false">
                                                @else
                                                    <div class="w-10 h-auto aspect-square bg-gradient-to-r {{ 'from-' . $preferences['color_2'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_2'] . '-900' }} rounded-full">
                                                        <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                                                    </div>
                                                @endif
                                                <p class="font-semibold {{ 'group-hover:text-' . $preferences['color_2'] . '-500' }} animation">{{ $manager->user->username }}</p>
                                            </a>
                                        @empty
                                            This fandom has no managers
                                        @endforelse
                                    </div>
                                </div>
                                {{-- member --}}
                                <div class="w-full h-fit p-1 flex flex-col space-x-0 space-y-1 border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                                    <h3 class="text-center">Members</h3>
                                    <hr class="{{ 'border-' . $preferences['color_2'] . '-200' }}">
                                    <div class="flex flex-row flex-wrap">
                                        @forelse ($members['member']['list'] as $member)
                                            <a wire:key="{{ 'fandom-' . $fandom->id . '-user-member-' . $loop->index }}" href="{{ route('user', $member->user) }}" class="w-fit m-1 p-2 flex flex-row space-x-2 space-y-0 justify-start items-center {{ 'bg-' . $preferences['color_2'] . '-100' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} group {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" title="{{ $member->user->username }}" draggable="false">
                                                @if ($member->user->avatar != null)
                                                    <img src="{{ asset('storage/avatars/' . $member->user->avatar->image->url) }}" alt="{{ $member->user->username }}" class="w-10 h-10 object-cover object-center rounded-full" draggable="false">
                                                @else
                                                    <div class="w-10 h-auto aspect-square bg-gradient-to-r {{ 'from-' . $preferences['color_2'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_2'] . '-900' }} rounded-full">
                                                        <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                                                    </div>
                                                @endif
                                                <p class="font-semibold {{ 'group-hover:text-' . $preferences['color_2'] . '-500' }} animation">{{ $member->user->username }}</p>
                                            </a>
                                        @empty
                                            <p>This fandom has no members</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (in_array(Auth::id(), $members['manager']['id']))
                        <div x-transition x-cloak x-show="tab == 'setting'" class="w-full h-fit flex flex-col space-x-0 space-y-2">
                            @livewire(FandomSetting::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key('fandom-setting-for-fandom-', $fandom->id))
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- discusses --}}
        <div @if (in_array(Auth::id(), $members['manager']['id'])) x-data="{ open_discuss_create_component: false }" @endif class="w-full h-fit max-h-[calc(100vh-16px)] p-4 col-span-12 lg:col-span-6 flex flex-col space-x-0 space-y-4 shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg overflow-y-auto">
            <div class="w-full h-fit p-2 flex flex-row justify-between items-center {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none">
                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                        Discusses
                    </span>
                </div>
                @if (in_array(Auth::id(), $members['manager']['id']))
                    <svg x-on:click="open_discuss_create_component = ! open_discuss_create_component" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                    </svg>
                @endif
            </div>
            @if (in_array(Auth::id(), $members['manager']['id']))
                <div x-cloak x-show="open_discuss_create_component" class="w-full h-fit">
                    @livewire(DiscussCreate::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key('discuss-create-for-fandom-', $fandom->id))
                </div>
            @endif
            @if ($discusses->isNotEmpty())
                <div class="w-full h-fit">
                    @livewire(Discuss::class, ['discuss_ids' => $discusses->pluck('id'), 'preferences' => $preferences, 'from' => 'discussion-for-fandom-' . $fandom->id], key("discussion-for-fandom-" . $fandom->id))
                </div>
            @endif
        </div>
    </div>
</div>
