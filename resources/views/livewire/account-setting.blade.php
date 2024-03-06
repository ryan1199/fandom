<div wire:ignore x-cloak x-show="account_modal" x-transition.duration.500ms.scale.origin id="accountSettings" class="w-10/12 md:w-1/3 h-fit p-4 bg-[{{ $preferences['color_primary'] }}]/10 backdrop-blur-sm border-0 border-transparent rounded-lg absolute z-10" :style="{ left: {{ $account_settings_modal_position['left'] }}+'px', right: {{ $account_settings_modal_position['right'] }}+'px',top: {{ $account_settings_modal_position['top'] }}+'px' ,bottom: {{ $account_settings_modal_position['bottom'] }}+'px' }">
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg">
        <div class="w-full h-fit flex flex-row justify-between items-center text-[{{ $preferences['color_text'] }}] text-center bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
            <div id="accountSettingsHeader" class="w-full p-2 cursor-move">
                <h1 class="w-full text-[{{ $preferences['color_text'] }}] text-center text-[calc({{'4px+' . $preferences['font_size'] . 'px' }})]">Account Settings</h1>
            </div>
            <div class="p-2">
                <svg x-on:click="account_modal = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 bg-[{{ $preferences['color_primary'] }}] cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                    <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        <div class="bg-gradient-to-tr from-[{{ $preferences['color_1'] }}] via-[{{ $preferences['color_2'] }}] to-[{{ $preferences['color_3'] }}] rounded-lg select-none">
            <div style="background-image: url('{{ asset('account-settings-cover-black.svg') }}')" class="w-full h-20 bg-repeat bg-center rounded-lg"></div>
        </div>
        {{-- rule --}}
        <div class="w-full h-full p-2 flex flex-col space-x-0 space-y-2 text-[calc({{$preferences['font_size'] . 'px-2px'}})] bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg select-none">
            <div class="w-full h-full p-2 flex flex-col space-x-0 space-y-2 bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
                <p class="text-[{{ $preferences['color_text'] }}] font-medium">Rules</p>
                <ul class="list-inside list-decimal flex flex-col space-x-0 space-y-2 text-[{{ $preferences['color_text'] }}]">
                    <li>Password minimum length is 8 characters and maximum length is 100 charatcters</li>
                </ul>
            </div>
        </div>
        @if ($errors->any())
            <div class="w-full h-full p-2 bg-[{{ $preferences['color_primary'] }}] border border-red-500 rounded-lg">
                <ul class="list-inside list-disc flex flex-col space-x-0 space-y-2 text-[{{ $preferences['font_size'] . 'px' }}] text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form wire:submit="updateAccount" method="post" class="w-full h-fit p-0 bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
            @csrf
            <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center">
                <label for="password" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] .'px' }}]">
                    <span class="basis-2/12 font-medium text-left select-none">Password</span>
                    <div x-data="{ type: 'password', get isPassword() { return this.type === 'password' }, get isText() { return this.type === 'text' }}" class="basis-8/12 md:basis-9/12 flex flex-row space-x-2 space-y-0 items-center">
                        <input wire:model="password" :type="type" id="password" class="w-full form-input border @error('password') invalid @else valid @enderror rounded-lg" required>
                        <svg x-show="isPassword" x-on:click="type = 'text'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 text-[{{ $preferences['color_text'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                        </svg>
                        <svg x-show="isText" x-on:click="type = 'password'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 text-[{{ $preferences['color_text'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                            <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                            <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                            <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                        </svg>
                    </div>
                </label>
                <label for="password_confirmation" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] .'px' }}]">
                    <span class="basis-2/12 font-medium text-left select-none">Confirm Password</span>
                    <div x-data="{ type: 'password', get isPassword() { return this.type === 'password' }, get isText() { return this.type === 'text' }}" class="basis-8/12 md:basis-9/12 flex flex-row space-x-2 space-y-0 items-center">
                        <input wire:model="password_confirmation" :type="type" id="password_confirmation" class="w-full form-input border @error('password_confirmation') invalid @else valid @enderror rounded-lg" required>
                        <svg x-show="isPassword" x-on:click="type = 'text'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 text-[{{ $preferences['color_text'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                        </svg>
                        <svg x-show="isText" x-on:click="type = 'password'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 aspect-square p-2 text-[{{ $preferences['color_text'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                            <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                            <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                            <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                        </svg>
                    </div>
                </label>
                <button type="submit" class="w-full h-fit self-center p-2 text-[{{ $preferences['font_size'] .'px' }}] text-[{{ $preferences['color_text'] }}] bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg select-none transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Update</button>
            </div>
        </form>
        <button type="submit" wire:click="deleteAccount" wire:confirm="Are you sure you want to delete your account?" class="w-full h-fit p-2 text-center text-[{{ $preferences['font_size'] .'px' }}] text-black bg-red-500 border-0 border-transparent rounded-lg cursor-pointer select-none transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Delete Account</button>
    </div>
</div>
@script
<script>
    let accountSettings = document.getElementById('accountSettings');
    let accountSettingsHeader = document.getElementById('accountSettingsHeader');
    let posX = 0,
        posY = 0,
        mouseX = 0,
        mouseY = 0,
        left_position = 0,
        right_position = 0,
        top_position = 0,
        bottom_position = 0;
    
    accountSettingsHeader.addEventListener('mousedown', mouseDown, false);
    accountSettings.addEventListener('mouseup', mouseUp, false);
    
    function mouseDown(e)
    {
        e.preventDefault();
        posX = e.clientX - accountSettings.offsetLeft;
        posY = e.clientY - accountSettings.offsetTop;
        document.addEventListener('mousemove', moveElement, false);
    }
    
    function mouseUp()
    {
        document.removeEventListener('mousemove', moveElement, false);
        $wire.dispatch('save_account_settings_modal_position', [{ 'left': left_position, 'right': right_position, 'top': top_position, 'bottom': bottom_position }]);
    }
    
    function moveElement(e)
    {
        mouseX = e.clientX - posX;
        mouseY = e.clientY - posY;
        if(mouseX >= 0 && window.innerWidth - mouseX - accountSettings.offsetWidth >= 0)
        {
            left_position = mouseX;
            right_position = window.innerWidth - left_position - accountSettings.offsetWidth;
            accountSettings.style.left = left_position + 'px';
            accountSettings.style.right = right_position + 'px';
        }
        if(mouseY >= 0 && window.innerHeight - mouseY - accountSettings.offsetHeight >= 0)
        {
            top_position = mouseY;
            bottom_position = window.innerHeight - top_position - accountSettings.offsetHeight;
            accountSettings.style.top = top_position + 'px';
            accountSettings.style.bottom = bottom_position + 'px';
        }
    }
</script>
@endscript