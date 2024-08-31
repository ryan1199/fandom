<div class="w-full h-full {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }}">
    @if ($from == 'gallery-management')
        <div class="w-full h-fit grid gap-2 grid-cols-1">
            @forelse ($galleries as $gallery)
                <div wire:key="{{ 'gallery-' . $gallery->id . '-from-' . $from . '-page' }}" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-950' }} backdrop-blur-xl {{ 'text-' . $preferences['color_2'] . '-100' }} rounded-lg">
                    @livewire(GalleryCard::class, ['gallery' => $gallery->id, 'preferences' => $preferences], key('gallery-' . $gallery->id . '-from-' . $from . '-page-' . now()))
                    <div class="flex flex-col space-x-0 space-y-2">
                        <div class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-between items-start">
                            <div class="flex flex-col space-x-0 space-y-2">
                                <p class="text-left"><span class="font-semibold">Uploaded</span> by {{ $gallery->user->username }} {{ $gallery->created_at->diffForHumans(['options' => null]) }}</p>
                                <p class="text-left">
                                    @if ($gallery->publish != null)
                                        <span class="font-semibold">Published:</span>
                                        @if (class_basename($gallery->publish->publishable_type) === 'User')
                                            {{ $gallery->publish->publishable->username }}
                                        @else
                                            {{ $gallery->publish->publishable->name }}
                                        @endif
                                    @else
                                        <span class="font-semibold">Unpublished</span>
                                    @endif
                                </p>
                            </div>
                            <div class="w-fit h-fit flex flex-row space-x-2 space-y-0 items-center">
                                <svg wire:click="editGallery({{ $gallery->id }})" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                </svg>
                                <svg wire:click="deleteGallery({{ $gallery->id }})" wire:confirm="Are you sure you want to delete this image?" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="w-screen max-w-full h-full py-12 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                    <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        No galleries found
                    </div>
                </div>
            @endforelse
        </div>
    @endif
    @if ($from == 'fandom')
        <div class="w-full h-fit grid gap-2 grid-cols-2">
            @forelse ($galleries as $gallery)
                @livewire(GalleryCard::class, ['gallery' => $gallery->id, 'preferences' => $preferences], key('gallery-' . $gallery->id . '-from-' . $from . '-page'))
                {{-- <div wire:key="{{ 'gallery-list-from-' . $from . '-gallery-' . $gallery->id }}" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-between border {{ 'border-' . $preferences['color_2'] . '-200' }} group {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer animation">
                    <div class="flex flex-col space-x-0 space-y-2">
                        <a wire:navigate href="{{ route('gallery.show', $gallery) }}" draggable="false">
                            <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}" class="w-full h-40 object-cover object-center rounded-lg" draggable="false">
                        </a>
                        <p class="text-left {{ 'group-hover:text-' . $preferences['color_2'] . '-500' }} animation"><span class="font-semibold">Uploaded</span> by {{ $gallery->user->username }} {{ $gallery->created_at->diffForHumans(['options' => null]) }}</p>
                    </div>
                </div> --}}
            @empty
                <div class="w-screen max-w-full h-full py-12 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                    <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        No galleries found
                    </div>
                </div>
            @endforelse
        </div>
    @endif
    @if ($from == 'gallery')
        <div class="w-full h-fit grid gap-2 grid-cols-3">
            @forelse ($galleries as $gallery)
                @livewire(GalleryCard::class, ['gallery' => $gallery->id, 'preferences' => $preferences], key('gallery-' . $gallery->id . '-from-' . $from . '-page'))
            @empty
                <div class="w-screen max-w-full h-full py-12 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                    <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        No galleries found
                    </div>
                </div>
            @endforelse
        </div>
    @endif
</div>
