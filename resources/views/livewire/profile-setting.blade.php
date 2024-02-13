<div wire:ignore x-cloak x-show="profile_modal" x-transition.duration.500ms.scale.origin id="profileSettings" class="w-10/12 md:w-1/3 h-fit border-0 border-transparent rounded-lg absolute z-10" :style="{ left: {{ $profile_settings_modal_position['left'] }}+'px', right: {{ $profile_settings_modal_position['right'] }}+'px',top: {{ $profile_settings_modal_position['top'] }}+'px' ,bottom: {{ $profile_settings_modal_position['bottom'] }}+'px' }">
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg">
        <div class="w-full h-fit flex flex-row justify-between items-center text-[{{ $preferences['color_text'] }}] text-center bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
            <div id="profileSettingsHeader" class="w-full p-2 cursor-move">
                <h1 class="w-full text-[{{ $preferences['color_text'] }}] text-center text-[calc({{'4px+' . $preferences['font_size'] . 'px' }})]">Profile Settings</h1>
            </div>
            <div class="p-2">
                <svg x-on:click="profile_modal = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 bg-[{{ $preferences['color_primary'] }}] cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                    <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        <div class="bg-gradient-to-tr from-[{{ session()->get('preference-' . Auth::user()->username)['color_1'] }}] via-[{{ session()->get('preference-' . Auth::user()->username)['color_2'] }}] to-[{{ session()->get('preference-' . Auth::user()->username)['color_3'] }}] rounded-lg select-none">
            <div style="background-image: url('{{ asset('profile-settings-cover-black.svg') }}')" class="w-full h-20 bg-repeat bg-center rounded-lg"></div>
        </div>
        @if ($errors->any())
            <div class="w-full h-full p-2 bg-[{{ session()->get('preference-' . Auth::user()->username)['color_primary'] }}] border border-red-500 rounded-lg">
                <ul class="list-inside list-disc flex flex-col space-x-0 space-y-2 text-[{{ session()->get('preference-' . Auth::user()->username)['font_size'] . 'px' }}] text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form wire:submit class="w-full h-fit p-0 bg-[{{ session()->get('preference-' . Auth::user()->username)['color_primary'] }}] border border-[{{ session()->get('preference-' . Auth::user()->username)['color_secondary'] }}] rounded-lg">
            <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center">
                <label for="cover" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get('preference-' . Auth::user()->username)['color_text'] }}] text-[{{ session()->get('preference-' . Auth::user()->username)['font_size'] .'px' }}]">
                    <span class="basis-2/12 font-medium text-left select-none">Cover</span>
                    <input wire:model.blur="cover" name="cover" type="file" id="cover" class="w-full form-input file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr file:from-[{{ session()->get('preference-' . Auth::user()->username)['color_1'] }}] file:via-[{{ session()->get('preference-' . Auth::user()->username)['color_2'] }}] file:to-[{{ session()->get('preference-' . Auth::user()->username)['color_3'] }}] file:border file:border-[{{ session()->get('preference-' . Auth::user()->username)['color_secondary'] }}] file:rounded-lg border @error('cover') invalid @else valid @enderror rounded-lg cursor-pointer file:cursor-pointer file:transition-all file:duration-100 hover:file:opacity-50 file:active:duration-75 file:active:scale-[.95]">
                </label>
                <label for="avatar" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get('preference-' . Auth::user()->username)['color_text'] }}] text-[{{ session()->get('preference-' . Auth::user()->username)['font_size'] .'px' }}]">
                    <span class="basis-2/12 font-medium text-left select-none">Avatar</span>
                    <input wire:model.blur="avatar" name="avatar" type="file" id="avatar" class="w-full form-input file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr file:from-[{{ session()->get('preference-' . Auth::user()->username)['color_1'] }}] file:via-[{{ session()->get('preference-' . Auth::user()->username)['color_2'] }}] file:to-[{{ session()->get('preference-' . Auth::user()->username)['color_3'] }}] file:border file:border-[{{ session()->get('preference-' . Auth::user()->username)['color_secondary'] }}] file:rounded-lg border @error('avatar') invalid @else valid @enderror rounded-lg cursor-pointer file:cursor-pointer file:transition-all file:duration-100 hover:file:opacity-50 file:active:duration-75 file:active:scale-[.95]">
                </label>
                <label for="status" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get('preference-' . Auth::user()->username)['color_text'] }}] text-[{{ session()->get('preference-' . Auth::user()->username)['font_size'] .'px' }}]">
                    <span class="basis-2/12 font-medium text-left select-none">Status</span>
                    <input wire:model.blur="status" type="text" id="status" placeholder="What are you feeling right now ?" class="w-full form-input border @error('status') invalid @else valid @enderror rounded-lg">
                </label>
                <label for="description" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get('preference-' . Auth::user()->username)['color_text'] }}] text-[{{ session()->get('preference-' . Auth::user()->username)['font_size'] .'px' }}]">
                    <span class="basis-2/12 font-medium text-left select-none">Description</span>
                    <input wire:model.blur="description" type="text" id="description" placeholder="Describe your self" class="w-full form-input border @error('description') invalid @else valid @enderror rounded-lg">
                </label>
            </div>
        </form>
    </div>
</div>
@script
<script>
    let profileSettings = document.getElementById('profileSettings');
    let profileSettingsHeader = document.getElementById('profileSettingsHeader');
    let posX = 0,
        posY = 0,
        mouseX = 0,
        mouseY = 0,
        left_position = 0,
        right_position = 0,
        top_position = 0,
        bottom_position = 0;
    
    profileSettingsHeader.addEventListener('mousedown', mouseDown, false);
    profileSettings.addEventListener('mouseup', mouseUp, false);
    
    function mouseDown(e)
    {
        e.preventDefault();
        posX = e.clientX - profileSettings.offsetLeft;
        posY = e.clientY - profileSettings.offsetTop;
        document.addEventListener('mousemove', moveElement, false);
    }
    
    function mouseUp()
    {
        document.removeEventListener('mousemove', moveElement, false);
        $wire.dispatch('save_profile_settings_modal_position', [{ 'left': left_position, 'right': right_position, 'top': top_position, 'bottom': bottom_position }]);
    }
    
    function moveElement(e)
    {
        mouseX = e.clientX - posX;
        mouseY = e.clientY - posY;
        if(mouseX >= 0 && window.innerWidth - mouseX - profileSettings.offsetWidth >= 0)
        {
            left_position = mouseX;
            right_position = window.innerWidth - left_position - profileSettings.offsetWidth;
            profileSettings.style.left = left_position + 'px';
            profileSettings.style.right = right_position + 'px';
        }
        if(mouseY >= 0 && window.innerHeight - mouseY - profileSettings.offsetHeight >= 0)
        {
            top_position = mouseY;
            bottom_position = window.innerHeight - top_position - profileSettings.offsetHeight;
            profileSettings.style.top = top_position + 'px';
            profileSettings.style.bottom = bottom_position + 'px';
        }
    }
</script>
@endscript