<form wire:submit="submitComment()">
    @csrf
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 items-stretch justify-stretch {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 rounded-lg z-10">
        <textarea wire:model="content" class="w-full h-fit form-textarea {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg" rows="5" cols="100"></textarea>
        @error('content')
            <div class="w-full h-fit text-red-500">{{ $message }}</div>
        @enderror
        <button type="submit" class="w-fit h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">Submit</button>
    </div>
</form>