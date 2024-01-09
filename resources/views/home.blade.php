@extends('layout.app')
@section('title')
    Home
@endsection
@section('content')
    <div class="w-full h-full pr-1 overflow-y-scroll overflow-x-clip">
        <h1>Home Page</h1>
        <div class="mail-bg-color">
            <div class="mail-bg-image" style="background-image: url('{{ asset('email_cover.svg') }}')">
                <table border="0" cellpadding="0" height="100" width="100%" class="table">
                <thead class="thead">
                <tr class="thead-tr1">
                <th></th>
                <th>
                <a href="{{ route('home') }}" class="thead-tr1-th2-a">
                <img src="{{ asset('logo.svg') }}" alt="{{ config('app.name') }} icon" title="{{ config('app.name') }}" class="thead-tr1-th2-a-img">
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
                <td colspan="3">Hallo ryan this is The Admin speaking, you or someone request to reset your password, if it was you kindly click the button below, if not you do what you have todo.</td>
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
@endsection