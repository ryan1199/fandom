<div x-data="{ blocked: @entangle('blocked').live }">
    <div x-cloak x-show="blocked" wire:click="unblock" class="w-fit h-fit px-2 font-semibold {{ 'hover:text-[' . $preferences['color_2'] . ']' }} cursor-pointer animation-button">Unblock</div>
    <div x-cloak x-show="!blocked" wire:click="block" class="w-fit h-fit px-2 font-semibold {{ 'hover:text-[' . $preferences['color_2'] . ']' }} cursor-pointer animation-button">Block</div>
</div>