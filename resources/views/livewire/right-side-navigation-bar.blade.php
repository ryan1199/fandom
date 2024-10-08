<div x-data="{ open_right_side_navigation_bar: @entangle('open_component').live }" x-cloak x-show="open_right_side_navigation_bar" x-transition class="w-full max-w-md h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50/70' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-l-lg select-none overflow-y-auto absolute top-0 right-0 z-20">
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2">
        @auth
            <div class="flex flex-col space-x-0 space-y-2">
                <div class="w-full h-fit p-2 flex flex-row space-x-2 space-y-0 justify-between items-center {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                    <p>Chats</p>
                    <svg x-on:click="open_right_side_navigation_bar = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                        <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </div>
                @livewire(Chat::class, ['user' => $user->username, 'preferences' => $preferences], key('chat-from-right-side-navigation-bar-on-user-' . $user->id))
                <p class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">Discusses</p>
                @foreach ($user->members as $member)
                    @livewire(FandomListRightSideNavigationBar::class, ['fandom' => $member->fandom->slug, 'member' => $member->id, 'user' => $user->username, 'preferences' => $preferences], key('fandom-list-fandom-' . $member->fandom->id . '-from-right-side-navigation-bar-on-user-' . $user->id))
                @endforeach
            </div>
        @endauth
    </div>
</div>
