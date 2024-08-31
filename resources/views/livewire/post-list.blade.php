<div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none">
    @if ($from == 'post-management')
        @foreach ($posts as $post)
            <div wire:key="{{ 'post-' . $post->id . '-from-' . $from . '-page' }}" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-950' }} backdrop-blur-xl {{ 'text-' . $preferences['color_2'] . '-100' }} rounded-lg">
                @livewire(PostCard::class, ['post' => $post->id, 'preferences' => $preferences], key('post-' . $post->id . '-from-' . $from . '-page-' . now()))
                <div class="flex flex-row justify-between items-start">
                    <div class="flex flex-col space-x-0 space-y-2">
                        <p class="text-left"><span class="font-semibold">Created</span> by {{ $post->user->username }} {{ $post->created_at->diffForHumans(['options' => null]) }}</p>
                        <p class="text-left">
                            @if ($post->publish != null)
                                <span class="font-semibold">Published</span> on
                                @if (class_basename($post->publish->publishable_type) === 'User')
                                    {{ $post->publish->publishable->username }}
                                @else
                                    {{ $post->publish->publishable->name }}
                                @endif
                            @else
                                <span class="font-semibold">Unpublished</span>
                            @endif
                        </p>
                    </div>
                    <div class="flex flex-row space-x-2 space-y-0 items-center">
                        <svg wire:click="editPost({{ $post->id }})" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                        </svg>
                        <svg wire:click="deletePost({{ $post->id }})" wire:confirm="Are you sure you want to delete this post?" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="flex flex-col space-x-0 space-y-1 select-none">
                    @if ($post->publish_id == null)
                        <div x-data="{ {{ 'open_publish_on_for_post_' . $post->id }}: false }" class="flex flex-col space-x-0 space-y-1">
                            <div x-on:click="{{ 'open_publish_on_for_post_' . $post->id }} = ! {{ 'open_publish_on_for_post_' . $post->id }}" class="w-fit h-fit mx-auto p-2 text-center font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">Publish On</div>
                            <div x-cloak x-show="{{ 'open_publish_on_for_post_' . $post->id }}" class="flex flex-col space-x-0 space-y-2 rounded-lg">
                                @foreach ($publish_on as $array)
                                    @if ($array['from'] == 'user')
                                        <div wire:key="{{ 'post-list-from-' . $from . '-publish-on-user-' . $array['data']->id }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} backdrop-blur-xl {{ 'text-' . $preferences['color_2'] . '-900' }} rounded-lg">
                                            <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                                                <div class="{{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                                    <h1 class="bg-clip-text line-clamp-2 text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">{{ $array['data']->username }}</h1>
                                                </div>
                                                <div class="w-full h-[15vh] relative">
                                                    @if ($array['data']->cover !== null)
                                                        <img src="{{ asset('storage/covers/'.$array['data']->cover->image->url) }}" alt="Cover image {{ $array['data']->username }}" title="Cover image {{ $array['data']->username }}" class="w-full h-full object-cover block rounded-lg" draggable="false">
                                                    @else
                                                        <div class="w-full h-full bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} rounded-lg">
                                                            <div style="background-image: url('{{ asset('cover-white.svg') }}')" class="w-full h-[15vh] bg-repeat bg-center rounded-lg"></div>
                                                        </div>
                                                    @endif
                                                    @if ($array['data']->avatar !== null)
                                                        <img src="{{ asset('storage/avatars/'.$array['data']->avatar->image->url) }}" alt="Avatar image {{ $array['data']->username }}" title="Avatar image {{ $array['data']->username }}" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square object-cover rounded-full" draggable="false">
                                                    @else
                                                        <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square bg-gradient-to-tr {{ 'from-' . $preferences['color_2'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_2'] . '-900' }} rounded-full">
                                                            <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="w-full h-full flex flex-row space-x-2 space-y-0 text-left">
                                                    <div wire:click="publishPost({{ $post }}, '{{ $array['from'] }}', {{ Auth::id() }}, 'self')" class="w-fit h-fit p-1 text-center border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg cursor-pointer {{ 'hover:border-' . $preferences['color_2'] . '-500' }} active:border-2 rounded-lg cursor-pointer animation-button">Self</div>
                                                    <div wire:click="publishPost({{ $post }}, '{{ $array['from'] }}', {{ Auth::id() }}, 'friend')" class="w-fit h-fit p-1 text-center border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg cursor-pointer {{ 'hover:border-' . $preferences['color_2'] . '-500' }} active:border-2 rounded-lg cursor-pointer animation-button">Friend</div>
                                                    <div wire:click="publishPost({{ $post }}, '{{ $array['from'] }}', {{ Auth::id() }}, 'public')" class="w-fit h-fit p-1 text-center border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg cursor-pointer {{ 'hover:border-' . $preferences['color_2'] . '-500' }} active:border-2 rounded-lg cursor-pointer animation-button">Public</div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div wire:key="{{ 'post-list-from-' . $from . 'publish-on-fandom-' . $array['data']->id }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} backdrop-blur-xl {{ 'text-' . $preferences['color_2'] . '-900' }} rounded-lg">
                                            <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                                                <div class="{{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                                    <h1 class="bg-clip-text line-clamp-2 text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">{{ $array['data']->name }}</h1>
                                                </div>
                                                <div class="w-full h-[15vh] relative">
                                                    @if ($array['data']->cover !== null)
                                                        <img src="{{ asset('storage/covers/'.$array['data']->cover->image->url) }}" alt="Cover image {{ $array['data']->name }}" title="Cover image {{ $array['data']->name }}" class="w-full h-full object-cover block rounded-lg" draggable="false">
                                                    @else
                                                        <div class="w-full h-fit bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} rounded-lg">
                                                            <div style="background-image: url('{{ asset('cover-white.svg') }}')" class="w-full h-[15vh] bg-repeat bg-center rounded-lg"></div>
                                                        </div>
                                                    @endif
                                                    @if ($array['data']->avatar !== null)
                                                        <img src="{{ asset('storage/avatars/'.$array['data']->avatar->image->url) }}" alt="Avatar image {{ $array['data']->name }}" title="Avatar image {{ $array['data']->name }}" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square object-cover rounded-full" draggable="false">
                                                    @else
                                                        <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square bg-gradient-to-tr {{ 'from-' . $preferences['color_2'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_2'] . '-900' }} rounded-full">
                                                            <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="w-full h-full flex flex-row space-x-2 space-y-0 text-left">
                                                    <div wire:click="publishPost({{ $post }}, '{{ $array['from'] }}', {{ $array['data']->id }}, 'member')" class="w-fit h-fit p-1 text-center border {{ 'border-' . $preferences['color_2'] .'-200' }} rounded-lg cursor-pointer {{ 'hover:border-' . $preferences['color_2'] . '-500' }} active:border-2 rounded-lg cursor-pointer animation-button">Member</div>
                                                    <div wire:click="publishPost({{ $post }}, '{{ $array['from'] }}', {{ $array['data']->id }}, 'public')" class="w-fit h-fit p-1 text-center border {{ 'border-' . $preferences['color_2'] .'-200' }} rounded-lg cursor-pointer {{ 'hover:border-' . $preferences['color_2'] . '-500' }} active:border-2 rounded-lg cursor-pointer animation-button">Public</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div wire:click="unpublishPost({{ $post->id }})" wire:confirm="Are you sure you want to unpublish this post?" class="w-fit h-fit mx-auto p-2 text-center font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">Unpublished</div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
    @if ($from == 'fandom')
        @foreach ($posts as $post)
            @livewire(PostCard::class, ['post' => $post->id, 'preferences' => $preferences], key('post-' . $post->id . '-from-' . $from . '-page'))
        @endforeach
    @endif
    @if ($from == 'post')
        <div class="w-full h-fit grid gap-2 grid-cols-3">
            @forelse ($posts as $post)
                @livewire(PostCard::class, ['post' => $post->id, 'preferences' => $preferences], key('post-' . $post->id . '-from-' . $from . '-page'))
            @empty
                <div class="w-screen max-w-full h-full py-12 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                    <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        No posts found
                    </div>
                </div>
            @endforelse
        </div>
    @endif
</div>