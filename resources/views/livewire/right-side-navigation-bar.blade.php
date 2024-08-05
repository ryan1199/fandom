<div x-data="{ open_component: @entangle('open_component').live }" x-cloak x-show="open_component" x-transition class="w-full max-w-md h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50/80' }} backdrop-blur-xl border-l-2 {{ 'border-' . $preferences['color_2'] . '-900' }} border-dashed shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} select-none overflow-y-auto absolute top-0 right-0 z-20">
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-1">
        @auth
            <div class="flex flex-col space-x-0 space-y-1">
                <div class="flex flex-row justify-between items-center">
                    <p>Chats</p>
                    <svg x-on:click="open_component = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                        <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </div>
                @livewire(Chat::class, ['user' => $user->username, 'preferences' => $preferences])
                <p>Discusses</p>
                @foreach ($user->members as $member)
                    @livewire(FandomListRightSideNavigationBar::class, ['fandom' => $member->fandom->slug, 'member' => $member->id, 'user' => $user->username, 'preferences' => $preferences], key('fandom-list-right-side-navigation-bar-' . $member->fandom->id))
                @endforeach
            </div>
        @endauth
    </div>
</div>
