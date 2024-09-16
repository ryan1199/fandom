<div class="w-full h-fit flex flex-col space-x-0 space-y-4">
    @foreach ($logs as $log)
        <div wire:key="{{ 'fandoms-log-' . $log->id }}" class="w-full h-fit leading-loose tracking-widest shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
            <div class="w-full h-fit p-2 flex flex-row space-x-2 space-y-0 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                </svg>
                <div class="w-full h-fit flex flex-row space-x-2 space-y-0 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-semibold">
                    <div class="w-fit h-fit">
                        {{ $log->created_at->toDateString() }}
                    </div>
                    <div class="w-fit h-fit">/</div>
                    <div class="w-fit h-fit">
                        {{ $log->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
            <div class="w-full h-full p-2 rounded-b-lg {{ 'bg-' . $preferences['color_2'] . '-100' }}">{{ $log->message }}</div>
        </div>
    @endforeach
    @if ($logs->hasPages())
        <div>{{ $logs->links('vendor.livewire.simple-tailwind' ,['preferences' => $preferences]) }}</div>
    @endif
</div>
