<div class="container h-full mx-auto p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} relative z-0">
    <div class="select-none">
        <x-nav :preferences="$preferences" />
    </div>
    <div class="fixed mx-auto inset-x-4 top-20 z-10 select-none">
        <livewire:alert :preferences="$preferences" />
    </div>
    <div class="w-full h-fit mx-auto">
        <div class="w-full h-fit col-span-6 p-2 {{ 'bg-[' . $preferences['color_primary'] . ']/10' }} backdrop-blur-sm border-0 rounded-lg">
            <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 rounded-lg">
                <div class="w-full p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
                    <div class="flex flex-col lg:flex-row space-x-0 space-y-2 lg:space-x-2 lg:space-y-0 justify-center">
                        <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}" class="w-full max-w-lg mx-auto lg:mx-0 object-contain rounded-lg" draggable="false">
                        <div class="w-full lg:w-fit h-fit flex flex-col space-x-0 space-y-2">
                            <p class="w-fit h-fit p-2 rounded-lg">Tags: {{ $gallery->tags }}</p>
                            <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                            <p class="w-fit h-fit p-2 rounded-lg">Views: {{ $gallery->view }}</p>
                            <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                            <p class="w-fit h-fit p-2 flex flex-row space-x-2 items-center">
                                <span>Uploaded on</span>
                                <span>
                                    @if (class_basename($gallery->publish->publishable_type) === 'User')
                                        <a href="{{ route('user', $gallery->publish->publishable) }}" class="w-fit h-fit p-2 flex flex-row space-x-2 items-center border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg" draggable="false">
                                            <span>{{ $gallery->publish->publishable->username }}</span>
                                            <img src="{{ asset('storage/avatars/'.$gallery->publish->publishable->avatar->image->url) }}"
                                                alt="{{ asset('storage/avatars/'.$gallery->publish->publishable->avatar->image->url) }}" class="w-10 h-auto aspect-square object-cover rounded-full" draggable="false">
                                        </a>
                                    @else
                                        <a href="{{ route('fandom-details', $gallery->publish->publishable) }}" class="w-fit h-fit p-2 flex flex-row space-x-2 items-center border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg" draggable="false">
                                            <span>{{ $gallery->publish->publishable->name }}</span>
                                            <img src="{{ asset('storage/avatars/'.$gallery->publish->publishable->avatar->image->url) }}"
                                                alt="{{ asset('storage/avatars/'.$gallery->publish->publishable->avatar->image->url) }}" class="w-10 h-auto aspect-square object-cover rounded-full" draggable="false">
                                        </a>
                                    @endif
                                </span>
                            </p>
                            <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                            <p class="w-fit h-fit p-2 flex flex-row space-x-2 items-center rounded-lg">
                                <span>Uploaded by</span>
                                <span>
                                    <a href="{{ route('user', $gallery->user) }}" class="w-fit h-fit p-2 flex flex-row space-x-2 items-center border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg" draggable="false">
                                        <span>{{ $gallery->user->username }}</span>
                                        <img src="{{ asset('storage/avatars/'.$gallery->user->avatar->image->url) }}" alt="{{ asset('storage/avatars/'.$gallery->user->avatar->image->url) }}"
                                            class="w-10 h-auto aspect-square object-cover rounded-full" draggable="false">
                                    </a>
                                </span>
                            </p>
                            @auth
                                <div class="flex flex-row flex-wrap">
                                    <div class="mr-2 flex flex-row space-x-2 space-y-0 items-stretch">
                                        <div class="flex flex-col space-x-0 space-y-1 items-center justify-center">
                                            @if (in_array(Auth::id(), collect($gallery->rates)->where('like', true)->pluck('user_id')->toArray()))
                                                <div class="p-2 border-2 {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg select-none cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                                    </svg>
                                                </div>
                                            @else
                                                <div wire:click="$dispatch('like_gallery')" class="p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg select-none cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>{{ collect($gallery->rates)->where('like', true)->count() }}</div>
                                        </div>
                                        <div class="flex flex-col space-x-0 space-y-1 items-center justify-center">
                                            @if (in_array(Auth::id(), collect($gallery->rates)->where('dislike', true)->pluck('user_id')->toArray()))
                                                <div class="p-2 border-2 {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg select-none cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                                                    </svg>
                                                </div>
                                            @else    
                                                <div wire:click="$dispatch('dislike_gallery')" class="p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg select-none cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>{{ collect($gallery->rates)->where('dislike', true)->count() }}</div>
                                        </div>
                                    </div>
                                    <div class="mr-2 flex flex-row space-x-2 space-y-0 items-stretch">
                                        <div class="flex flex-col space-x-0 space-y-1 items-center justify-center">
                                            <a href="#commentForm" class="w-fit h-fit p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg select-none cursor-pointer" draggable="false">Comments</a>
                                            <div>{{ collect($gallery->comments)->count() }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
                {{-- recommend --}}
                @if ($recommends['tags'] != null)
                    <div class="w-full p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
                        <div class="font-semibold my-2">Recommended similar pictures by tags</div>
                        <div class="grid grid-cols-3 md:grid-cols-5 gap-2">
                            @foreach ($recommends['tags'] as $gallery_1)
                                <a href="{{ route('gallery.show', $gallery_1) }}" draggable="false">
                                    <img src="{{ asset('storage/galleries/'.$gallery_1->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery_1->image->url) }}"
                                        class="w-full h-40 object-cover rounded-lg" draggable="false">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (class_basename($gallery->publish->publishable_type) === 'User')
                    @if ($recommends['user'] != null)
                        <div class="w-full p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
                            <div class="font-semibold my-2">Recommended pictures from user <a href="{{ route('user', $gallery->publish->publishable) }}" draggable="false">{{ $gallery->publish->publishable->username }}</a></div>
                            <div class="grid grid-cols-3 md:grid-cols-5 gap-2">
                                @foreach ($recommends['user'] as $gallery_2)
                                    <a href="{{ route('gallery.show', $gallery_2) }}" draggable="false">
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
                        <div class="w-full p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
                            <div class="font-semibold my-2">Recommended pictures from fandom <a href="{{ route('fandom-details', $gallery->publish->publishable) }}" draggable="false">{{ $gallery->publish->publishable->name }}</a></div>
                            <div class="grid grid-cols-3 md:grid-cols-5 gap-2">
                                @foreach ($recommends['fandom'] as $gallery_3)
                                    <a href="{{ route('gallery.show', $gallery_3) }}" draggable="false">
                                        <img src="{{ asset('storage/galleries/'.$gallery_3->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery_3->image->url) }}"
                                            class="w-full h-40 object-cover rounded-lg" draggable="false">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if ($recommends['user'] != null)
                        <div class="w-full p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
                            <div class="font-semibold my-2">Recommended pictures from user <a href="{{ route('user', $gallery->user) }}" draggable="false">{{ $gallery->user->username }}</a></div>
                            <div class="grid grid-cols-3 md:grid-cols-5 gap-2">
                                @foreach ($recommends['user'] as $gallery_4)
                                    <a href="{{ route('gallery.show', $gallery_4) }}" draggable="false">
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
                        @livewire(Comment::class, ['preferences' => $preferences, 'post' => null, 'gallery' => $gallery])
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
