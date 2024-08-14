<div class="w-full max-w-[calc(100vw-24rem)] h-full max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} overflow-y-auto">
    <div class="w-full h-full p-2 flex flex-col justify-center items-center">
        <div class="w-full max-w-md h-fit p-2 flex flex-col space-x-0 space-y-2 shadow-lg {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
            <div class="w-fit {{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                  Resend verification
                </span>
            </div>
            @if ($errors->any())
                <div class="w-full h-full p-2 flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }}">
                    <p class="font-semibold">Errors:</p>
                    <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} list-disc list-outside">
                        @foreach ($errors->all() as $error)
                            <li wire:key="{{ 'error' . $loop->index }}">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form wire:submit="sendEmailVerification" method="post">
                @csrf
                <div class="w-full h-fit flex flex-col space-x-0 space-y-2 justify-center">
                    <label for="email" class="flex flex-col space-x-0 space-y-2">
                        <span class="font-medium text-left select-none">Email</span>
                        <input wire:model="email" type="email" id="email" class="form-input border @error('email') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-' . $preferences['color_2'] . '-500' }} {{ 'caret-' . $preferences['color_2'] . '-500' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} animation rounded-lg" required>
                    </label>
                    <button type="submit" class="w-fit h-fit p-2 self-end font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg select-none animation-button hover:-translate-x-2">Verification</button>
                </div>
            </form>
        </div>
    </div>
</div>