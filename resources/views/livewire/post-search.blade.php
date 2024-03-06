<div class="w-full h-fit flex flex-row space-x-2 space-y-0">
    <input wire:model.blur="search" type="text" placeholder="Title" class="w-full form-input border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
    <select wire:model.blur="sort_by" class="form-select border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
        <option selected value="Published">Published</option>
        <option value="Views">Views</option>
    </select>
    <select wire:model.blur="sort" class="form-select border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
        <option selected value="ASC">ASC</option>
        <option value="DESC">DESC</option>
    </select>
</div>