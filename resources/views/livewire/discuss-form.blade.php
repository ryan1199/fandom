<div class="{{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-100' }} rounded-lg">
    <form wire:submit="submitDiscuss">
        @csrf
        <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
            @error('content')
                <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                    <p class="font-semibold">Errors:</p>
                    <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-disc list-outside">
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
            @if ($raw_content)
                <div 
                    @switch($preferences['color_2'])
                        @case('slate')
                            class="font-thin prose prose-base prose-rose prose-headings:text-slate-900 prose-p:text-slate-900 prose-a:text-slate-900 prose-ol:text-slate-900 prose-ul:text-slate-900 prose-blockquote:text-slate-900 prose-blockquote:border-slate-900 prose-strong:text-slate-900 prose-em:text-slate-900 prose-code:text-slate-100 prose-pre:text-slate-900 prose-hr:border-slate-200 prose-table:text-slate-900 prose-li:text-slate-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-slate-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('gray')
                            class="font-thin prose prose-base prose-rose prose-headings:text-gray-900 prose-p:text-gray-900 prose-a:text-gray-900 prose-ol:text-gray-900 prose-ul:text-gray-900 prose-blockquote:text-gray-900 prose-blockquote:border-gray-900 prose-strong:text-gray-900 prose-em:text-gray-900 prose-code:text-gray-100 prose-pre:text-gray-900 prose-hr:border-gray-200 prose-table:text-gray-900 prose-li:text-gray-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-gray-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('zinc')
                            class="font-thin prose prose-base prose-rose prose-headings:text-zinc-900 prose-p:text-zinc-900 prose-a:text-zinc-900 prose-ol:text-zinc-900 prose-ul:text-zinc-900 prose-blockquote:text-zinc-900 prose-blockquote:border-zinc-900 prose-strong:text-zinc-900 prose-em:text-zinc-900 prose-code:text-zinc-100 prose-pre:text-zinc-900 prose-hr:border-zinc-200 prose-table:text-zinc-900 prose-li:text-zinc-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-zinc-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('neutral')
                            class="font-thin prose prose-base prose-rose prose-headings:text-neutral-900 prose-p:text-neutral-900 prose-a:text-neutral-900 prose-ol:text-neutral-900 prose-ul:text-neutral-900 prose-blockquote:text-neutral-900 prose-blockquote:border-neutral-900 prose-strong:text-neutral-900 prose-em:text-neutral-900 prose-code:text-neutral-100 prose-pre:text-neutral-900 prose-hr:border-neutral-200 prose-table:text-neutral-900 prose-li:text-neutral-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-neutral-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('stone')
                            class="font-thin prose prose-base prose-rose prose-headings:text-stone-900 prose-p:text-stone-900 prose-a:text-stone-900 prose-ol:text-stone-900 prose-ul:text-stone-900 prose-blockquote:text-stone-900 prose-blockquote:border-stone-900 prose-strong:text-stone-900 prose-em:text-stone-900 prose-code:text-stone-100 prose-pre:text-stone-900 prose-hr:border-stone-200 prose-table:text-stone-900 prose-li:text-stone-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-stone-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('red')
                            class="font-thin prose prose-base prose-rose prose-headings:text-red-900 prose-p:text-red-900 prose-a:text-red-900 prose-ol:text-red-900 prose-ul:text-red-900 prose-blockquote:text-red-900 prose-blockquote:border-red-900 prose-strong:text-red-900 prose-em:text-red-900 prose-code:text-red-100 prose-pre:text-red-900 prose-hr:border-red-200 prose-table:text-red-900 prose-li:text-red-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-red-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('orange')
                            class="font-thin prose prose-base prose-rose prose-headings:text-orange-900 prose-p:text-orange-900 prose-a:text-orange-900 prose-ol:text-orange-900 prose-ul:text-orange-900 prose-blockquote:text-orange-900 prose-blockquote:border-orange-900 prose-strong:text-orange-900 prose-em:text-orange-900 prose-code:text-orange-100 prose-pre:text-orange-900 prose-hr:border-orange-200 prose-table:text-orange-900 prose-li:text-orange-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-orange-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('amber')
                            class="font-thin prose prose-base prose-rose prose-headings:text-amber-900 prose-p:text-amber-900 prose-a:text-amber-900 prose-ol:text-amber-900 prose-ul:text-amber-900 prose-blockquote:text-amber-900 prose-blockquote:border-amber-900 prose-strong:text-amber-900 prose-em:text-amber-900 prose-code:text-amber-100 prose-pre:text-amber-900 prose-hr:border-amber-200 prose-table:text-amber-900 prose-li:text-amber-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-amber-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('yellow')
                            class="font-thin prose prose-base prose-rose prose-headings:text-yellow-900 prose-p:text-yellow-900 prose-a:text-yellow-900 prose-ol:text-yellow-900 prose-ul:text-yellow-900 prose-blockquote:text-yellow-900 prose-blockquote:border-yellow-900 prose-strong:text-yellow-900 prose-em:text-yellow-900 prose-code:text-yellow-100 prose-pre:text-yellow-900 prose-hr:border-yellow-200 prose-table:text-yellow-900 prose-li:text-yellow-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-yellow-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('lime')
                            class="font-thin prose prose-base prose-rose prose-headings:text-lime-900 prose-p:text-lime-900 prose-a:text-lime-900 prose-ol:text-lime-900 prose-ul:text-lime-900 prose-blockquote:text-lime-900 prose-blockquote:border-lime-900 prose-strong:text-lime-900 prose-em:text-lime-900 prose-code:text-lime-100 prose-pre:text-lime-900 prose-hr:border-lime-200 prose-table:text-lime-900 prose-li:text-lime-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-lime-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('green')
                            class="font-thin prose prose-base prose-rose prose-headings:text-green-900 prose-p:text-green-900 prose-a:text-green-900 prose-ol:text-green-900 prose-ul:text-green-900 prose-blockquote:text-green-900 prose-blockquote:border-green-900 prose-strong:text-green-900 prose-em:text-green-900 prose-code:text-green-100 prose-pre:text-green-900 prose-hr:border-green-200 prose-table:text-green-900 prose-li:text-green-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-green-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('emerald')
                            class="font-thin prose prose-base prose-rose prose-headings:text-emerald-900 prose-p:text-emerald-900 prose-a:text-emerald-900 prose-ol:text-emerald-900 prose-ul:text-emerald-900 prose-blockquote:text-emerald-900 prose-blockquote:border-emerald-900 prose-strong:text-emerald-900 prose-em:text-emerald-900 prose-code:text-emerald-100 prose-pre:text-emerald-900 prose-hr:border-emerald-200 prose-table:text-emerald-900 prose-li:text-emerald-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-emerald-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('teal')
                            class="font-thin prose prose-base prose-rose prose-headings:text-teal-900 prose-p:text-teal-900 prose-a:text-teal-900 prose-ol:text-teal-900 prose-ul:text-teal-900 prose-blockquote:text-teal-900 prose-blockquote:border-teal-900 prose-strong:text-teal-900 prose-em:text-teal-900 prose-code:text-teal-100 prose-pre:text-teal-900 prose-hr:border-teal-200 prose-table:text-teal-900 prose-li:text-teal-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-teal-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('cyan')
                            class="font-thin prose prose-base prose-rose prose-headings:text-cyan-900 prose-p:text-cyan-900 prose-a:text-cyan-900 prose-ol:text-cyan-900 prose-ul:text-cyan-900 prose-blockquote:text-cyan-900 prose-blockquote:border-cyan-900 prose-strong:text-cyan-900 prose-em:text-cyan-900 prose-code:text-cyan-100 prose-pre:text-cyan-900 prose-hr:border-cyan-200 prose-table:text-cyan-900 prose-li:text-cyan-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-cyan-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('sky')
                            class="font-thin prose prose-base prose-rose prose-headings:text-sky-900 prose-p:text-sky-900 prose-a:text-sky-900 prose-ol:text-sky-900 prose-ul:text-sky-900 prose-blockquote:text-sky-900 prose-blockquote:border-sky-900 prose-strong:text-sky-900 prose-em:text-sky-900 prose-code:text-sky-100 prose-pre:text-sky-900 prose-hr:border-sky-200 prose-table:text-sky-900 prose-li:text-sky-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-sky-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('blue')
                            class="font-thin prose prose-base prose-rose prose-headings:text-blue-900 prose-p:text-blue-900 prose-a:text-blue-900 prose-ol:text-blue-900 prose-ul:text-blue-900 prose-blockquote:text-blue-900 prose-blockquote:border-blue-900 prose-strong:text-blue-900 prose-em:text-blue-900 prose-code:text-blue-100 prose-pre:text-blue-900 prose-hr:border-blue-200 prose-table:text-blue-900 prose-li:text-blue-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-blue-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('indigo')
                            class="font-thin prose prose-base prose-rose prose-headings:text-indigo-900 prose-p:text-indigo-900 prose-a:text-indigo-900 prose-ol:text-indigo-900 prose-ul:text-indigo-900 prose-blockquote:text-indigo-900 prose-blockquote:border-indigo-900 prose-strong:text-indigo-900 prose-em:text-indigo-900 prose-code:text-indigo-100 prose-pre:text-indigo-900 prose-hr:border-indigo-200 prose-table:text-indigo-900 prose-li:text-indigo-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-indigo-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('violet')
                            class="font-thin prose prose-base prose-rose prose-headings:text-violet-900 prose-p:text-violet-900 prose-a:text-violet-900 prose-ol:text-violet-900 prose-ul:text-violet-900 prose-blockquote:text-violet-900 prose-blockquote:border-violet-900 prose-strong:text-violet-900 prose-em:text-violet-900 prose-code:text-violet-100 prose-pre:text-violet-900 prose-hr:border-violet-200 prose-table:text-violet-900 prose-li:text-violet-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-violet-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('purple')
                            class="font-thin prose prose-base prose-rose prose-headings:text-purple-900 prose-p:text-purple-900 prose-a:text-purple-900 prose-ol:text-purple-900 prose-ul:text-purple-900 prose-blockquote:text-purple-900 prose-blockquote:border-purple-900 prose-strong:text-purple-900 prose-em:text-purple-900 prose-code:text-purple-100 prose-pre:text-purple-900 prose-hr:border-purple-200 prose-table:text-purple-900 prose-li:text-purple-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-purple-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('fuchsia')
                            class="font-thin prose prose-base prose-rose prose-headings:text-fuchsia-900 prose-p:text-fuchsia-900 prose-a:text-fuchsia-900 prose-ol:text-fuchsia-900 prose-ul:text-fuchsia-900 prose-blockquote:text-fuchsia-900 prose-blockquote:border-fuchsia-900 prose-strong:text-fuchsia-900 prose-em:text-fuchsia-900 prose-code:text-fuchsia-100 prose-pre:text-fuchsia-900 prose-hr:border-fuchsia-200 prose-table:text-fuchsia-900 prose-li:text-fuchsia-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-fuchsia-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('pink')
                            class="font-thin prose prose-base prose-rose prose-headings:text-pink-900 prose-p:text-pink-900 prose-a:text-pink-900 prose-ol:text-pink-900 prose-ul:text-pink-900 prose-blockquote:text-pink-900 prose-blockquote:border-pink-900 prose-strong:text-pink-900 prose-em:text-pink-900 prose-code:text-pink-100 prose-pre:text-pink-900 prose-hr:border-pink-200 prose-table:text-pink-900 prose-li:text-pink-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-pink-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @case('rose')
                            class="font-thin prose prose-base prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @break
                        @default
                            class="font-thin prose prose-base prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                    @endswitch>
                    {!! $raw_content !!}
                </div>
            @endif
            <div class="w-full h-fit flex flex-row space-x-1 space-y-0 items-center">
                <textarea wire:model.live="content" placeholder="Your message" title="Your message" cols="30" rows="1" class="w-full h-full form-textarea border @error('content') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation"></textarea>
                <button type="submit" title="Send your message" class="w-fit h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg group {{ 'hover:border-' . $preferences['color_2'] . '-500' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 {{ 'text-' . $preferences['color_2'] . '-500' }} {{ 'hover:text-' . $preferences['color_2'] . '-500' }} animation-button-group">
                        <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>
