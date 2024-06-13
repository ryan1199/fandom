<div x-data="{ blocked: @entangle('blocked').live }">
    <div x-cloak x-show="blocked" wire:click="unblock" class="w-fit h-full p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg cursor-pointer">Unblock</div>
    <div x-cloak x-show="!blocked" wire:click="block" class="w-fit h-full p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg cursor-pointer">Block</div>
</div>