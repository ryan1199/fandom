<div class="w-full h-full max-h-[100vh] pb-14 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} overflow-y-auto">
    <div class="w-full container h-full mx-auto mt-14 p-2 flex flex-col justify-stretch md:justify-center items-center">
        <div class="w-full max-w-md h-fit p-2 flex flex-col space-x-0 space-y-2 shadow-lg {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
            <div class="w-fit {{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                  Register
                </span>
            </div>
            <div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                <p class="font-semibold">Rules:</p>
                <ol class="pl-8 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-decimal list-outside">
                    <li>Username must only contain letters, numbers, dashes, underscores, maximum length is 100 characters, and must unique</li>
                    <li>Email must active and valid</li>
                    <li>Password minimum length is 8 characters and maximum length is 100 charatcters</li>
                </ol>
            </div>
            <div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                <p class="font-semibold">Note:</p>
                <ol class="pl-8 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-decimal list-outside">
                    <li>Please verify your email address after registration otherwise you can not login</li>
                </ol>
            </div>
            @if ($errors->any())
                <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                    <p class="font-semibold">Errors:</p>
                    <ul class="pl-4 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-disc list-outside">
                        @foreach ($errors->all() as $error)
                            <li wire:key="{{ 'register-error-' . $loop->index }}">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form wire:submit="register" method="post">
                @csrf
                <div class="w-full h-fit flex flex-col space-x-0 space-y-2 justify-center">
                    <label for="username" class="font-medium text-left select-none">
                        <span class="font-medium text-left select-none">Username</span>
                        <input wire:model="username" type="text" id="username" class="w-full h-fit form-input {{ 'bg-' . $preferences['color_2'] . '-50' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} border @error('username') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} animation rounded-lg" required>
                    </label>
                    <label for="email" class="font-medium text-left select-none">
                        <span class="font-medium text-left select-none">Email</span>
                        <input wire:model="email" type="email" id="email" class="w-full h-fit form-input {{ 'bg-' . $preferences['color_2'] . '-50' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} border @error('email') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} animation rounded-lg" required>
                    </label>
                    <label for="password" class="font-medium text-left select-none">
                        <span class="font-medium text-left select-none">Password</span>
                        <div x-data="{ type: 'password', get isPassword() { return this.type === 'password' }, get isText() { return this.type === 'text' }}" class="basis-8/12 md:basis-9/12 flex flex-row space-x-2 space-y-0 items-center">
                            <input wire:model="password" :type="type" id="password" class="w-full h-fit form-input {{ 'bg-' . $preferences['color_2'] . '-50' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} border @error('username') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} animation rounded-lg" required>
                            <svg x-show="isPassword" x-on:click="type = 'text'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} {{ 'bg-' . $preferences['color_2'] . '-50' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer animation">
                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="isText" x-on:click="type = 'password'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} {{ 'bg-' . $preferences['color_2'] . '-50' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer animation">
                                <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                            </svg>
                        </div>
                    </label>
                    <label for="password_confirmation" class="font-medium text-left select-none">
                        <span class="font-medium text-left select-none">Confirm Password</span>
                        <div x-data="{ type: 'password', get isPassword() { return this.type === 'password' }, get isText() { return this.type === 'text' }}" class="basis-8/12 md:basis-9/12 flex flex-row space-x-2 space-y-0 items-center">
                            <input wire:model="password_confirmation" :type="type" id="password_confirmation" class="w-full h-fit form-input {{ 'bg-' . $preferences['color_2'] . '-50' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} border @error('password_confirmation') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} animation rounded-lg" required>
                            <svg x-show="isPassword" x-on:click="type = 'text'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} {{ 'bg-' . $preferences['color_2'] . '-50' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer animation">
                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="isText" x-on:click="type = 'password'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} {{ 'bg-' . $preferences['color_2'] . '-50' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer animation">
                                <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                            </svg>
                        </div>
                    </label>
                    <button type="submit" class="w-fit h-fit p-2 self-end font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} select-none animation-button hover:-translate-x-1">Register</button>
                </div>
            </form>
            <div class="w-full h-fit flex flex-col md:flex-row space-x-0 space-y-2 md:space-x-2 md:space-y-0 justify-between items-center select-none">
                <a wire:navigate.hover href="{{ route('forgot-password') }}" class="block text-nowrap w-fit h-fit p-2 self-end font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} select-none animation-button hover:translate-x-2" draggable="false">Reset Password</a>
                <a wire:navigate.hover href="{{ route('verification.send') }}" class="block text-nowrap w-fit h-fit p-2 self-end font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} select-none animation-button hover:-translate-x-3" draggable="false">Resend Email Verification</a>
            </div>
        </div>
    </div>
</div>