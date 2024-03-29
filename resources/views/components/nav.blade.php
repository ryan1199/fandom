<nav class="w-fit h-[48px] p-1 flex flex-row space-x-2 space-y-0 justify-center items-center bg-gray-50/90 backdrop-blur-sm border-0 border-transparent rounded-full">
    <a wire:navigate.hover href="{{ route('home') }}" class="nav-icons">
        <img src="{{ asset('logo.svg') }}" alt="Home icon" title="Home">
    </a>
    @guest
        <a wire:navigate.hover href="{{ route('login') }}" class="nav-icons">
            <img src="{{ asset('login.svg') }}" alt="Login icon" title="Login">
        </a>
        <a wire:navigate.hover href="{{ route('register') }}" class="nav-icons">
            <img src="{{ asset('register.svg') }}" alt="Register icon" title="Register">
        </a>
    @endguest
    @auth
        <a wire:navigate.hover href="{{ route('user', Auth::user()) }}" class="nav-icons">
            <img src="{{ asset('user.svg') }}" alt="User icon" title="User">
        </a>
        <form action="{{ route('logout') }}" method="post" class="block aspect-square w-fit h-fit p-0 bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500 border-0 border-transparent rounded-full">
            @csrf
            <button type="submit" class="nav-icons">
                <img src="{{ asset('logout.svg') }}" alt="Logout icon" title="Logout">
            </button>
        </form>
    @endauth
    <a href="{{ route('test') }}" class="nav-icons">
        <img src="{{ asset('logo.svg') }}" alt="Test icon" title="Test">
    </a>
</nav>