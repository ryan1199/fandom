<div class="w-screen h-screen max-w-sm md:max-w-lg max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center">
    <livewire:alert/>
    <div class="w-full h-fit max-h-[calc(100%-48px)] overflow-clip">
        <div class="w-full h-fit p-2 bg-gray-50/90 backdrop-blur-sm border-0 border-transparent rounded-lg">
            <div wire:scroll class="w-full h-full max-h-[calc(100vh-96px)] pr-1 font-mono overflow-y-auto overflow-x-clip">
                <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-black border-0 border-transparent rounded-lg">
                    <div class="bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500">
                        <img src="{{ asset('verification_cover.svg') }}" alt="Verification image" title="Verification image" class="w-full h-full max-h-[30vh] object-cover block">
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
                    <form wire:submit="sendEmailVerification" method="post" class="w-full h-fit p-0 bg-white border border-black rounded-lg">
                        @csrf
                        <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 justify-center">
                            <label for="email" class="flex flex-col sm:flex-row space-x-0 space-y-2 sm:space-x-2 space- sm:space-y-0 justify-between items-stretch sm:items-center">
                                <span class="basis-2/12 text-black text-base font-medium text-left">Email</span>
                                <input wire:model="email" type="email" id="email" class="form-input basis-8/12 md:basis-9/12 border @error('email') invalid @else valid @enderror rounded-lg">
                            </label>
                            <button type="submit" class="w-full h-fit self-center p-2 text-base text-black bg-white border border-black rounded-lg">Verification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-nav/>
</div>