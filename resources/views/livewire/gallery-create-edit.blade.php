<div
    class="w-full h-hit max-h-[calc(100vh-160px)] p-2 flex flex-col space-x-0 space-y-2 overflow-y-auto overflow-x-clip scroll-smooth text-[{{ $preferences['color_text'] }}] bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-lg">
    <div
        class="w-full h-fit flex flex-row justify-between items-center {{ 'text-[calc('.$preferences['font_size'] . 'px+2px)]' }}">
        <div>Gallery @if($mode == 'create') Create @else Edit @endif</div>
        <div wire:click="saveGallery"
            class="p-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
            Save Gallery</div>
    </div>
    @if ($mode == 'create')
    <div
        class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
        <div class="{{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">Image</div>
        <ul class="{{ 'text-[calc('.$preferences['font_size'] . 'px-2px)]' }}">
            <li>Rules:</li>
            <li>Must not empty</li>
            <li>Image file max size is 10 MB</li>
        </ul>
        @error('image')
        <div class="w-full h-fit text-red-500 {{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">{{ $message }}
        </div>
        @enderror
        @if ($image)
        <img src="{{ $image->temporaryUrl() }}">
        @endif
        <input wire:model="image" type="file"
            class="w-full form-input file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr file:from-[{{ $preferences['color_1'] }}] file:via-[{{ $preferences['color_2'] }}] file:to-[{{ $preferences['color_3'] }}] file:border file:border-[{{ $preferences['color_secondary'] }}] file:rounded-lg border @error('image') invalid @else valid @enderror rounded-lg cursor-pointer file:cursor-pointer file:transition-all file:duration-100 hover:file:opacity-50 file:active:duration-75 file:active:scale-[.95]">
    </div>
    @endif
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
        <div class="{{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">Upload location</div>
        <div class="w-full grid gap-2 grid-cols-3">
            @foreach ($available_publish_on as $array)
            <div
                class="w-full p-2 flex flex-col space-x-0 space-y-2 @if($publish_on['name'] == $array['name']) border-2 @else border @endif {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
                <p class="text-center {{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">{{ $array['name'] }}</p>
                <div
                    class="p-2 flex flex-col space-x-0 space-y-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
                    @if ($array['from'] == 'fandom')
                    <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ $array['id'] }},'{{ $array['name'] }}','member')"
                        class="p-1 text-center @if($visible == 'member') border-2 @else border @endif {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
                        member</div>
                    <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ $array['id'] }},'{{ $array['name'] }}','public')"
                        class="p-1 text-center @if($visible == 'public' && $publish_on['name'] == $array['name']) border-2 @else border @endif {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
                        public</div>
                    @else
                    <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ $array['id'] }},'{{ $array['name'] }}','self')"
                        class="p-1 text-center @if($visible == 'self') border-2 @else border @endif {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
                        self</div>
                    <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ $array['id'] }},'{{ $array['name'] }}','public')"
                        class="p-1 text-center @if($visible == 'public' && $publish_on['name'] == $array['name']) border-2 @else border @endif {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
                        public</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @error('publish_on')
        <div class="w-full h-fit text-red-500 {{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">{{ $message }}
        </div>
        @enderror
        @error('visible')
        <div class="w-full h-fit text-red-500 {{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">{{ $message }}
        </div>
        @enderror
    </div>
</div>