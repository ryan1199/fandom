<div class="w-full h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none overflow-clip">
    <div class="w-full container h-screen max-h-[100vh] mx-auto flex flex-col lg:flex-row space-x-0 lg:space-x-2 space-y-2 lg:space-y-0 items-center lg:items-start overflow-y-auto lg:overflow-clip">
        {{-- profile --}}
        <div class="w-full max-w-xl h-fit lg:max-h-[100vh] lg:pb-14 p-2 lg:overflow-y-auto">
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
                @if ($user->id == Auth::id())
                    <div x-data="{ openLog: false }" class="w-full h-fit flex flex-col space-x-0 space-y-2">
                        <div class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-between items-center">
                            <div class="w-full h-fit {{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                                  Log
                                </span>
                            </div>
                            <svg x-cloak x-show="! openLog" x-on:click="openLog = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                                <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z" clip-rule="evenodd" />
                            </svg>
                            <svg x-cloak x-show="openLog" x-on:click="openLog = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div x-cloak x-show="openLog" x-transition class="w-full h-fit">
                            @livewire(UsersLog::class, ['user' => $user->username, 'preferences' => $preferences])
                        </div>
                    </div>
                @endif
            </div>
        </div>
        {{-- post and gallery tabs --}}
        <div x-data="{ tab: 'post' }" class="w-full max-w-xl lg:max-w-full h-fit lg:max-h-[100vh] pb-14 p-2 break-inside-avoid-column lg:overflow-y-auto">
            <div class="w-full h-fit lg:mt-14 p-4 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="w-full h-fit p-2 flex flex-row space-x-4 space-y-0 items-center">
                    <div :class="tab == 'post' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="tab = 'post'" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} text-center font-semibold rounded-lg cursor-pointer">Post</div>
                    <div :class="tab == 'gallery' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="tab = 'gallery'" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} text-center font-semibold rounded-lg cursor-pointer">Gallery</div>
                </div>
                <div x-cloak x-show="tab == 'post'" class="w-full h-fit flex flex-col space-x-0 space-y-4">
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
                    <div class="w-full h-fit p-4 text-center border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                        <div class="w-full h-fit flex flex-col space-x-0 space-y-4">
                            @livewire(UsersPostSearch::class, ['user' => $user->username, 'preferences' => $preferences], key('post-search-for-post-list'))
                            @livewire(UsersPostList::class, ['user' => $user->username, 'preferences' => $preferences, 'static' => false], key('post-list'))
                        </div>
                    </div>
                </div>
                <div x-cloak x-show="tab == 'gallery'" class="w-full h-fit flex flex-col space-x-0 space-y-4">
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
                    <div class="w-full h-fit p-4 text-center border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                        <div class="w-full h-fit flex flex-col space-x-0 space-y-4">
                            @livewire(UsersGallerySearch::class, ['user' => $user->username, 'preferences' => $preferences], key('gallery-search-for-gallery-list'))
                            @livewire(UsersGalleryList::class, ['user' => $user->username, 'preferences' => $preferences, 'static' => false], key('gallery-list'))
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>