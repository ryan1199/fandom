<div class="w-full p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg overflow-x-auto">
    <div class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-between items-center">
        <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
            <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                Comments
            </span>
        </div>
        <select wire:model.live="sorting" class="form-select {{ 'bg-' . $preferences['color_2'] . '-50/10' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation">
            <option value="Latest" @selected($sorting == 'Latest')>Latest</option>
            <option value="Old" @selected($sorting == 'Old')>Old</option>
            <option value="Like" @selected($sorting == 'Like')>Like</option>
            <option value="Dislike" @selected($sorting == 'Dislike')>Dislike</option>
        </select>
    </div>
    @if ($post != null)
        @auth
            @livewire(CommentForm::class, ['preferences' => $preferences, 'post' => $post, 'gallery' => null, 'reply' => null], key('comment-form-for-post-' . $post->id))
        @endauth
        @livewire(CommentList::class, ['preferences' => $preferences, 'reply' => null, 'comments' => $comments], key('comment-list-for-post-' . $post->id))
    @endif
    @if ($gallery != null)
        @auth
            @livewire(CommentForm::class, ['preferences' => $preferences, 'post' => null, 'gallery' => $gallery, 'reply' => null], key('comment-form-for-gallery-' . $gallery->id))
        @endauth
        @livewire(CommentList::class, ['preferences' => $preferences, 'reply' => null, 'comments' => $comments], key('comment-list-for-gallery-' . $gallery->id))
    @endif
</div>
