<div class="w-full h-hit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['color_text'] . ']' }} {{ 'bg-[' . $preferences['color_primary'] . ']' }} border-0 rounded-lg">
    <div class="w-full h-fit flex flex-row justify-between items-center {{ 'text-[calc(' . $preferences['font_size'] . 'px+2px)]' }}">
        <div class="font-semibold">Post @if($mode == 'create') Create @else Edit @endif</div>
        <div wire:click="savePost" class="p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">Save Post</div>
    </div>
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
        <div>Title</div>
        <ul class="{{ 'text-[calc(' . $preferences['font_size'] . 'px-2px)]' }}">
            <li>Rules:</li>
            <li>Must not empty</li>
            <li>5 - 50 digit characters</li>
            <li>Must unique</li>
        </ul>
        @error('title')
            <div class="w-full h-fit text-red-500">{{ $message }}</div>
        @enderror
        <input wire:model="title" type="text" class="form-input border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg" placeholder="Post Title">
    </div>
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
        <div>Description</div>
        <ul class="{{ 'text-[calc(' . $preferences['font_size'] . 'px-2px)]' }}">
            <li>Rules:</li>
            <li>Must not empty</li>
            <li>10 - 100 digit characters</li>
        </ul>
        @error('description')
            <div class="w-full h-fit text-red-500">{{ $message }}</div>
        @enderror
        <textarea wire:model="description" class="form-input border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg" placeholder="Post Description"></textarea>
    </div>
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
        <div>Tags</div>
        <ul class="{{ 'text-[calc(' . $preferences['font_size'] . 'px-2px)]' }}">
            <li>Rules:</li>
            <li>Must not empty</li>
            <li>1 - 100 digit characters</li>
            <li>Separate with comma without space for more than one tag</li>
            <li>Example: Funny,Cute</li>
        </ul>
        @error('tags')
            <div class="w-full h-fit text-red-500">{{ $message }}</div>
        @enderror
        <textarea wire:model="tags" class="form-input border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg" placeholder="Post Tags"></textarea>
    </div>
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
        <div>Galleries</div>
        <div class="w-full h-fit grid gap-2 grid-cols-4 md:grid-cols-6 lg:grid-cols-4 xl:grid-cols-6">
            @foreach ($galleries as $gallery)
                <div class="w-full h-fit p-1 flex flex-col space-x-0 space-y-2 justify-between border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                    <div class="flex flex-col space-x-0 space-y-2">
                        <img wire:click="addImage('{{ $gallery->image->url }}')" src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}" class="w-full h-40 object-cover object-center rounded-lg cursor-pointer" draggable="false">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'text-[' . $preferences['font_size'] . 'px]' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
        <div>Content</div>
        <p>Write content in markdown using commonmark.</p>
        <p>For detail see here: <a href="https://commonmark.org/help/" target="_BLANK" draggable="false">commonmark</a></p>
        @error('raw_body')
            <div class="w-full h-fit text-red-500">{{ $message }}</div>
        @enderror
        <div class="w-full h-fit grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-2">
            <textarea wire:model.live="raw_body" x-data="{ 
                startPosition: @entangle('startPosition').live,
                endPosition: @entangle('endPosition').live,
             }" x-ref="textarea" x-on:click="startPosition = $refs.textarea.selectionStart, endPosition = $refs.textarea.selectionEnd" class="w-full h-full min-h-96 form-input border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg"></textarea>
             <div class="w-full h-fit min-h-96 p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg overflow-clip">
                 <div class="container prose prose-base prose-img:mx-auto prose-img:w-[20vw] prose-img:h-[10vh] sm:prose-img:h-[15vh] md:prose-img:h-[20vh] lg:prose-img:h-[25vh] xl:prose-img:h-[30vh] prose-img:inline-block prose-img:object-cover prose-img:object-center prose-img:rounded-lg">
                     {!! $body !!}
                 </div>
             </div>
        </div>
    </div>
</div>