<div class="w-full h-fit flex flex-col space-x-0 space-y-2">
    @if ($from == 'post')
    @foreach ($posts as $post)
    <div class="w-full h-fit p-1 border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
        <h1>{{ $post->title }}</h1>
        <div class="flex flex-col">
            <p>By {{ $post->user->username }}</p>
            <p class="text-right">Created {{ $post->created_at->diffForHumans(['options' => null]) }}</p>
            <p class="text-right">
                @if ($post->publish != null)
                Published on
                @if (class_basename($post->publish->publishable_type) === 'User')
                {{ $post->publish->publishable->username }}
                @else
                {{ $post->publish->publishable->name }}
                @endif
                @else
                Unpublished
                @endif
            </p>
        </div>
        <div class="flex flex-col space-x-0 space-y-1 select-none">
            @if ($post->publish_id == null)
            <div x-data="{ open: false }" class="flex flex-col space-x-0 space-y-1">
                <div x-on:click="open = ! open"
                    class="w-full h-fit p-1 text-center border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg cursor-pointer">
                    Publish On</div>
                <div x-show="open" class="flex flex-col space-x-0 space-y-1 rounded-lg">
                    @foreach ($publish_on as $array)
                    <div
                        class="w-full h-fit p-1 flex flex-row items-center space-x-1 space-y-0 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
                        <div class="w-full h-fit text-center">{{ $array['name'] }}</div>
                        @if ($array['from'] == 'user')
                        <div wire:click="$parent.publishPost({{ $post }}, '{{ $array['from'] }}', {{ $array['id'] }}, 'self')"
                            class="w-full h-fit p-1 text-center border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg cursor-pointer">
                            Self</div>
                        <div wire:click="$parent.publishPost({{ $post }}, '{{ $array['from'] }}', {{ $array['id'] }}, 'friend')"
                            class="w-full h-fit p-1 text-center border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg cursor-pointer">
                            Friend</div>
                        <div wire:click="$parent.publishPost({{ $post }}, '{{ $array['from'] }}', {{ $array['id'] }}, 'public')"
                            class="w-full h-fit p-1 text-center border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg cursor-pointer">
                            Public</div>
                        @else
                        <div wire:click="$parent.publishPost({{ $post }}, '{{ $array['from'] }}', {{ $array['id'] }}, 'member')"
                            class="w-full h-fit p-1 text-center border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg cursor-pointer">
                            Member</div>
                        <div wire:click="$parent.publishPost({{ $post }}, '{{ $array['from'] }}', {{ $array['id'] }}, 'public')"
                            class="w-full h-fit p-1 text-center border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg cursor-pointer">
                            Public</div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div wire:click="$parent.unpublishPost({{ $post->id }})"
                class="w-full h-fit p-1 text-center border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg cursor-pointer">
                Unpublished</div>
            @endif
            <div wire:click="$parent.editPost({{ $post->id }})"
                class="w-full h-fit p-1 text-center border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg cursor-pointer">
                Edit</div>
            <div wire:click="$parent.deletePost({{ $post->id }})"
                wire:confirm="Are you sure you want to delete this post?"
                class="w-full h-fit p-1 text-center border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg cursor-pointer">
                Delete</div>
        </div>
    </div>
    @endforeach
    @endif
    @if ($from == 'fandom')
    @foreach ($posts as $post)
    <div class="w-full h-fit p-1 border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
        <h1>{{ $post->title }}</h1>
        <div class="flex flex-col">
            <p>By {{ $post->user->username }}</p>
            <p class="text-right">Published {{ $post->publish->created_at->diffForHumans(['options' => null]) }}</p>
        </div>
    </div>
    @endforeach
    @endif
</div>