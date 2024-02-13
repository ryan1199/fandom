<div class="w-full h-fit flex flex-col space-x-0 space-y-2 border-0 border-transparent rounded-lg">
    <div class="bg-gradient-to-tr from-[{{ session()->get('preference-' . Auth::user()->username)['color_1'] }}] via-[{{ session()->get('preference-' . Auth::user()->username)['color_2'] }}] to-[{{ session()->get('preference-' . Auth::user()->username)['color_3'] }}] rounded-lg select-none">
        <div style="background-image: url('{{ asset('new-fandom-cover-black.svg') }}')" class="w-full h-20 bg-repeat bg-center rounded-lg"></div>
    </div>
    <div class="max-h-[calc(15vh-8px)] bg-gradient-to-tr from-[{{ session()->get('preference-' . Auth::user()->username)['color_1'] }}] via-[{{ session()->get('preference-' . Auth::user()->username)['color_2'] }}] to-[{{ session()->get('preference-' . Auth::user()->username)['color_3'] }}] relative rounded-lg select-none">
        @if ($cover)
            <img src="{{ $cover->temporaryUrl() }}" alt="Cover image" title="Cover image" class="w-full h-[calc(15vh-8px)] object-cover block rounded-lg">
        @else
            <div style="background-image: url('{{ asset('cover-black.svg') }}')" class="w-full h-[calc(15vh-8px)] bg-repeat bg-center rounded-lg"></div>
        @endif
        @if ($avatar)
            <img src="{{ $avatar->temporaryUrl() }}" alt="Avatar image" title="Avatar image" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-full max-h-[90%] aspect-square object-cover border-0 border-transparent rounded-full">
        @else
            <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-full max-h-[90%] aspect-square bg-gradient-to-tr from-[{{ session()->get('preference-' . Auth::user()->username)['color_1'] }}] via-[{{ session()->get('preference-' . Auth::user()->username)['color_2'] }}] to-[{{ session()->get('preference-' . Auth::user()->username)['color_3'] }}] rounded-full">
                <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
            </div>
        @endif
    </div>
    @if ($errors->any())
        <div class="w-full h-full p-2 bg-[{{ session()->get('preference-' . Auth::user()->username)['color_primary'] }}] border border-red-500 rounded-lg">
            <ul class="list-inside list-disc text-left flex flex-col space-x-0 space-y-2 text-[{{ session()->get('preference-' . Auth::user()->username)['font_size'] . 'px' }}] text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form wire:submit="createFandom" class="w-full h-fit p-0 bg-[{{ session()->get('preference-' . Auth::user()->username)['color_primary'] }}] border border-[{{ session()->get('preference-' . Auth::user()->username)['color_secondary'] }}] rounded-lg">
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center">
            <label for="cover" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get('preference-' . Auth::user()->username)['color_text'] }}] text-[{{ session()->get('preference-' . Auth::user()->username)['font_size'] .'px' }}]">
                <span class="basis-4/12 font-medium text-left select-none">Fandom's cover</span>
                <input wire:model="cover" name="cover" type="file" id="cover" class="w-full form-input file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr file:from-[{{ session()->get('preference-' . Auth::user()->username)['color_1'] }}] file:via-[{{ session()->get('preference-' . Auth::user()->username)['color_2'] }}] file:to-[{{ session()->get('preference-' . Auth::user()->username)['color_3'] }}] file:border file:border-[{{ session()->get('preference-' . Auth::user()->username)['color_secondary'] }}] file:rounded-lg border @error('cover') invalid @else valid @enderror rounded-lg cursor-pointer file:cursor-pointer file:transition-all file:duration-100 hover:file:opacity-50 file:active:duration-75 file:active:scale-[.95]" required>
            </label>
            <label for="avatar" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get('preference-' . Auth::user()->username)['color_text'] }}] text-[{{ session()->get('preference-' . Auth::user()->username)['font_size'] .'px' }}]">
                <span class="basis-4/12 font-medium text-left select-none">Fandom's avatar</span>
                <input wire:model="avatar" name="avatar" type="file" id="avatar" class="w-full form-input file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr file:from-[{{ session()->get('preference-' . Auth::user()->username)['color_1'] }}] file:via-[{{ session()->get('preference-' . Auth::user()->username)['color_2'] }}] file:to-[{{ session()->get('preference-' . Auth::user()->username)['color_3'] }}] file:border file:border-[{{ session()->get('preference-' . Auth::user()->username)['color_secondary'] }}] file:rounded-lg border @error('avatar') invalid @else valid @enderror rounded-lg cursor-pointer file:cursor-pointer file:transition-all file:duration-100 hover:file:opacity-50 file:active:duration-75 file:active:scale-[.95]" required>
            </label>
            <label for="name" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get('preference-' . Auth::user()->username)['color_text'] }}] text-[{{ session()->get('preference-' . Auth::user()->username)['font_size'] .'px' }}]">
                <span class="basis-4/12 font-medium text-left select-none">Fandom's name</span>
                <input wire:model="name" type="text" id="name" placeholder="Fandom's name" class="w-full form-input border @error('name') invalid @else valid @enderror rounded-lg" required>
            </label>
            <label for="description" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get('preference-' . Auth::user()->username)['color_text'] }}] text-[{{ session()->get('preference-' . Auth::user()->username)['font_size'] .'px' }}]">
                <span class="basis-4/12 font-medium text-left select-none">Fandom's description</span>
                <textarea wire:model="description" name="description" id="description" cols="30" rows="5" class="w-full h-fit form-textarea border @error('description') invalid @else valid @enderror rounded-lg" required></textarea>
            </label>
            <button type="submit" class="w-full h-fit self-center p-2 text-[{{ session()->get('preference-' . Auth::user()->username)['font_size'] . 'px' }}] text-[{{ session()->get('preference-' . Auth::user()->username)['color_text'] }}] bg-[{{ session()->get('preference-' . Auth::user()->username)['color_primary'] }}] border border-[{{ session()->get('preference-' . Auth::user()->username)['color_secondary'] }}] rounded-lg select-none transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Create fandom</button>
        </div>
    </form>
</div>