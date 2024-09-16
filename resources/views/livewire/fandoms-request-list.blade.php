<div x-data="{ tab: 'open' } " class="w-full h-fit flex flex-col space-x-0 space-y-4">
    <div class="w-full h-fit flex flex-row space-x-4 space-y-0 items-center">
        <div x-on:click="tab = 'open'" :class="tab == 'open' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" class="w-full h-fit p-4 font-semibold text-center {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg cursor-pointer">Open</div>
        <div x-on:click="tab = 'close'" :class="tab == 'close' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" class="w-full h-fit p-4 font-semibold text-center {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg cursor-pointer">Close</div>
    </div>
    <div>
        <div x-cloak x-show="tab == 'open'" class="w-full h-fit flex flex-col space-x-0 space-y-4">
            @forelse ($open_requests as $request)
                @livewire(FandomsRequestCard::class, ['request' => $request->id, 'preferences' => $preferences], key('fandoms-request-card-for-request-' . $request->id . '-' . rand()))
            @empty
                <div class="w-screen max-w-full h-fit py-12 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                    <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        No requests found
                    </div>
                </div>
            @endforelse
        </div>
        <div x-cloak x-show="tab == 'close'" class="w-full h-fit flex flex-col space-x-0 space-y-4">
            @forelse ($close_requests as $request)
                @livewire(FandomsRequestCard::class, ['request' => $request->id, 'preferences' => $preferences], key('fandoms-request-card-for-request-' . $request->id . '-' . rand()))
            @empty
                <div class="w-screen max-w-full h-fit py-12 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                    <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        No requests found
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>