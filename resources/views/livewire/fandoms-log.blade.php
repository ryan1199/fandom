<div class="w-full h-fit flex flex-col space-x-0 space-y-4">
    @foreach ($logs as $log)
        <div wire:key="{{ 'fandoms-log-' . $log->id }}" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
            <div>
                {{ $log->message }}
            </div>
            <div class="w-full h-fit flex flex-row space-x-2 space-y-0">
                <div class="text-pretty">
                    {{ $log->created_at->toDateString() }}
                </div>
                <div>/</div>
                <div>
                    {{ $log->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    @endforeach
    @if ($logs->hasPages())
        <div>{{ $logs->links('vendor.livewire.simple-tailwind' ,['preferences' => $preferences]) }}</div>
    @endif
</div>
