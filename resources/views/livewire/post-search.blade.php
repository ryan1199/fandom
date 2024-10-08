<div class="w-full h-fit flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }}">
    <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
        <div class="w-full h-fit flex flex-row lg:flex-col space-x-2 space-y-0 lg:space-x-0 lg:space-y-2">
            <input wire:model.live="title" type="text" placeholder="Title" class="w-full h-14 form-input {{ 'placeholder:text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50/10' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" title="Post title">
            <input wire:model.live="tags" type="text" placeholder="Tags" class="w-full h-14 form-input {{ 'placeholder:text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50/10' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" title="tag,tag,tag,...">
        </div>
        <div class="w-full sm:w-fit lg:w-full xl:w-fit h-full flex flex-row space-x-2 space-y-0">
            <select wire:model.live="sort_by" class="w-full sm:w-fit lg:w-full xl:w-fit h-14 form-select {{ 'bg-' . $preferences['color_2'] . '-50/10' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" title="Sort by">
                @foreach ($sort_by_available as $value)
                    @if ($loop->first)
                        <option wire:key="{{ 'post-search-sort-by-' . $loop->index }}" selected value="{{ $value }}">{{ $value }}</option>
                    @else
                        <option wire:key="{{ 'post-search-sort-by-' . $loop->index }}" value="{{ $value }}">{{ $value }}</option>
                    @endif
                @endforeach
            </select>
            <select wire:model.live="sort" class="w-full sm:w-fit lg:w-full xl:w-fit h-14 form-select {{ 'bg-' . $preferences['color_2'] . '-50/10' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" title="Sorting">
                @foreach ($sort_available as $value)
                    @if ($loop->first)
                        <option wire:key="{{ 'post-search-sort-' . $loop->index }}" selected value="{{ $value }}">{{ $value }}</option>
                    @else
                        <option wire:key="{{ 'post-search-sort-' . $loop->index }}" value="{{ $value }}">{{ $value }}</option>
                    @endif
                @endforeach
            </select>
            <input wire:model.live="limit" type="number" class="w-fit h-14 form-input {{ 'placeholder:text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50/10' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" min="1" max="10" title="Limit">
        </div>
    </div>
    @if ($errors->any())
        <div class="flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
            <p class="font-semibold">Errors:</p>
            <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-disc list-outside">
                @foreach ($errors->all() as $error)
                    <li wire:key="{{ 'post-search-error-' . $loop->index }}">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>