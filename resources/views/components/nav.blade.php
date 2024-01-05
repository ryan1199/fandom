<nav class="w-fit h-[48px] p-1 flex flex-row space-x-2 space-y-0 justify-center items-center bg-gray-50/90 backdrop-blur-sm border border-transparent rounded-full">
    <a href="{{ route('home') }}" class="nav-icons">
        <img src="logo.svg" alt="Home icon" title="Home">
    </a>
    @guest
        <a href="{{ route('login.view') }}" class="nav-icons">
            <img src="login.svg" alt="Login icon" title="Login">
        </a>
        <a href="{{ route('register.view') }}" class="nav-icons">
            <img src="register.svg" alt="Register icon" title="Register">
        </a>
    @endguest
    @auth
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="nav-icons">
                <img src="logout.svg" alt="Logout icon" title="Logout">
            </button>
        </form>
    @endauth
</nav>