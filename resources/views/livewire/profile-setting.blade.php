<div x-cloak x-show="profile_modal" class="w-full h-fit mb-2 p-2 flex flex-col space-x-0 space-y-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] border-0 border-transparent rounded-lg">
    @if ($errors->any())
        <div class="w-full h-full p-2 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-red-500 rounded-lg">
            <ul class="list-inside list-disc flex flex-col space-x-0 space-y-2 text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] . 'px' }}] text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form wire:submit class="w-full h-fit p-0 bg-[{{ session()->get(Auth::user()->username . '-preference')['color_primary'] }}] border border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] rounded-lg">
        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center">
            <label for="cover" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <span class="basis-2/12 font-medium text-left">Cover</span>
                <input wire:model.blur="cover" name="cover" type="file" id="cover" class="w-full form-input file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr file:from-[{{ session()->get(Auth::user()->username . '-preference')['color_1'] }}] file:via-[{{ session()->get(Auth::user()->username . '-preference')['color_2'] }}] file:to-[{{ session()->get(Auth::user()->username . '-preference')['color_3'] }}] file:border file:border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] file:rounded-lg border @error('cover') invalid @else valid @enderror rounded-lg">
            </label>
            <label for="avatar" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <span class="basis-2/12 font-medium text-left">Avatar</span>
                <input wire:model.blur="avatar" name="avatar" type="file" id="avatar" class="w-full form-input file:text-center file:align-middle file:p-2 file:bg-gradient-to-tr file:from-[{{ session()->get(Auth::user()->username . '-preference')['color_1'] }}] file:via-[{{ session()->get(Auth::user()->username . '-preference')['color_2'] }}] file:to-[{{ session()->get(Auth::user()->username . '-preference')['color_3'] }}] file:border file:border-[{{ session()->get(Auth::user()->username . '-preference')['color_secondary'] }}] file:rounded-lg border @error('avatar') invalid @else valid @enderror rounded-lg">
            </label>
            <label for="status" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <span class="basis-2/12 font-medium text-left">Status</span>
                <input wire:model.blur="status" type="text" id="status" placeholder="What are you feeling right now ?" class="w-full form-input border @error('status') invalid @else valid @enderror rounded-lg">
            </label>
            <label for="description" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center text-[{{ session()->get(Auth::user()->username . '-preference')['color_text'] }}] text-[{{ session()->get(Auth::user()->username . '-preference')['font_size'] .'px' }}]">
                <span class="basis-2/12 font-medium text-left">Description</span>
                <input wire:model.blur="description" type="text" id="description" placeholder="Describe your self" class="w-full form-input border @error('description') invalid @else valid @enderror rounded-lg">
            </label>
        </div>
    </form>
</div>