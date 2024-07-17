<div x-data="{ openDiscuss: @entangle('openDiscuss').live }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500 bg-zinc-50 border border-zinc-200 rounded-lg">
    <div class="w-full h-fit flex flex-col space-x-0 space-y-2 select-none">
        <div class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center justify-between">
            <p class="font-semibold">{{ $discuss->name }}</p>
            @if (in_array(Auth::id(), $managers))
                <div class="w-fit h-fit flex flex-row space-x-2 space-y-0 items-center">
                    <svg wire:click="deleteDiscuss" wire:confirm="Are you sure, you want to delete this discussion ?" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-[' . $preferences['color_2'] . ']' }} cursor-pointer animation-button">
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                    </svg>
                    <svg wire:click="resetDiscuss" wire:confirm="Are you sure, you want to reset this discussion ?" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-[' . $preferences['color_2'] . ']' }} cursor-pointer animation-button">
                        <path fill-rule="evenodd" d="M4.755 10.059a7.5 7.5 0 0 1 12.548-3.364l1.903 1.903h-3.183a.75.75 0 1 0 0 1.5h4.992a.75.75 0 0 0 .75-.75V4.356a.75.75 0 0 0-1.5 0v3.18l-1.9-1.9A9 9 0 0 0 3.306 9.67a.75.75 0 1 0 1.45.388Zm15.408 3.352a.75.75 0 0 0-.919.53 7.5 7.5 0 0 1-12.548 3.364l-1.902-1.903h3.183a.75.75 0 0 0 0-1.5H2.984a.75.75 0 0 0-.75.75v4.992a.75.75 0 0 0 1.5 0v-3.18l1.9 1.9a9 9 0 0 0 15.059-4.035.75.75 0 0 0-.53-.918Z" clip-rule="evenodd" />
                    </svg>
                </div>
            @endif
        </div>
        <div x-on:click="openDiscuss = ! openDiscuss" class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center">
            <img src="{{ asset('storage/avatars/'.$fandom->avatar->image->url) }}" alt="{{ $fandom->name }}" title="{{ $fandom->name }}" class="aspect-square w-auto h-[5vh] bg-zinc-50 border-0 rounded-full object-cover" draggable="false">
            <div class="flex flex-col space-x-0 space-y-0">
                <p class="font-bold">{{ $fandom->name }}</p>
                @if ($messages->isNotEmpty())
                    <div x-cloak x-show="!openDiscuss" class="font-thin line-clamp-1 prose prose-zinc prose-headings:text-zinc-500 prose-p:text-zinc-500 prose-a:text-zinc-500 prose-ol:text-zinc-500 prose-ul:text-zinc-500 prose-blockquote:text-zinc-500 prose-strong:text-zinc-500 prose-em:text-zinc-500 prose-code:text-zinc-500 prose-pre:text-zinc-500 prose-hr:border-zinc-200 prose-table:text-zinc-500 prose-li:text-zinc-500 prose-ol:text-pretty prose-ul:text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside">
                        {!! $messages->first()->text !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div x-cloak x-show="openDiscuss" x-transition class="w-full h-fit flex flex-col space-x-0 space-y-1 relative">
        @if ($messages->isNotEmpty())
            <hr class="border-zinc-200">
            <div class="w-full h-fit max-h-[calc(80vh)] flex flex-col-reverse space-x-0 space-y-1 space-y-reverse overflow-x-clip overflow-y-auto">
                @foreach ($messages as $message)
                    @if ($message->user->id == Auth::id())
                        <div wire:key="{{ 'message' . $message->id }}" class="w-2/3 h-fit p-1 self-end flex flex-col space-x-0 space-y-1 border border-zinc-200 rounded-lg">
                            <p class="font-semibold text-right">{{ $message->user->username }}</p>
                            <hr class="border-zinc-200">
                            <div class="prose prose-zinc prose-headings:text-zinc-500 prose-p:text-zinc-500 prose-a:text-zinc-500 prose-ol:text-zinc-500 prose-ul:text-zinc-500 prose-blockquote:text-zinc-500 prose-strong:text-zinc-500 prose-em:text-zinc-500 prose-code:text-zinc-500 prose-pre:text-zinc-500 prose-hr:border-zinc-200 prose-table:text-zinc-500 prose-li:text-zinc-500 prose-ol:text-pretty prose-ul:text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside">
                                {!! $message->text !!}
                            </div>
                        </div>
                    @else
                        <div wire:key="{{ 'message' . $message->id }}" class="w-2/3 h-fit p-1 flex flex-col space-x-0 space-y-1 border border-zinc-200 rounded-lg">
                            <p class="font-semibold">{{ $message->user->username }}</p>
                            <hr class="border-zinc-200">
                            <div class="prose prose-zinc prose-headings:text-zinc-500 prose-p:text-zinc-500 prose-a:text-zinc-500 prose-ol:text-zinc-500 prose-ul:text-zinc-500 prose-blockquote:text-zinc-500 prose-strong:text-zinc-500 prose-em:text-zinc-500 prose-code:text-zinc-500 prose-pre:text-zinc-500 prose-hr:border-zinc-200 prose-table:text-zinc-500 prose-li:text-zinc-500 prose-ol:text-pretty prose-ul:text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside">
                                {!! $message->text !!}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <hr class="border-zinc-200">
        @endif
        <div class="sticky bottom-0">
            @livewire(DiscussForm::class, ['discuss' => $discuss->id, 'preferences' => $preferences])
        </div>
    </div>
</div>