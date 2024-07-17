<div wire:poll.60s="savePostTemporary" class="w-full h-screen max-h-[calc(100vh-25vh-8px)] lg:max-h-[100vh] p-2 pt-0 lg:pt-2 pl-2 lg:pl-1 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500 overflow-y-auto">
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg">
        <div class="w-full {{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
            <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }}">
                Post @if($mode == 'create') Create @else Edit @endif
            </span>
        </div>
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg">
            <div class="font-semibold {{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">Title</div>
            <div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                <p class="font-semibold">Rules:</p>
                <ol class="pl-8 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} list-decimal list-outside">
                    <li>Must not empty</li>
                    <li>5 - 50 digit characters</li>
                    <li>Must unique</li>
                </ol>
            </div>
            @error('title')
                <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
                    <p class="font-semibold">Errors:</p>
                    <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} text-rose-500 list-disc list-outside">
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
            <input wire:model="title" type="text" class="form-input border @error('title') border-rose-500 @else border-zinc-200 @enderror {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation" placeholder="Post Title">
        </div>
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg">
            <div class="font-semibold {{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">Description</div>
            <div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                <p class="font-semibold">Rules:</p>
                <ol class="pl-8 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} list-decimal list-outside">
                    <li>Must not empty</li>
                    <li>10 - 100 digit characters</li>
                </ol>
            </div>
            @error('description')
                <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
                    <p class="font-semibold">Errors:</p>
                    <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} text-rose-500 list-disc list-outside">
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
            <textarea wire:model="description" class="form-textarea border @error('description') border-rose-500 @else border-zinc-200 @enderror {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation" placeholder="Post Description"></textarea>
        </div>
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg">
            <div class="font-semibold {{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">Tags</div>
            <div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                <p class="font-semibold">Rules:</p>
                <ol class="pl-8 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} list-decimal list-outside">
                    <li>Must not empty</li>
                    <li>1 - 100 digit characters</li>
                    <li>Separate with comma without space for more than one tag</li>
                    <li>Example: Funny,Cute</li>
                </ol>
            </div>
            @error('tags')
                <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
                    <p class="font-semibold">Errors:</p>
                    <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} text-rose-500 list-disc list-outside">
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
            <textarea wire:model="tags" class="form-textarea border @error('tags') border-rose-500 @else border-zinc-200 @enderror {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation" placeholder="Post Tags"></textarea>
        </div>
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg">
            <div class="font-semibold {{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">Galleries</div>
            <div class="w-full h-fit grid gap-2 grid-cols-4 md:grid-cols-6 lg:grid-cols-4 xl:grid-cols-6">
                @foreach ($galleries as $gallery)
                    <img wire:key="{{ 'gallery' . $gallery->id }}" wire:click="addImage('{{ $gallery->image->url }}')" src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}" class="w-full h-40 object-cover object-center border border-zinc-200 {{ 'hover:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation-button" draggable="false">
                @endforeach
            </div>
        </div>
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg">
            <div class="font-semibold {{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">Content</div>
            <div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                <p class="font-semibold">Rules:</p>
                <ol class="pl-8 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} list-decimal list-outside">
                    <li>Write content in markdown using commonmark<a href="https://commonmark.org/help/" class="{{ 'text-[' . $preferences['color_2'] . ']' }}" target="_BLANK" draggable="false">(see here)</a>.</li>
                </ol>
            </div>
            @error('raw_body')
                <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
                    <p class="font-semibold">Errors:</p>
                    <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} text-rose-500 list-disc list-outside">
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
            <div class="w-full h-fit grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-2">
                <textarea wire:model.live="raw_body" x-data="{ 
                    startPosition: @entangle('startPosition').live,
                    endPosition: @entangle('endPosition').live,
                 }" x-ref="textarea" x-on:click="startPosition = $refs.textarea.selectionStart, endPosition = $refs.textarea.selectionEnd" class="w-full h-full min-h-96 form-textarea border @error('raw-body') border-rose-500 @else border-zinc-200 @enderror {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation"></textarea>
                 <div class="w-full h-fit min-h-96 p-2 border border-zinc-200 rounded-lg overflow-clip">
                     <div class="prose prose-zinc prose-headings:text-zinc-500 prose-p:text-zinc-500 prose-a:text-zinc-500 prose-ol:text-zinc-500 prose-ul:text-zinc-500 prose-blockquote:text-zinc-500 prose-strong:text-zinc-500 prose-em:text-zinc-500 prose-code:text-zinc-500 prose-pre:text-zinc-500 prose-hr:border-zinc-200 prose-table:text-zinc-500 prose-li:text-zinc-500 prose-ol:text-pretty prose-ul:text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} prose-ol:list-decimal prose-ul:list-disc prose-ol:list-outside prose-ul:list-outside">
                         {!! $body !!}
                     </div>
                 </div>
            </div>
        </div>
        <div class="flex flex-row justify-center">
            <div wire:click="savePost" class="w-fit p-2 text-nowrap font-semibold {{ 'hover:text-[' . $preferences['color_2'] . ']' }} cursor-pointer select-none animation-button">Save Post</div>
        </div>
    </div>
</div>