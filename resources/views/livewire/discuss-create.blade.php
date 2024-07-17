<div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500 bg-zinc-50 border border-zinc-200 rounded-lg">
    {{-- image cover --}}
    @if ($errors->any())
        <div class="flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
            <p class="font-semibold">Errors:</p>
            <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} text-rose-500 list-disc list-outside">
                @foreach ($errors->all() as $error)
                    <li wire:key="{{ 'error' . $loop->index }}">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="w-full h-fit flex flex-col sm:flex-row lg:flex-col xl:flex-row space-x-0 space-y-2 sm:space-x-2 sm:space-y-0 lg:space-x-0 lg:space-y-2 xl:space-x-2 xl:space-y-0 items-center">
        <input wire:model="name" type="text" placeholder="Discussion Name" class="w-full h-14 form-input border border-zinc-200 {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation">
        <select wire:model.live="visible" class="w-full sm:w-fit lg:w-full xl:w-fit h-14 form-select border border-zinc-200 {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation">
            @foreach ($available_visible as $value)
                @if ($loop->first)
                    <option wire:key="{{ 'visible' . $loop->index }}" selected value="{{ $value }}">{{ $value }}</option>
                @else
                    <option wire:key="{{ 'visible' . $loop->index }}" value="{{ $value }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
        <div wire:click="createDiscussion" class="w-fit h-fit text-nowrap font-semibold {{ 'hover:text-[' . $preferences['color_2'] . ']' }} cursor-pointer select-none animation-button">Create</div>
    </div>
</div>
