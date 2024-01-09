<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        @vite(['resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
        <title>{{ $title ?? 'Page Title' }} - {{ config('app.name') }}</title>
    </head>
    <body class="antialiased bg-black font-mono overflow-clip">
        {{ $slot }}
    </body>
</html>
