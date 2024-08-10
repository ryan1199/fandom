<div class="w-full h-screen max-h-[calc(100vh-25vh-8px)] lg:max-h-[100vh] p-2 pt-0 lg:pt-2 pl-2 lg:pl-1 {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} overflow-y-auto">
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-100' }} rounded-lg">
        <div class="w-full {{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
            <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                Gallery @if($mode == 'create') Create @else Edit @endif
            </span>
        </div>
        @if ($mode == 'create')
            <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg">
                <div class="font-semibold {{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">Image</div>
                <div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                    <p class="font-semibold">Rules:</p>
                    <ol class="pl-8 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-decimal list-outside">
                        <li>Must not empty</li>
                        <li>Image file max size is 10 MB</li>
                    </ol>
                </div>
                @error('image')
                    <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
                        <p class="font-semibold">Errors:</p>
                        <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} list-disc list-outside">
                            <li>{{ $message }}</li>
                        </ul>
                    </div>
                @enderror
            </div>
            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" draggable="false">
            @endif
            <input wire:model="image" type="file" class="w-full form-input {{ 'bg-' . $preferences['color_2'] . '-50' }} {{ 'file:text-' . $preferences['color_2'] . '-900' }} file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr {{ 'file:from-' . $preferences['color_1'] . '-500' }} {{ 'file:via-' . $preferences['color_2'] . '-500' }} {{ 'file:to-' . $preferences['color_3'] . '-500' }} file:border {{ 'file:border-' . $preferences['color_2'] . '-200' }} file:rounded-lg border @error('image') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer file:cursor-pointer animation animation-button-file">
        @endif
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg">
            <div class="font-semibold {{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">Tags</div>
            <div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                <p class="font-semibold">Rules:</p>
                <ol class="pl-8 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-decimal list-outside">
                    <li>Must not empty</li>
                    <li>1 - 100 digit characters</li>
                    <li>Separate with comma without space for more than one tag</li>
                    <li>Example: Funny,Cute</li>
                </ol>
            </div>
            @error('tags')
                <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
                    <p class="font-semibold">Errors:</p>
                    <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} list-disc list-outside">
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>
        <textarea wire:model="tags" class="w-full form-textarea {{ 'bg-' . $preferences['color_2'] . '-50' }} border @error('tags') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" placeholder="Post Tags"></textarea>
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg">
            <div class="font-semibold {{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">Upload location</div>
            <p class="{{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                <span class="font-semibold">Selected:</span> 
                @if ($publish_on['from'] == 'user')
                    {{ $publish_on['name'] }} with visible {{ $visible }}
                @else
                    {{ $publish_on['name'] }} with visible {{ $visible }}
                @endif
            </p>
            @error('publish_on')
                <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
                    <p class="font-semibold">Errors:</p>
                    <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} list-disc list-outside">
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
            @error('visible')
                <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
                    <p class="font-semibold">Errors:</p>
                    <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} list-disc list-outside">
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>
        <div class="w-full grid gap-2 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
            @foreach ($available_publish_on as $array)
                @if ($array['from'] == 'user')
                    <div wire:key="{{ 'publish-on-user-' . $array['data']->id }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} border @if($publish_on['from'] == $array['from'] && $publish_on['name'] == Auth::user()->username) {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @endif rounded-lg">
                        <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                            <div class="{{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                <h1 class="bg-clip-text line-clamp-2 text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">{{ $array['data']->username }}</h1>
                            </div>
                            <div class="w-full h-[15vh] relative">
                                @if ($array['data']->cover !== null)
                                    <img src="{{ asset('storage/covers/'.$array['data']->cover->image->url) }}" alt="Cover image {{ $array['data']->username }}" title="Cover image {{ $array['data']->username }}" class="w-full h-full object-cover block rounded-lg" draggable="false">
                                @else
                                    <div class="w-full h-[15vh] bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} rounded-lg">
                                        <div style="background-image: url('{{ asset('cover-white.svg') }}')" class="w-full h-[15vh] bg-repeat bg-center rounded-lg"></div>
                                    </div>
                                @endif
                                @if ($array['data']->avatar !== null)
                                    <img src="{{ asset('storage/avatars/'.$array['data']->avatar->image->url) }}" alt="Avatar image {{ $array['data']->username }}" title="Avatar image {{ $array['data']->username }}" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square object-cover rounded-full" draggable="false">
                                @else
                                    <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square bg-gradient-to-tr {{ 'from-' . $preferences['color_2'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_2'] . '-900' }} rounded-full">
                                        <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                                    </div>
                                @endif
                            </div>
                            <div class="w-full h-full flex flex-row space-x-2 space-y-0 text-left">
                                <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ Auth::id() }},'{{ Auth::user()->username }}','self')" class="p-1 text-center {{ 'bg-' . $preferences['color_2'] . '-100' }} border @if($visible == 'self' && $publish_on['from'] == $array['from'] && $publish_on['name'] == Auth::user()->username) {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @endif {{ 'hover:border-' . $preferences['color_2'] . '-500' }} active:border-2 rounded-lg cursor-pointer animation-button">self</div>
                                <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ Auth::id() }},'{{ Auth::user()->username }}','friend')" class="p-1 text-center {{ 'bg-' . $preferences['color_2'] . '-100' }} border @if($visible == 'friend' && $publish_on['from'] == $array['from'] && $publish_on['name'] == Auth::user()->username) {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @endif {{ 'hover:border-' . $preferences['color_2'] . '-500' }} active:border-2 rounded-lg cursor-pointer animation-button">friend</div>
                                <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ Auth::id() }},'{{ Auth::user()->username }}','public')" class="p-1 text-center {{ 'bg-' . $preferences['color_2'] . '-100' }} border @if($visible == 'public' && $publish_on['from'] == $array['from'] && $publish_on['name'] == Auth::user()->username) {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @endif {{ 'hover:border-' . $preferences['color_2'] . '-500' }} active:border-2 rounded-lg cursor-pointer animation-button">public</div>
                            </div>
                        </div>
                    </div>
                @else
                    <div wire:key="{{ 'publish-on-fandom-' . $array['data']->id }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50' }} border @if($publish_on['from'] == $array['from'] && $publish_on['name'] == $array['data']->name) {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @endif rounded-lg">
                        <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                            <div class="{{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                <h1 class="bg-clip-text line-clamp-2 text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">{{ $array['data']->name }}</h1>
                            </div>
                            <div class="w-full h-[15vh] relative">
                                @if ($array['data']->cover !== null)
                                    <img src="{{ asset('storage/covers/'.$array['data']->cover->image->url) }}" alt="Cover image {{ $array['data']->name }}" title="Cover image {{ $array['data']->name }}" class="w-full h-full object-cover block rounded-lg" draggable="false">
                                @else
                                    <div class="w-full h-[15vh] bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} rounded-lg">
                                    </div>
                                @endif
                                @if ($array['data']->avatar !== null)
                                    <img src="{{ asset('storage/avatars/'.$array['data']->avatar->image->url) }}" alt="Avatar image {{ $array['data']->name }}" title="Avatar image {{ $array['data']->name }}" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square object-cover rounded-full" draggable="false">
                                @else
                                    <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square bg-gradient-to-tr {{ 'from-' . $preferences['color_2'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_2'] . '-900' }} rounded-full"></div>
                                @endif
                            </div>
                            <div class="w-full h-full flex flex-row space-x-2 space-y-0 text-left">
                                <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ $array['data']->id }},'{{ $array['data']->name }}','member')" class="p-1 text-center {{ 'bg-' . $preferences['color_2'] . '-100' }} border @if($visible == 'member' && $publish_on['from'] == $array['from'] && $publish_on['name'] == $array['data']->name) {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @endif {{ 'hover:border-' . $preferences['color_2'] . '-500' }} active:border-2 rounded-lg cursor-pointer animation-button">member</div>
                                <div wire:click="setUploadLocation('{{ $array['from'] }}',{{ $array['data']->id }},'{{ $array['data']->name }}','public')" class="p-1 text-center {{ 'bg-' . $preferences['color_2'] . '-100' }} border @if($visible == 'public' && $publish_on['from'] == $array['from'] && $publish_on['name'] == $array['data']->name) {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @endif {{ 'hover:border-' . $preferences['color_2'] . '-500' }} active:border-2 rounded-lg cursor-pointer animation-button">public</div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="flex flex-row justify-center">
            <div wire:click="saveGallery" class="w-fit mx-auto p-2 text-nowrap font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer select-none animation-button">Save Gallery</div>
        </div>
    </div>
</div>
