<div
    @if ($fandom->cover != null)
        style="background-image: url('{{ asset('storage/covers/'.$fandom->cover->image->url) }}')"
    @else
        style="background-image: url('{{ asset('cover-black.svg') }}')"
    @endif
    class="w-full h-fit p-4 bg-cover bg-no-repeat bg-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
    <div class="w-full max-w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/10' }} backdrop-blur-xl {{ 'text-' . $preferences['color_2'] . '-100' }} {{ 'selection:bg-' . $preferences['color_2'] . '-50' }} {{ 'selection:text-' . $preferences['color_2'] . '-500' }} rounded-lg">
        <h2 class="w-full h-fit overflow-x-scroll max-w-full text-nowrap {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-semibold">{{ $fandom->name }}</h2>
        <p class="w-full h-fit max-h-20 overflow-y-auto">
            {{ $fandom->description }}
        </p>
        <div class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center justify-between">
            <div x-data="{ openTotalMembers: false, openTotalGalleries: false, openTotalPosts: false }" class="flex flex-row space-x-2 space-y-0 items-center select-none">
                <p x-on:click="openTotalMembers = ! openTotalMembers, openTotalGalleries = false, openTotalPosts = false" class="w-fit h-fit p-1 flex flex-row space-x-1 space-y-0 items-center {{ 'bg-' . $preferences['color_2'] . '-50/10' }} rounded-full" title="{{ $totalMembers }} members">
                    <span>
                        {{ $totalMembers }}
                    </span>
                    <svg x-cloak x-show="!openTotalMembers" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                    </svg>
                    <span x-cloak x-show="openTotalMembers">
                        members
                    </span>
                </p>
                <p x-on:click="openTotalGalleries = ! openTotalGalleries, openTotalMembers = false, openTotalPosts = false" class="w-fit h-fit p-1 flex flex-row space-x-1 space-y-0 items-center {{ 'bg-' . $preferences['color_2'] . '-50/10' }} rounded-full" title="{{ $totalGalleries }} galleries">
                    <span>
                        {{ $totalGalleries }}
                    </span>
                    <svg x-cloak x-show="!openTotalGalleries" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                    </svg>
                    <span x-cloak x-show="openTotalGalleries">
                        galleries
                    </span>
                </p>
                <p x-on:click="openTotalPosts = ! openTotalPosts, openTotalMembers = false, openTotalGalleries = false" class="w-fit h-fit p-1 flex flex-row space-x-1 space-y-0 items-center {{ 'bg-' . $preferences['color_2'] . '-50/10' }} rounded-full" title="{{ $totalPosts }} posts">
                    <span>
                        {{ $totalPosts }}
                    </span>
                    <svg x-cloak x-show="!openTotalPosts" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 0 0 3 3h15a3 3 0 0 1-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125ZM12 9.75a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H12Zm-.75-2.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5H12a.75.75 0 0 1-.75-.75ZM6 12.75a.75.75 0 0 0 0 1.5h7.5a.75.75 0 0 0 0-1.5H6Zm-.75 3.75a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5H6a.75.75 0 0 1-.75-.75ZM6 6.75a.75.75 0 0 0-.75.75v3c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75v-3A.75.75 0 0 0 9 6.75H6Z" clip-rule="evenodd" />
                        <path d="M18.75 6.75h1.875c.621 0 1.125.504 1.125 1.125V18a1.5 1.5 0 0 1-3 0V6.75Z" />
                    </svg>
                    <span x-cloak x-show="openTotalPosts">
                        posts
                    </span>
                </p>
            </div>
            <a wire:navigate.hover href="{{ route('fandom-details', $fandom) }}" class="self-end" draggable="false" title="{{ $fandom->name }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                    <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</div>