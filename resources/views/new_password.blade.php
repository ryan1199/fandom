@extends('layout.app')
@section('title')
    New Password
@endsection
@section('content')
    <div>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('reset-password.update', request()->route('ticket')) }}" method="post">
            @csrf
            <label for="password">
                <span>Password</span>
                <input type="password" name="password" id="password">
            </label>
            <label for="password_confirmation">
                <span>Confirm Password</span>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </label>
            <button type="submit">Update Password</button>
        </form>
    </div>
@endsection