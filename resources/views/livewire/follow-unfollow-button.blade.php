<div x-data="{ followed: @entangle('followed').live }" class="flex flex-row space-x-1 space-y-0">
    <div x-cloak x-show="followed" wire:click="unfollow" class="w-fit h-fit p-2 font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">Unfollow</div>
    <div x-cloak x-show="!followed" wire:click="follow" class="w-fit h-fit p-2 font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">Follow</div>
</div>