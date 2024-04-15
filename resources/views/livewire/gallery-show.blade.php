<div
    class="w-screen h-screen max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center relative z-0">
    <livewire:alert />
    <div class="container h-fit max-h-[calc(100%-48px)] overflow-clip">
        <div
            class="container h-fit max-h-[calc(100vh-96px)] col-span-6 p-4 bg-[{{ $preferences['color_primary'] }}]/10 backdrop-blur-sm border-0 border-transparent rounded-lg overflow-clip">
            <div wire:scroll
                class="container max-h-[calc(100vh-128px)] p-4 flex flex-col space-x-0 space-y-4 bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-lg overflow-y-auto">
                <div class="grid grid-cols-2 gap-2">
                    <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="" class="w-full rounded-lg">
                    <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                        <p class="w-fit h-fit p-2 rounded-lg">Tags: {{ $gallery->tags }}</p>
                        <hr>
                        <p class="w-fit h-fit p-2 rounded-lg">Views: {{ $gallery->view }}</p>
                        <hr>
                        <p class="w-fit h-fit p-2 flex flex-row space-x-2 items-center rounded-lg">
                            <span>
                                Uploaded on
                            </span>
                            <span class="w-fit h-fit p-2 flex flex-row space-x-2 items-center border rounded-lg">
                                @if (class_basename($gallery->publish->publishable_type) === 'User')
                                <span>
                                    <a href="{{ route('user', $gallery->publish->publishable) }}">
                                        {{ $gallery->publish->publishable->username }}
                                    </a>
                                </span>
                                <a href="{{ route('user', $gallery->publish->publishable) }}">
                                    <img src="{{ asset('storage/avatars/'.$gallery->publish->publishable->avatar->image->url) }}"
                                        alt="" class="w-10 h-auto aspect-square object-cover rounded-full">
                                </a>
                                @else
                                <span>
                                    <a href="{{ route('fandom-details', $gallery->publish->publishable) }}">
                                        {{ $gallery->publish->publishable->name }}
                                    </a>
                                </span>
                                <a href="{{ route('fandom-details', $gallery->publish->publishable) }}">
                                    <img src="{{ asset('storage/avatars/'.$gallery->publish->publishable->avatar->image->url) }}"
                                        alt="" class="w-10 h-auto aspect-square object-cover rounded-full">
                                </a>
                                @endif
                            </span>
                        </p>
                        <hr>
                        <p class="w-fit h-fit p-2 flex flex-row space-x-2 items-center rounded-lg">
                            <span>
                                Uploaded by
                            </span>
                            <span class="w-fit h-fit p-2 flex flex-row space-x-2 items-center border rounded-lg">
                                <span>
                                    <a href="{{ route('user', $gallery->user) }}">
                                        {{ $gallery->user->username }}
                                    </a>
                                </span>
                                <a href="{{ route('user', $gallery->user) }}">
                                    <img src="{{ asset('storage/avatars/'.$gallery->user->avatar->image->url) }}" alt=""
                                        class="w-10 h-auto aspect-square object-cover rounded-full">
                                </a>
                            </span>
                        </p>
                    </div>
                </div>
                {{-- comment --}}
                {{-- <div>
                    
                </div> --}}
                {{-- recommend --}}
                <div
                    class="w-full h-fit p-4 flex flex-col space-x-0 space-y-2 border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
                    <div>Recommended similar pictures by tags</div>
                    <div class="grid grid-cols-5 gap-2">
                        @foreach ($recommends['tags'] as $gallery)
                        <a href="{{ route('gallery.show', $gallery) }}">
                            <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt=""
                                class="w-full h-40 object-cover rounded-lg">
                        </a>
                        @endforeach
                    </div>
                </div>
                @if (class_basename($gallery->publish->publishable_type) === 'User')
                @if ($recommends['user'] != null)
                <div
                    class="w-full h-fit p-4 flex flex-col space-x-0 space-y-2 border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
                    <div>Recommended pictures from <a
                            href="{{ route('user', $gallery->publish->publishable) }}">{{ $gallery->publish->publishable->username }}</a>
                    </div>
                    <div class="grid grid-cols-5 gap-2">
                        @foreach ($recommends['user'] as $gallery)
                        <a href="{{ route('gallery.show', $gallery) }}">
                            <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt=""
                                class="w-full h-40 object-cover rounded-lg">
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                @endif
                @if (class_basename($gallery->publish->publishable_type) === 'Fandom')
                @if ($recommends['fandom'] != null)
                <div
                    class="w-full h-fit p-4 flex flex-col space-x-0 space-y-2 border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
                    <div>Recommended pictures from <a
                            href="{{ route('fandom-details', $gallery->publish->publishable) }}">{{ $gallery->publish->publishable->name }}</a>
                    </div>
                    <div class="grid grid-cols-5 gap-2">
                        @foreach ($recommends['fandom'] as $gallery)
                        <a href="{{ route('gallery.show', $gallery) }}">
                            <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt=""
                                class="w-full h-40 object-cover rounded-lg">
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                @if ($recommends['user'] != null)
                <div
                    class="w-full h-fit p-4 flex flex-col space-x-0 space-y-2 border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
                    <div>Recommended pictures from <a
                            href="{{ route('user', $gallery->user) }}">{{ $gallery->user->username }}</a></div>
                    <div class="grid grid-cols-5 gap-2">
                        @foreach ($recommends['user'] as $gallery)
                        <a href="{{ route('gallery.show', $gallery) }}">
                            <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt=""
                                class="w-full h-40 object-cover rounded-lg">
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
    <x-nav :preferences="$preferences" />
</div>