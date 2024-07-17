<div class="w-full h-screen max-h-[calc(100vh-25vh-8px)] lg:max-h-[100vh] p-2 pt-0 lg:pt-2 pl-2 lg:pl-1 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500 overflow-y-auto">
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg">
        <div class="w-full {{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
            <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }}">
                Gallery @if($mode == 'create') Create @else Edit @endif
            </span>
        </div>
        @if ($mode == 'create')
            <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg">
                <div class="font-semibold {{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">Image</div>
                <div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                    <p class="font-semibold">Rules:</p>
                    <ol class="pl-8 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} list-decimal list-outside">
                        <li>Must not empty</li>
                        <li>Image file max size is 10 MB</li>
                    </ol>
                </div>
                @error('image')
                    <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
                        <p class="font-semibold">Errors:</p>
                        <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} text-rose-500 list-disc list-outside">
                            <li>{{ $message }}</li>
                        </ul>
                    </div>
                @enderror
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" draggable="false">
                @endif
                <input wire:model="image" type="file" class="w-full form-input file:text-zinc-50 file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr {{ 'file:from-[' . $preferences['color_1'] . ']' }} {{ 'file:via-[' . $preferences['color_2'] . ']' }} {{ 'file:to-[' . $preferences['color_3'] . ']' }} file:border file:border-zinc-200 file:rounded-lg border @error('image') border-rose-500 @else border-zinc-200 @enderror {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg cursor-pointer file:cursor-pointer animation animation-button-file">
            </div>
        @endif
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
            <textarea wire:model="tags" class="w-full form-textarea border @error('tags') border-rose-500 @else border-zinc-200 @enderror {{ 'hover:border-[' . $preferences['color_2'] . ']' }} {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation" placeholder="Post Tags"></textarea>
        </div>
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg">
            <div class="font-semibold {{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">Upload location</div>
            <p class="{{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                <span class="font-semibold">Selected:</span> 
                @if ($publish_on['from'] == 'user')
                    {{ $publish_on['name'] }} with visible {{ $visible }}
                @else
                    {{ $publish_on['name'] }} with visible {{ $visible }}
                @endif
            </p>
            <div class="w-full grid gap-2 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
                @foreach ($available_publish_on as $array)
                    @if ($array['from'] == 'user')
                        <div wire:key="{{ 'publishOnUser' . $array['data']->id }}" class="w-full h-fit p-2 bg-zinc-50 border @if($publish_on['from'] == $array['from'] && $publish_on['name'] == Auth::user()->username) {{ 'border-[' . $preferences['color_2'] . ']' }} @else border-zinc-200 @endif rounded-lg">
                            <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                                <div class="{{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                    <h1 class="bg-clip-text line-clamp-2 text-transparent bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }}">{{ $array['data']->username }}</h1>
                                </div>
                                <div class="w-full h-[15vh] relative">
                                    @if ($array['data']->cover !== null)
                                        <img src="{{ asset('storage/covers/'.$array['data']->cover->image->url) }}" alt="Cover image {{ $array['data']->username }}" title="Cover image {{ $array['data']->username }}" class="w-full h-full object-cover block border border-zinc-200 rounded-lg" draggable="false">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border border-zinc-200 rounded-lg">
                                            <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-[15vh] object-cover block rounded-lg" draggable="false">
                                        </div>
                                    @endif
                                    @if ($array['data']->avatar !== null)
                                        <img src="{{ asset('storage/avatars/'.$array['data']->avatar->image->url) }}" alt="Avatar image {{ $array['data']->username }}" title="Avatar image {{ $array['data']->username }}" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square object-cover border-0 rounded-full" draggable="false">
                                    @else
                                        <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square bg-zinc-50 border-0 rounded-full"></div>
                                    @endif
                                </div>
                                <div class="w-full h-full flex flex-row space-x-2 space-y-0 text-left">
                                    <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ Auth::id() }},'{{ Auth::user()->username }}','self')" class="p-1 text-center bg-zinc-50 border @if($visible == 'self' && $publish_on['from'] == $array['from'] && $publish_on['name'] == Auth::user()->username) {{ 'border-[' . $preferences['color_2'] . ']' }} @else border-zinc-200 @endif {{ 'hover:border-[' . $preferences['color_2'] . ']' }} active:border-2 rounded-lg cursor-pointer animation-button">self</div>
                                    <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ Auth::id() }},'{{ Auth::user()->username }}','friend')" class="p-1 text-center bg-zinc-50 border @if($visible == 'friend' && $publish_on['from'] == $array['from'] && $publish_on['name'] == Auth::user()->username) {{ 'border-[' . $preferences['color_2'] . ']' }} @else border-zinc-200 @endif {{ 'hover:border-[' . $preferences['color_2'] . ']' }} active:border-2 rounded-lg cursor-pointer animation-button">friend</div>
                                    <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ Auth::id() }},'{{ Auth::user()->username }}','public')" class="p-1 text-center bg-zinc-50 border @if($visible == 'public' && $publish_on['from'] == $array['from'] && $publish_on['name'] == Auth::user()->username) {{ 'border-[' . $preferences['color_2'] . ']' }} @else border-zinc-200 @endif {{ 'hover:border-[' . $preferences['color_2'] . ']' }} active:border-2 rounded-lg cursor-pointer animation-button">public</div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div wire:key="{{ 'publishOnFandom' . $array['data']->id }}" class="w-full h-fit p-2 bg-zinc-50 border @if($publish_on['from'] == $array['from'] && $publish_on['name'] == $array['data']->name) {{ 'border-[' . $preferences['color_2'] . ']' }} @else border-zinc-200 @endif rounded-lg">
                            <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                                <div class="{{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                    <h1 class="bg-clip-text line-clamp-2 text-transparent bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }}">{{ $array['data']->name }}</h1>
                                </div>
                                <div class="w-full h-[15vh] relative">
                                    @if ($array['data']->cover !== null)
                                        <img src="{{ asset('storage/covers/'.$array['data']->cover->image->url) }}" alt="Cover image {{ $array['data']->name }}" title="Cover image {{ $array['data']->name }}" class="w-full h-full object-cover block border border-zinc-200 rounded-lg" draggable="false">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border border-zinc-200 rounded-lg">
                                            <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-[15vh] object-cover block rounded-lg" draggable="false">
                                        </div>
                                    @endif
                                    @if ($array['data']->avatar !== null)
                                        <img src="{{ asset('storage/avatars/'.$array['data']->avatar->image->url) }}" alt="Avatar image {{ $array['data']->name }}" title="Avatar image {{ $array['data']->name }}" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square object-cover border-0 rounded-full" draggable="false">
                                    @else
                                        <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square bg-zinc-50 border-0 rounded-full"></div>
                                    @endif
                                </div>
                                <div class="w-full h-full flex flex-row space-x-2 space-y-0 text-left">
                                    <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ $array['data']->id }},'{{ $array['data']->name }}','member')" class="p-1 text-center bg-zinc-50 border @if($visible == 'member' && $publish_on['from'] == $array['from'] && $publish_on['name'] == $array['data']->name) {{ 'border-[' . $preferences['color_2'] . ']' }} @else border-zinc-200 @endif {{ 'hover:border-[' . $preferences['color_2'] . ']' }} active:border-2 rounded-lg cursor-pointer animation-button">member</div>
                                    <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ $array['data']->id }},'{{ $array['data']->name }}','public')" class="p-1 text-center bg-zinc-50 border @if($visible == 'public' && $publish_on['from'] == $array['from'] && $publish_on['name'] == $array['data']->name) {{ 'border-[' . $preferences['color_2'] . ']' }} @else border-zinc-200 @endif {{ 'hover:border-[' . $preferences['color_2'] . ']' }} active:border-2 rounded-lg cursor-pointer animation-button">public</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @error('publish_on')
                <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
                    <p class="font-semibold">Errors:</p>
                    <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} text-rose-500 list-disc list-outside">
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
            @error('visible')
                <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
                    <p class="font-semibold">Errors:</p>
                    <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} text-rose-500 list-disc list-outside">
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>
        <div class="flex flex-row justify-center">
            <div wire:click="saveGallery" class="w-fit mx-auto p-2 text-nowrap font-semibold {{ 'hover:text-[' . $preferences['color_2'] . ']' }} cursor-pointer select-none animation-button">Save Gallery</div>
        </div>
    </div>
</div>
