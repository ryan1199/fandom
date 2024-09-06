<div class="w-full h-fit grid grid-cols-2 gap-2">
    <div class="w-full h-fit mb-1 p-2 flex flex-col space-x-0 space-y-1 items-center border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
        <div class="w-full flex flex-row justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10 {{ 'text-' . $preferences['color_2'] . '-900' }}">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
            </svg>
            <p class="w-fit {{ 'text-' . $preferences['color_2'] . '-900' }} text-center tracking-tighter">
                {{ $totalFollower }}
            </p>
        </div>
        <p class="font-semibold {{ 'text-' . $preferences['color_2'] . '-900' }}">Followed</p>
    </div>
    <div class="w-full h-fit mb-1 p-2 break-inside-avoid-column flex flex-col space-x-0 space-y-1 items-center border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
        <div class="w-full flex flex-row justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10 {{ 'text-' . $preferences['color_2'] . '-900' }}">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
            </svg>
            <p class="w-fit {{ 'text-' . $preferences['color_2'] . '-900' }} text-center tracking-tighter">
                {{ $totalFollowing }}
            </p>
        </div>
        <p class="font-semibold {{ 'text-' . $preferences['color_2'] . '-900' }}">Following</p>
    </div>
</div>