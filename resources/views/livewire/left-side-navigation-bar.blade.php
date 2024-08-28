<div class="w-full max-w-sm h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} border-r-2 {{ 'border-' . $preferences['color_2'] . '-900' }} border-dashed select-none overflow-y-auto">
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2">
        @guest
            <a wire:navigate href="{{ route('home') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Fandom</a>
            <a wire:navigate href="{{ route('login') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Login</a>
            <a wire:navigate href="{{ route('register') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Register</a>
            <a wire:navigate href="{{ route('fandom-list') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Fandom list</a>
            <a wire:navigate href="{{ route('post') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Post</a>
            <a wire:navigate href="{{ route('gallery') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Gallery</a>
        @endguest
        @auth
            <a wire:navigate href="{{ route('home') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Fandom</a>
            <div x-data="{ open_user: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-1 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="flex flex-row justify-between items-center">
                    <a wire:navigate href="{{ route('user', $user) }}" class="w-fit" draggable="false">{{ $user->username }}</a>
                    <svg x-cloak x-show="!open_user" x-on:click="open_user = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-900' }} cursor-pointer">
                        <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                    </svg>
                    <svg x-cloak x-show="open_user" x-on:click="open_user = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-500' }} cursor-pointer">
                        <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div x-transition x-cloak x-show="open_user" class="pl-1 flex flex-col space-x-0 space-y-2">
                    <p wire:click="openChat" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg cursor-pointer">Chats</p>
                    <div x-data="{ open_followed_user_list: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                        <div class="flex flex-row justify-between items-center">
                            <p>Followed users</p>
                            <svg x-cloak x-show="!open_followed_user_list" x-on:click="open_followed_user_list = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-900' }} cursor-pointer">
                                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                            </svg>
                            <svg x-cloak x-show="open_followed_user_list" x-on:click="open_followed_user_list = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-500' }} cursor-pointer">
                                <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div x-transition x-cloak x-show="open_followed_user_list">
                            @livewire(Follow::class, ['user' => $user->username, 'preferences' => $preferences], key('follow-from-left-side-navigation-bar-on-user-' . $user->id))
                        </div>
                    </div>
                    <div x-data="{ open_blocked_user_list: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                        <div class="flex flex-row justify-between items-center">
                            <p>Blocked users</p>
                            <svg x-cloak x-show="!open_blocked_user_list" x-on:click="open_blocked_user_list = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-900' }} cursor-pointer">
                                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                            </svg>
                            <svg x-cloak x-show="open_blocked_user_list" x-on:click="open_blocked_user_list = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-500' }} cursor-pointer">
                                <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div x-transition x-cloak x-show="open_blocked_user_list">
                            @livewire(Block::class, ['user' => $user->username, 'preferences' => $preferences], key('block-from-left-side-navigation-bar-on-user-' . $user->id))
                        </div>
                    </div>
                    <div x-data="{ open_setting: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                        <div class="flex flex-row justify-between items-center">
                            <p>Settings</p>
                            <svg x-cloak x-show="!open_setting" x-on:click="open_setting = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-900' }} cursor-pointer">
                                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                            </svg>
                            <svg x-cloak x-show="open_setting" x-on:click="open_setting = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-500' }} cursor-pointer">
                                <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div x-transition x-cloak x-show="open_setting" class="pl-1 flex flex-col space-x-0 space-y-2">
                            <div x-data="{ open_account_setting: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                                <div class="flex flex-row justify-between items-center">
                                    <p>Account</p>
                                    <svg x-cloak x-show="!open_account_setting" x-on:click="open_account_setting = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-900' }} cursor-pointer">
                                        <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                                    </svg>
                                    <svg x-cloak x-show="open_account_setting" x-on:click="open_account_setting = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-500' }} cursor-pointer">
                                        <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div x-transition x-cloak x-show="open_account_setting">
                                    @livewire(AccountSetting::class, ['user' => $user->username, 'preferences' => $preferences], key('account-setting-from-left-side-navigation-bar-on-user-' . $user->id))
                                </div>
                            </div>
                            <div x-data="{ open_profile_setting: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                                <div class="flex flex-row justify-between items-center">
                                    <p>Profile</p>
                                    <svg x-cloak x-show="!open_profile_setting" x-on:click="open_profile_setting = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-900' }} cursor-pointer">
                                        <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                                    </svg>
                                    <svg x-cloak x-show="open_profile_setting" x-on:click="open_profile_setting = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-500' }} cursor-pointer">
                                        <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div x-transition x-cloak x-show="open_profile_setting">
                                    @livewire(ProfileSetting::class, ['user' => $user->username, 'preferences' => $preferences], key('profile-setting-from-left-side-navigation-bar-on-user-' . $user->id))
                                </div>
                            </div>
                            <div x-data="{ open_preference_setting: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                                <div class="flex flex-row justify-between items-center">
                                    <p>Preference</p>
                                    <svg x-cloak x-show="!open_preference_setting" x-on:click="open_preference_setting = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-900' }} cursor-pointer">
                                        <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                                    </svg>
                                    <svg x-cloak x-show="open_preference_setting" x-on:click="open_preference_setting = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-500' }} cursor-pointer">
                                        <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div x-transition x-cloak x-show="open_preference_setting">
                                    @livewire(PreferenceSetting::class, ['user' => $user->username, 'preferences' => $preferences], key('preference-setting-from-left-side-navigation-bar-on-user-' . $user->id))
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div x-data="{ open_fandom_list: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="flex flex-row justify-between items-center">
                    <a wire:navigate href="{{ route('fandom-list') }}" class="w-fit" draggable="false">Fandom list</a>
                    <svg x-cloak x-show="!open_fandom_list" x-on:click="open_fandom_list = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-900' }} cursor-pointer">
                        <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                    </svg>
                    <svg x-cloak x-show="open_fandom_list" x-on:click="open_fandom_list = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-500' }} cursor-pointer">
                        <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div x-transition x-cloak x-show="open_fandom_list" class="pl-1 flex flex-col space-x-0 space-y-2">
                    @foreach ($user->members as $member)
                        @livewire(FandomListLeftSideNavigationBar::class, ['fandom' => $member->fandom->slug, 'member' => $member->id, 'user' => $user->username, 'preferences' => $preferences], key('fandom-list-fandom-' . $member->fandom->id . '-from-left-side-navigation-bar-on-user-' . $user->id))
                    @endforeach
                    <div x-data="{ open_create_fandom: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                        <div class="flex flex-row justify-between items-center">
                            <p>Create a fandom</p>
                            <svg x-cloak x-show="!open_create_fandom" x-on:click="open_create_fandom = true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-900' }} cursor-pointer">
                                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                            </svg>
                            <svg x-cloak x-show="open_create_fandom" x-on:click="open_create_fandom = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'text-' . $preferences['color_2'] . '-500' }} cursor-pointer">
                                <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div x-transition x-cloak x-show="open_create_fandom">
                            @livewire(FandomCreate::class, ['preferences' => $preferences], key('fandom-create-from-left-side-navigation-bar-on-user-' . $user->id))
                        </div>
                    </div>
                </div>
            </div>
            <a wire:navigate href="{{ route('post-management') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Post Management</a>
            <a wire:navigate href="{{ route('gallery-management') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Gallery Management</a>
            <a wire:navigate href="{{ route('post') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Post</a>
            <a wire:navigate href="{{ route('gallery') }}" class="w-full h-fit p-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Gallery</a>
            <form action="{{ route('logout') }}" method="post" draggable="false">
                @csrf
                <button type="submit" class="w-full h-fit p-2 text-left {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg" draggable="false">Logout</button>
            </form>
        @endauth
    </div>
</div>
