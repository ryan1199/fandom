<div class="w-full h-fit flex flex-col space-x-0 space-y-2">
    <div class="w-full h-fit flex flex-col sm:flex-row lg:flex-col xl:flex-row space-x-0 space-y-2 sm:space-x-2 sm:space-y-0 lg:space-x-0 lg:space-y-2 xl:space-x-2 xl:space-y-0">
        <input wire:model.blur="search" type="text" placeholder="Title" class="w-full h-14 form-input border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
        <div class="w-full sm:w-fit lg:w-full xl:w-fit h-full flex flex-row space-x-2 space-y-0">
            <select wire:model.live="sort_by" class="w-full sm:w-fit lg:w-full xl:w-fit h-14 form-select border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                @foreach ($sort_by_available as $value)
                    @if ($loop->first)
                        <option selected value="{{ $value }}">{{ $value }}</option>
                    @else
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endif
                @endforeach
            </select>
            <select wire:model.live="sort" class="w-full sm:w-fit lg:w-full xl:w-fit h-14 form-select border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                @foreach ($sort_available as $value)
                    @if ($loop->first)
                        <option selected value="{{ $value }}">{{ $value }}</option>
                    @else
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        @if ($from == 'user')
            <label for="Published" class="w-fit h-14 p-2 flex flex-row space-x-2 space-y-0 items-center border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                <span>Published</span>
                <input wire:model.live="published" type="checkbox" id="Published" value="true" class="form-checkbox p-4 rounded-lg">
            </label>
        @endif
    </div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="text-red-500">{{ $error }}</div>
        @endforeach
    @endif
</div>