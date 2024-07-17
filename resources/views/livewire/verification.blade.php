<div class="w-full h-full max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500 bg-zinc-100 overflow-y-auto">
    <div class="w-full h-full p-2 flex flex-col justify-center items-center">
        <div class="w-full max-w-md h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg">
            <div class="bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} rounded-lg select-none">
                <div style="background-image: url('{{ asset('verification-cover-white.svg') }}')" class="w-full h-20 bg-repeat bg-center border border-zinc-200 rounded-lg"></div>
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
            <form wire:submit="sendEmailVerification" method="post">
                @csrf
                <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center bg-zinc-50 border border-zinc-200">
                    <label for="email" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                        <span class="basis-2/12 font-medium text-left select-none">Email</span>
                        <input wire:model="email" type="email" id="email" class="form-input basis-8/12 md:basis-9/12 border @error('email') border-red-500 @else border-zinc-200 @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'focus:border-[' . $preferences['color_2'] . ']' }} rounded-lg" required>
                    </label>
                    <button type="submit" class="w-full h-fit self-center p-2 bg-zinc-50 border border-zinc-200 rounded-lg select-none transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Verification</button>
                </div>
            </form>
        </div>
    </div>
</div>