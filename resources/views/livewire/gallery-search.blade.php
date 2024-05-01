<div class="w-full h-fit flex flex-col space-x-0 space-y-2">
    <div class="w-full h-fit flex flex-row space-x-2 space-y-0">
        <input wire:model.blur="search" type="text" placeholder="Tags" class="w-full form-input border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
        <select wire:model.blur="sort_by" class="form-select border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
            @foreach ($sort_by_available as $value)
                @if ($loop->first)
                    <option selected value="{{ $value }}">{{ $value }}</option>
                @else
                    <option value="{{ $value }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
        <select wire:model.blur="sort" class="form-select border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
            @foreach ($sort_available as $value)
                @if ($loop->first)
                    <option selected value="{{ $value }}">{{ $value }}</option>
                @else
                    <option value="{{ $value }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
    </div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="text-red-500">{{ $error }}</div>
        @endforeach
    @endif
</div>
