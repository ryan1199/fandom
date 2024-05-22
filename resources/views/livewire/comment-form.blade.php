<form wire:submit="submitComment()">
    @csrf
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 items-stretch justify-stretch {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 rounded-lg z-10">
        @if ($comment != null)
            <div class="w-full h-fit p-2 flex flex-row space-x-4 space-y-0 items-start {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                <img src="{{ asset('storage/avatars/'.$comment->user->avatar->image->url) }}" alt="{{ $comment->user->username }}" title="{{ $comment->user->username }}" class="aspect-square w-auto h-[7vh] bg-black border-0 rounded-full object-cover" draggable="false">
                <div x-data="{ {{ 'open_comment_' . $comment->id }}: false }" class="w-full flex flex-col space-x-0 space-y-2">
                    <div class="flex flex-row items-center justify-between">
                        <p class="font-bold">{{ $comment->user->username }}</p>
                        <div wire:click="cancelReply" class="p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <p x-on:click="{{ 'open_comment_' . $comment->id . ' = ! ' . 'open_comment_' . $comment->id }}" :class="{{ 'open_comment_' . $comment->id }} ? 'line-clamp-none' : 'line-clamp-2'" class="font-thin text-gray-600">
                        {{ $comment->message->text }}
                    </p>
                </div>
            </div>
        @endif
        <textarea id="commentForm" wire:model="content" class="w-full h-fit form-textarea {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg" rows="5" cols="100"></textarea>
        @error('content')
            <div class="w-full h-fit text-red-500">{{ $message }}</div>
        @enderror
        <button type="submit" class="w-fit h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">Submit</button>
    </div>
</form>