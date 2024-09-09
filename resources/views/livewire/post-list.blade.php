<div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none">
    <div class="w-full h-fit grid gap-2 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($posts as $post)
            @if (class_basename($post->publish->publishable_type) === 'User')
                @livewire(UsersPostCard::class, ['post' => $post->id, 'user' => $post->publish->publishable->username, 'preferences' => $preferences], key('post-' . $post->id . '-from-post-page-' . rand()))
            @else
                @livewire(FandomsPostCard::class, ['post' => $post->id, 'fandom' => $post->publish->publishable->slug, 'preferences' => $preferences], key('post-' . $post->id . '-from-post-page-' . rand()))
            @endif
        @empty
            <div class="w-screen max-w-full h-full py-12 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    No posts found
                </div>
            </div>
        @endforelse
    </div>
    @if ($posts->hasPages())
        <div>{{ $posts->links('vendor.livewire.simple-tailwind' ,['preferences' => $preferences]) }}</div>
    @endif
</div>