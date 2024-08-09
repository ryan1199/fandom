<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>@yield('title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width" />
        @vite('resources/css/app.css')
        @vite(['resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="antialiased bg-gradient-to-tr from-pink-500 via-rose-500 to-red-500 select-none font-mono overflow-clip">
        <div style="background-image: url('{{ asset('bg-white.svg') }}')" class="w-full h-full bg-repeat bg-auto bg-center">
            <div class="bg-white/5 backdrop-blur-0">
                <div class="w-screen h-screen flex flex-row overflow-clip relative">
                    <div class="w-full h-screen">
                        <div class="w-full h-[100vh] p-2 pt-20 text-base leading-normal font-mono text-rose-900 bg-rose-50 overflow-y-auto">
                            <div class="w-full max-w-md h-fit mx-auto p-2 flex flex-col space-x-0 space-y-2 bg-rose-100 rounded-lg">
                                <table border="0" cellpadding="0" height="100" width="100%" class="table-fixed container h-fit mx-auto p-2 flex flex-col space-x-0 space-y-4 font-mono rounded-lg">
                                    <thead class="w-1/2 h-fit mx-auto flex flex-col space-x-0 space-y-4 justify-center rounded-lg">
                                        <tr class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-center">
                                            <th></th>
                                            <th>
                                                <a href="{{ route('home') }}" class="block aspect-square w-fit h-fit p-2 bg-gradient-to-tr from-pink-300 via-rose-300 to-red-300 rounded-lg">
                                                    <img src="{{ asset('logo-white.svg') }}" alt="{{ config('app.name') }} icon" title="{{ config('app.name') }}" class="w-36 h-auto rounded-lg">
                                                </a>
                                            </th>
                                            <th></th>
                                        </tr>
                                        <tr class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-center">
                                            <th></th>
                                            <th>
                                                <div class="w-fit text-4xl leading-7 font-extrabold">
                                                    <a href="{{ route('home') }}">
                                                        <span class="bg-clip-text text-transparent bg-gradient-to-tr from-pink-900 via-rose-900 to-red-900">
                                                            {{ config('app.name') }}
                                                        </span>
                                                    </a>
                                                </div>
                                            </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="w-full h-fit p-2 flex flex-col space-x-0 space-y-4 rounded-lg">
                                        <tr>
                                            <td class="text-xl font-bold">@yield('subject')</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="break-words text-justify">
                                            <td colspan="3">@yield('message')</td>
                                        </tr>
                                        <tr class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-center">
                                            <td></td>
                                            <td>
                                                <a href="@yield('buttonUrl')" target="_blank" rel="noopener" class="w-fit h-fit p-2 font-semibold hover:text-rose-500 bg-rose-50 rounded-lg select-none animation-button">@yield('buttonText')</a>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Thanks,<br>
                                                {{ config('app.name') }}
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-center text-center">
                                            <td></td>
                                            <td>© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>