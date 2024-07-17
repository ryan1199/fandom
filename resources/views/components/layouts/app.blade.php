<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        @vite(['resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
        <title>{{ $title ?? 'Page Title' }} | {{ config('app.name') }}</title>
    </head>

    <body 
        @if (Auth::check() && session()->has('preference-' . Auth::user()->username))
            class="antialiased bg-gradient-to-tr {{ 'from-[' . session()->get('preference-' . Auth::user()->username)['color_1'] . ']' }} {{ 'via-[' . session()->get('preference-' . Auth::user()->username)['color_2'] . ']' }} {{ 'to-[' . session()->get('preference-' . Auth::user()->username)['color_3'] . ']' }} {{ 'font-[' . session()->get('preference-' . Auth::user()->username)['selected_font_family'] . ']' }} overflow-clip"
        @else
            class="antialiased bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500 select-none font-mono overflow-clip"
        @endif>
        <div style="background-image: url('{{ asset('bg-white.svg') }}')" class="w-full h-full bg-repeat bg-auto bg-center">
            <div class="bg-zinc-100/10 backdrop-blur-3xl">
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
    </body>

</html>