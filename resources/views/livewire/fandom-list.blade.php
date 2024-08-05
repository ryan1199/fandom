<div class="w-full h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none overflow-clip">
    <div class="w-full h-screen max-h-[100vh] p-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 grid-flow-row-dense auto-rows-max auto-cols-max gap-2 {{ 'bg-' . $preferences['color_2'] . '-50/95' }} overflow-y-auto">
        @forelse ($fandoms as $fandom)
            <a wire:key="{{ 'fandom-' . $fandom->id }}" wire:navigate.hover href="{{ route('fandom-details', $fandom) }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-100' }} rounded-lg block" draggable="false" title="{{ $fandom->name }}">
                <div class="w-full h-fit max-h-[30vh] flex flex-col space-x-0 space-y-2 overflow-y-auto">
                    <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        <h1 class="w-full h-fit overflow-x-scroll max-w-full text-nowrap {{ 'text-' . $preferences['color_2'] . '-900' }}">{{ $fandom->name }}</h1>
                    </div>
                    <div class="w-full h-[15vh] relative">
                        @if ($fandom->cover !== null)
                            <img src="{{ asset('storage/covers/'.$fandom->cover->image->url) }}" alt="Cover image {{ $fandom->name }}" title="Cover image {{ $fandom->name }}" class="w-full h-full object-cover block rounded-lg" draggable="false">
                        @else
                            <div class="w-full h-full bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} rounded-lg">
                                <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-[15vh] object-cover block rounded-lg" draggable="false">
                            </div>
                        @endif
                        @if ($fandom->avatar !== null)
                            <img src="{{ asset('storage/avatars/'.$fandom->avatar->image->url) }}" alt="Avatar image {{ $fandom->name }}" title="Avatar image {{ $fandom->name }}" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square object-cover rounded-full" draggable="false">
                        @else
                            <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[10vh] aspect-square bg-gradient-to-r {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} rounded-full"></div>
                        @endif
                    </div>
                    <div class="w-full h-full p-2 text-left {{ 'bg-' . $preferences['color_2'] . '-50' }} border border-zinc-200 rounded-lg">
                        <p>{{ $fandom->description }}</p>
                    </div>
                </div>
            </a>
        @empty
            <div class="w-full h-screen max-h-[31vh] p-2 flex flex-row items-center justify-center bg-zinc-50 border border-zinc-200 rounded-lg">
                <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} text-center {{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    No fandom has been created
                </div>
            </div>
        @endforelse
    </div>
</div>