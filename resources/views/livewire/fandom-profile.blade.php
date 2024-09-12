<div style="background-image: url('{{ asset('storage/covers/' . $fandom->cover->image->url) }}')" class="w-full h-fit bg-cover bg-no-repeat bg-center rounded-lg">
    <div class="w-full h-fit p-4 flex flex-col justify-center items-center space-x-0 space-y-4">
        <img src="{{ asset('storage/avatars/' . $fandom->avatar->image->url) }}" alt="Avatar image {{ $fandom->name }}" title="Avatar image {{ $fandom->name }}" class="p-2 w-auto h-40 aspect-square object-cover {{ 'bg-' . $preferences['color_2'] . '-50/10' }} backdrop-blur-sm shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-full select-none" draggable="false">
        <div class="w-full h-fit p-2 {{ 'text-' . $preferences['color_2'] . '-100' }} {{ 'bg-' . $preferences['color_2'] . '-50/10' }} backdrop-blur-xl {{ 'selection:bg-' . $preferences['color_2'] . '-50' }} {{ 'selection:text-' . $preferences['color_2'] . '-500' }} rounded-lg overflow-clip">
            <div x-data="{ open_leave_join_button: false }" class="flex flex-row space-x-1 space-y-0 justify-center items-center">
                <h1 class="w-fit max-w-full p-2 text-nowrap text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-semibold overflow-x-auto">{{ $fandom->name }}</h1>
                @auth
                    @livewire(FandomJoinLeaveButton::class, ['fandom' => $fandom->slug, 'user' => Auth::user()->username, 'preferences' => $preferences])
                @endauth
            </div>
            <div class="w-fit max-w-full h-fit max-h-40 mx-auto p-2 text-left overflow-clip overflow-y-auto">
                <p>{{ $fandom->description }}</p>
            </div>
        </div>
    </div>
</div>