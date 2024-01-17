{{-- [{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] --}}
@guest
    <nav class="w-fit h-[48px] p-1 flex flex-row space-x-2 space-y-0 justify-center items-center bg-white opacity-90 backdrop-blur-sm border-0 border-transparent rounded-full">
        <a wire:navigate.hover href="{{ route('home') }}" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500 border-0 border-transparent rounded-full">
            <img src="{{ asset('logo.svg') }}" alt="Home icon" title="Home" class="block w-8 h-8 rounded-full">
        </a>
        <a wire:navigate.hover href="{{ route('login') }}" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500 border-0 border-transparent rounded-full">
            <img src="{{ asset('login.svg') }}" alt="Login icon" title="Login" class="block w-8 h-8 rounded-full">
        </a>
        <a wire:navigate.hover href="{{ route('register') }}" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500 border-0 border-transparent rounded-full">
            <img src="{{ asset('register.svg') }}" alt="Register icon" title="Register" class="block w-8 h-8 rounded-full">
        </a>
    </nav>
@endguest
@auth
    <nav class="w-fit h-[48px] p-1 flex flex-row space-x-2 space-y-0 justify-center items-center bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] opacity-90 backdrop-blur-sm border-0 border-transparent rounded-full">
        <a wire:navigate.hover href="{{ route('home') }}" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr from-[{{ session()->get(Auth::user()->username . '-preference')['color_1'] }}] via-[{{ session()->get(Auth::user()->username . '-preference')['color_2'] }}] to-[{{ session()->get(Auth::user()->username . '-preference')['color_3'] }}] border-0 border-transparent rounded-full">
            <img src="{{ asset('logo.svg') }}" alt="Home icon" title="Home" class="block w-8 h-8 rounded-full">
        </a>
        <a wire:navigate.hover href="{{ route('user', Auth::user()) }}" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr from-[{{ session()->get(Auth::user()->username . '-preference')['color_1'] }}] via-[{{ session()->get(Auth::user()->username . '-preference')['color_2'] }}] to-[{{ session()->get(Auth::user()->username . '-preference')['color_3'] }}] border-0 border-transparent rounded-full">
            <img src="{{ asset('user.svg') }}" alt="User icon" title="User" class="block w-8 h-8 rounded-full">
        </a>
        <form action="{{ route('logout') }}" method="post" class="block aspect-square w-fit h-fit p-0 bg-gradient-to-tr from-[{{ session()->get(Auth::user()->username . '-preference')['color_1'] }}] via-[{{ session()->get(Auth::user()->username . '-preference')['color_2'] }}] to-[{{ session()->get(Auth::user()->username . '-preference')['color_3'] }}] border-0 border-transparent rounded-full">
            @csrf
            <button type="submit" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr from-[{{ session()->get(Auth::user()->username . '-preference')['color_1'] }}] via-[{{ session()->get(Auth::user()->username . '-preference')['color_2'] }}] to-[{{ session()->get(Auth::user()->username . '-preference')['color_3'] }}] border-0 border-transparent rounded-full">
                <img src="{{ asset('logout.svg') }}" alt="Logout icon" title="Logout" class="block w-8 h-8 rounded-full">
            </button>
        </form>
    </nav>
@endauth