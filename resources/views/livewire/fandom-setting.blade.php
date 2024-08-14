<div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
    <div class="w-fit {{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
        <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
          Setting
        </span>
    </div>
    <div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
        <p class="font-semibold">Rules:</p>
        <ol class="pl-8 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-decimal list-outside">
            <li>Image maximum size is 10 mb</li>
            <li>Description maximum length is 500 characters</li>
        </ol>
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
    <div class="w-full h-fit flex flex-col space-x-0 space-y-2 rounded-lg justify-center">
        <label for="cover" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
            <span class="font-medium text-left select-none">Cover</span>
            <input wire:model.blur="cover" type="file" id="cover" class="w-full form-input {{ 'bg-' . $preferences['color_2'] . '-50/10' }} {{ 'file:text-' . $preferences['color_2'] . '-900' }} file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr {{ 'file:from-' . $preferences['color_1'] . '-500' }} {{ 'file:via-' . $preferences['color_2'] . '-500' }} {{ 'file:to-' . $preferences['color_3'] . '-500' }} file:rounded-lg border @error('cover') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer file:cursor-pointer animation animation-button-file">
        </label>
        <label for="avatar" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
            <span class="font-medium text-left select-none">Avatar</span>
            <input wire:model.blur="avatar" type="file" id="avatar" class="w-full form-input {{ 'bg-' . $preferences['color_2'] . '-50/10' }} {{ 'file:text-' . $preferences['color_2'] . '-900' }} file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr {{ 'file:from-' . $preferences['color_1'] . '-500' }} {{ 'file:via-' . $preferences['color_2'] . '-500' }} {{ 'file:to-' . $preferences['color_3'] . '-500' }} file:rounded-lg border @error('avatar') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer file:cursor-pointer animation animation-button-file">
        </label>
        <label for="description" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
            <span class="font-medium text-left select-none">Description</span>
            <textarea wire:model.blur="description" id="description" placeholder="The description of fandom" class="w-full form-textarea {{ 'placeholder:text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50/10' }} border @error('description') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation"></textarea>
        </label>
    </div>
</div>
