<div class="w-full h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none overflow-clip">
    <div class="w-full h-fit max-h-[100vh] px-4 sm:px-0 py-8 flex flex-col space-x-0 space-y-8 items-center overflow-y-auto">
        <div class="w-full sm:w-11/12 md:w-10/12 lg:w-8/12 h-fit self-center flex flex-col 2xl:flex-row space-x-0 space-y-8 2xl:space-x-8 2xl:space-y-0">
            <div class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}" class="w-full max-w-3xl mx-auto 2xl:mx-0 object-cover rounded-lg" draggable="false">
            </div>
            <div class="w-full 2xl:w-fit h-fit p-2 flex flex-col space-x-0 space-y-2 tracking-widest {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="w-fit h-fit p-2 pb-1 flex flex-row flex-wrap">
                    <span class="mr-1 mb-1">Tags: </span>
                    @foreach (explode(',', $gallery->tags) as $tag)
                        @if ($loop->last)
                            <span class="mr-1 mb-1 text-wrap break-all">{{ $tag }}</span>
                        @else
                            <span class="mr-1 mb-1 text-wrap break-all">{{ $tag }},</span>
                        @endif
                    @endforeach
                </div>
                <div class="w-fit h-fit p-2">
                    <span>Views: </span>
                    <span>{{ $totalViews }}</span>
                </div>
                <span>
                    @if (class_basename($gallery->publish->publishable_type) === 'User')
                        <a wire:navigate href="{{ route('user', $gallery->publish->publishable) }}" class="w-fit h-fit p-2 flex flex-row space-x-2 items-center" draggable="false">
                            <div class="flex flex-col">
                                <span>Published on: </span>
                                <span class="w-fit overflow-x-scroll max-w-40 text-nowrap">{{ $gallery->publish->publishable->username }}</span>
                            </div>
                            @if ($gallery->publish->publishable->avatar != null)
                                <img src="{{ asset('storage/avatars/'.$gallery->publish->publishable->avatar->image->url) }}" alt="{{ asset('storage/avatars/'.$gallery->publish->publishable->avatar->image->url) }}" class="w-10 h-auto aspect-square object-cover rounded-full" draggable="false">
                            @else
                                <div class="w-10 h-auto aspect-square bg-gradient-to-r {{ 'from-' . $preferences['color_2'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_2'] . '-900' }} rounded-full">
                                    <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                                </div>
                            @endif
                        </a>
                    @else
                        <a wire:navigate href="{{ route('fandom-details', $gallery->publish->publishable) }}" class="w-fit h-fit p-2 flex flex-row space-x-2 items-center" draggable="false">
                            <div class="flex flex-col">
                                <span>Published on: </span>
                                <span class="w-fit overflow-x-scroll max-w-40 text-nowrap">{{ $gallery->publish->publishable->name }}</span>
                            </div>
                            @if ($gallery->publish->publishable->avatar != null)
                                <img src="{{ asset('storage/avatars/'.$gallery->publish->publishable->avatar->image->url) }}" alt="{{ asset('storage/avatars/'.$gallery->publish->publishable->avatar->image->url) }}" class="w-10 h-auto aspect-square object-cover rounded-full" draggable="false">
                            @else
                                <div class="w-10 h-auto aspect-square bg-gradient-to-r {{ 'from-' . $preferences['color_2'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_2'] . '-900' }} rounded-full">
                                    <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                                </div>
                            @endif
                        </a>
                    @endif
                </span>
                <span>
                    <a wire:navigate href="{{ route('user', $gallery->user) }}" class="w-fit h-fit p-2 flex flex-row space-x-2 items-center" draggable="false">
                        <div class="flex flex-col">
                            <span>Published by: </span>
                            <span class="w-fit overflow-x-scroll max-w-40 text-nowrap">{{ $gallery->user->username }}</span>
                        </div>
                        @if ($gallery->user->avatar != null)
                            <img src="{{ asset('storage/avatars/'.$gallery->user->avatar->image->url) }}" alt="{{ asset('storage/avatars/'.$gallery->user->avatar->image->url) }}"
                                class="w-10 h-auto aspect-square object-cover rounded-full" draggable="false">
                        @else
                            <div class="w-10 h-auto aspect-square bg-gradient-to-r {{ 'from-' . $preferences['color_2'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_2'] . '-900' }} rounded-full">
                                <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                            </div>
                        @endif
                    </a>
                </span>
                <div class="w-fit h-fit p-2 text-nowrap">
                    <span>Published: </span>
                    <span>{{ $gallery->publish->created_at->toDateString() }}</span>
                </div>
                @auth
                    <div class="flex flex-row space-x-2 space-y-0 items-stretch">
                        <div class="w-fit h-fit flex flex-row space-x-2 space-y-0 items-center justify-center {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg">
                            @if (in_array(Auth::id(), collect($gallery->rates)->where('like', true)->pluck('user_id')->toArray()))
                                <div class="p-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg select-none cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                    </svg>
                                </div>
                                <div class="pr-2 font-semibold">{{ $totalLikes }}</div>
                            @else
                                <div wire:click="$dispatch('like_gallery')" class="p-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg select-none cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                    </svg>
                                </div>
                                <div class="pr-2">{{ $totalLikes }}</div>
                            @endif
                        </div>
                        <div class="w-fit h-fit flex flex-row space-x-2 space-y-0 items-center justify-center {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg">
                            @if (in_array(Auth::id(), collect($gallery->rates)->where('dislike', true)->pluck('user_id')->toArray()))
                                <div class="p-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg select-none cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                                    </svg>
                                </div>
                                <div class="pr-2 font-semibold">{{ $totalDislikes }}</div>
                            @else    
                                <div wire:click="$dispatch('dislike_gallery')" class="p-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg select-none cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                                    </svg>
                                </div>
                                <div class="pr-2">{{ $totalDislikes }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="w-fit h-fit flex flex-row space-x-2 space-y-0 items-center justify-center {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg">
                        <a wire:navigate href="#commentForm" class="w-fit h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg select-none cursor-pointer" draggable="false">Comments</a>
                        <div class="pr-2">{{ $totalComments }}</div>
                    </div>
                @endauth
            </div>
        </div>
        {{-- recommend --}}
        @if ($recommends['tags'] != null)
            <div class="w-full sm:w-11/12 md:w-10/12 lg:w-8/12 h-fit mx-auto p-2 flex flex-col space-x-0 space-y-2 tracking-widest {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="w-fit h-fit {{ 'text-[calc(theme(fontSize.2xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.2xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                        Recommended similar pictures by tags
                    </span>
                </div>
                <div class="grid grid-cols-3 md:grid-cols-5 gap-2">
                    @foreach ($recommends['tags'] as $gallery_1)
                        <a wire:navigate href="{{ route('gallery.show', $gallery_1) }}" draggable="false">
                            <img src="{{ asset('storage/galleries/'.$gallery_1->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery_1->image->url) }}"
                                class="w-full h-40 object-cover rounded-lg" draggable="false">
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
        @if (class_basename($gallery->publish->publishable_type) === 'User')
            @if ($recommends['user'] != null)
                <div class="w-full sm:w-11/12 md:w-10/12 lg:w-8/12 h-fit mx-auto p-2 flex flex-col space-x-0 space-y-2 tracking-widest {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                    <div class="w-fit h-fit {{ 'text-[calc(theme(fontSize.2xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.2xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                            Recommended pictures from user <a wire:navigate href="{{ route('user', $gallery->publish->publishable) }}" draggable="false">{{ $gallery->publish->publishable->username }}</a>
                        </span>
                    </div>
                    <div class="grid grid-cols-3 md:grid-cols-5 gap-2">
                        @foreach ($recommends['user'] as $gallery_2)
                            <a wire:navigate href="{{ route('gallery.show', $gallery_2) }}" draggable="false">
                                <img src="{{ asset('storage/galleries/'.$gallery_2->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery_2->image->url) }}"
                                    class="w-full h-40 object-cover rounded-lg" draggable="false">
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
        @if (class_basename($gallery->publish->publishable_type) === 'Fandom')
            @if ($recommends['fandom'] != null)
                <div class="w-full sm:w-11/12 md:w-10/12 lg:w-8/12 h-fit mx-auto p-2 flex flex-col space-x-0 space-y-2 tracking-widest {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                    <div class="w-fit h-fit {{ 'text-[calc(theme(fontSize.2xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.2xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                            Recommended pictures from fandom <a wire:navigate href="{{ route('fandom-details', $gallery->publish->publishable) }}" draggable="false">{{ $gallery->publish->publishable->name }}</a>
                        </span>
                    </div>
                    <div class="grid grid-cols-3 md:grid-cols-5 gap-2">
                        @foreach ($recommends['fandom'] as $gallery_3)
                            <a wire:navigate href="{{ route('gallery.show', $gallery_3) }}" draggable="false">
                                <img src="{{ asset('storage/galleries/'.$gallery_3->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery_3->image->url) }}"
                                    class="w-full h-40 object-cover rounded-lg" draggable="false">
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
            @if ($recommends['user'] != null)
                <div class="w-full sm:w-11/12 md:w-10/12 lg:w-8/12 h-fit mx-auto p-2 flex flex-col space-x-0 space-y-2 tracking-widest {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                    <div class="w-fit h-fit {{ 'text-[calc(theme(fontSize.2xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.2xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                            Recommended pictures from user <a wire:navigate href="{{ route('user', $gallery->user) }}" draggable="false">{{ $gallery->user->username }}</a>
                        </span>
                    </div>
                    <div class="grid grid-cols-3 md:grid-cols-5 gap-2">
                        @foreach ($recommends['user'] as $gallery_4)
                            <a wire:navigate href="{{ route('gallery.show', $gallery_4) }}" draggable="false">
                                <img src="{{ asset('storage/galleries/'.$gallery_4->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery_4->image->url) }}"
                                    class="w-full h-40 object-cover rounded-lg" draggable="false">
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
        @auth
            <div class="w-full sm:w-11/12 md:w-10/12 lg:w-8/12 h-fit mx-auto">
                @livewire(Comment::class, ['preferences' => $preferences, 'post' => null, 'gallery' => $gallery], key('comment-for-gallery-' . $gallery->id))
            </div>
        @endauth
    </div>
</div>
