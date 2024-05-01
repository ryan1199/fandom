<div x-data="{ open: @entangle('open').live }" x-cloak x-show="open" x-transition class="w-fit h-fit p-0 mx-auto border-0 rounded-lg z-10">
    <div class="w-fit h-fit p-1 bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500 border-0 rounded-lg">
        <div class="w-fit h-fit p-4 flex flex-row space-x-4 space-y-0 justify-start items-center bg-white backdrop-blur-sm border-0 rounded-lg">
            <p class="@if($type == 'success') text-green-500 @elseif($type == 'error') text-red-500 @else text-black @endif font-semibold">{{ $message }}</p>
            <button class="w-fit h-full" @click="open = !open">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-white bg-black border-0 rounded-lg">
                    <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</div>