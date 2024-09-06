<div class="shrink-0 w-full h-fit bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} {{ 'selection:bg-' . $preferences['color_2'] . '-50' }} {{ 'selection:text-' . $preferences['color_2'] . '-500' }} rounded-lg">
    <div
        @if ($cover != null)
            style="background-image: url('{{ asset('storage/covers/'.$cover) }}')"
        @else
            style="background-image: url('{{ asset('cover-black.svg') }}')"
        @endif
        class="w-full h-fit p-4 bg-cover bg-no-repeat bg-center rounded-lg">
        <div class="w-full max-w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/10' }} backdrop-blur-xl {{ 'text-' . $preferences['color_2'] . '-100' }} {{ 'selection:bg-' . $preferences['color_2'] . '-50' }} {{ 'selection:text-' . $preferences['color_2'] . '-500' }} rounded-lg">
            <h2 class="w-full h-fit overflow-x-scroll max-w-full text-nowrap {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-semibold">{{ $name }}</h2>
            <p class="w-full h-fit max-h-20 overflow-y-auto">
                {{ $description }}
            </p>
            <div class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center justify-between">
                <div class="{{ 'text-' . $preferences['color_2'] . '-100' }}">Role: {{ $role }}</div>
                <a wire:navigate.hover href="{{ route('fandom-details', $fandom->slug) }}" class="self-end" draggable="false" title="{{ $name }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                        <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>