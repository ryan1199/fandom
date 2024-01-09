<nav class="w-fit h-[48px] p-1 flex flex-row space-x-2 space-y-0 justify-center items-center bg-gray-50/90 backdrop-blur-sm border-0 border-transparent rounded-full">
    <a href="{{ route('home') }}" class="nav-icons">
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
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="nav-icons">
                <img src="{{ asset('logout.svg') }}" alt="Logout icon" title="Logout">
            </button>
        </form>
    @endauth
</nav>