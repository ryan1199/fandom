<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        @vite(['resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
        <title>{{ $title ?? 'Page Title' }} | {{ config('app.name') }}</title>
    </head>
    <body 
        @if (Auth::check() && session()->has(Auth::user()->username . '-preference'))
            class="antialiased bg-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] font-[{{ session()->get(Auth::user()->username . '-preference')['selected_font_family'] }}] overflow-clip"
        @else
            class="antialiased bg-black font-mono overflow-clip"
        @endif>
        {{ $slot }}
    </body>
</html>