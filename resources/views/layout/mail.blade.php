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
    <body class="antialiased text-black font-mono bg-black">
        <div class="w-screen h-screen max-w-sm md:max-w-lg max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center">
            <div class="w-full h-fit max-h-full pr-2 overflow-y-auto overflow-x-clip">
                <div class="w-full h-fit p-2 bg-white/90 backdrop-blur-sm border-0 border-transparent rounded-lg">
                    <div class="w-fit h-fit mx-auto bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500 border-0 border-transparent rounded-lg">
                        <div class="w-fit h-fit bg-repeat bg-auto bg-center p-2 border-0 border-transparent rounded-lg" style="background-image: url('{{ asset('bg-black.svg') }}')">
                            <table border="0" cellpadding="0" height="100" width="100%" class="table-fixed container h-fit mx-auto p-4 flex flex-col space-x-0 space-y-4 font-mono border-0 border-transparent rounded-lg">
                                <thead class="w-1/2 h-fit mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center bg-white border-0 border-transparent rounded-lg">
                                    <tr class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-center">
                                        <th></th>
                                        <th>
                                            <a href="{{ route('home') }}" class="block aspect-square w-fit h-fit p-1 bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500 border-0 border-transparent rounded-full">
                                                <img src="{{ asset('logo-black.svg') }}" alt="{{ config('app.name') }} icon" title="{{ config('app.name') }}" class="w-36 h-auto rounded-full">
                                            </a>
                                        </th>
                                        <th></th>
                                    </tr>
                                    <tr class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-center">
                                        <th></th>
                                        <th>
                                            <a href="{{ route('home') }}" class="text-xl font-extrabold">{{ config('app.name') }}</a>
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="w-full h-fit p-2 flex flex-col space-x-0 space-y-4 bg-white border-0 border-transparent rounded-lg">
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
                                        <td class="block p-1 bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500 border-0 border-transparent rounded-lg">
                                            <a href="@yield('buttonUrl')" target="_blank" rel="noopener" class="block p-2 align-middle bg-white/90 border-0 border-transparent rounded-lg">@yield('buttonText')</a>
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
    </body>
</html>