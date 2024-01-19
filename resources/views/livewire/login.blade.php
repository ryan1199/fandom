<div class="w-screen h-screen max-w-sm md:max-w-lg max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center relative z-0">
    <livewire:alert/>
    <div class="w-full h-fit max-h-[calc(100%-48px)] overflow-clip">
        <div class="w-full h-fit p-2 bg-white opacity-90 backdrop-blur-sm border-0 border-transparent rounded-lg">
            <div wire:scroll class="w-full h-full max-h-[calc(100vh-96px)] pr-1 font-mono overflow-y-scroll overflow-x-clip">
                <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-black border-0 border-transparent rounded-lg">
                    <div class="bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500 select-none">
                        <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-full max-h-[30vh] object-cover block">
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
                    <form wire:submit="login" method="post" class="w-full h-fit p-0 bg-white border border-black rounded-lg">
                        @csrf
                        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center">
                            <label for="username" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                                <span class="basis-2/12 text-black text-base font-medium text-left select-none">Username</span>
                                <input wire:model="username" type="text" id="username" class="form-input accent-black caret-black basis-8/12 md:basis-9/12 border @error('username') invalid @else valid @enderror rounded-lg" required>
                            </label>
                            <label for="password" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                                <span class="basis-2/12 text-black text-base font-medium text-left select-none">Password</span>
                                <div x-data="{ type: 'password', get isPassword() { return this.type === 'password' }, get isText() { return this.type === 'text' }}" class="basis-8/12 md:basis-9/12 flex flex-row space-x-2 space-y-0 items-center">
                                    <input wire:model="password" :type="type" id="password" class="w-full form-input accent-black caret-black border @error('password') invalid @else valid @enderror rounded-lg" required>
                                    <svg x-show="isPassword" x-on:click="type = 'text'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 border border-black rounded-lg cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                    </svg>
                                    <svg x-show="isText" x-on:click="type = 'password'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 border border-black rounded-lg cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                                        <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                        <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                        <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                                    </svg>
                                </div>
                            </label>
                            <div class="flex flex-col sm:flex-row space-x-0 sm:space-x-2 space-y-2 sm:space-y-0 items-stretch sm:items-center">
                                <label for="remember" class="w-fit h-fit p-2 shrink-0 flex flex-row space-x-2 space-y-0 justify-start items-center border @error('remember') invalid @else valid @enderror rounded-lg transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                                    <input wire:model="remember" type="checkbox" id="remember" class="p-2 form-checkbox accent-black border border-black rounded-sm cursor-pointer">
                                    <span class="text-black text-base font-medium text-left cursor-pointer select-none">Remember me</span>
                                </label>
                                <button type="submit" class="w-full h-fit self-center p-2 text-base text-black bg-white border border-black rounded-lg select-none transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Login</button>
                            </div>
                        </div>
                    </form>
                    <div class="w-full h-hit p-2 text-black text-center bg-white border border-black rounded-lg">
                        <div class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 sm:space-y-0 justify-between items-center select-none">
                            <a wire:navigate.hover href="{{ route('forgot-password') }}" class="block w-full sm:w-fit h-fit p-2 bg-white border border-black rounded-lg transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Reset Password</a>
                            <a wire:navigate.hover href="{{ route('verification.send') }}" class="block w-full sm:w-fit h-fit p-2 bg-white border border-black rounded-lg transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Resend Email Verification</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-nav/>
</div>