<div class="w-screen h-screen max-w-lg mx-auto {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-[' . $preferences['color_text'] . ']' }} relative z-0 overflow-clip">
    <div class="w-full h-fit absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
        <div class="max-h-screen p-2 overflow-x-clip overflow-y-auto flex flex-col space-x-0 space-y-2 relative">
            <div class="sticky top-0 z-10 select-none">
                <x-nav :preferences="$preferences" />
            </div>
            <div class="fixed mx-auto inset-x-4 top-20 z-10 select-none">
                <livewire:alert :preferences="$preferences" />
            </div>
            <div class="w-full h-fit p-2 {{ 'bg-[' . $preferences['color_primary'] . ']/10' }} backdrop-blur-sm border-0 rounded-lg">
                <div class="w-full h-full">
                    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 rounded-lg">
                        <div class="bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} rounded-lg select-none">
                            <div style="background-image: url('{{ asset('verification-cover-black.svg') }}')" class="w-full h-20 bg-repeat bg-center rounded-lg"></div>
                        </div>
                        @if ($errors->any())
                            <div class="w-full h-full p-2 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border border-red-500 rounded-lg">
                                <ul class="list-inside list-disc flex flex-col space-x-0 space-y-2 text-red-500">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form wire:submit="sendEmailVerification" method="post" class="w-full h-fit p-0 {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                            @csrf
                            <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center">
                                <label for="email" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                                    <span class="basis-2/12 {{ 'text-[' . $preferences['color_text'] . ']' }} font-medium text-left select-none">Email</span>
                                    <input wire:model="email" type="email" id="email" class="form-input basis-8/12 md:basis-9/12 border @error('email') invalid @else valid @enderror rounded-lg" required>
                                </label>
                                <button type="submit" class="w-full h-fit self-center p-2 {{ 'text-[' . $preferences['color_text'] . ']' }} {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg select-none transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Verification</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>