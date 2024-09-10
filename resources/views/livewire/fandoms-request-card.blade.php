<div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-4 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
    <div>Requested by {{ $request_by }}</div>
    <div class="{{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-semibold leading-loose">{{ $request->title }}</div>
    <div class="leading-loose">{{ $request->description }}</div>
    <div class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center">
        <div class="w-4 h-4 bg-red-700 p-2"></div>
        <div>No</div>
    </div>
    <div class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center">
        <div class="w-4 h-4 bg-blue-700 p-2"></div>
        <div>Yes</div>
    </div>
    <div class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center">
        <div class="w-4 h-4 bg-gray-700 p-2"></div>
        <div>Undecided</div>
    </div>
    <div class="w-full h-fit flex flex-row justify-between">
        <div class="{{ 'w-[' . $voted_no_percentage . '%]' }} h-4 bg-red-700" title="No: {{ $voted_no }}"></div>
        <div class="{{ 'w-[' . $unvoted_percentage . '%]' }} h-4 bg-gray-700" title="Undecided: {{ $unvoted }}"></div>
        <div class="{{ 'w-[' . $voted_yes_percentage . '%]' }} h-4 bg-blue-700" title="Yes: {{ $voted_yes }}"></div>
    </div>
    @auth
        @if ($request->status == 'open')
            <div class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-between items-center">
                <div wire:click="voteNo" class="w-fit h-fit p-2 font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none animation-button cursor-pointer">No</div>
                <div wire:click="voteYes" class="w-fit h-fit p-2 font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none animation-button cursor-pointer">Yes</div>
            </div>
        @endif
        @if ($voted != null)
            @if ($voted->agree)
                <div class="font-semibold">You vote yes</div>
            @else
                <div class="font-semibold">You vote no</div>
            @endif
        @endif
    @endauth
</div>