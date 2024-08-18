<div class="w-full h-full {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none overflow-clip">
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-100' }} rounded-lg">
        <div class="w-fit {{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
            <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
              Create a fandom
            </span>
        </div>
        <div class="h-[30vh] relative select-none">
            @if ($cover)
                <img src="{{ $cover->temporaryUrl() }}" alt="Cover image" title="Cover image" class="w-full h-[30vh] object-cover block  rounded-lg" draggable="false">
            @else
                <div class="w-full h-full bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-500' }} {{ 'via-' . $preferences['color_2'] . '-500' }} {{ 'to-' . $preferences['color_3'] . '-500' }} rounded-lg">
                    <div style="background-image: url('{{ asset('cover-white.svg') }}')" class="w-full h-[30vh] bg-repeat bg-center rounded-lg"></div>
                </div>
            @endif
            @if ($avatar)
                <img src="{{ $avatar->temporaryUrl() }}" alt="Avatar image" title="Avatar image" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-full max-h-[15vh] aspect-square object-cover rounded-full" draggable="false">
            @else
                <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-full max-h-[15vh] aspect-square bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-500' }} {{ 'via-' . $preferences['color_2'] . '-500' }} {{ 'to-' . $preferences['color_3'] . '-500' }} rounded-full">
                    <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                </div>
            @endif
        </div>
        <div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
            <p class="font-semibold">Rules:</p>
            <ol class="pl-8 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-decimal list-outside">
                <li>Image maximum size is 10 mb</li>
                <li>Name maximum length is 50 characters</li>
                <li>Description maximum length is 500 characters</li>
            </ol>
        </div>
        @if ($errors->any())
            <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                <p class="font-semibold">Errors:</p>
                <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} list-disc list-outside">
                    @foreach ($errors->all() as $error)
                        <li wire:key="{{ 'fandom-create-error-' . $loop->index }}">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form wire:submit="createFandom">
            @csrf
            <div class="w-full h-fit flex flex-col space-x-0 space-y-2 justify-center">
                <label for="cover" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
                    <span class="font-medium text-left select-none">Cover</span>
                    <input wire:model="cover" name="cover" type="file" id="cover" class="w-full form-input {{ 'bg-' . $preferences['color_2'] . '-50' }} {{ 'file:text-' . $preferences['color_2'] . '-900' }} file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr {{ 'file:from-' . $preferences['color_1'] . '-500' }} {{ 'file:via-' . $preferences['color_2'] . '-500' }} {{ 'file:to-' . $preferences['color_3'] . '-500' }} file:rounded-lg border @error('cover') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer file:cursor-pointer animation animation-button-file" required>
                </label>
                <label for="avatar" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
                    <span class="font-medium text-left select-none">Avatar</span>
                    <input wire:model="avatar" name="avatar" type="file" id="avatar" class="w-full form-input {{ 'bg-' . $preferences['color_2'] . '-50' }} {{ 'file:text-' . $preferences['color_2'] . '-900' }} file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr {{ 'file:from-' . $preferences['color_1'] . '-500' }} {{ 'file:via-' . $preferences['color_2'] . '-500' }} {{ 'file:to-' . $preferences['color_3'] . '-500' }} file:rounded-lg border @error('avatar') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg cursor-pointer file:cursor-pointer animation animation-button-file" required>
                </label>
                <label for="name" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
                    <span class="font-medium text-left select-none">Name</span>
                    <input wire:model="name" type="text" id="name" placeholder="The name of fandom" class="w-full form-textarea {{ 'bg-' . $preferences['color_2'] . '-50' }} border @error('name') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" required>
                </label>
                <label for="description" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
                    <span class="font-medium text-left select-none">Description</span>
                    <textarea wire:model="description" name="description" id="description" placeholder="The description of fandom" cols="30" rows="5" class="w-full form-textarea {{ 'bg-' . $preferences['color_2'] . '-50' }} border @error('description') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" required></textarea>
                </label>
                <button type="submit" class="w-fit h-fit p-2 self-end font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg select-none animation-button">Create fandom</button>
            </div>
        </form>
    </div>
</div>