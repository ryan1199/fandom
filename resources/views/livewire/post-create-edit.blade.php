<div
    class="w-full h-hit max-h-[calc(100vh-160px)] p-2 flex flex-col space-x-0 space-y-2 overflow-y-auto overflow-x-clip scroll-smooth text-[{{ $preferences['color_text'] }}] bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-lg">
    <div
        class="w-full h-fit flex flex-row justify-between items-center {{ 'text-[calc('.$preferences['font_size'] . 'px+2px)]' }}">
        <div>Post @if($mode == 'create') Create @else Edit @endif</div>
        <div wire:click="savePost" class="p-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
            Save Post</div>
    </div>
    <div
        class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
        <div class="{{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">Title</div>
        <ul class="{{ 'text-[calc('.$preferences['font_size'] . 'px-2px)]' }}">
            <li>Rules:</li>
            <li>Must not empty</li>
            <li>5 - 50 digit characters</li>
            <li>Must unique</li>
        </ul>
        @error('title')
        <div class="w-full h-fit text-red-500 {{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">{{ $message }}
        </div>
        @enderror
        <input wire:model="title" type="text"
            class="form-input border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg"
            placeholder="Post Title">
    </div>
    <div
        class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
        <div class="{{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">Description</div>
        <ul class="{{ 'text-[calc('.$preferences['font_size'] . 'px-2px)]' }}">
            <li>Rules:</li>
            <li>Must not empty</li>
            <li>10 - 100 digit characters</li>
        </ul>
        @error('description')
        <div class="w-full h-fit text-red-500 {{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">{{ $message }}
        </div>
        @enderror
        <textarea wire:model="description"
            class="form-input border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg"
            placeholder="Post Description"></textarea>
    </div>
    <div
        class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
        <div class="{{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">Tags</div>
        <ul class="{{ 'text-[calc('.$preferences['font_size'] . 'px-2px)]' }}">
            <li>Rules:</li>
            <li>Must not empty</li>
            <li>1 - 100 digit characters</li>
            <li>Separate with comma without space for more than one tag</li>
            <li>Example: Funny,Cute</li>
        </ul>
        @error('tags')
        <div class="w-full h-fit text-red-500 {{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">{{ $message }}
        </div>
        @enderror
        <textarea wire:model="tags"
            class="form-input border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg"
            placeholder="Post Tags"></textarea>
    </div>
    <div
        class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
        <div class="{{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">Galleries</div>
        <div class="w-full h-fit grid gap-2 grid-cols-6">
            @foreach ($galleries as $gallery)
            <div
                class="w-full h-fit p-1 flex flex-col space-x-0 space-y-2 justify-between border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
                <div class="flex flex-col space-x-0 space-y-2">
                    <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt=""
                        class="w-full h-40 object-cover object-center rounded-lg">
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div
        class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
        <div>Content</div>
        <p>Write content in markdown using commonmark.</p>
        <p>For detail see here: <a href="https://commonmark.org/help/" target="_BLANK">commonmark</a></p>
        @error('raw_body')
        <div class="w-full h-fit text-red-500 {{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">{{ $message }}
        </div>
        @enderror
        <div class="w-full h-fit grid grid-cols-2 gap-2">
            <textarea wire:model.live="raw_body"
                class="w-full h-full min-h-96 form-input border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg"></textarea>
            <div
                class="prose prose-base prose-img:mx-auto prose-img:max-w-sm w-full h-fit min-h-96 p-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
                {!! $body !!}
            </div>
        </div>
    </div>
</div>