<div class="w-screen h-screen p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} relative z-0 overflow-x-clip overflow-y-auto">
    <div class="sticky top-0 z-10 select-none">
        <x-nav :preferences="$preferences" />
    </div>
    <div class="fixed mx-auto inset-x-4 top-20 z-10 select-none">
        <livewire:alert :preferences="$preferences" />
    </div>
    <div class="w-full h-fit flex flex-col lg:flex-row space-x-0 space-y-2 lg:space-x-2 lg:space-y-0 relative">
        <div class="w-full h-fit col-span-6 p-2 {{ 'bg-[' . $preferences['color_primary'] . ']/10' }} backdrop-blur-sm border-0 rounded-lg">
            <div class="w-full p-4 flex flex-col space-x-0 space-y-4 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
                <div class="flex flex-col lg:flex-row space-x-0 space-y-2 lg:space-x-2 lg:space-y-0 justify-center">
                    <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}" class="w-auto max-w-lg rounded-lg" draggable="false">
                    <div class="w-auto h-fit flex flex-col space-x-0 space-y-2">
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
                    </div>
                </div>
                {{-- comment --}}
                {{-- 
                <div>
                </div>
                --}}
                {{-- recommend --}}
                <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                    <div class="font-semibold">Recommended similar pictures by tags</div>
                    <div class="grid grid-cols-3 md:grid-cols-5 gap-2">
                        @foreach ($recommends['tags'] as $gallery)
                            <a href="{{ route('gallery.show', $gallery) }}" draggable="false">
                                <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}"
                                    class="w-full h-40 object-cover rounded-lg" draggable="false">
                            </a>
                        @endforeach
                    </div>
                </div>
                @if (class_basename($gallery->publish->publishable_type) === 'User')
                    @if ($recommends['user'] != null)
                        <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                            <div class="font-semibold">Recommended pictures from <a href="{{ route('user', $gallery->publish->publishable) }}" draggable="false">{{ $gallery->publish->publishable->username }}</a></div>
                            <div class="grid grid-cols-3 md:grid-cols-5 gap-2">
                                @foreach ($recommends['user'] as $gallery)
                                    <a href="{{ route('gallery.show', $gallery) }}" draggable="false">
                                        <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}"
                                            class="w-full h-40 object-cover rounded-lg" draggable="false">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
                @if (class_basename($gallery->publish->publishable_type) === 'Fandom')
                    @if ($recommends['fandom'] != null)
                        <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                            <div class="font-semibold">Recommended pictures from <a href="{{ route('fandom-details', $gallery->publish->publishable) }}" draggable="false">{{ $gallery->publish->publishable->name }}</a></div>
                            <div class="grid grid-cols-3 md:grid-cols-5 gap-2">
                                @foreach ($recommends['fandom'] as $gallery)
                                    <a href="{{ route('gallery.show', $gallery) }}" draggable="false">
                                        <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}"
                                            class="w-full h-40 object-cover rounded-lg" draggable="false">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if ($recommends['user'] != null)
                        <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                            <div class="font-semibold">Recommended pictures from <a href="{{ route('user', $gallery->user) }}" draggable="false">{{ $gallery->user->username }}</a></div>
                            <div class="grid grid-cols-3 md:grid-cols-5 gap-2">
                                @foreach ($recommends['user'] as $gallery)
                                    <a href="{{ route('gallery.show', $gallery) }}" draggable="false">
                                        <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}"
                                            class="w-full h-40 object-cover rounded-lg" draggable="false">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
