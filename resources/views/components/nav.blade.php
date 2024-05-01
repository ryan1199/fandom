@guest
    <div class="w-fit h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']/10' }} backdrop-blur-sm border-0 rounded-full">
        <nav class="w-fit h-[50px] p-1 flex flex-row space-x-2 space-y-0 justify-center items-center {{ 'bg-[' . $preferences['color_primary'] . ']' }} backdrop-blur-sm border-0 rounded-full select-none">
            <a wire:navigate.hover href="{{ route('home') }}" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border-0 rounded-full" draggable="false">
                <img src="{{ asset('home-black.svg') }}" alt="Home icon" title="Home" class="block w-8 h-8 rounded-full" draggable="false">
            </a>
            <a wire:navigate.hover href="{{ route('fandom-list') }}" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border-0 rounded-full" draggable="false">
                <img src="{{ asset('fandom-black.svg') }}" alt="Fandom icon" title="Fandom" class="block w-8 h-8 rounded-full" draggable="false">
            </a>
            <a wire:navigate.hover href="{{ route('login') }}" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border-0 rounded-full" draggable="false">
                <img src="{{ asset('login-black.svg') }}" alt="Login icon" title="Login" class="block w-8 h-8 rounded-full" draggable="false">
            </a>
            <a wire:navigate.hover href="{{ route('register') }}" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border-0 rounded-full" draggable="false">
                <img src="{{ asset('register-black.svg') }}" alt="Register icon" title="Register" class="block w-8 h-8 rounded-full" draggable="false">
            </a>
        </nav>
    </div>
@endguest
@auth
    <div class="w-fit h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']/10' }} backdrop-blur-sm border-0 rounded-full">
        <nav class="w-fit h-[50px] p-1 flex flex-row space-x-2 space-y-0 justify-center items-center {{ 'bg-[' . $preferences['color_primary'] . ']' }} backdrop-blur-sm border-0 rounded-full select-none">
            <a wire:navigate.hover href="{{ route('home') }}" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border-0 rounded-full" draggable="false">
                <img src="{{ asset('home-black.svg') }}" alt="Home icon" title="Home" class="block w-8 h-8 rounded-full" draggable="false">
            </a>
            <a wire:navigate.hover href="{{ route('fandom-list') }}" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border-0 rounded-full" draggable="false">
                <img src="{{ asset('fandom-black.svg') }}" alt="Fandom icon" title="Fandom" class="block w-8 h-8 rounded-full" draggable="false">
            </a>
            <a wire:navigate.hover href="{{ route('user', Auth::user()) }}" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border-0 rounded-full" draggable="false">
                <img src="{{ asset('user-black.svg') }}" alt="User icon" title="User" class="block w-8 h-8 rounded-full" draggable="false">
            </a>
            <form action="{{ route('logout') }}" method="post" class="block aspect-square w-fit h-fit p-0 bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border-0 rounded-full">
                @csrf
                <button type="submit" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border-0 rounded-full">
                    <img src="{{ asset('logout-black.svg') }}" alt="Logout icon" title="Logout" class="block w-8 h-8 rounded-full" draggable="false">
                </button>
            </form>
        </nav>
    </div>
@endauth