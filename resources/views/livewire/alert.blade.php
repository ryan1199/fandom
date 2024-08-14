<div x-data="{ open: @entangle('open').live }" x-cloak x-show="open" x-transition class="w-fit h-fit mx-auto {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} absolute inset-x-0 top-4 z-10 shadow {{ 'shadow-' . $preferences['color_2'] . '-500' }} rounded-lg">
    <div class="w-fit h-fit p-4 flex flex-row space-x-4 space-y-0 justify-start items-center {{ 'text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50' }} backdrop-blur-sm rounded-lg">
        <p class="font-semibold">{{ $message }}</p>
        <svg @click="open = !open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 {{ 'text-' . $preferences['color_2'] . '-50' }} {{ 'bg-' . $preferences['color_2'] . '-900' }} {{ 'hover:bg-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer animation-button">
            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
        </svg>
    </div>
</div>