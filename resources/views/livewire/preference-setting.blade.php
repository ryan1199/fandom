<div wire:ignore x-cloak x-show="preference_modal" x-transition.duration.500ms.scale.origin id="preferenceSettings" class="w-10/12 md:w-1/3 h-fit p-4 bg-[{{ $preferences['color_primary'] }}]/10 backdrop-blur-sm border-0 border-transparent rounded-lg absolute z-10" :style="{ left: {{ $preference_settings_modal_position['left'] }}+'px', right: {{ $preference_settings_modal_position['right'] }}+'px',top: {{ $preference_settings_modal_position['top'] }}+'px' ,bottom: {{ $preference_settings_modal_position['bottom'] }}+'px' }">
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg">
        <div class="w-full h-fit flex flex-row justify-between items-center text-[{{ $preferences['color_text'] }}] text-center bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
            <div id="preferenceSettingsHeader" class="w-full p-2 cursor-move">
                <h1 class="w-full text-[{{ $preferences['color_text'] }}] text-center text-[calc({{'4px+' . $preferences['font_size'] . 'px' }})]">Preference Settings</h1>
            </div>
            <div class="p-2">
                <svg x-on:click="preference_modal = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 bg-[{{ $preferences['color_primary'] }}] cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                    <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        <div class="bg-gradient-to-tr from-[{{ $preferences['color_1'] }}] via-[{{ $preferences['color_2'] }}] to-[{{ $preferences['color_3'] }}] rounded-lg select-none">
            <div style="background-image: url('{{ asset('preference-settings-cover-black.svg') }}')" class="w-full h-20 bg-repeat bg-center rounded-lg"></div>
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
        <form wire:submit="updatePreference" class="w-full h-fit p-0 bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
            <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center">
                <label for="color_1" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] .'px' }}]">
                    <span class="font-medium text-left select-none">Color 1</span>
                    <input wire:model="color_1" name="color_1" type="color" id="color_1" class="w-[5vw] h-[5vh] form-input text-center align-middle p-2 bg-[{{ $preferences['color_primary'] }}] border border-[{{$preferences['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg cursor-pointer">
                </label>
                <label for="color_2" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] .'px' }}]">
                    <span class="font-medium text-left select-none">Color 2</span>
                    <input wire:model="color_2" name="color_2" type="color" id="color_2" class="w-[5vw] h-[5vh] form-input text-center align-middle p-2 bg-[{{ $preferences['color_primary'] }}] border border-[{{$preferences['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg cursor-pointer">
                </label>
                <label for="color_3" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] .'px' }}]">
                    <span class="font-medium text-left select-none">Color 3</span>
                    <input wire:model="color_3" name="color_3" type="color" id="color_3" class="w-[5vw] h-[5vh] form-input text-center align-middle p-2 bg-[{{ $preferences['color_primary'] }}] border border-[{{$preferences['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg cursor-pointer">
                </label>
                <label for="color_primary" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] .'px' }}]">
                    <span class="font-medium text-left select-none">Color primary</span>
                    <input wire:model="color_primary" name="color_primary" type="color" id="color_primary" class="w-[5vw] h-[5vh] form-input text-center align-middle p-2 bg-[{{ $preferences['color_primary'] }}] border border-[{{$preferences['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg cursor-pointer">
                </label>
                <label for="color_secondary" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] .'px' }}]">
                    <span class="font-medium text-left select-none">Color secondary</span>
                    <input wire:model="color_secondary" name="color_secondary" type="color" id="color_secondary" class="w-[5vw] h-[5vh] form-input text-center align-middle p-2 bg-[{{ $preferences['color_primary'] }}] border border-[{{$preferences['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg cursor-pointer">
                </label>
                <label for="color_text" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] .'px' }}]">
                    <span class="font-medium text-left select-none">Color text</span>
                    <input wire:model="color_text" name="color_text" type="color" id="color_text" class="w-[5vw] h-[5vh] form-input text-center align-middle p-2 bg-[{{ $preferences['color_primary'] }}] border border-[{{$preferences['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg cursor-pointer">
                </label>
                <label for="font_size" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] .'px' }}]">
                    <span class="font-medium text-left select-none whitespace-nowrap">Font size</span>
                    <input wire:model="font_size" name="font_size" type="number" id="font_size" min="12" max="128" class="w-[5vw] h-fit form-input text-center align-middle p-2 bg-[{{ $preferences['color_primary'] }}] border border-[{{$preferences['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg">
                </label>
                <div class="flex flex-col space-x-0 space-y-2 text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] .'px' }}]">
                    <label for="fonts" class="basis-2/12 font-medium text-left select-none">Font family</label>
                    <select wire:model="selected_font_family" name="selected_font_family" id="fonts" class="form-select bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg cursor-pointer">
                            <option disabled>Select a font family</option>
                        @foreach ($available_font_families as $available_font_family)
                            <option value="{{ $available_font_family }}" class="font-[{{ $available_font_family }}] cursor-pointer">{{ $available_font_family }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full h-fit self-center p-2 text-[{{ $preferences['font_size'] . 'px' }}] text-[{{ $preferences['color_text'] }}] bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg select-none transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Update</button>
            </div>
        </form>
        <button type="submit" wire:click="resetPreference" wire:confirm="Are you sure you want to reset your preference settings?" class="w-full h-fit p-2 text-center text-[{{ $preferences['font_size'] .'px' }}] text-black bg-red-500 border-0 border-transparent rounded-lg cursor-pointer select-none transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Reset Preference</button>
    </div>
</div>
@script
<script>
    let preferenceSettings = document.getElementById('preferenceSettings');
    let preferenceSettingsHeader = document.getElementById('preferenceSettingsHeader');
    let posX = 0,
        posY = 0,
        mouseX = 0,
        mouseY = 0,
        left_position = 0,
        right_position = 0,
        top_position = 0,
        bottom_position = 0;
    
    preferenceSettingsHeader.addEventListener('mousedown', mouseDown, false);
    preferenceSettings.addEventListener('mouseup', mouseUp, false);
    
    function mouseDown(e)
    {
        e.preventDefault();
        posX = e.clientX - preferenceSettings.offsetLeft;
        posY = e.clientY - preferenceSettings.offsetTop;
        document.addEventListener('mousemove', moveElement, false);
    }
    
    function mouseUp()
    {
        document.removeEventListener('mousemove', moveElement, false);
        $wire.dispatch('save_preference_settings_modal_position', [{ 'left': left_position, 'right': right_position, 'top': top_position, 'bottom': bottom_position }]);
    }
    
    function moveElement(e)
    {
        mouseX = e.clientX - posX;
        mouseY = e.clientY - posY;
        if(mouseX >= 0 && window.innerWidth - mouseX - preferenceSettings.offsetWidth >= 0)
        {
            left_position = mouseX;
            right_position = window.innerWidth - left_position - preferenceSettings.offsetWidth;
            preferenceSettings.style.left = left_position + 'px';
            preferenceSettings.style.right = right_position + 'px';
        }
        if(mouseY >= 0 && window.innerHeight - mouseY - preferenceSettings.offsetHeight >= 0)
        {
            top_position = mouseY;
            bottom_position = window.innerHeight - top_position - preferenceSettings.offsetHeight;
            preferenceSettings.style.top = top_position + 'px';
            preferenceSettings.style.bottom = bottom_position + 'px';
        }
    }
</script>
@endscript