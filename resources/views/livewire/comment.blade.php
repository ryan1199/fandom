<div class="w-full p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg overflow-x-auto">
    <div class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-between items-center">
        <div class="font-semibold">Comments</div>
        <select wire:model.live="sorting" class="form-select border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
            <option value="Latest" @selected($sorting == 'Latest')>Latest</option>
            <option value="Old" @selected($sorting == 'Old')>Old</option>
            <option value="Like" @selected($sorting == 'Like')>Like</option>
            <option value="Dislike" @selected($sorting == 'Dislike')>Dislike</option>
        </select>
    </div>
    @auth
        <livewire:comment-form :$preferences :$from :$id :reply=null :key="rand()" />
    @endauth
    <livewire:comment-list :$preferences :$from :$id :reply=null :$comments :key="rand()" />
</div>
