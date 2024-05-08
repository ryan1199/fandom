<div class="container h-full mx-auto p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} relative z-0">
    <div class="select-none">
        <x-nav :preferences="$preferences" />
    </div>
    <div class="fixed mx-auto inset-x-4 top-20 z-10 select-none">
        <livewire:alert :preferences="$preferences" />
    </div>
    <div class="w-full h-fit relative">
        <div class="w-full h-fit col-span-6 p-2 {{ 'bg-[' . $preferences['color_primary'] . ']/10' }} backdrop-blur-sm border-0 rounded-lg">
            <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 rounded-lg">
                <div class="w-full p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
                    <div class="flex flex-col lg:flex-row space-x-0 space-y-2 lg:space-x-2 lg:space-y-0 justify-center">
                        <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}" class="w-full max-w-lg mx-auto lg:mx-0 rounded-lg" draggable="false">
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
                        </div>
                    </div>
                </div>
                {{-- recommend --}}
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
                @if (class_basename($gallery->publish->publishable_type) === 'User')
                    @if ($recommends['user'] != null)
                        <div class="w-full p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
                            <div class="font-semibold my-2">Recommended pictures from <a href="{{ route('user', $gallery->publish->publishable) }}" draggable="false">{{ $gallery->publish->publishable->username }}</a></div>
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
                            <div class="font-semibold my-2">Recommended pictures from <a href="{{ route('fandom-details', $gallery->publish->publishable) }}" draggable="false">{{ $gallery->publish->publishable->name }}</a></div>
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
                            <div class="font-semibold my-2">Recommended pictures from <a href="{{ route('user', $gallery->user) }}" draggable="false">{{ $gallery->user->username }}</a></div>
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
                {{-- comment --}}
                <livewire:comment :preferences="$preferences" from="gallery" :id="$gallery->id"/>
            </div>
        </div>
    </div>
</div>
