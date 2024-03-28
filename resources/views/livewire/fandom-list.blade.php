<div @auth x-data="{ create_fandom_modal: @entangle('create_fandom_modal').live }" @endauth
    class="w-screen h-screen max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center relative z-0">
    <livewire:alert />
    <div class="container h-fit max-h-[calc(100%-48px)] overflow-clip">
        <div class="w-full h-fit relative">
            <div wire:scroll
                class="w-full h-fit max-h-[calc(100vh-96px)] grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 grid-flow-row-dense auto-rows-max auto-cols-max gap-4 overflow-y-auto">
                @foreach ($fandoms as $fandom)
                <div
                    class="w-full h-fit max-h-[calc(100vh-50vh)] p-4 grid grid-cols-1 grid-rows-1 content-stretch overflow-clip bg-[{{ $preferences['color_primary'] }}]/10 backdrop-blur-sm border-0 border-transparent rounded-lg">
                    <div
                        class="w-full h-full p-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg">
                        <div wire:scroll
                            class="w-full h-full max-h-[calc(100vh-50vh)] flex flex-col space-x-0 space-y-2 border-0 border-transparent rounded-lg overflow-y-auto">
                            <div
                                class="w-full h-full max-h-[calc(15vh-8px)] sm:max-h-[calc(10vh-8px)] bg-gradient-to-tr from-[{{ $preferences['color_1'] }}] via-[{{ $preferences['color_2'] }}] to-[{{ $preferences['color_3'] }}] relative rounded-lg">
                                @if ($fandom->cover !== null)
                                <img src="{{ asset('storage/covers/'.$fandom->cover->image->url) }}"
                                    alt="Cover image {{ $fandom->name }}" title="Cover image {{ $fandom->name }}"
                                    class="w-full h-full object-cover block rounded-lg">
                                @else
                                <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image"
                                    class="w-full h-full max-h-[30vh] object-cover block rounded-lg">
                                @endif
                                @if ($fandom->avatar !== null)
                                <img src="{{ asset('storage/avatars/'.$fandom->avatar->image->url) }}"
                                    alt="Avatar image {{ $fandom->name }}" title="Avatar image {{ $fandom->name }}"
                                    class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-full max-h-[90%] aspect-square object-cover border-0 border-transparent rounded-full">
                                @else
                                <div
                                    class="absolute top-0 bottom-0 right-0 left-0 m-auto w-40 h-40 bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-full">
                                </div>
                                @endif
                            </div>
                            <div
                                class="w-full h-full p-2 flex flex-row space-x-2 space-y-0 text-[{{ $preferences['color_text'] }}] text-center bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
                                <div class="w-full h-full">
                                    <div class="w-fit h-fit">
                                        <h1
                                            class="w-fit text-[{{ $preferences['color_text'] }}] text-center text-[calc({{'4px+' . $preferences['font_size'] . 'px' }})] font-semibold">
                                            {{ $fandom->name }}</h1>
                                        <p
                                            class="text-[{{ $preferences['color_text'] }}] text-[calc({{$preferences['font_size'] . 'px'}})]">
                                            {{ $fandom->description }}</p>
                                    </div>
                                </div>
                                <a wire:navigate.hover href="{{ route('fandom-details', $fandom) }}"
                                    class="w-fit h-full py-2 flex flex-col space-x-0 space-y-1 justify-center items-center border-2 border-[{{ $preferences['color_secondary'] }}] rounded-lg cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-4 h-4 bg-[{{ $preferences['color_primary'] }}]">
                                        <path fill-rule="evenodd"
                                            d="M11.47 2.47a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06l-6.22-6.22V21a.75.75 0 0 1-1.5 0V4.81l-6.22 6.22a.75.75 0 1 1-1.06-1.06l7.5-7.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="-rotate-90">SEE</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @auth
                <div
                    class="w-full h-fit max-h-[calc(100vh-50vh)] p-4 flex flex-col space-x-0 space-y-2 overflow-clip bg-[{{ $preferences['color_primary'] }}]/10 backdrop-blur-sm border-0 border-transparent rounded-lg">
                    <div
                        class="w-full h-fit p-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg">
                        <div wire:scroll class="w-full h-full max-h-[calc(100vh-50vh)] overflow-y-auto">
                            <div
                                class="w-full h-fit p-2 flex flex-row space-x-2 space-y-0 text-[{{ $preferences['color_text'] }}] text-center bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
                                <div class="w-full h-full flex flex-col justify-between items-center">
                                    <div
                                        class="w-full h-full flex flex-row space-x-2 space-y-0 justify-center items-center">
                                        <h1
                                            class="w-full text-[{{ $preferences['color_text'] }}] text-center text-[calc({{'4px+' . $preferences['font_size'] . 'px' }})]">
                                            Don't see what you are looking for ?</h1>
                                    </div>
                                    <div x-on:click="create_fandom_modal = true"
                                        class="w-full h-full p-2 flex flex-row space-x-2 space-y-0 justify-center items-center border-2 border-[{{ $preferences['color_secondary'] }}] rounded-lg cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                                        <p class="">Create</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6 bg-[{{ $preferences['color_primary'] }}]">
                                            <path fill-rule="evenodd"
                                                d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
    @auth
    <div wire:ignore x-cloak x-show="create_fandom_modal" x-transition.duration.500ms.scale.origin id="createFandom"
        class="w-10/12 md:w-1/2 h-fit max-h-[calc(100vh-96px)] p-4 bg-[{{ $preferences['color_primary'] }}]/10 backdrop-blur-sm overflow-clip border-0 border-transparent rounded-lg absolute z-10"
        :style="{ left: {{ $create_fandom_modal_position['left'] }}+'px', right: {{ $create_fandom_modal_position['right'] }}+'px',top: {{ $create_fandom_modal_position['top'] }}+'px' ,bottom: {{ $create_fandom_modal_position['bottom'] }}+'px' }">
        {{-- create fandom --}}
        <div wire:scroll
            class="w-full h-fit max-h-[calc(100vh-96px)] pr-1 flex flex-col space-x-0 space-y-2 overflow-y-auto overflow-x-clip">
            <div
                class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg">
                <div
                    class="w-full h-fit flex flex-row justify-between items-center text-[{{ $preferences['color_text'] }}] text-center bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
                    <div id="createFandomHeader" class="w-full p-2 cursor-move">
                        <h1
                            class="w-full text-[{{ $preferences['color_text'] }}] text-center text-[calc({{'4px+' . $preferences['font_size'] . 'px' }})]">
                            Create Fandom</h1>
                    </div>
                    <div class="p-2">
                        <svg x-on:click="create_fandom_modal = false" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 h-6 bg-[{{ $preferences['color_primary'] }}] cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                            <path fill-rule="evenodd"
                                d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div
                    class="w-full h-fit flex flex-row space-x-2 space-y-0 text-[{{ $preferences['color_text'] }}] text-center border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
                    <livewire:fandom-create />
                </div>
            </div>
        </div>
    </div>
    @endauth
    <x-nav :preferences="$preferences" />
