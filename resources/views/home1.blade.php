<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Fandom</title>
    <link rel="icon" type="image/x-icon" href="logo.svg">
    @vite('resources/css/app.css')
</head>
<body class="body-mail">
    <div class="mail-wrapper1">
        <div class="mail-wrapper2">
            <div class="mail-wrapper3">
                <div class="mail-bg-color">
                    <div class="mail-bg-image" style="background-image: url('{{ asset('email_cover.svg') }}')">
                        <table border="0" cellpadding="0" height="100" width="100%" class="table">
                        <thead class="thead">
                        <tr class="thead-tr1">
                        <th></th>
                        <th>
                        <a href="{{ route('home') }}" class="thead-tr1-th2-a">
                        <img src="logo.svg" alt="{{ config('app.name') }} icon" title="{{ config('app.name') }}" class="thead-tr1-th2-a-img">
                        </a>
                        </th>
                        <th></th>
                        </tr>
                        <tr class="thead-tr2">
                        <th></th>
                        <th>
                        <a href="{{ route('home') }}" class="thead-tr2-th2-a">{{ config('app.name') }}</a>
                        </th>
                        <th></th>
                        </tr>
                        </thead>
                        <tbody class="tbody">
                        <tr>
                        <td class="tbody-tr1-td1">Reset Password</td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr class="tbody-tr-2">
                        <td colspan="3">Hallo ryan this is The Admin speaking, you or someone request to reset your password, if it was you kindly click the button below, if it was not you do what you have todo.</td>
                        </tr>
                        <tr class="tbody-tr3">
                        <td></td>
                        <td class="tbody-tr3-td2">
                        <a href="#" target="_blank" rel="noopener" class="tbody-tr3-td2-a">I am your button</a>
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
                        <tr class="tbody-tr5">
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