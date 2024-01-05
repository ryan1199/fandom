<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fandom - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="logo.svg">
    @vite('resources/css/app.css')
</head>
<body class="antialiased bg-black">
    <div class="w-screen h-screen max-w-sm md:max-w-lg max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center">
        <div class="w-full h-fit max-h-[calc(100%-48px)] pr-2 overflow-y-auto overflow-x-clip">
            <div class="w-full h-fit p-2 bg-gray-50/90 backdrop-blur-sm border-0 border-transparent rounded-lg">
                @yield('content')
            </div>
        </div>
        {{-- 48px --}}
        <x-nav/>
    </div>
</body>
</html>