</div>
@script
<script>
    let createFandom = document.getElementById('createFandom');
    let createFandomHeader = document.getElementById('createFandomHeader');
    let posX = 0,
        posY = 0,
        mouseX = 0,
        mouseY = 0,
        left_position = 0,
        right_position = 0,
        top_position = 0,
        bottom_position = 0;
    
    createFandomHeader.addEventListener('mousedown', mouseDown, false);
    createFandom.addEventListener('mouseup', mouseUp, false);
    
    function mouseDown(e)
    {
        e.preventDefault();
        posX = e.clientX - createFandom.offsetLeft;
        posY = e.clientY - createFandom.offsetTop;
        document.addEventListener('mousemove', moveElement, false);
    }
    
    function mouseUp()
    {
        document.removeEventListener('mousemove', moveElement, false);
        $wire.dispatch('save_create_fandom_modal_position', [{ 'left': left_position, 'right': right_position, 'top': top_position, 'bottom': bottom_position }]);
    }
    
    function moveElement(e)
    {
        mouseX = e.clientX - posX;
        mouseY = e.clientY - posY;
        if(mouseX >= 0 && window.innerWidth - mouseX - createFandom.offsetWidth >= 0)
        {
            left_position = mouseX;
            right_position = window.innerWidth - left_position - createFandom.offsetWidth;
            createFandom.style.left = left_position + 'px';
            createFandom.style.right = right_position + 'px';
        }
        if(mouseY >= 0 && window.innerHeight - mouseY - createFandom.offsetHeight >= 0)
        {
            top_position = mouseY;
            bottom_position = window.innerHeight - top_position - createFandom.offsetHeight;
            createFandom.style.top = top_position + 'px';
            createFandom.style.bottom = bottom_position + 'px';
        }
    }
</script>
@endscript