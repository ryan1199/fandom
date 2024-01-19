<div x-cloak x-show="account_modal" x-transition.duration.500ms.scale.origin class="w-full h-fit mb-2 p-2 flex flex-col space-x-0 space-y-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] border-0 border-transparent rounded-lg">
    <div class="bg-gradient-to-tr from-[{{ session()->get(Auth::user()->username . '-preference')['color_1'] }}] via-[{{ session()->get(Auth::user()->username . '-preference')['color_2'] }}] to-[{{ session()->get(Auth::user()->username . '-preference')['color_3'] }}] rounded-lg">
        <img src="{{ asset('register_cover.svg') }}" alt="Register image" title="Register image" class="w-full h-full max-h-[30vh] object-cover block rounded-lg">
    </div>
    {{-- rule --}}
    <div class="w-full h-full p-2 flex flex-col space-x-0 space-y-2 text-[calc({{session()->get(Auth::user()->username . '-preference')['font_size'] . 'px-2px'}})] bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] rounded-lg select-none">
        <div class="w-full h-full p-2 flex flex-col space-x-0 space-y-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] rounded-lg">
            <p class="text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] font-medium">Rules</p>
            <ul class="list-inside list-decimal flex flex-col space-x-0 space-y-2 text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}]">
                <li>Password minimum length is 8 characters and maximum length is 100 charatcters</li>
            </ul>
        </div>
    </div>
    @if ($errors->any())
        <div class="w-full h-full p-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-red-500 rounded-lg">
            <ul class="list-inside list-disc flex flex-col space-x-0 space-y-2 text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] . 'px' }}] text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form wire:submit="updateAccount" method="post" class="w-full h-fit p-0 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] rounded-lg">
        @csrf
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center">
            <label for="password" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <span class="basis-2/12 font-medium text-left select-none">Password</span>
                <div x-data="{ type: 'password', get isPassword() { return this.type === 'password' }, get isText() { return this.type === 'text' }}" class="basis-8/12 md:basis-9/12 flex flex-row space-x-2 space-y-0 items-center">
                    <input wire:model="password" :type="type" id="password" class="w-full form-input border @error('password') invalid @else valid @enderror rounded-lg" required>
                    <svg x-show="isPassword" x-on:click="type = 'text'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] border border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] rounded-lg cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                    </svg>
                    <svg x-show="isText" x-on:click="type = 'password'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] border border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] rounded-lg cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                        <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                        <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                        <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                    </svg>
                </div>
            </label>
            <label for="password_confirmation" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <span class="basis-2/12 font-medium text-left select-none">Confirm Password</span>
                <div x-data="{ type: 'password', get isPassword() { return this.type === 'password' }, get isText() { return this.type === 'text' }}" class="basis-8/12 md:basis-9/12 flex flex-row space-x-2 space-y-0 items-center">
                    <input wire:model="password_confirmation" :type="type" id="password_confirmation" class="w-full form-input border @error('password_confirmation') invalid @else valid @enderror rounded-lg" required>
                    <svg x-show="isPassword" x-on:click="type = 'text'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] border border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] rounded-lg cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                    </svg>
                    <svg x-show="isText" x-on:click="type = 'password'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] border border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] rounded-lg cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                        <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                        <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                        <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                    </svg>
                </div>
            </label>
            <button type="submit" class="w-full h-fit self-center p-2 text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}] text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] rounded-lg select-none transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Update</button>
        </div>
    </form>
    <button type="submit" wire:click="deleteAccount" wire:confirm="Are you sure you want to delete your account?" class="w-full h-fit p-2 text-center text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}] text-black bg-red-500 border-0 border-transparent rounded-lg cursor-pointer select-none transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Delete Account</button>
</div>