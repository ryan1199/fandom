<div x-data="{ followed: @entangle('followed').live }">
    <div x-cloak x-show="followed" wire:click="unfollow" class="w-fit h-fit px-2 font-semibold {{ 'hover:text-[' . $preferences['color_2'] . ']' }} cursor-pointer animation-button">Unfollow</div>
    <div x-cloak x-show="!followed" wire:click="follow" class="w-fit h-fit px-2 font-semibold {{ 'hover:text-[' . $preferences['color_2'] . ']' }} cursor-pointer animation-button">Follow</div>
</div>