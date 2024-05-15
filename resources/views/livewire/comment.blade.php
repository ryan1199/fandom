<div class="w-full p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg overflow-x-auto">
    <div class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-between items-center">
        <div class="font-semibold">Comments</div>
        <select class="form-select border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
            <option value="Like">Like</option>
            <option value="New" selected>New</option>
            <option value="Old">Old</option>
        </select>
    </div>
    @auth
        <livewire:comment-form :$preferences :$from :$id :reply=null :key="rand()" />
    @endauth
    <livewire:comment-list :$preferences :$from :$id :reply=null :$comments :key="rand()" />
</div>
