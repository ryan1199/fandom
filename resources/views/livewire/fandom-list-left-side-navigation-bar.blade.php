<div x-data="{ {{ 'open_fandom_' . $fandom->id }}: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
    <div class="flex flex-row justify-between items-center">
        <a wire:navigate href="{{ route('fandom-details', $fandom) }}" class="w-fit" draggable="false">{{ $fandom->name }}</a>
        <svg x-cloak x-show="!{{ 'open_fandom_' . $fandom->id }}" x-on:click="{{ 'open_fandom_' . $fandom->id }} = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-900' }} cursor-pointer">
            <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
        </svg>
        <svg x-cloak x-show="{{ 'open_fandom_' . $fandom->id }}" x-on:click="{{ 'open_fandom_' . $fandom->id }} = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-500' }} cursor-pointer">
            <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
        </svg>
    </div>
    <div x-transition x-cloak x-show="{{ 'open_fandom_' . $fandom->id }}" class="pl-1 flex flex-col space-x-0 space-y-2">
        @if ($member->role->name == 'Manager')
            <div x-data="{ {{ 'open_setting_fandom_' . $fandom->id }}: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="flex flex-row justify-between items-center">
                    <p>Setting</p>
                    <svg x-cloak x-show="!{{ 'open_setting_fandom_' . $fandom->id }}" x-on:click="{{ 'open_setting_fandom_' . $fandom->id }} = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-900' }} cursor-pointer">
                        <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                    </svg>
                    <svg x-cloak x-show="{{ 'open_setting_fandom_' . $fandom->id }}" x-on:click="{{ 'open_setting_fandom_' . $fandom->id }} = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-500' }} cursor-pointer">
                        <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div x-transition x-cloak x-show="{{ 'open_setting_fandom_' . $fandom->id }}">
                    @livewire(FandomSetting::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key( 'user-' . $user->id . '-fandom-setting-for-fandom-' . $fandom->id))
                </div>
            </div>
        @endif
        <div x-data="{ {{ 'open_discusses_fandom_' . $fandom->id }}: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
            <div class="flex flex-row justify-between items-center">
                <p>Discusses</p>
                <svg x-cloak x-show="!{{ 'open_discusses_fandom_' . $fandom->id }}" x-on:click="{{ 'open_discusses_fandom_' . $fandom->id }} = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-900' }} cursor-pointer">
                    <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                </svg>
                <svg x-cloak x-show="{{ 'open_discusses_fandom_' . $fandom->id }}" x-on:click="{{ 'open_discusses_fandom_' . $fandom->id }} = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-500' }} cursor-pointer">
                    <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                </svg>
            </div>
            <div x-transition x-cloak x-show="{{ 'open_discusses_fandom_' . $fandom->id }}" class="flex flex-col space-x-0 space-y-2">
                @if ($discusses->isNotEmpty())
                    <div class="flex flex-col space-x-0 space-y-2">
                        @foreach ($discusses as $discuss)
                            @switch($discuss->visible)
                                @case('manager')
                                    @if ($member->role->name == 'Manager')
                                        <div wire:key="{{ 'user-' . $user->id . '-fandom-' . $fandom->id . '-discuss-' . $discuss->id }}" class="w-full h-fit p-2 flex flex-row space-x-2 space-y-0 justify-between items-start {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none">
                                            <p class="font-semibold self-center line-clamp-3">{{ $discuss->name }}</p>
                                            <p wire:click="discussTo({{ $discuss->id }})" class="w-fit h-full p-2 font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">Discuss</p>
                                        </div>
                                    @endif
                                    @break
                                @case('member')
                                    @if ($member->role->name == 'Manager' || $member->role->name == 'Member')
                                        <div wire:key="{{ 'user-' . $user->id . '-fandom-' . $fandom->id . '-discuss-' . $discuss->id }}" class="w-full h-fit p-2 flex flex-row space-x-2 space-y-0 justify-between items-start {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none">
                                            <p class="font-semibold self-center line-clamp-3">{{ $discuss->name }}</p>
                                            <p wire:click="discussTo({{ $discuss->id }})" class="w-fit h-full p-2 font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">Discuss</p>
                                        </div>
                                    @endif
                                    @break
                                @default
                                    <div wire:key="{{ 'user-' . $user->id . '-fandom-' . $fandom->id . '-discuss-' . $discuss->id }}" class="w-full h-fit p-2 flex flex-row space-x-2 space-y-0 justify-between items-start {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none">
                                        <p class="font-semibold self-center line-clamp-3">{{ $discuss->name }}</p>
                                        <p wire:click="discussTo({{ $discuss->id }})" class="w-fit h-full p-2 font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">Discuss</p>
                                    </div>
                            @endswitch
                        @endforeach
                    </div>
                @endif
                @if ($member->role->name == 'Manager')
                    <div x-data="{ {{ 'open_create_discuss_fandom_' . $fandom->id }}: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                        <div class="flex flex-row justify-between items-center">
                            <p>Create a discuss</p>
                            <svg x-cloak x-show="!{{ 'open_create_discuss_fandom_' . $fandom->id }}" x-on:click="{{ 'open_create_discuss_fandom_' . $fandom->id }} = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-900' }} cursor-pointer">
                                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                            </svg>
                            <svg x-cloak x-show="{{ 'open_create_discuss_fandom_' . $fandom->id }}" x-on:click="{{ 'open_create_discuss_fandom_' . $fandom->id }} = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-500' }} cursor-pointer">
                                <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div x-transition x-cloak x-show="{{ 'open_create_discuss_fandom_' . $fandom->id }}">
                            @livewire(DiscussCreate::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key('user-' . $user->id . '-discuss-create-for-fandom-' . $fandom->id))
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>