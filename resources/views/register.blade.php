@extends('layout.app')
@section('title')
    Register
@endsection
@section('content')
    <div class="w-full h-full pr-1 font-mono overflow-y-scroll overflow-x-clip">
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-black border-0 border-transparent rounded-lg">
            <div class="bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500">
                <img src="register_cover.svg" alt="Register image" title="Register image" class="w-full h-full max-h-[30vh] object-cover block">
            </div>
            {{-- rule --}}
            <div class="w-full h-full p-2 flex flex-col space-x-0 space-y-2 text-sm bg-white border border-black rounded-lg">
                <div class="w-full h-full p-2 flex flex-col space-x-0 space-y-2 bg-white border border-black rounded-lg">
                    <p class="text-black font-medium">Rules</p>
                    <ul class="list-inside list-decimal flex flex-col space-x-0 space-y-2 text-black">
                        <li>Username must only contain letters, numbers, dashes, underscores, maximum length is 100 characters, and must unique</li>
                        <li>Email must active and valid</li>
                        <li>Password minimum length is 8 characters and maximum length is 100 charatcters</li>
                    </ul>
                </div>
                <div class="w-full h-full p-2 flex flex-col space-x-0 space-y-2 bg-white border border-black rounded-lg">
                    <p class="text-black font-medium">Important note</p>
                    <p class="text-black font-medium">Please verify your email address after registration otherwise you can not login</p>
                </div>
            </div>
            @if ($errors->any())
                <div class="w-full h-full p-2 bg-white border border-red-500 rounded-lg">
                    <ul class="list-inside list-disc flex flex-col space-x-0 space-y-2 text-red-500">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('register') }}" method="post" class="w-full h-fit p-0 bg-white border border-black rounded-lg">
                @csrf
                <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center">
                    <label for="username" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                        <span class="basis-2/12 text-black text-base font-medium text-left">Username</span>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-input basis-8/12 md:basis-9/12 border @error('username') invalid @else valid @enderror rounded-lg">
                    </label>
                    <label for="email" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                        <span class="basis-2/12 text-black text-base font-medium text-left">Email</span>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-input basis-8/12 md:basis-9/12 border @error('email') invalid @else valid @enderror rounded-lg">
                    </label>
                    <label for="password" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                        <span class="basis-2/12 text-black text-base font-medium text-left">Password</span>
                        <input type="password" name="password" id="password" class="form-input basis-8/12 md:basis-9/12 border @error('password') invalid @else valid @enderror rounded-lg">
                    </label>
                    <label for="password_confirmation" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                        <span class="basis-2/12 text-black text-base font-medium text-left">Confirm Password</span>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input basis-8/12 md:basis-9/12 border @error('password_confirmation') invalid @else valid @enderror rounded-lg">
                    </label>
                    <button type="submit" class="w-full h-fit self-center p-2 text-base text-black bg-white border border-black rounded-lg">Register</button>
                </div>
            </form>
            <div class="w-full h-hit p-2 text-black text-center bg-white border border-black rounded-lg">
                <div class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 sm:space-y-0 justify-between items-center">
                    <a href="{{ route('reset-password.view') }}" class="block w-full sm:w-fit h-fit p-2 bg-white border border-black rounded-lg">Reset Password</a>
                    <a href="{{ route('verification.view') }}" class="block w-full sm:w-fit h-fit p-2 bg-white border border-black rounded-lg">Resend Email Verification</a>
                </div>
            </div>
        </div>
    </div>
@endsection