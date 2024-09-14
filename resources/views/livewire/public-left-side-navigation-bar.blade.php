<div class="w-fit h-fit max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50/70' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-r-lg select-none overflow-y-auto absolute top-0 left-0 z-20">
    <div x-data="{ openLeftSideNavigationBar: false }" class="w-fit h-fit p-2 flex flex-col space-x-0 space-y-2">
        <div x-on:click="openLeftSideNavigationBar = ! openLeftSideNavigationBar" class="w-full h-fit p-2 flex flex-row justify-center items-center {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>
        </div>
        <div x-cloak x-show="openLeftSideNavigationBar" class="w-full sm:w-screen max-w-full sm:max-w-sm h-fit flex flex-col space-x-0 space-y-2">
            <a wire:navigate href="{{ route('home') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Fandom</a>
            <a wire:navigate href="{{ route('login') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Login</a>
            <a wire:navigate href="{{ route('register') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Register</a>
            <a wire:navigate href="{{ route('fandom-list') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Fandom list</a>
            <a wire:navigate href="{{ route('post') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Post</a>
            <a wire:navigate href="{{ route('gallery') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Gallery</a>
        </div>
    </div>
</div>
