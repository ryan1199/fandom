<div class="{{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500">
    <form wire:submit="submitDiscuss">
        @csrf
        <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
            @error('content')
                <div class="w-full h-full p-2 flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} border border-zinc-200 rounded-lg">
                    <p class="font-semibold">Errors:</p>
                    <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} text-rose-500 list-disc list-outside">
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
            @if ($raw_content)
                <div class="bg-zinc-50 prose prose-zinc prose-headings:text-zinc-500 prose-p:text-zinc-500 prose-a:text-zinc-500 prose-ol:text-zinc-500 prose-ul:text-zinc-500 prose-blockquote:text-zinc-500 prose-strong:text-zinc-500 prose-em:text-zinc-500 prose-code:text-zinc-500 prose-pre:text-zinc-500 prose-hr:border-zinc-200 prose-table:text-zinc-500 prose-li:text-zinc-500 prose-ol:text-pretty prose-ul:text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside">
                    {!! $raw_content !!}
                </div>
            @endif
            <div class="w-full h-fit flex flex-row space-x-1 space-y-0 items-center">
                <textarea wire:model.live="content" placeholder="Your message" title="Your message" cols="30" rows="1" class="w-full h-full form-textarea border @error('content') border-rose-500 @else border-zinc-200 @enderror {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation"></textarea>
                <button type="submit" title="Send your message" class="w-fit h-fit p-2 bg-zinc-50 border border-zinc-200 rounded-lg group {{ 'hover:border-[' . $preferences['color_2'] . ']' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-zinc-500 {{ 'hover:text-[' . $preferences['color_2'] . ']' }} animation-button-group">
                        <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>
