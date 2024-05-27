<div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
    <div class="flex flex-row space-x-2 space-y-0 items-center justify-stretch">
        <input wire:model="name" type="text" class="w-full h-fit form-input border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg" placeholder="Discussion Name">
        <select wire:model.live="visible" class="w-fit h-fit form-select border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
            @foreach ($available_visible as $value)
                @if ($loop->first)
                    <option selected value="{{ $value }}">{{ $value }}</option>
                @else
                    <option value="{{ $value }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
        <div wire:click="createDiscussion" class="h-fit p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">Create</div>
    </div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="text-red-500">{{ $error }}</div>
        @endforeach
    @endif
</div>
