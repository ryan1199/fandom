<div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
    <div x-data="{ open: true }" class="w-full h-fit p-1 flex flex-col space-x-0 space-y-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg relative">
        <div class="p-1">
            <h3 x-on:click="open = ! open" class="{{ 'text-[' . $preferences['color_text'] . ']' }} text-center {{ 'text-[' . $preferences['font_size'] . 'px]' }} font-normal select-none">{{ $discuss->name }}</h3>
            @if (in_array(Auth::id(), $managers))
                <div wire:click="deleteDiscuss" wire:confirm="Are you sure, you want to delete this discussion ?" class="size-8 p-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg absolute right-1 inset-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div wire:click="resetDiscuss" wire:confirm="Are you sure, you want to reset this discussion ?" class="size-8 p-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg absolute right-10 inset-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M4.755 10.059a7.5 7.5 0 0 1 12.548-3.364l1.903 1.903h-3.183a.75.75 0 1 0 0 1.5h4.992a.75.75 0 0 0 .75-.75V4.356a.75.75 0 0 0-1.5 0v3.18l-1.9-1.9A9 9 0 0 0 3.306 9.67a.75.75 0 1 0 1.45.388Zm15.408 3.352a.75.75 0 0 0-.919.53 7.5 7.5 0 0 1-12.548 3.364l-1.902-1.903h3.183a.75.75 0 0 0 0-1.5H2.984a.75.75 0 0 0-.75.75v4.992a.75.75 0 0 0 1.5 0v-3.18l1.9 1.9a9 9 0 0 0 15.059-4.035.75.75 0 0 0-.53-.918Z" clip-rule="evenodd" />
                    </svg>
                </div>
            @endif
        </div>
        <div x-cloak x-show="open" class="w-full h-fit max-h-[calc(50vh)] flex flex-col space-x-0 space-y-1 relative">
            @if ($messages->isNotEmpty())
                <div class="w-full h-fit max-h-[calc(50vh)] flex flex-col-reverse space-x-0 space-y-1 space-y-reverse overflow-x-clip overflow-y-auto">
                    @foreach ($messages as $message)
                        @if ($message->user->id == Auth::id())
                            <div class="w-2/3 h-fit p-1 self-end border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                <p>{{ $message->user->username }}</p>
                                <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                                <div class="prose prose-sm w-full h-fit">
                                    {!! $message->text !!}
                                </div>
                            </div>
                        @else
                            <div class="w-2/3 h-fit p-1 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                <p>{{ $message->user->username }}</p>
                                <hr class="{{ 'border-[' . $preferences['color_secondary'] . ']' }}">
                                <div class="prose prose-sm w-full h-fit">
                                    {!! $message->text !!}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
            <form wire:submit="submitMessage" class="w-full h-fit flex flex-col space-x-0 space-y-2 sticky bottom-0 {{ 'bg-[' . $preferences['color_primary'] . ']' }}">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="text-red-500">{{ $error }}</div>
                    @endforeach
                @endif
                @if ($raw_content)
                    <div class="prose">
                        {!! $raw_content !!}
                    </div>
                @endif
                <div class="flex flex-row space-x-1 space-y-0 items-center">
                    {{-- <input wire:model.live="content" type="text" placeholder="Your message" title="Your message" class="form-input w-full h-fit border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg"> --}}
                    <textarea wire:model.live="content" placeholder="Your message" title="Your message" cols="30" rows="1" class="form-input w-full h-fit border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg"></textarea>
                    <button type="submit" title="Send your message"
                        class="w-fit h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>