<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    @auth
        class="scroll-smooth{{ session()->get('preference-' . Auth::user()->username)['dark_mode'] ? ' dark' : ''}}"
    @endauth
    @guest
        class="scroll-smooth"
    @endguest>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        @vite('resources/css/app.css')
        @vite(['resources/js/app.js'])
        <title>{{ $title ?? 'Page Title' }} | {{ config('app.name') }}</title>
    </head>

    <body class="antialiased">
        <div 
            @auth
                class="w-screen h-screen antialiased bg-gradient-to-tr {{ 'from-' . session()->get('preference-' . Auth::user()->username)['color_1'] . '-50' }} {{ 'via-' . session()->get('preference-' . Auth::user()->username)['color_2'] . '-50' }} {{ 'to-' . session()->get('preference-' . Auth::user()->username)['color_3'] . '-50' }} overflow-clip"
            @endauth
            @guest
                class="w-screen h-screen antialiased bg-gradient-to-tr from-pink-50 via-rose-50 to-red-50 overflow-clip"
            @endguest>
            <div 
                @auth
                    style="background-image: url('{{ asset(session()->get('preference-' . Auth::user()->username)['color_2'] . '.png') }}')" class="w-screen h-screen bg-cover bg-no-repeat bg-center"
                @endauth
                @guest
                    style="background-image: url('{{ asset('rose.png') }}')" class="w-screen h-screen bg-cover bg-no-repeat bg-center"
                @endguest>
                <div
                    @auth
                        class="w-screen h-screen flex flex-row overflow-clip relative {{ 'bg-' . session()->get('preference-' . Auth::user()->username)['color_2'] . '-50/70' }} backdrop-blur-3xl"
                    @endauth
                    @guest
                        class="w-screen h-screen flex flex-row overflow-clip relative bg-rose-50/70 backdrop-blur-3xl"
                    @endguest>
                    @guest
                        @livewire(PublicLeftSideNavigationBar::class)
                    @endguest
                    @auth
                        @livewire(LeftSideNavigationBar::class)
                    @endauth
                    @livewire(Alert::class)
                    <div class="w-full h-screen">
                        {{ $slot }}
                    </div>
                    @auth
                        @livewire(RightSideNavigationBar::class)
                    @endauth
                </div>
            </div>
        </div>
    </body>

</html>