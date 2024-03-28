<div
    class="w-screen h-screen max-w-sm md:max-w-lg max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center">
    <livewire:alert />
    <div class="w-full h-fit max-h-[calc(100%-64px-16px)] overflow-clip">
        <div class="w-full h-fit p-4 bg-white/10 backdrop-blur-sm border-0 border-transparent rounded-lg">
            <div wire:scroll
                class="w-full h-full max-h-[calc(100vh-64px-48px-16px)] pr-1 font-mono overflow-y-auto overflow-x-clip">
                <div
                    class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-black border-0 border-transparent rounded-lg">
                    <div class="bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500 rounded-lg select-none">
                        <div style="background-image: url('{{ asset('reset-password-cover-black.svg') }}')"
                            class="w-full h-20 bg-repeat bg-center rounded-lg"></div>
                    </div>
                    @if ($errors->any())
                    <div class="w-full h-full p-2 bg-white border border-red-500 rounded-lg">
                        <ul class="list-inside list-disc flex flex-col space-x-0 space-y-2 text-red-500">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form wire:submit="sendEmailForgotPassword" method="post"
                        class="w-full h-fit p-0 bg-white border border-black rounded-lg">
                        @csrf
                        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center">
                            <label for="email"
                                class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                                <span
                                    class="basis-2/12 text-black text-base font-medium text-left select-none">Email</span>
                                <input wire:model="email" type="email" id="email"
                                    class="form-input basis-8/12 md:basis-9/12 border @error('email') invalid @else valid @enderror rounded-lg"
                                    required>
                            </label>
                            <button type="submit"
                                class="w-full h-fit self-center p-2 text-base text-black bg-white border border-black rounded-lg select-none transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">Reset
                                Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-nav :preferences="$preferences" />
</div>