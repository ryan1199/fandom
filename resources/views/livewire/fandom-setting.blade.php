<div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500 bg-zinc-50 border border-zinc-200 rounded-lg">
    {{-- image cover --}}
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
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg justify-center">
        <label for="cover" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
            <span class="font-medium text-left select-none">Cover</span>
            <input wire:model.blur="cover" type="file" id="cover" class="w-full form-input file:text-zinc-50 file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr {{ 'file:from-[' . $preferences['color_1'] . ']' }} {{ 'file:via-[' . $preferences['color_2'] . ']' }} {{ 'file:to-[' . $preferences['color_3'] . ']' }} file:border file:border-zinc-200 file:rounded-lg border @error('cover') border-rose-500 @else border-zinc-200 @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg cursor-pointer file:cursor-pointer animation animation-button-file">
        </label>
        <label for="avatar" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
            <span class="font-medium text-left select-none">Avatar</span>
            <input wire:model.blur="avatar" type="file" id="avatar" class="w-full form-input file:text-zinc-50 file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr {{ 'file:from-[' . $preferences['color_1'] . ']' }} {{ 'file:via-[' . $preferences['color_2'] . ']' }} {{ 'file:to-[' . $preferences['color_3'] . ']' }} file:border file:border-zinc-200 file:rounded-lg border @error('avatar') border-rose-500 @else border-zinc-200 @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg cursor-pointer file:cursor-pointer animation animation-button-file">
        </label>
        <label for="description" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
            <span class="font-medium text-left select-none">Description</span>
            <textarea wire:model.blur="description" id="description" placeholder="Describe your self" class="w-full form-textarea border @error('description') border-rose-500 @else border-zinc-200 @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation"></textarea>
        </label>
    </div>
</div>
