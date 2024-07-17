<div class="w-full h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500 select-none overflow-clip">
    <div class="w-full h-screen max-h-[100vh] p-2 bg-zinc-100/95 overflow-clip">
        <div class="w-full max-w-md h-screen max-h-[100vh] mx-auto flex flex-col space-x-0 space-y-2 justify-center items-center overflow-y-auto">
            <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg">
                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }}">
                      Fandom Create
                    </span>
                </div>
                <div class="bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} rounded-lg select-none">
                    <div style="background-image: url('{{ asset('new-fandom-cover-white.svg') }}')" class="w-full h-20 bg-repeat bg-center border border-zinc-200 rounded-lg"></div>
                </div>
                <div class="h-[30vh] relative select-none">
                    @if ($cover)
                        <img src="{{ $cover->temporaryUrl() }}" alt="Cover image" title="Cover image" class="w-full h-[30vh] object-cover block border border-zinc-200 rounded-lg" draggable="false">
                    @else
                        <div class="w-full h-full bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border border-zinc-200 rounded-lg">
                            <div style="background-image: url('{{ asset('cover-white.svg') }}')" class="w-full h-[30vh] bg-repeat bg-center rounded-lg"></div>
                        </div>
                    @endif
                    @if ($avatar)
                        <img src="{{ $avatar->temporaryUrl() }}" alt="Avatar image" title="Avatar image" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-full max-h-[15vh] aspect-square object-cover border-0 rounded-full" draggable="false">
                    @else
                        <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-full max-h-[15vh] aspect-square bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} rounded-full">
                            <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                        </div>
                    @endif
                </div>
                @if ($errors->any())
                    <div class="w-full h-full p-2 flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} bg-zinc-50 border border-zinc-200 rounded-lg">
                        <p class="font-semibold">Errors:</p>
                        <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} text-rose-500 list-disc list-outside">
                            @foreach ($errors->all() as $error)
                                <li wire:key="{{ 'error' . $loop->index }}">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form wire:submit="createFandom">
                    @csrf
                    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center bg-zinc-50 border border-zinc-200 rounded-lg">
                        <label for="cover" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                            <span class="basis-5/12 font-medium text-left select-none">Cover</span>
                            <input wire:model="cover" name="cover" type="file" id="cover" class="w-full form-input file:text-zinc-50 file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr {{ 'file:from-[' . $preferences['color_1'] . ']' }} {{ 'file:via-[' . $preferences['color_2'] . ']' }} {{ 'file:to-[' . $preferences['color_3'] . ']' }} file:border file:border-zinc-200 file:rounded-lg border @error('cover') border-rose-500 @else border-zinc-200 @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg cursor-pointer file:cursor-pointer file:transition-all file:duration-100 hover:file:opacity-50 file:active:duration-75 file:active:scale-[.95]" required>
                        </label>
                        <label for="avatar" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                            <span class="basis-5/12 font-medium text-left select-none">Avatar</span>
                            <input wire:model="avatar" name="avatar" type="file" id="avatar" class="w-full form-input file:text-zinc-50 file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr {{ 'file:from-[' . $preferences['color_1'] . ']' }} {{ 'file:via-[' . $preferences['color_2'] . ']' }} {{ 'file:to-[' . $preferences['color_3'] . ']' }} file:border file:border-zinc-200 file:rounded-lg border @error('cover') border-rose-500 @else border-zinc-200 @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg cursor-pointer file:cursor-pointer file:transition-all file:duration-100 hover:file:opacity-50 file:active:duration-75 file:active:scale-[.95]" required>
                        </label>
                        <label for="name" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                            <span class="basis-5/12 font-medium text-left select-none">Name</span>
                            <input wire:model="name" type="text" id="name" placeholder="The name of fandom" class="w-full form-input border @error('status') border-rose-500 @else border-zinc-200 @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg" required>
                        </label>
                        <label for="description" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                            <span class="basis-5/12 font-medium text-left select-none">Description</span>
                            <textarea wire:model="description" name="description" id="description" cols="30" rows="5" class="w-full h-fit form-textarea border @error('description') border-rose-500 @else border-zinc-200 @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg" required></textarea>
                        </label>
                        <button type="submit" class="w-full h-fit self-center p-2 bg-zinc-50 border border-zinc-200 rounded-lg select-none transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Create fandom</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>