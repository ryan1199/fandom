<div x-data="{ followed: @entangle('followed').live }">
    <div x-cloak x-show="followed" wire:click="unfollow" class="w-fit h-full p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg cursor-pointer">Unfollow</div>
    <div x-cloak x-show="!followed" wire:click="follow" class="w-fit h-full p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg cursor-pointer">Follow</div>
</div>