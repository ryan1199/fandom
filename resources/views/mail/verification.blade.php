@extends('layout.mail')
@section('title')Verification - {{ config('app.name') }}@endsection
@section('subject'){{ 'Verification' }}@endsection
@section('message')Hallo {{ $user->username }} this is The Admin speaking, you need to verify your email address by click the button below.@endsection
@section('buttonUrl'){{ $url }}@endsection
@section('buttonText'){{ 'I am your button' }}@endsection