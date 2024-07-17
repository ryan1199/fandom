<div x-data="{ openChat: @entangle('openChat').live }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500 bg-zinc-50 border border-zinc-200 rounded-lg">
    <div x-on:click="openChat = ! openChat"  class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center select-none">
        <img src="{{ asset('storage/avatars/'.$user->avatar->image->url) }}" alt="{{ $user->username }}" title="{{ $user->username }}" class="aspect-square w-auto h-[5vh] bg-zinc-50 border-0 rounded-full object-cover" draggable="false">
        <div class="flex flex-col space-x-0 space-y-0">
            <p class="font-bold">{{ $user->username }}</p>
            <div x-cloak x-show="!openChat" class="font-thin line-clamp-1 prose prose-zinc prose-headings:text-zinc-500 prose-p:text-zinc-500 prose-a:text-zinc-500 prose-ol:text-zinc-500 prose-ul:text-zinc-500 prose-blockquote:text-zinc-500 prose-strong:text-zinc-500 prose-em:text-zinc-500 prose-code:text-zinc-500 prose-pre:text-zinc-500 prose-hr:border-zinc-200 prose-table:text-zinc-500 prose-li:text-zinc-500 prose-ol:text-pretty prose-ul:text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside">
                {!! $chat->messages->last()->text !!}
            </div>
        </div>
    </div>
    <div x-cloak x-show="openChat" class="w-full h-fit flex flex-col space-x-0 space-y-1 relative">
        <hr class="border-zinc-200">
        <div class="w-full h-fit max-h-[calc(80vh)] flex flex-col-reverse space-x-0 space-y-1 space-y-reverse overflow-x-clip overflow-y-auto">
            @foreach ($messages as $message)
                @if ($message->user->id == Auth::id())
                    <div wire:key="{{ 'message' . $message->id }}" class="w-10/12 h-fit p-1 self-end flex flex-col space-x-0 space-y-1 border border-zinc-200 rounded-lg">
                        <p class="font-semibold text-right">{{ $message->user->username }}</p>
                        <hr class="border-zinc-200">
                        <div class="prose prose-zinc prose-headings:text-zinc-500 prose-p:text-zinc-500 prose-a:text-zinc-500 prose-ol:text-zinc-500 prose-ul:text-zinc-500 prose-blockquote:text-zinc-500 prose-strong:text-zinc-500 prose-em:text-zinc-500 prose-code:text-zinc-500 prose-pre:text-zinc-500 prose-hr:border-zinc-200 prose-table:text-zinc-500 prose-li:text-zinc-500 prose-ol:text-pretty prose-ul:text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside">
                            {!! $message->text !!}
                        </div>
                    </div>
                @else
                    <div wire:key="{{ 'message' . $message->id }}" class="w-10/12 h-fit p-1 flex flex-col space-x-0 space-y-1 border border-zinc-200 rounded-lg">
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
        <div class="sticky bottom-0">
            @livewire(ChatForm::class, ['user1' => Auth::user()->username, 'user2' => $user->username, 'user_ids' => $user_ids, 'preferences' => $preferences])
        </div>
    </div>
</div>