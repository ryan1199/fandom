<div class="w-full h-fit grid gap-2 grid-cols-3">
    @if ($from == 'gallery')
    @foreach ($galleries as $gallery)
    <div
        class="w-full h-fit p-1 flex flex-col space-x-0 space-y-2 justify-between border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
        <div class="flex flex-col space-x-0 space-y-2">
            <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt=""
                class="w-full h-fit max-h-52 hover:max-h-full object-cover object-center rounded-lg">
            <div class="flex flex-col">
                <p>By {{ $gallery->user->username }}</p>
                <p class="text-right">Uploaded {{ $gallery->created_at->diffForHumans(['options' => null]) }}</p>
                <p class="text-right">
                    @if ($gallery->publish != null)
                    Published on
                    @if (class_basename($gallery->publish->publishable_type) === 'User')
                    {{ $gallery->publish->publishable->username }}
                    @else
                    {{ $gallery->publish->publishable->name }}
                    @endif
                    @else
                    Unpublished
                    @endif
                </p>
            </div>
        </div>
        <div class="flex flex-col space-x-0 space-y-1 select-none">
            <div wire:click="$parent.editGallery({{ $gallery->id }})"
                class="w-full h-fit p-1 text-center border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg cursor-pointer">
                Edit</div>
            <div wire:click="$parent.deleteGallery({{ $gallery->id }})"
                wire:confirm="Are you sure you want to delete this image?"
                class="w-full h-fit p-1 text-center border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg cursor-pointer">
                Delete</div>
        </div>
    </div>
    @endforeach
    @endif
    @if ($from == 'fandom')
    @foreach ($galleries as $gallery)
    <div
        class="w-full h-fit p-1 flex flex-col space-x-0 space-y-2 justify-between border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
        <div class="flex flex-col space-x-0 space-y-2">
            <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt=""
                class="w-full h-fit max-h-52 hover:max-h-full object-cover object-center rounded-lg">
            <div class="flex flex-col">
                <p>By {{ $gallery->user->username }}</p>
                <p class="text-right">Uploaded {{ $gallery->publish->created_at->diffForHumans(['options' => null]) }}
                </p>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>