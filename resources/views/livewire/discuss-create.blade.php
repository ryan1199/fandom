<div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
    <div class="w-fit {{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
        <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
          Create a discussion
        </span>
    </div>
    <div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
        <p class="font-semibold">Rules:</p>
        <ol class="pl-8 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-decimal list-outside">
            <li>Name maximum length is 50 characters</li>
            <li>Visible available options are public, member and manager</li>
        </ol>
    </div>
    @if ($errors->any())
        <div class="flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
            <p class="font-semibold">Errors:</p>
            <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-disc list-outside">
                @foreach ($errors->all() as $error)
                    <li wire:key="{{ 'error' . $loop->index }}">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form wire:submit="createDiscussion">
        @csrf
        <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
            <label for="name" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
                <span class="font-medium text-left select-none">Name</span>
                <input wire:model="name" type="text" placeholder="Discussion Name" id="name" class="w-full h-fit form-input {{ 'placeholder:text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50/10' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation">
            </label>
            <label for="visible" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
                <span class="font-medium text-left select-none">Visible</span>
                <select wire:model.live="visible" id="visible" class="w-full h-fit form-select {{ 'bg-' . $preferences['color_2'] . '-50/10' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation">
                    @foreach ($available_visible as $value)
                        @if ($loop->first)
                            <option wire:key="{{ 'visible' . $loop->index }}" selected value="{{ $value }}">{{ $value }}</option>
                        @else
                            <option wire:key="{{ 'visible' . $loop->index }}" value="{{ $value }}">{{ $value }}</option>
                        @endif
                    @endforeach
                </select>
            </label>
            <button type="submit" class="w-fit h-fit p-2 self-end text-nowrap font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer select-none animation-button">Create</button>
        </div>
    </form>
</div>
