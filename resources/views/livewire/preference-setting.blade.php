<div x-cloak x-show="preference_modal" class="w-full h-fit mb-2 p-2 flex flex-col space-x-0 space-y-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] border-0 border-transparent rounded-lg">
    @if ($errors->any())
        <div class="w-full h-full p-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-red-500 rounded-lg">
            <ul class="list-inside list-disc flex flex-col space-x-0 space-y-2 text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] . 'px' }}] text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form wire:submit="updatePreference" class="w-full h-fit p-0 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] rounded-lg">
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center">
            <label for="color_1" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <span class="font-medium text-left">Color 1</span>
                <input wire:model="color_1" name="color_1" type="color" id="color_1" class="w-[5vw] h-[5vh] form-input text-center align-middle p-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{session()->get(Auth::user()->username . '-preference')['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg">
            </label>
            <label for="color_2" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <span class="font-medium text-left">Color 2</span>
                <input wire:model="color_2" name="color_2" type="color" id="color_2" class="w-[5vw] h-[5vh] form-input text-center align-middle p-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{session()->get(Auth::user()->username . '-preference')['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg">
            </label>
            <label for="color_3" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <span class="font-medium text-left">Color 3</span>
                <input wire:model="color_3" name="color_3" type="color" id="color_3" class="w-[5vw] h-[5vh] form-input text-center align-middle p-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{session()->get(Auth::user()->username . '-preference')['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg">
            </label>
            <label for="color_primary" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <span class="font-medium text-left">Color primary</span>
                <input wire:model="color_primary" name="color_primary" type="color" id="color_primary" class="w-[5vw] h-[5vh] form-input text-center align-middle p-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{session()->get(Auth::user()->username . '-preference')['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg">
            </label>
            <label for="color_secondary" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <span class="font-medium text-left">Color secondary</span>
                <input wire:model="color_secondary" name="color_secondary" type="color" id="color_secondary" class="w-[5vw] h-[5vh] form-input text-center align-middle p-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{session()->get(Auth::user()->username . '-preference')['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg">
            </label>
            <label for="color_text" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <span class="font-medium text-left">Color text</span>
                <input wire:model="color_text" name="color_text" type="color" id="color_text" class="w-[5vw] h-[5vh] form-input text-center align-middle p-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{session()->get(Auth::user()->username . '-preference')['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg">
            </label>
            <label for="font_size" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <span class="font-medium text-left whitespace-nowrap">Font size</span>
                <input wire:model="font_size" name="font_size" type="number" id="font_size" min="12" max="128" class="w-[5vw] h-fit form-input text-center align-middle p-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{session()->get(Auth::user()->username . '-preference')['color_secondary']}}] @error('cover') invalid @else valid @enderror rounded-lg">
            </label>
            <div class="flex flex-col space-x-0 space-y-2 text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <label for="fonts" class="basis-2/12 font-medium text-left">Font family</label>
                <select wire:model="selected_font_family" name="selected_font_family" id="fonts" class="form-select bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] rounded-lg">
                        <option disabled>Select a font family</option>
                    @foreach ($available_font_families as $available_font_family)
                        <option value="{{ $available_font_family }}" class="font-[{{ $available_font_family }}]">{{ $available_font_family }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-full h-fit self-center p-2 text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] . 'px' }}] text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] rounded-lg">Update</button>
        </div>
    </form>
</div>