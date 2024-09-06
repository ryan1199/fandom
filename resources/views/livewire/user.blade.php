<div class="w-full h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none overflow-clip">
    <div class="w-full container h-screen max-h-[100vh] mx-auto flex flex-row space-x-2 space-y-0 overflow-clip">
        <div class="w-full max-w-xl h-fit max-h-[100vh] p-2 overflow-y-auto">
            <div class="w-full h-fit mt-14 p-4 flex flex-col space-x-0 space-y-8 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="w-full h-fit flex flex-col space-x-0 space-y-2 break-inside-avoid-column">
                    <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                          Profile
                        </span>
                    </div>
                    @livewire(UsersProfile::class, ['user' => $user->username, 'preferences' => $preferences], key('users-profile'))
                </div>
                @if ($user->id != Auth::id())
                    <div class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-center items-center border-b-2 {{ 'border-' . $preferences['color_2'] . '-900' }} select-none">
                        @livewire(FollowUnfollowButton::class, ['user1' => Auth::user()->username, 'user2' => $user->username, 'preferences' => $preferences], key('user-' . Auth::id() . '-follow-unfollow-button-for-user-' . $user->id))
                        @livewire(BlockUnblockButton::class, ['user1' => Auth::user()->username, 'user2' => $user->username, 'preferences' => $preferences], key('user-' . Auth::id() . '-block-unblock-button-for-user-' . $user->id))
                        <div wire:click="chatTo" class="w-fit h-fit p-2 font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">Chat</div>
                    </div>
                @endif
                <div class="w-full h-fit flex flex-col space-x-0 space-y-1 text-center break-inside-avoid-column">
                    {{-- following and follower --}}
                    @livewire(UsersFollowedFollowing::class, ['user' => $user->username, 'preferences' => $preferences], key('users-followed-and-following'))
                    {{-- fandom --}}
                    @livewire(UsersFandomList::class, ['user' => $user->username, 'preferences' => $preferences], key('users-fandom-list'))
                </div>
                <div class="w-full h-fit flex flex-col space-x-0 space-y-2 break-inside-avoid-column">
                    <div class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-between items-center">
                        <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                            <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                              Posts
                            </span>
                        </div>
                        @if (Auth::id() == $user->id)
                            <a wire:navigate href="{{ route('post-management') }}" draggable="false">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                    </div>
                    @livewire(UsersPostSearch::class, ['user' => $user->username, 'preferences' => $preferences], key('post-search-for-post-list'))
                    @livewire(UsersPostList::class, ['user' => $user->username, 'preferences' => $preferences, 'static' => false], key('post-list'))
                </div>
            </div>
        </div>
        <div class="w-full h-fit max-h-[100vh] p-2 break-inside-avoid-column overflow-y-auto">
            <div class="w-full h-fit mt-14 p-4 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-between items-center">
                    <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                          Images
                        </span>
                    </div>
                    @if (Auth::id() == $user->id)
                        <a wire:navigate href="{{ route('gallery-management') }}" draggable="false">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif
                </div>
                <div class="w-full h-fit p-2 text-center border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                    <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                        @livewire(UsersGallerySearch::class, ['user' => $user->username, 'preferences' => $preferences], key('gallery-search-for-gallery-list'))
                        @livewire(UsersGalleryList::class, ['user' => $user->username, 'preferences' => $preferences, 'static' => false], key('gallery-list'))
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>