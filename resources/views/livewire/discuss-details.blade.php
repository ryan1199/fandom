<div x-data="{ openDiscuss: @entangle('openDiscuss').live }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-100' }} rounded-lg">
    <div class="w-full h-fit flex flex-col space-x-0 space-y-2 select-none">
        <div class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center justify-between">
            <p class="font-semibold">{{ $discuss->name }}</p>
            @if (in_array(Auth::id(), $managers))
                <div class="w-fit h-fit flex flex-row space-x-2 space-y-0 items-center">
                    <svg wire:click="deleteDiscuss" wire:confirm="Are you sure, you want to delete this discussion ?" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                    </svg>
                    <svg wire:click="resetDiscuss" wire:confirm="Are you sure, you want to reset this discussion ?" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                        <path fill-rule="evenodd" d="M4.755 10.059a7.5 7.5 0 0 1 12.548-3.364l1.903 1.903h-3.183a.75.75 0 1 0 0 1.5h4.992a.75.75 0 0 0 .75-.75V4.356a.75.75 0 0 0-1.5 0v3.18l-1.9-1.9A9 9 0 0 0 3.306 9.67a.75.75 0 1 0 1.45.388Zm15.408 3.352a.75.75 0 0 0-.919.53 7.5 7.5 0 0 1-12.548 3.364l-1.902-1.903h3.183a.75.75 0 0 0 0-1.5H2.984a.75.75 0 0 0-.75.75v4.992a.75.75 0 0 0 1.5 0v-3.18l1.9 1.9a9 9 0 0 0 15.059-4.035.75.75 0 0 0-.53-.918Z" clip-rule="evenodd" />
                    </svg>
                </div>
            @endif
        </div>
        <div x-on:click="openDiscuss = ! openDiscuss" class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center">
            <img src="{{ asset('storage/avatars/'.$fandom->avatar->image->url) }}" alt="{{ $fandom->name }}" title="{{ $fandom->name }}" class="aspect-square w-auto h-[5vh] rounded-full object-cover" draggable="false">
            <p class="font-bold">{{ $fandom->name }}</p>
        </div>
        <div x-cloak x-show="!openDiscuss" class="flex flex-col space-x-0 space-y-0">
            @if ($messages->isNotEmpty())
                <div 
                    @switch($preferences['color_2'])
                        @case('slate')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-slate prose-headings:text-slate-900 prose-p:text-slate-900 prose-a:text-slate-900 prose-ol:text-slate-900 prose-ul:text-slate-900 prose-blockquote:text-slate-900 prose-blockquote:border-slate-900 prose-strong:text-slate-900 prose-em:text-slate-900 prose-code:text-slate-100 prose-pre:text-slate-900 prose-hr:border-slate-200 prose-table:text-slate-900 prose-li:text-slate-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-slate-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('gray')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-gray prose-headings:text-gray-900 prose-p:text-gray-900 prose-a:text-gray-900 prose-ol:text-gray-900 prose-ul:text-gray-900 prose-blockquote:text-gray-900 prose-blockquote:border-gray-900 prose-strong:text-gray-900 prose-em:text-gray-900 prose-code:text-gray-100 prose-pre:text-gray-900 prose-hr:border-gray-200 prose-table:text-gray-900 prose-li:text-gray-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-gray-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('zinc')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-zinc prose-headings:text-zinc-900 prose-p:text-zinc-900 prose-a:text-zinc-900 prose-ol:text-zinc-900 prose-ul:text-zinc-900 prose-blockquote:text-zinc-900 prose-blockquote:border-zinc-900 prose-strong:text-zinc-900 prose-em:text-zinc-900 prose-code:text-zinc-100 prose-pre:text-zinc-900 prose-hr:border-zinc-200 prose-table:text-zinc-900 prose-li:text-zinc-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-zinc-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('neutral')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-neutral prose-headings:text-neutral-900 prose-p:text-neutral-900 prose-a:text-neutral-900 prose-ol:text-neutral-900 prose-ul:text-neutral-900 prose-blockquote:text-neutral-900 prose-blockquote:border-neutral-900 prose-strong:text-neutral-900 prose-em:text-neutral-900 prose-code:text-neutral-100 prose-pre:text-neutral-900 prose-hr:border-neutral-200 prose-table:text-neutral-900 prose-li:text-neutral-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-neutral-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('stone')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-stone prose-headings:text-stone-900 prose-p:text-stone-900 prose-a:text-stone-900 prose-ol:text-stone-900 prose-ul:text-stone-900 prose-blockquote:text-stone-900 prose-blockquote:border-stone-900 prose-strong:text-stone-900 prose-em:text-stone-900 prose-code:text-stone-100 prose-pre:text-stone-900 prose-hr:border-stone-200 prose-table:text-stone-900 prose-li:text-stone-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-stone-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('red')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-red prose-headings:text-red-900 prose-p:text-red-900 prose-a:text-red-900 prose-ol:text-red-900 prose-ul:text-red-900 prose-blockquote:text-red-900 prose-blockquote:border-red-900 prose-strong:text-red-900 prose-em:text-red-900 prose-code:text-red-100 prose-pre:text-red-900 prose-hr:border-red-200 prose-table:text-red-900 prose-li:text-red-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-red-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('orange')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-orange prose-headings:text-orange-900 prose-p:text-orange-900 prose-a:text-orange-900 prose-ol:text-orange-900 prose-ul:text-orange-900 prose-blockquote:text-orange-900 prose-blockquote:border-orange-900 prose-strong:text-orange-900 prose-em:text-orange-900 prose-code:text-orange-100 prose-pre:text-orange-900 prose-hr:border-orange-200 prose-table:text-orange-900 prose-li:text-orange-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-orange-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('amber')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-amber prose-headings:text-amber-900 prose-p:text-amber-900 prose-a:text-amber-900 prose-ol:text-amber-900 prose-ul:text-amber-900 prose-blockquote:text-amber-900 prose-blockquote:border-amber-900 prose-strong:text-amber-900 prose-em:text-amber-900 prose-code:text-amber-100 prose-pre:text-amber-900 prose-hr:border-amber-200 prose-table:text-amber-900 prose-li:text-amber-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-amber-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('yellow')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-yellow prose-headings:text-yellow-900 prose-p:text-yellow-900 prose-a:text-yellow-900 prose-ol:text-yellow-900 prose-ul:text-yellow-900 prose-blockquote:text-yellow-900 prose-blockquote:border-yellow-900 prose-strong:text-yellow-900 prose-em:text-yellow-900 prose-code:text-yellow-100 prose-pre:text-yellow-900 prose-hr:border-yellow-200 prose-table:text-yellow-900 prose-li:text-yellow-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-yellow-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('lime')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-lime prose-headings:text-lime-900 prose-p:text-lime-900 prose-a:text-lime-900 prose-ol:text-lime-900 prose-ul:text-lime-900 prose-blockquote:text-lime-900 prose-blockquote:border-lime-900 prose-strong:text-lime-900 prose-em:text-lime-900 prose-code:text-lime-100 prose-pre:text-lime-900 prose-hr:border-lime-200 prose-table:text-lime-900 prose-li:text-lime-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-lime-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('green')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-green prose-headings:text-green-900 prose-p:text-green-900 prose-a:text-green-900 prose-ol:text-green-900 prose-ul:text-green-900 prose-blockquote:text-green-900 prose-blockquote:border-green-900 prose-strong:text-green-900 prose-em:text-green-900 prose-code:text-green-100 prose-pre:text-green-900 prose-hr:border-green-200 prose-table:text-green-900 prose-li:text-green-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-green-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('emerald')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-emerald prose-headings:text-emerald-900 prose-p:text-emerald-900 prose-a:text-emerald-900 prose-ol:text-emerald-900 prose-ul:text-emerald-900 prose-blockquote:text-emerald-900 prose-blockquote:border-emerald-900 prose-strong:text-emerald-900 prose-em:text-emerald-900 prose-code:text-emerald-100 prose-pre:text-emerald-900 prose-hr:border-emerald-200 prose-table:text-emerald-900 prose-li:text-emerald-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-emerald-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('teal')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-teal prose-headings:text-teal-900 prose-p:text-teal-900 prose-a:text-teal-900 prose-ol:text-teal-900 prose-ul:text-teal-900 prose-blockquote:text-teal-900 prose-blockquote:border-teal-900 prose-strong:text-teal-900 prose-em:text-teal-900 prose-code:text-teal-100 prose-pre:text-teal-900 prose-hr:border-teal-200 prose-table:text-teal-900 prose-li:text-teal-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-teal-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('cyan')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-cyan prose-headings:text-cyan-900 prose-p:text-cyan-900 prose-a:text-cyan-900 prose-ol:text-cyan-900 prose-ul:text-cyan-900 prose-blockquote:text-cyan-900 prose-blockquote:border-cyan-900 prose-strong:text-cyan-900 prose-em:text-cyan-900 prose-code:text-cyan-100 prose-pre:text-cyan-900 prose-hr:border-cyan-200 prose-table:text-cyan-900 prose-li:text-cyan-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-cyan-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('sky')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-sky prose-headings:text-sky-900 prose-p:text-sky-900 prose-a:text-sky-900 prose-ol:text-sky-900 prose-ul:text-sky-900 prose-blockquote:text-sky-900 prose-blockquote:border-sky-900 prose-strong:text-sky-900 prose-em:text-sky-900 prose-code:text-sky-100 prose-pre:text-sky-900 prose-hr:border-sky-200 prose-table:text-sky-900 prose-li:text-sky-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-sky-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('blue')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-blue prose-headings:text-blue-900 prose-p:text-blue-900 prose-a:text-blue-900 prose-ol:text-blue-900 prose-ul:text-blue-900 prose-blockquote:text-blue-900 prose-blockquote:border-blue-900 prose-strong:text-blue-900 prose-em:text-blue-900 prose-code:text-blue-100 prose-pre:text-blue-900 prose-hr:border-blue-200 prose-table:text-blue-900 prose-li:text-blue-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-blue-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('indigo')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-indigo prose-headings:text-indigo-900 prose-p:text-indigo-900 prose-a:text-indigo-900 prose-ol:text-indigo-900 prose-ul:text-indigo-900 prose-blockquote:text-indigo-900 prose-blockquote:border-indigo-900 prose-strong:text-indigo-900 prose-em:text-indigo-900 prose-code:text-indigo-100 prose-pre:text-indigo-900 prose-hr:border-indigo-200 prose-table:text-indigo-900 prose-li:text-indigo-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-indigo-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('violet')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-violet prose-headings:text-violet-900 prose-p:text-violet-900 prose-a:text-violet-900 prose-ol:text-violet-900 prose-ul:text-violet-900 prose-blockquote:text-violet-900 prose-blockquote:border-violet-900 prose-strong:text-violet-900 prose-em:text-violet-900 prose-code:text-violet-100 prose-pre:text-violet-900 prose-hr:border-violet-200 prose-table:text-violet-900 prose-li:text-violet-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-violet-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('purple')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-purple prose-headings:text-purple-900 prose-p:text-purple-900 prose-a:text-purple-900 prose-ol:text-purple-900 prose-ul:text-purple-900 prose-blockquote:text-purple-900 prose-blockquote:border-purple-900 prose-strong:text-purple-900 prose-em:text-purple-900 prose-code:text-purple-100 prose-pre:text-purple-900 prose-hr:border-purple-200 prose-table:text-purple-900 prose-li:text-purple-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-purple-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('fuchsia')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-fuchsia prose-headings:text-fuchsia-900 prose-p:text-fuchsia-900 prose-a:text-fuchsia-900 prose-ol:text-fuchsia-900 prose-ul:text-fuchsia-900 prose-blockquote:text-fuchsia-900 prose-blockquote:border-fuchsia-900 prose-strong:text-fuchsia-900 prose-em:text-fuchsia-900 prose-code:text-fuchsia-100 prose-pre:text-fuchsia-900 prose-hr:border-fuchsia-200 prose-table:text-fuchsia-900 prose-li:text-fuchsia-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-fuchsia-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('pink')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-pink prose-headings:text-pink-900 prose-p:text-pink-900 prose-a:text-pink-900 prose-ol:text-pink-900 prose-ul:text-pink-900 prose-blockquote:text-pink-900 prose-blockquote:border-pink-900 prose-strong:text-pink-900 prose-em:text-pink-900 prose-code:text-pink-100 prose-pre:text-pink-900 prose-hr:border-pink-200 prose-table:text-pink-900 prose-li:text-pink-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-pink-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @case('rose')
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc"
                            @break
                        @default
                            class="line-clamp-1 max-w-none font-thin prose prose-base prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc"
                    @endswitch>
                    {!! $messages->first()->text !!}
                </div>
            @else
                <p>No messages</p>
            @endif
        </div>
    </div>
    <div x-cloak x-show="openDiscuss" class="w-full h-fit flex flex-col space-x-0 space-y-1 relative">
        @if ($messages->isNotEmpty())
            <hr class="{{ 'border-' . $preferences['color_2'] . '-200' }}">
            <div class="w-full h-fit max-h-[25vh] flex flex-col-reverse space-x-0 space-y-1 space-y-reverse overflow-x-clip overflow-y-auto">
                @foreach ($messages as $message)
                    @if ($message->user->id == Auth::id())
                        <div wire:key="{{ 'message-' . $message->id }}" class="w-2/3 h-fit p-1 self-end flex flex-col space-x-0 space-y-1 border {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg">
                            <p class="font-semibold text-right">{{ $message->user->username }}</p>
                            <hr class="{{ 'border-' . $preferences['color_2'] . '-200' }}">
                            <div 
                                @switch($preferences['color_2'])
                                    @case('slate')
                                        class="max-w-none font-thin prose prose-base prose-slate prose-headings:text-slate-900 prose-p:text-slate-900 prose-a:text-slate-900 prose-ol:text-slate-900 prose-ul:text-slate-900 prose-blockquote:text-slate-900 prose-blockquote:border-slate-900 prose-strong:text-slate-900 prose-em:text-slate-900 prose-code:text-slate-100 prose-pre:text-slate-900 prose-hr:border-slate-200 prose-table:text-slate-900 prose-li:text-slate-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-slate-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('gray')
                                        class="max-w-none font-thin prose prose-base prose-gray prose-headings:text-gray-900 prose-p:text-gray-900 prose-a:text-gray-900 prose-ol:text-gray-900 prose-ul:text-gray-900 prose-blockquote:text-gray-900 prose-blockquote:border-gray-900 prose-strong:text-gray-900 prose-em:text-gray-900 prose-code:text-gray-100 prose-pre:text-gray-900 prose-hr:border-gray-200 prose-table:text-gray-900 prose-li:text-gray-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-gray-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('zinc')
                                        class="max-w-none font-thin prose prose-base prose-zinc prose-headings:text-zinc-900 prose-p:text-zinc-900 prose-a:text-zinc-900 prose-ol:text-zinc-900 prose-ul:text-zinc-900 prose-blockquote:text-zinc-900 prose-blockquote:border-zinc-900 prose-strong:text-zinc-900 prose-em:text-zinc-900 prose-code:text-zinc-100 prose-pre:text-zinc-900 prose-hr:border-zinc-200 prose-table:text-zinc-900 prose-li:text-zinc-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-zinc-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('neutral')
                                        class="max-w-none font-thin prose prose-base prose-neutral prose-headings:text-neutral-900 prose-p:text-neutral-900 prose-a:text-neutral-900 prose-ol:text-neutral-900 prose-ul:text-neutral-900 prose-blockquote:text-neutral-900 prose-blockquote:border-neutral-900 prose-strong:text-neutral-900 prose-em:text-neutral-900 prose-code:text-neutral-100 prose-pre:text-neutral-900 prose-hr:border-neutral-200 prose-table:text-neutral-900 prose-li:text-neutral-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-neutral-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('stone')
                                        class="max-w-none font-thin prose prose-base prose-stone prose-headings:text-stone-900 prose-p:text-stone-900 prose-a:text-stone-900 prose-ol:text-stone-900 prose-ul:text-stone-900 prose-blockquote:text-stone-900 prose-blockquote:border-stone-900 prose-strong:text-stone-900 prose-em:text-stone-900 prose-code:text-stone-100 prose-pre:text-stone-900 prose-hr:border-stone-200 prose-table:text-stone-900 prose-li:text-stone-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-stone-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('red')
                                        class="max-w-none font-thin prose prose-base prose-red prose-headings:text-red-900 prose-p:text-red-900 prose-a:text-red-900 prose-ol:text-red-900 prose-ul:text-red-900 prose-blockquote:text-red-900 prose-blockquote:border-red-900 prose-strong:text-red-900 prose-em:text-red-900 prose-code:text-red-100 prose-pre:text-red-900 prose-hr:border-red-200 prose-table:text-red-900 prose-li:text-red-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-red-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('orange')
                                        class="max-w-none font-thin prose prose-base prose-orange prose-headings:text-orange-900 prose-p:text-orange-900 prose-a:text-orange-900 prose-ol:text-orange-900 prose-ul:text-orange-900 prose-blockquote:text-orange-900 prose-blockquote:border-orange-900 prose-strong:text-orange-900 prose-em:text-orange-900 prose-code:text-orange-100 prose-pre:text-orange-900 prose-hr:border-orange-200 prose-table:text-orange-900 prose-li:text-orange-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-orange-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('amber')
                                        class="max-w-none font-thin prose prose-base prose-amber prose-headings:text-amber-900 prose-p:text-amber-900 prose-a:text-amber-900 prose-ol:text-amber-900 prose-ul:text-amber-900 prose-blockquote:text-amber-900 prose-blockquote:border-amber-900 prose-strong:text-amber-900 prose-em:text-amber-900 prose-code:text-amber-100 prose-pre:text-amber-900 prose-hr:border-amber-200 prose-table:text-amber-900 prose-li:text-amber-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-amber-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('yellow')
                                        class="max-w-none font-thin prose prose-base prose-yellow prose-headings:text-yellow-900 prose-p:text-yellow-900 prose-a:text-yellow-900 prose-ol:text-yellow-900 prose-ul:text-yellow-900 prose-blockquote:text-yellow-900 prose-blockquote:border-yellow-900 prose-strong:text-yellow-900 prose-em:text-yellow-900 prose-code:text-yellow-100 prose-pre:text-yellow-900 prose-hr:border-yellow-200 prose-table:text-yellow-900 prose-li:text-yellow-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-yellow-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('lime')
                                        class="max-w-none font-thin prose prose-base prose-lime prose-headings:text-lime-900 prose-p:text-lime-900 prose-a:text-lime-900 prose-ol:text-lime-900 prose-ul:text-lime-900 prose-blockquote:text-lime-900 prose-blockquote:border-lime-900 prose-strong:text-lime-900 prose-em:text-lime-900 prose-code:text-lime-100 prose-pre:text-lime-900 prose-hr:border-lime-200 prose-table:text-lime-900 prose-li:text-lime-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-lime-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('green')
                                        class="max-w-none font-thin prose prose-base prose-green prose-headings:text-green-900 prose-p:text-green-900 prose-a:text-green-900 prose-ol:text-green-900 prose-ul:text-green-900 prose-blockquote:text-green-900 prose-blockquote:border-green-900 prose-strong:text-green-900 prose-em:text-green-900 prose-code:text-green-100 prose-pre:text-green-900 prose-hr:border-green-200 prose-table:text-green-900 prose-li:text-green-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-green-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('emerald')
                                        class="max-w-none font-thin prose prose-base prose-emerald prose-headings:text-emerald-900 prose-p:text-emerald-900 prose-a:text-emerald-900 prose-ol:text-emerald-900 prose-ul:text-emerald-900 prose-blockquote:text-emerald-900 prose-blockquote:border-emerald-900 prose-strong:text-emerald-900 prose-em:text-emerald-900 prose-code:text-emerald-100 prose-pre:text-emerald-900 prose-hr:border-emerald-200 prose-table:text-emerald-900 prose-li:text-emerald-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-emerald-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('teal')
                                        class="max-w-none font-thin prose prose-base prose-teal prose-headings:text-teal-900 prose-p:text-teal-900 prose-a:text-teal-900 prose-ol:text-teal-900 prose-ul:text-teal-900 prose-blockquote:text-teal-900 prose-blockquote:border-teal-900 prose-strong:text-teal-900 prose-em:text-teal-900 prose-code:text-teal-100 prose-pre:text-teal-900 prose-hr:border-teal-200 prose-table:text-teal-900 prose-li:text-teal-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-teal-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('cyan')
                                        class="max-w-none font-thin prose prose-base prose-cyan prose-headings:text-cyan-900 prose-p:text-cyan-900 prose-a:text-cyan-900 prose-ol:text-cyan-900 prose-ul:text-cyan-900 prose-blockquote:text-cyan-900 prose-blockquote:border-cyan-900 prose-strong:text-cyan-900 prose-em:text-cyan-900 prose-code:text-cyan-100 prose-pre:text-cyan-900 prose-hr:border-cyan-200 prose-table:text-cyan-900 prose-li:text-cyan-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-cyan-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('sky')
                                        class="max-w-none font-thin prose prose-base prose-sky prose-headings:text-sky-900 prose-p:text-sky-900 prose-a:text-sky-900 prose-ol:text-sky-900 prose-ul:text-sky-900 prose-blockquote:text-sky-900 prose-blockquote:border-sky-900 prose-strong:text-sky-900 prose-em:text-sky-900 prose-code:text-sky-100 prose-pre:text-sky-900 prose-hr:border-sky-200 prose-table:text-sky-900 prose-li:text-sky-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-sky-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('blue')
                                        class="max-w-none font-thin prose prose-base prose-blue prose-headings:text-blue-900 prose-p:text-blue-900 prose-a:text-blue-900 prose-ol:text-blue-900 prose-ul:text-blue-900 prose-blockquote:text-blue-900 prose-blockquote:border-blue-900 prose-strong:text-blue-900 prose-em:text-blue-900 prose-code:text-blue-100 prose-pre:text-blue-900 prose-hr:border-blue-200 prose-table:text-blue-900 prose-li:text-blue-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-blue-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('indigo')
                                        class="max-w-none font-thin prose prose-base prose-indigo prose-headings:text-indigo-900 prose-p:text-indigo-900 prose-a:text-indigo-900 prose-ol:text-indigo-900 prose-ul:text-indigo-900 prose-blockquote:text-indigo-900 prose-blockquote:border-indigo-900 prose-strong:text-indigo-900 prose-em:text-indigo-900 prose-code:text-indigo-100 prose-pre:text-indigo-900 prose-hr:border-indigo-200 prose-table:text-indigo-900 prose-li:text-indigo-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-indigo-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('violet')
                                        class="max-w-none font-thin prose prose-base prose-violet prose-headings:text-violet-900 prose-p:text-violet-900 prose-a:text-violet-900 prose-ol:text-violet-900 prose-ul:text-violet-900 prose-blockquote:text-violet-900 prose-blockquote:border-violet-900 prose-strong:text-violet-900 prose-em:text-violet-900 prose-code:text-violet-100 prose-pre:text-violet-900 prose-hr:border-violet-200 prose-table:text-violet-900 prose-li:text-violet-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-violet-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('purple')
                                        class="max-w-none font-thin prose prose-base prose-purple prose-headings:text-purple-900 prose-p:text-purple-900 prose-a:text-purple-900 prose-ol:text-purple-900 prose-ul:text-purple-900 prose-blockquote:text-purple-900 prose-blockquote:border-purple-900 prose-strong:text-purple-900 prose-em:text-purple-900 prose-code:text-purple-100 prose-pre:text-purple-900 prose-hr:border-purple-200 prose-table:text-purple-900 prose-li:text-purple-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-purple-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('fuchsia')
                                        class="max-w-none font-thin prose prose-base prose-fuchsia prose-headings:text-fuchsia-900 prose-p:text-fuchsia-900 prose-a:text-fuchsia-900 prose-ol:text-fuchsia-900 prose-ul:text-fuchsia-900 prose-blockquote:text-fuchsia-900 prose-blockquote:border-fuchsia-900 prose-strong:text-fuchsia-900 prose-em:text-fuchsia-900 prose-code:text-fuchsia-100 prose-pre:text-fuchsia-900 prose-hr:border-fuchsia-200 prose-table:text-fuchsia-900 prose-li:text-fuchsia-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-fuchsia-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('pink')
                                        class="max-w-none font-thin prose prose-base prose-pink prose-headings:text-pink-900 prose-p:text-pink-900 prose-a:text-pink-900 prose-ol:text-pink-900 prose-ul:text-pink-900 prose-blockquote:text-pink-900 prose-blockquote:border-pink-900 prose-strong:text-pink-900 prose-em:text-pink-900 prose-code:text-pink-100 prose-pre:text-pink-900 prose-hr:border-pink-200 prose-table:text-pink-900 prose-li:text-pink-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-pink-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('rose')
                                        class="max-w-none font-thin prose prose-base prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @default
                                        class="max-w-none font-thin prose prose-base prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc"
                                @endswitch>
                                {!! $message->text !!}
                            </div>
                        </div>
                    @else
                        <div wire:key="{{ 'message-' . $message->id }}" class="w-2/3 h-fit p-1 flex flex-col space-x-0 space-y-1 border {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg">
                            <p class="font-semibold">{{ $message->user->username }}</p>
                            <hr class="{{ 'border-' . $preferences['color_2'] . '-200' }}">
                            <div 
                                @switch($preferences['color_2'])
                                    @case('slate')
                                        class="max-w-none font-thin prose prose-base prose-slate prose-headings:text-slate-900 prose-p:text-slate-900 prose-a:text-slate-900 prose-ol:text-slate-900 prose-ul:text-slate-900 prose-blockquote:text-slate-900 prose-blockquote:border-slate-900 prose-strong:text-slate-900 prose-em:text-slate-900 prose-code:text-slate-100 prose-pre:text-slate-900 prose-hr:border-slate-200 prose-table:text-slate-900 prose-li:text-slate-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-slate-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('gray')
                                        class="max-w-none font-thin prose prose-base prose-gray prose-headings:text-gray-900 prose-p:text-gray-900 prose-a:text-gray-900 prose-ol:text-gray-900 prose-ul:text-gray-900 prose-blockquote:text-gray-900 prose-blockquote:border-gray-900 prose-strong:text-gray-900 prose-em:text-gray-900 prose-code:text-gray-100 prose-pre:text-gray-900 prose-hr:border-gray-200 prose-table:text-gray-900 prose-li:text-gray-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-gray-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('zinc')
                                        class="max-w-none font-thin prose prose-base prose-zinc prose-headings:text-zinc-900 prose-p:text-zinc-900 prose-a:text-zinc-900 prose-ol:text-zinc-900 prose-ul:text-zinc-900 prose-blockquote:text-zinc-900 prose-blockquote:border-zinc-900 prose-strong:text-zinc-900 prose-em:text-zinc-900 prose-code:text-zinc-100 prose-pre:text-zinc-900 prose-hr:border-zinc-200 prose-table:text-zinc-900 prose-li:text-zinc-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-zinc-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('neutral')
                                        class="max-w-none font-thin prose prose-base prose-neutral prose-headings:text-neutral-900 prose-p:text-neutral-900 prose-a:text-neutral-900 prose-ol:text-neutral-900 prose-ul:text-neutral-900 prose-blockquote:text-neutral-900 prose-blockquote:border-neutral-900 prose-strong:text-neutral-900 prose-em:text-neutral-900 prose-code:text-neutral-100 prose-pre:text-neutral-900 prose-hr:border-neutral-200 prose-table:text-neutral-900 prose-li:text-neutral-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-neutral-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('stone')
                                        class="max-w-none font-thin prose prose-base prose-stone prose-headings:text-stone-900 prose-p:text-stone-900 prose-a:text-stone-900 prose-ol:text-stone-900 prose-ul:text-stone-900 prose-blockquote:text-stone-900 prose-blockquote:border-stone-900 prose-strong:text-stone-900 prose-em:text-stone-900 prose-code:text-stone-100 prose-pre:text-stone-900 prose-hr:border-stone-200 prose-table:text-stone-900 prose-li:text-stone-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-stone-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('red')
                                        class="max-w-none font-thin prose prose-base prose-red prose-headings:text-red-900 prose-p:text-red-900 prose-a:text-red-900 prose-ol:text-red-900 prose-ul:text-red-900 prose-blockquote:text-red-900 prose-blockquote:border-red-900 prose-strong:text-red-900 prose-em:text-red-900 prose-code:text-red-100 prose-pre:text-red-900 prose-hr:border-red-200 prose-table:text-red-900 prose-li:text-red-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-red-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('orange')
                                        class="max-w-none font-thin prose prose-base prose-orange prose-headings:text-orange-900 prose-p:text-orange-900 prose-a:text-orange-900 prose-ol:text-orange-900 prose-ul:text-orange-900 prose-blockquote:text-orange-900 prose-blockquote:border-orange-900 prose-strong:text-orange-900 prose-em:text-orange-900 prose-code:text-orange-100 prose-pre:text-orange-900 prose-hr:border-orange-200 prose-table:text-orange-900 prose-li:text-orange-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-orange-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('amber')
                                        class="max-w-none font-thin prose prose-base prose-amber prose-headings:text-amber-900 prose-p:text-amber-900 prose-a:text-amber-900 prose-ol:text-amber-900 prose-ul:text-amber-900 prose-blockquote:text-amber-900 prose-blockquote:border-amber-900 prose-strong:text-amber-900 prose-em:text-amber-900 prose-code:text-amber-100 prose-pre:text-amber-900 prose-hr:border-amber-200 prose-table:text-amber-900 prose-li:text-amber-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-amber-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('yellow')
                                        class="max-w-none font-thin prose prose-base prose-yellow prose-headings:text-yellow-900 prose-p:text-yellow-900 prose-a:text-yellow-900 prose-ol:text-yellow-900 prose-ul:text-yellow-900 prose-blockquote:text-yellow-900 prose-blockquote:border-yellow-900 prose-strong:text-yellow-900 prose-em:text-yellow-900 prose-code:text-yellow-100 prose-pre:text-yellow-900 prose-hr:border-yellow-200 prose-table:text-yellow-900 prose-li:text-yellow-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-yellow-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('lime')
                                        class="max-w-none font-thin prose prose-base prose-lime prose-headings:text-lime-900 prose-p:text-lime-900 prose-a:text-lime-900 prose-ol:text-lime-900 prose-ul:text-lime-900 prose-blockquote:text-lime-900 prose-blockquote:border-lime-900 prose-strong:text-lime-900 prose-em:text-lime-900 prose-code:text-lime-100 prose-pre:text-lime-900 prose-hr:border-lime-200 prose-table:text-lime-900 prose-li:text-lime-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-lime-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('green')
                                        class="max-w-none font-thin prose prose-base prose-green prose-headings:text-green-900 prose-p:text-green-900 prose-a:text-green-900 prose-ol:text-green-900 prose-ul:text-green-900 prose-blockquote:text-green-900 prose-blockquote:border-green-900 prose-strong:text-green-900 prose-em:text-green-900 prose-code:text-green-100 prose-pre:text-green-900 prose-hr:border-green-200 prose-table:text-green-900 prose-li:text-green-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-green-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('emerald')
                                        class="max-w-none font-thin prose prose-base prose-emerald prose-headings:text-emerald-900 prose-p:text-emerald-900 prose-a:text-emerald-900 prose-ol:text-emerald-900 prose-ul:text-emerald-900 prose-blockquote:text-emerald-900 prose-blockquote:border-emerald-900 prose-strong:text-emerald-900 prose-em:text-emerald-900 prose-code:text-emerald-100 prose-pre:text-emerald-900 prose-hr:border-emerald-200 prose-table:text-emerald-900 prose-li:text-emerald-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-emerald-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('teal')
                                        class="max-w-none font-thin prose prose-base prose-teal prose-headings:text-teal-900 prose-p:text-teal-900 prose-a:text-teal-900 prose-ol:text-teal-900 prose-ul:text-teal-900 prose-blockquote:text-teal-900 prose-blockquote:border-teal-900 prose-strong:text-teal-900 prose-em:text-teal-900 prose-code:text-teal-100 prose-pre:text-teal-900 prose-hr:border-teal-200 prose-table:text-teal-900 prose-li:text-teal-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-teal-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('cyan')
                                        class="max-w-none font-thin prose prose-base prose-cyan prose-headings:text-cyan-900 prose-p:text-cyan-900 prose-a:text-cyan-900 prose-ol:text-cyan-900 prose-ul:text-cyan-900 prose-blockquote:text-cyan-900 prose-blockquote:border-cyan-900 prose-strong:text-cyan-900 prose-em:text-cyan-900 prose-code:text-cyan-100 prose-pre:text-cyan-900 prose-hr:border-cyan-200 prose-table:text-cyan-900 prose-li:text-cyan-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-cyan-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('sky')
                                        class="max-w-none font-thin prose prose-base prose-sky prose-headings:text-sky-900 prose-p:text-sky-900 prose-a:text-sky-900 prose-ol:text-sky-900 prose-ul:text-sky-900 prose-blockquote:text-sky-900 prose-blockquote:border-sky-900 prose-strong:text-sky-900 prose-em:text-sky-900 prose-code:text-sky-100 prose-pre:text-sky-900 prose-hr:border-sky-200 prose-table:text-sky-900 prose-li:text-sky-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-sky-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('blue')
                                        class="max-w-none font-thin prose prose-base prose-blue prose-headings:text-blue-900 prose-p:text-blue-900 prose-a:text-blue-900 prose-ol:text-blue-900 prose-ul:text-blue-900 prose-blockquote:text-blue-900 prose-blockquote:border-blue-900 prose-strong:text-blue-900 prose-em:text-blue-900 prose-code:text-blue-100 prose-pre:text-blue-900 prose-hr:border-blue-200 prose-table:text-blue-900 prose-li:text-blue-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-blue-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('indigo')
                                        class="max-w-none font-thin prose prose-base prose-indigo prose-headings:text-indigo-900 prose-p:text-indigo-900 prose-a:text-indigo-900 prose-ol:text-indigo-900 prose-ul:text-indigo-900 prose-blockquote:text-indigo-900 prose-blockquote:border-indigo-900 prose-strong:text-indigo-900 prose-em:text-indigo-900 prose-code:text-indigo-100 prose-pre:text-indigo-900 prose-hr:border-indigo-200 prose-table:text-indigo-900 prose-li:text-indigo-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-indigo-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('violet')
                                        class="max-w-none font-thin prose prose-base prose-violet prose-headings:text-violet-900 prose-p:text-violet-900 prose-a:text-violet-900 prose-ol:text-violet-900 prose-ul:text-violet-900 prose-blockquote:text-violet-900 prose-blockquote:border-violet-900 prose-strong:text-violet-900 prose-em:text-violet-900 prose-code:text-violet-100 prose-pre:text-violet-900 prose-hr:border-violet-200 prose-table:text-violet-900 prose-li:text-violet-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-violet-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('purple')
                                        class="max-w-none font-thin prose prose-base prose-purple prose-headings:text-purple-900 prose-p:text-purple-900 prose-a:text-purple-900 prose-ol:text-purple-900 prose-ul:text-purple-900 prose-blockquote:text-purple-900 prose-blockquote:border-purple-900 prose-strong:text-purple-900 prose-em:text-purple-900 prose-code:text-purple-100 prose-pre:text-purple-900 prose-hr:border-purple-200 prose-table:text-purple-900 prose-li:text-purple-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-purple-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('fuchsia')
                                        class="max-w-none font-thin prose prose-base prose-fuchsia prose-headings:text-fuchsia-900 prose-p:text-fuchsia-900 prose-a:text-fuchsia-900 prose-ol:text-fuchsia-900 prose-ul:text-fuchsia-900 prose-blockquote:text-fuchsia-900 prose-blockquote:border-fuchsia-900 prose-strong:text-fuchsia-900 prose-em:text-fuchsia-900 prose-code:text-fuchsia-100 prose-pre:text-fuchsia-900 prose-hr:border-fuchsia-200 prose-table:text-fuchsia-900 prose-li:text-fuchsia-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-fuchsia-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('pink')
                                        class="max-w-none font-thin prose prose-base prose-pink prose-headings:text-pink-900 prose-p:text-pink-900 prose-a:text-pink-900 prose-ol:text-pink-900 prose-ul:text-pink-900 prose-blockquote:text-pink-900 prose-blockquote:border-pink-900 prose-strong:text-pink-900 prose-em:text-pink-900 prose-code:text-pink-100 prose-pre:text-pink-900 prose-hr:border-pink-200 prose-table:text-pink-900 prose-li:text-pink-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-pink-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @case('rose')
                                        class="max-w-none font-thin prose prose-base prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc"
                                        @break
                                    @default
                                        class="max-w-none font-thin prose prose-base prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc"
                                @endswitch>
                                {!! $message->text !!}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <hr class="{{ 'border-' . $preferences['color_2'] . '-200' }}">
        @else
            <p>No messages</p>
        @endif
        @auth
            <div class="sticky bottom-0">
                @livewire(DiscussForm::class, ['discuss' => $discuss->id, 'preferences' => $preferences])
            </div>
        @endauth
    </div>
</div>