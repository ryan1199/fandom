<div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2">
    <div class="font-semibold">Setting</div>
    <div class="w-full h-fit p-1 flex flex-col space-x-0 space-y-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
        <label for="cover" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 sm:space-y-0 justify-between items-stretch sm:items-center {{ 'text-[' . $preferences['color_text'] . ']' }} {{ 'text-[' . $preferences['font_size'] . 'px]' }}">
            <span class="basis-2/12 font-medium text-left select-none">Cover</span>
            <input wire:model.blur="cover" type="file" id="cover" class="w-full h-fit form-input file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr {{ 'file:from-[' . $preferences['color_1'] . ']' }} {{ 'file:via-[' . $preferences['color_2'] . ']' }} {{ 'file:to-[' . $preferences['color_3'] . ']' }} file:border {{ 'file:border-[' . $preferences['color_secondary'] . ']' }} file:rounded-lg border @error('cover') invalid @else valid @enderror rounded-lg cursor-pointer file:cursor-pointer file:transition-all file:duration-100 hover:file:opacity-50 file:active:duration-75 file:active:scale-[.95]">
        </label>
        <label for="avatar" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 sm:space-y-0 justify-between items-stretch sm:items-center {{ 'text-[' . $preferences['color_text'] . ']' }} {{ 'text-[' . $preferences['font_size'] . 'px]' }}">
            <span class="basis-2/12 font-medium text-left select-none">Avatar</span>
            <input wire:model.blur="avatar" type="file" id="avatar" class="w-full h-fit form-input file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr {{ 'file:from-[' . $preferences['color_1'] . ']' }} {{ 'file:via-[' . $preferences['color_2'] . ']' }} {{ 'file:to-[' . $preferences['color_3'] . ']' }} file:border {{ 'file:border-[' . $preferences['color_secondary'] . ']' }} file:rounded-lg border @error('avatar') invalid @else valid @enderror rounded-lg cursor-pointer file:cursor-pointer file:transition-all file:duration-100 hover:file:opacity-50 file:active:duration-75 file:active:scale-[.95]">
        </label>
        <label for="description" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 sm:space-y-0 justify-between items-stretch sm:items-center {{ 'text-[' . $preferences['color_text'] . ']' }} {{ 'text-[' . $preferences['font_size'] . 'px]' }}">
            <span class="basis-2/12 font-medium text-left select-none">Description</span>
            <input wire:model.blur="description" type="text" id="description" placeholder="Fandom description" class="w-full h-fit form-input border @error('description') invalid @else valid @enderror rounded-lg">
        </label>
    </div>
</div>
