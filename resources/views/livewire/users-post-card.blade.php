<div class="w-full max-w-full h-fit bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} {{ 'selection:bg-' . $preferences['color_2'] . '-50' }} {{ 'selection:text-' . $preferences['color_2'] . '-500' }} shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
    <div
        @if ($published != null && $hasCover !== null)
            style="background-image: url('{{ asset('storage/covers/'.$cover) }}')" class="w-full h-fit p-4 bg-cover bg-no-repeat bg-center rounded-lg"
        @else
            style="background-image: url('{{ asset('cover-black.svg') }}')" class="w-full h-fit p-4 bg-repeat bg-center rounded-lg"
        @endif>
        <div class="w-full max-w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/10' }} backdrop-blur-xl {{ 'text-' . $preferences['color_2'] . '-100' }} rounded-lg">
            <h2 class="w-full h-fit overflow-x-scroll max-w-full text-nowrap {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-semibold">{{ $post->title }}</h2>
            <p class="w-full h-fit max-h-20 overflow-y-auto">
                {{ $post->description }}
            </p>
            <div class="w-fit h-fit pb-1 flex flex-row flex-wrap text-left">
                <span class="mr-1 mb-1 font-semibold">Tags: </span>
                @foreach (explode(',', $post->tags) as $tag)
                    @if ($loop->last)
                        <span class="mr-1 mb-1 text-wrap break-all">{{ $tag }}</span>
                    @else
                        <span class="mr-1 mb-1 text-wrap break-all">{{ $tag }},</span>
                    @endif
                @endforeach
            </div>
            <div class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center justify-between">
                <div x-data="{ open_views: false, open_likes: false, open_dislikes: false }" class="max-w-full text-nowrap flex flex-row space-x-2 space-y-0 items-center select-none overflow-x-scroll">
                    <p class="max-w-full overflow-x-auto text-nowrap">{{ $publisher }}</p>
                    <p x-on:click="open_views = ! open_views, open_likes = false, open_dislikes = false" class="w-fit h-fit p-1 flex flex-row space-x-1 space-y-0 items-center {{ 'bg-' . $preferences['color_2'] . '-50/10' }} rounded-full" title="{{ $views }} views">
                        <span>
                            {{ $views }}
                        </span>
                        <svg x-cloak x-show="!open_views" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                        </svg>
                        <span x-cloak x-show="open_views">
                            views
                        </span>
                    </p>
                    <p x-on:click="open_likes = ! open_likes, open_views = false, open_dislikes = false" class="w-fit h-fit p-1 flex flex-row space-x-1 space-y-0 items-center {{ 'bg-' . $preferences['color_2'] . '-50/10' }} rounded-full" title="{{ $likes }} likes">
                        <span>
                            {{ $likes }}
                        </span>
                        <svg x-cloak x-show="!open_likes" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                        </svg>
                        <span x-cloak x-show="open_likes">
                            likes
                        </span>
                    </p>
                    <p x-on:click="open_dislikes = ! open_dislikes, open_views = false, open_likes = false" class="w-fit h-fit p-1 flex flex-row space-x-1 space-y-0 items-center {{ 'bg-' . $preferences['color_2'] . '-50/10' }} rounded-full" title="{{ $dislikes }} dislikes">
                        <span>
                            {{ $dislikes }}
                        </span>
                        <svg x-cloak x-show="!open_dislikes" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path d="M15.73 5.5h1.035A7.465 7.465 0 0 1 18 9.625a7.465 7.465 0 0 1-1.235 4.125h-.148c-.806 0-1.534.446-2.031 1.08a9.04 9.04 0 0 1-2.861 2.4c-.723.384-1.35.956-1.653 1.715a4.499 4.499 0 0 0-.322 1.672v.633A.75.75 0 0 1 9 22a2.25 2.25 0 0 1-2.25-2.25c0-1.152.26-2.243.723-3.218.266-.558-.107-1.282-.725-1.282H3.622c-1.026 0-1.945-.694-2.054-1.715A12.137 12.137 0 0 1 1.5 12.25c0-2.848.992-5.464 2.649-7.521C4.537 4.247 5.136 4 5.754 4H9.77a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23ZM21.669 14.023c.536-1.362.831-2.845.831-4.398 0-1.22-.182-2.398-.52-3.507-.26-.85-1.084-1.368-1.973-1.368H19.1c-.445 0-.72.498-.523.898.591 1.2.924 2.55.924 3.977a8.958 8.958 0 0 1-1.302 4.666c-.245.403.028.959.5.959h1.053c.832 0 1.612-.453 1.918-1.227Z" />
                        </svg>
                        <span x-cloak x-show="open_dislikes">
                            dislikes
                        </span>
                    </p>
                </div>
                <a wire:navigate.hover href="{{ route('post.show', $post) }}" class="w-fit h-fit" draggable="false" title="{{ $post->title }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                        <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>