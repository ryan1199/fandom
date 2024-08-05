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
                class="w-screen h-screen antialiased bg-gradient-to-tr {{ 'from-' . session()->get('preference-' . Auth::user()->username)['color_1'] . '-500/0' }} {{ 'via-' . session()->get('preference-' . Auth::user()->username)['color_2'] . '-500/0' }} {{ 'to-' . session()->get('preference-' . Auth::user()->username)['color_3'] . '-500/0' }} {{ 'font-[' . session()->get('preference-' . Auth::user()->username)['selected_font_family'] . ']' }} overflow-clip"
            @endauth
            @guest
                class="w-screen h-screen antialiased bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500 select-none font-mono overflow-clip"
            @endguest>
            <div style="background-image: url('{{ asset('bg-white.svg') }}')" class="w-full h-full bg-repeat bg-auto bg-center">
                <div 
                @auth
                    class="{{ 'bg-' . session()->get('preference-' . Auth::user()->username)['color_2'] . '-50/5' }} backdrop-blur-3xl"
                @endauth
                @guest
                    class="bg-white/5 backdrop-blur-3xl"
                @endguest>
                    <div class="w-screen h-screen flex flex-row overflow-clip relative">
                        @livewire(LeftSideNavigationBar::class)
                        @livewire(Alert::class)
                        <div class="w-full h-screen">
                            {{ $slot }}
                        </div>
                        @livewire(RightSideNavigationBar::class)
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>