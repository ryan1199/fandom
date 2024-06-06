<div>
    <form wire:submit="submitChat">
        @csrf
        <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-red-500">{{ $error }}</div>
                @endforeach
            @endif
            <div class="flex flex-row space-x-1 space-y-0 items-center">
                <textarea wire:model="content" placeholder="Your message" title="Your message" cols="30" rows="1" class="form-input w-full h-fit border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg"></textarea>
                <button type="submit" title="Send your message"
                    class="w-fit h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>
