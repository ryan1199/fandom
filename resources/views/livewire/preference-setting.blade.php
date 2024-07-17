<div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500 bg-zinc-50 border border-zinc-200 rounded-lg">
    <div class="bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} rounded-lg select-none">
        <div style="background-image: url('{{ asset('preference-settings-cover-white.svg') }}')" class="w-full h-20 bg-repeat bg-center border border-zinc-200 rounded-lg"></div>
    </div>
    @if ($errors->any())
        <div class="w-full h-full p-2 flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} bg-zinc-50 border border-rose-500 rounded-lg">
            <p class="font-semibold">Errors:</p>
            <ul class="pl-4 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} text-rose-500 list-disc list-outside">
                @foreach ($errors->all() as $error)
                    <li wire:key="{{ 'error' . $loop->index }}">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form wire:submit="updatePreference">
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg justify-center">
            <label for="color_1" class="grid grid-cols-2 gap-2 items-center">
                <span class="w-full h-fit font-medium text-left select-none">Color 1</span>
                <input wire:model="color_1" name="color_1" type="color" id="color_1" class="w-full h-10 form-input text-center align-middle p-2 bg-zinc-50 border @error('cover') border-rose-500 @else border-zinc-200 @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg cursor-pointer animation">
            </label>
            <hr class="border-zinc-200">
            <label for="color_2" class="grid grid-cols-2 gap-2 items-center  ">
                <span class="w-full h-fit font-medium text-left select-none">Color 2</span>
                <input wire:model="color_2" name="color_2" type="color" id="color_2" class="w-full h-10 form-input text-center align-middle p-2 bg-zinc-50 border @error('cover') border-rose-500 @else border-zinc-200 @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg cursor-pointer animation">
            </label>
            <hr class="border-zinc-200">
            <label for="color_3" class="grid grid-cols-2 gap-2 items-center  ">
                <span class="w-full h-fit font-medium text-left select-none">Color 3</span>
                <input wire:model="color_3" name="color_3" type="color" id="color_3" class="w-full h-10 form-input text-center align-middle p-2 bg-zinc-50 border @error('cover') border-rose-500 @else border-zinc-200 @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg cursor-pointer animation">
            </label>
            {{-- <hr class="border-zinc-200">
            <label for="color_primary" class="grid grid-cols-2 gap-2 items-center  ">
                <span class="w-full h-fit font-medium text-left select-none">Color primary</span>
                <input wire:model="color_primary" name="color_primary" type="color" id="color_primary" class="w-full h-10 form-input text-center align-middle p-2 bg-zinc-50 border @error('cover') border-rose-500 @else border-zinc-200 @enderror rounded-lg cursor-pointer">
            </label>
            <hr class="border-zinc-200">
            <label for="color_secondary" class="grid grid-cols-2 gap-2 items-center  ">
                <span class="w-full h-fit font-medium text-left select-none">Color secondary</span>
                <input wire:model="color_secondary" name="color_secondary" type="color" id="color_secondary" class="w-full h-10 form-input text-center align-middle p-2 bg-zinc-50 border @error('cover') border-rose-500 @else border-zinc-200 @enderror rounded-lg cursor-pointer">
            </label>
            <hr class="border-zinc-200">
            <label for="color_text" class="grid grid-cols-2 gap-2 items-center  ">
                <span class="w-full h-fit font-medium text-left select-none">Color text</span>
                <input wire:model="color_text" name="color_text" type="color" id="color_text" class="w-full h-10 form-input text-center align-middle p-2 bg-zinc-50 border @error('cover') border-rose-500 @else border-zinc-200 @enderror rounded-lg cursor-pointer">
            </label> --}}
            <hr class="border-zinc-200">
            <label for="font_size" class="grid grid-cols-2 gap-2 items-center  ">
                <span class="w-full h-fit font-medium text-left select-none whitespace-nowrap">Font size</span>
                <input wire:model="font_size" name="font_size" type="number" id="font_size" min="11" max="127" class="w-full h-10 form-input text-center align-middle p-2 bg-zinc-50 border @error('cover') border-rose-500 @else border-zinc-200 @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} animation rounded-lg">
             </label>
            <hr class="border-zinc-200">
            <div class="grid grid-cols-2 gap-2 items-center  ">
                <label for="fonts" class="w-full h-fit font-medium text-left select-none whitespace-nowrap">Font family</label>
                <select wire:model="selected_font_family" name="selected_font_family" id="fonts" class="w-full h-10 form-select bg-zinc-50 border border-zinc-200 {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg cursor-pointer animation">
                    <option disabled>Select a font family</option>
                    @foreach ($available_font_families as $available_font_family)
                        <option value="{{ $available_font_family }}" class="{{ 'font-[' . $available_font_family . ']' }} cursor-pointer">{{ $available_font_family }}</option>
                    @endforeach
                </select>
            </div>
            <hr class="border-zinc-200">
            <button type="submit" class="w-fit h-fit self-center font-semibold {{ 'hover:text-[' . $preferences['color_2'] . ']' }} select-none animation-button">Update</button>
        </div>
    </form>
    <button type="submit" wire:click="resetPreference" wire:confirm="Are you sure you want to reset your preference settings?" class="w-fit h-fit self-center text-center font-semibold {{ 'hover:text-[' . $preferences['color_2'] . ']' }} select-none animation-button">Reset Preference</button>
</div>