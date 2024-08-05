<div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-100' }} rounded-lg">
    <div class="w-full h-fit flex flex-row justify-between items-center">
        <div class="w-fit {{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
            <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
              Preference
            </span>
        </div>
        <div wire:click="resetPreference" wire:confirm="Are you sure you want to reset your preference settings?" class="w-fit h-fit p-2 font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg select-none cursor-pointer animation-button">Reset</div>
    </div>
    @if ($errors->any())
        <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
            <p class="font-semibold">Errors:</p>
            <ul class="pl-4 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-disc list-outside">
                @foreach ($errors->all() as $error)
                    <li wire:key="{{ 'error' . $loop->index }}">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form wire:submit="updatePreference">
        <div class="w-full h-fit flex flex-col space-x-0 space-y-2 rounded-lg justify-center">
            <div class="w-full h-fit flex flex-row justify-between items-center">
                <span>Mode</span>
                <div x-data="{ dark_mode: @entangle('dark_mode') }" class="flex flex-row space-x-2">
                    <svg x-on:click="dark_mode = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" :class="dark_mode ? 'opacity-50 cursor-pointer' : 'opacity-100 cursor-not-allowed'" class="size-6 text-yellow-500">
                        <path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
                    </svg>
                    <svg x-on:click="dark_mode = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" :class="dark_mode ? 'opacity-100 cursor-not-allowed' : 'opacity-50 cursor-pointer'" class="size-6 text-indigo-500">
                        <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div x-data="{ selected_color_scheme: @entangle('selected_color_scheme'), selected_color: @entangle('selected_color') }" class="w-full h-fi flex flex-col space-x-0 space-y-2">
                <span class="font-medium select-none">Color scheme</span>
                <div>
                    <div class="w-full h-fit grid grid-cols-5">
                        @foreach ($available_color_scheme_1 as $color_scheme_1)
                            <div wire:click="setColorScheme('color_scheme_1', '{{ $color_scheme_1 }}')" wire:key="{{ 'color-scheme-' . $color_scheme_1 }}" class="w-full h-10 flex flex-col justify-center items-center {{ 'bg-' . $color_scheme_1 . '-500' }} cursor-pointer" title="{{ $color_scheme_1 }}">
                                <svg x-cloak x-show="selected_color == '{{ $color_scheme_1 }}'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-50' }}">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endforeach
                    </div>
                    <div class="w-full h-fit grid grid-cols-5">
                        @foreach ($available_color_scheme_2 as $color_scheme_2)
                            <div wire:click="setColorScheme('color_scheme_2', '{{ $color_scheme_2 }}')" wire:key="{{ 'color-scheme-' . $color_scheme_1 }}" class="w-full h-10 flex flex-col justify-center items-center {{ 'bg-' . $color_scheme_2 . '-500' }} cursor-pointer" title="{{ $color_scheme_2 }}">
                                <svg x-cloak x-show="selected_color == '{{ $color_scheme_2 }}'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-50' }}">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <label for="font_size" class="grid grid-cols-2 gap-2 items-center  ">
                <span class="w-full h-fit font-medium text-left select-none whitespace-nowrap">Font size</span>
                <input wire:model="font_size" name="font_size" type="number" id="font_size" min="11" max="127" class="w-full h-10 form-input text-center align-middle p-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} border @error('font_size') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} animation rounded-lg">
             </label>
            <div class="grid grid-cols-2 gap-2 items-center  ">
                <label for="fonts" class="w-full h-fit font-medium text-left select-none whitespace-nowrap">Font family</label>
                <select wire:model="selected_font_family" name="selected_font_family" id="fonts" class="w-full h-10 form-select {{ 'bg-' . $preferences['color_2'] . '-50' }} border @error('selected_font_family') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer animation">
                    <option disabled>Select a font family</option>
                    @foreach ($available_font_families as $available_font_family)
                        <option value="{{ $available_font_family }}" class="{{ 'font-[' . $available_font_family . ']' }} cursor-pointer">{{ $available_font_family }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-fit h-fit p-2 self-end font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg select-none animation-button">Update</button>
        </div>
    </form>
</div>