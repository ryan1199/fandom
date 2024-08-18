<div x-data="{ {{ 'open_replies_comment_' . $comment->id }}: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 items-start {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg">
    <div class="w-full h-fit p-2 flex flex-row space-x-4 space-y-0 items-start border-l-2 {{ 'border-' . $preferences['color_2'] . '-200' }}">
        <a wire:navigate href="{{ route('user', $comment->user) }}" class="aspect-square w-[7vh] h-[7vh] block object-cover" draggable="false">
            @if ($comment->user->avatar != null)
                <img src="{{ asset('storage/avatars/'.$comment->user->avatar->image->url) }}" alt="{{ $comment->user->username }}" title="{{ $comment->user->username }}" class="aspect-square w-full h-full rounded-full object-cover block" draggable="false">
            @else
                <div class="aspect-square w-auto h-full bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} rounded-full object-cover"></div>
            @endif
        </a>
        <div x-data="{ {{ 'open_comment_' . $comment->id }}: false }" class="w-full flex flex-col space-x-0 space-y-2">
            <a wire:navigate href="{{ route('user', $comment->user) }}" class="font-bold" draggable="false">{{ $comment->user->username }}</a>
            <div x-on:click="{{ 'open_comment_' . $comment->id . ' = ! ' . 'open_comment_' . $comment->id }}" :class="{{ 'open_comment_' . $comment->id }} ? 'line-clamp-none' : 'line-clamp-2'" 
                @switch($preferences['color_2'])
                    @case('slate')
                        class="max-w-none font-thin prose prose-slate prose-headings:text-slate-900 prose-p:text-slate-900 prose-a:text-slate-900 prose-ol:text-slate-900 prose-ul:text-slate-900 prose-blockquote:text-slate-900 prose-blockquote:border-slate-900 prose-strong:text-slate-900 prose-em:text-slate-900 prose-code:text-slate-100 prose-pre:text-slate-900 prose-hr:border-slate-200 prose-table:text-slate-900 prose-li:text-slate-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-slate-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('gray')
                        class="max-w-none font-thin prose prose-gray prose-headings:text-gray-900 prose-p:text-gray-900 prose-a:text-gray-900 prose-ol:text-gray-900 prose-ul:text-gray-900 prose-blockquote:text-gray-900 prose-blockquote:border-gray-900 prose-strong:text-gray-900 prose-em:text-gray-900 prose-code:text-gray-100 prose-pre:text-gray-900 prose-hr:border-gray-200 prose-table:text-gray-900 prose-li:text-gray-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-gray-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('zinc')
                        class="max-w-none font-thin prose prose-zinc prose-headings:text-zinc-900 prose-p:text-zinc-900 prose-a:text-zinc-900 prose-ol:text-zinc-900 prose-ul:text-zinc-900 prose-blockquote:text-zinc-900 prose-blockquote:border-zinc-900 prose-strong:text-zinc-900 prose-em:text-zinc-900 prose-code:text-zinc-100 prose-pre:text-zinc-900 prose-hr:border-zinc-200 prose-table:text-zinc-900 prose-li:text-zinc-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-zinc-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('neutral')
                        class="max-w-none font-thin prose prose-neutral prose-headings:text-neutral-900 prose-p:text-neutral-900 prose-a:text-neutral-900 prose-ol:text-neutral-900 prose-ul:text-neutral-900 prose-blockquote:text-neutral-900 prose-blockquote:border-neutral-900 prose-strong:text-neutral-900 prose-em:text-neutral-900 prose-code:text-neutral-100 prose-pre:text-neutral-900 prose-hr:border-neutral-200 prose-table:text-neutral-900 prose-li:text-neutral-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-neutral-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('stone')
                        class="max-w-none font-thin prose prose-stone prose-headings:text-stone-900 prose-p:text-stone-900 prose-a:text-stone-900 prose-ol:text-stone-900 prose-ul:text-stone-900 prose-blockquote:text-stone-900 prose-blockquote:border-stone-900 prose-strong:text-stone-900 prose-em:text-stone-900 prose-code:text-stone-100 prose-pre:text-stone-900 prose-hr:border-stone-200 prose-table:text-stone-900 prose-li:text-stone-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-stone-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('red')
                        class="max-w-none font-thin prose prose-red prose-headings:text-red-900 prose-p:text-red-900 prose-a:text-red-900 prose-ol:text-red-900 prose-ul:text-red-900 prose-blockquote:text-red-900 prose-blockquote:border-red-900 prose-strong:text-red-900 prose-em:text-red-900 prose-code:text-red-100 prose-pre:text-red-900 prose-hr:border-red-200 prose-table:text-red-900 prose-li:text-red-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-red-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('orange')
                        class="max-w-none font-thin prose prose-orange prose-headings:text-orange-900 prose-p:text-orange-900 prose-a:text-orange-900 prose-ol:text-orange-900 prose-ul:text-orange-900 prose-blockquote:text-orange-900 prose-blockquote:border-orange-900 prose-strong:text-orange-900 prose-em:text-orange-900 prose-code:text-orange-100 prose-pre:text-orange-900 prose-hr:border-orange-200 prose-table:text-orange-900 prose-li:text-orange-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-orange-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('amber')
                        class="max-w-none font-thin prose prose-amber prose-headings:text-amber-900 prose-p:text-amber-900 prose-a:text-amber-900 prose-ol:text-amber-900 prose-ul:text-amber-900 prose-blockquote:text-amber-900 prose-blockquote:border-amber-900 prose-strong:text-amber-900 prose-em:text-amber-900 prose-code:text-amber-100 prose-pre:text-amber-900 prose-hr:border-amber-200 prose-table:text-amber-900 prose-li:text-amber-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-amber-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('yellow')
                        class="max-w-none font-thin prose prose-yellow prose-headings:text-yellow-900 prose-p:text-yellow-900 prose-a:text-yellow-900 prose-ol:text-yellow-900 prose-ul:text-yellow-900 prose-blockquote:text-yellow-900 prose-blockquote:border-yellow-900 prose-strong:text-yellow-900 prose-em:text-yellow-900 prose-code:text-yellow-100 prose-pre:text-yellow-900 prose-hr:border-yellow-200 prose-table:text-yellow-900 prose-li:text-yellow-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-yellow-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('lime')
                        class="max-w-none font-thin prose prose-lime prose-headings:text-lime-900 prose-p:text-lime-900 prose-a:text-lime-900 prose-ol:text-lime-900 prose-ul:text-lime-900 prose-blockquote:text-lime-900 prose-blockquote:border-lime-900 prose-strong:text-lime-900 prose-em:text-lime-900 prose-code:text-lime-100 prose-pre:text-lime-900 prose-hr:border-lime-200 prose-table:text-lime-900 prose-li:text-lime-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-lime-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('green')
                        class="max-w-none font-thin prose prose-green prose-headings:text-green-900 prose-p:text-green-900 prose-a:text-green-900 prose-ol:text-green-900 prose-ul:text-green-900 prose-blockquote:text-green-900 prose-blockquote:border-green-900 prose-strong:text-green-900 prose-em:text-green-900 prose-code:text-green-100 prose-pre:text-green-900 prose-hr:border-green-200 prose-table:text-green-900 prose-li:text-green-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-green-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('emerald')
                        class="max-w-none font-thin prose prose-emerald prose-headings:text-emerald-900 prose-p:text-emerald-900 prose-a:text-emerald-900 prose-ol:text-emerald-900 prose-ul:text-emerald-900 prose-blockquote:text-emerald-900 prose-blockquote:border-emerald-900 prose-strong:text-emerald-900 prose-em:text-emerald-900 prose-code:text-emerald-100 prose-pre:text-emerald-900 prose-hr:border-emerald-200 prose-table:text-emerald-900 prose-li:text-emerald-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-emerald-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('teal')
                        class="max-w-none font-thin prose prose-teal prose-headings:text-teal-900 prose-p:text-teal-900 prose-a:text-teal-900 prose-ol:text-teal-900 prose-ul:text-teal-900 prose-blockquote:text-teal-900 prose-blockquote:border-teal-900 prose-strong:text-teal-900 prose-em:text-teal-900 prose-code:text-teal-100 prose-pre:text-teal-900 prose-hr:border-teal-200 prose-table:text-teal-900 prose-li:text-teal-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-teal-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('cyan')
                        class="max-w-none font-thin prose prose-cyan prose-headings:text-cyan-900 prose-p:text-cyan-900 prose-a:text-cyan-900 prose-ol:text-cyan-900 prose-ul:text-cyan-900 prose-blockquote:text-cyan-900 prose-blockquote:border-cyan-900 prose-strong:text-cyan-900 prose-em:text-cyan-900 prose-code:text-cyan-100 prose-pre:text-cyan-900 prose-hr:border-cyan-200 prose-table:text-cyan-900 prose-li:text-cyan-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-cyan-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('sky')
                        class="max-w-none font-thin prose prose-sky prose-headings:text-sky-900 prose-p:text-sky-900 prose-a:text-sky-900 prose-ol:text-sky-900 prose-ul:text-sky-900 prose-blockquote:text-sky-900 prose-blockquote:border-sky-900 prose-strong:text-sky-900 prose-em:text-sky-900 prose-code:text-sky-100 prose-pre:text-sky-900 prose-hr:border-sky-200 prose-table:text-sky-900 prose-li:text-sky-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-sky-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('blue')
                        class="max-w-none font-thin prose prose-blue prose-headings:text-blue-900 prose-p:text-blue-900 prose-a:text-blue-900 prose-ol:text-blue-900 prose-ul:text-blue-900 prose-blockquote:text-blue-900 prose-blockquote:border-blue-900 prose-strong:text-blue-900 prose-em:text-blue-900 prose-code:text-blue-100 prose-pre:text-blue-900 prose-hr:border-blue-200 prose-table:text-blue-900 prose-li:text-blue-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-blue-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('indigo')
                        class="max-w-none font-thin prose prose-indigo prose-headings:text-indigo-900 prose-p:text-indigo-900 prose-a:text-indigo-900 prose-ol:text-indigo-900 prose-ul:text-indigo-900 prose-blockquote:text-indigo-900 prose-blockquote:border-indigo-900 prose-strong:text-indigo-900 prose-em:text-indigo-900 prose-code:text-indigo-100 prose-pre:text-indigo-900 prose-hr:border-indigo-200 prose-table:text-indigo-900 prose-li:text-indigo-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-indigo-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('violet')
                        class="max-w-none font-thin prose prose-violet prose-headings:text-violet-900 prose-p:text-violet-900 prose-a:text-violet-900 prose-ol:text-violet-900 prose-ul:text-violet-900 prose-blockquote:text-violet-900 prose-blockquote:border-violet-900 prose-strong:text-violet-900 prose-em:text-violet-900 prose-code:text-violet-100 prose-pre:text-violet-900 prose-hr:border-violet-200 prose-table:text-violet-900 prose-li:text-violet-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-violet-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('purple')
                        class="max-w-none font-thin prose prose-purple prose-headings:text-purple-900 prose-p:text-purple-900 prose-a:text-purple-900 prose-ol:text-purple-900 prose-ul:text-purple-900 prose-blockquote:text-purple-900 prose-blockquote:border-purple-900 prose-strong:text-purple-900 prose-em:text-purple-900 prose-code:text-purple-100 prose-pre:text-purple-900 prose-hr:border-purple-200 prose-table:text-purple-900 prose-li:text-purple-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-purple-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('fuchsia')
                        class="max-w-none font-thin prose prose-fuchsia prose-headings:text-fuchsia-900 prose-p:text-fuchsia-900 prose-a:text-fuchsia-900 prose-ol:text-fuchsia-900 prose-ul:text-fuchsia-900 prose-blockquote:text-fuchsia-900 prose-blockquote:border-fuchsia-900 prose-strong:text-fuchsia-900 prose-em:text-fuchsia-900 prose-code:text-fuchsia-100 prose-pre:text-fuchsia-900 prose-hr:border-fuchsia-200 prose-table:text-fuchsia-900 prose-li:text-fuchsia-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-fuchsia-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('pink')
                        class="max-w-none font-thin prose prose-pink prose-headings:text-pink-900 prose-p:text-pink-900 prose-a:text-pink-900 prose-ol:text-pink-900 prose-ul:text-pink-900 prose-blockquote:text-pink-900 prose-blockquote:border-pink-900 prose-strong:text-pink-900 prose-em:text-pink-900 prose-code:text-pink-100 prose-pre:text-pink-900 prose-hr:border-pink-200 prose-table:text-pink-900 prose-li:text-pink-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-pink-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @case('rose')
                        class="max-w-none font-thin prose prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc"
                        @break
                    @default
                        class="max-w-none font-thin prose prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc"
                @endswitch>
                {!! $comment->message->text !!}
            </div>
            <div class="w-fit h-fit flex flex-col space-x-0 space-y-2 p-2 shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                {{-- like dislike button --}}
                <div class="flex flex-row space-x-2 space-y-0 items-stretch">
                    <div class="flex flex-row space-x-2 space-y-0 items-center justify-center">
                        @if (in_array(Auth::id(), collect($comment->rates)->where('like', true)->pluck('user_id')->toArray()))
                            <div class="p-2 select-none cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                </svg>
                            </div>
                            <div class="pr-2 font-semibold">{{ $totalLikes }}</div>
                        @else
                            <div wire:click="$dispatch('like_comment', { id: {{ $comment->id }} })" class="p-2 select-none cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                </svg>
                            </div>
                            <div class="pr-2">{{ $totalLikes }}</div>
                        @endif
                    </div>
                    <div class="flex flex-row space-x-2 space-y-0 items-center justify-center">
                        @if (in_array(Auth::id(), collect($comment->rates)->where('dislike', true)->pluck('user_id')->toArray()))
                            <div class="p-2 select-none cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                                </svg>
                            </div>
                            <div class="pr-2 font-semibold">{{ $totalDislikes }}</div>
                        @else    
                            <div wire:click="$dispatch('dislike_comment', { id: {{ $comment->id }} })" class="p-2 select-none cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                                </svg>
                            </div>
                            <div class="pr-2">{{ $totalDislikes }}</div>
                        @endif
                    </div>
                </div>
                <div class="flex flex-row space-x-2 space-y-0 items-stretch">
                    <div class="flex flex-row space-x-2 space-y-0 items-center justify-center">
                        <div x-on:click="{{ 'open_replies_comment_' . $comment->id . ' = ! ' . 'open_replies_comment_' . $comment->id }}" class="p-2 rounded-lg select-none cursor-pointer">Replies</div>
                        <div class="pr-2">{{ $totalComments }}</div>
                    </div>
                    <a wire:click="$dispatch('reply_comment', { id: {{ $comment->id }} })" href="#commentForm" class="w-fit h-fit p-2 select-none cursor-pointer" draggable="false">Reply</a>
                </div>
                @auth
                    @if (Auth::id() == $comment->user_id && $comment->message->text != "<p><em>deleted comment</em></p>")
                        <div wire:click="$dispatch('delete_comment', { id: {{ $comment->id }} })" wire:confirm="Are you sure you want to delete this comment?" class="w-fit h-fit p-2 font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer select-none animation-button">Delete</div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <div x-cloak x-show="{{ 'open_replies_comment_' . $comment->id }}" class="flex flex-col space-x-0 space-y-2">
        @livewire(CommentList::class, ['preferences' => $preferences, 'reply' => $comment->id, 'comments' => $comments], key('replied-comment-' . $comment->id))
    </div>
</div>