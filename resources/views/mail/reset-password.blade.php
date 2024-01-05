@extends('layout.mail')
@section('title')Reset Password - {{ config('app.name') }}@endsection
@section('subject')Reset Password @endsection
@section('message')Hallo {{ $user->username }} this is The Admin speaking, you or someone request to reset your password, if it was you kindly click the button below, if it was not you do what you have todo.@endsection
@section('buttonUrl'){{ $url }}@endsection
@section('buttonText')I am your button @endsection