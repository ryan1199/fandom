<div @if($user->id == Auth::id()) x-data="{
    setting_modal: @entangle('setting_modal').live,
    profile_modal: @entangle('profile_modal').live,
    account_modal: @entangle('account_modal').live,
    preference_modal: @entangle('preference_modal').live,
    tab: @entangle('tab').live
    }" @endif
    class="w-screen h-screen max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center
    relative z-0">
    <livewire:alert />
    <div class="container h-fit max-h-[calc(100%-48px)] overflow-clip">
        <div class="w-full h-fit">
            <div
                class="w-full h-fit max-h-[calc(100vh-96px)] grid grid-cols-3 grid-flow-row-dense auto-cols-max gap-4 overflow-clip">
                <div wire:scroll
                    class="col-span-2 h-fit max-h-[calc(100vh-96px)] p-4 flex flex-col space-x-0 space-y-4 overflow-y-auto overflow-x-clip bg-[{{ $preferences['color_primary'] }}]/10 backdrop-blur-sm border-0 border-transparent rounded-lg">
                    {{-- user information --}}
                    <div
                        class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg">
                        <div
                            class="bg-gradient-to-tr from-[{{ $preferences['color_1'] }}] via-[{{ $preferences['color_2'] }}] to-[{{ $preferences['color_3'] }}] relative rounded-lg">
                            @if ($user->cover !== null)
                            <img src="{{ asset('storage/covers/'.$user->cover->image->url) }}"
                                alt="Cover image {{ $user->username }}" title="Cover image {{ $user->username }}"
                                class="w-full h-full max-h-[30vh] object-cover block rounded-lg">
                            @else
                            <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image"
                                class="w-full h-full max-h-[30vh] object-cover block rounded-lg">
                            @endif
                            @if ($user->avatar !== null)
                            <img src="{{ asset('storage/avatars/'.$user->avatar->image->url) }}"
                                alt="Avatar image {{ $user->username }}" title="Avatar image {{ $user->username }}"
                                class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-full max-h-[15vh] aspect-square object-cover border-0 border-transparent rounded-full">
                            @else
                            <div
                                class="absolute top-0 bottom-0 right-0 left-0 m-auto w-40 h-40 bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-full">
                            </div>
                            @endif
                        </div>
                        <div
                            class="w-full h-hit p-2 flex flex-col space-x-0 space-y-2 text-[{{ $preferences['color_text'] }}] text-center bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-lg">
                            <div class="w-full h-fit flex flex-row justify-between items-start">
                                <div class="w-full h-fit">
                                    <h1
                                        class="w-full text-[{{ $preferences['color_text'] }}] text-center text-[calc({{'4px+' . $preferences['font_size'] . 'px' }})] font-semibold">
                                        {{ $user->username }}</h1>
                                    <p
                                        class="text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] . 'px' }}]">
                                        {{ $user->profile->status }}</p>
                                    <p
                                        class="text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] . 'px' }}]">
                                        {{ $user->profile->description }}</p>
                                </div>
                                @if ($user->id == Auth::id())
                                <div class="relative select-none">
                                    <svg x-on:click="setting_modal = ! setting_modal" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" fill="currentColor"
                                        class="w-8 h-8 bg-[{{ $preferences['color_primary'] }}] cursor-pointer transition-transform duration-1000 hover:rotate-180 active:duration-75 active:scale-[.85]">
                                        <path fill-rule="evenodd"
                                            d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div x-cloak x-show="setting_modal" x-transition.duration.500ms.scale.origin
                                        class="whitespace-nowrap absolute right-0 top-10 p-2 bg-[{{ $preferences['color_primary'] }}] border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
                                        <div x-on:click="account_modal = ! account_modal"
                                            class="text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] . 'px' }}] cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                                            Account settings</div>
                                        <div x-on:click="profile_modal = ! profile_modal"
                                            class="text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] . 'px' }}] cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                                            Profile settings</div>
                                        <div x-on:click="preference_modal = ! preference_modal"
                                            class="text-[{{ $preferences['color_text'] }}] text-[{{ $preferences['font_size'] . 'px' }}] cursor-pointer transition-all duration-100 hover:opacity-50 active:duration-75 active:scale-[.95]">
                                            Preference settings</div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                                {{-- list of badges or something --}}
                                <h2>Badges</h2>
                                <div>
                                    <div class="w-full h-fit">
                                        @foreach ($user->members as $member)
                                        <span class="inline-block">
                                            <a wire:navigate.hover href="{{ route('fandom-details', $member->fandom) }}"
                                                class="w-fit h-fit px-2 text-white bg-black border-0 border-transparent rounded-full block">{{ $member->role->name }}
                                                of {{ $member->fandom->name }}</a>
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- user images and posts --}}
                    <div
                        class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg">
                        <div class="w-full h-fit grid grid-cols-2 gap-2 {{ 'bg-[' . $preferences['color_secondary'] . ']' }} border-0 border-transparent rounded-lg">
                            <div x-on:click="tab = 'image'" :class="tab == 'image' ? 'font-bold' : ''" class="w-full h-fit p-2 text-center {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg hover:font-bold cursor-pointer">Gallery</div>
                            <div x-on:click="tab = 'post'" :class="tab == 'post' ? 'font-bold' : ''" class="w-full h-fit p-2 text-center {{ 'bg-[' . $preferences['color_primary'] . ']' }} border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg hover:font-bold cursor-pointer">Post</div>
                        </div>
                        <div x-cloak x-show="tab == 'image'"
                            class="w-full h-hit p-2 text-[{{ $preferences['color_text'] }}] text-center bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-lg">
                            <div class="grid grid-cols-5 gap-2">
                                @if (Auth::check() && Auth::id() == $user->id)
                                <a href="{{ route('gallery') }}" class="w-full h-40 flex flex-row items-center justify-center border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                    <div>
                                        Add new image
                                    </div>
                                </a>
                                @endif
                                @foreach ($galleries as $gallery)
                                <div class="flex flex-col space-x-0 space-y-2">
                                    <a href="{{ route('gallery.show', $gallery) }}">
                                        <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="" class="w-full h-40 object-cover rounded-lg">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div x-cloak x-show="tab == 'post'"
                            class="w-full h-hit p-2 text-[{{ $preferences['color_text'] }}] text-center bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-lg">
                            <div class="flex flex-col space-x-0 space-y-2">
                                @if (Auth::check() && Auth::id() == $user->id)
                                <a href="{{ route('post') }}" class="w-full h-fit p-4 text-center border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg">
                                    <div>
                                        Create new post
                                    </div>
                                </a>
                                @endif
                                @foreach ($posts as $post)
                                <div
                                    class="w-full h-fit p-1 border border-[{{ $preferences['color_secondary'] }}] rounded-lg">
                                    <h1 class="text-left"><a href="{{ route('post.show', $post) }}" class="cursor-pointer">{{ $post->title }}</a></h1>
                                    <div class="flex flex-col">
                                        <p class="text-right">Published
                                            {{ $post->publish->created_at->diffForHumans(['options' => null]) }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{-- following and chat --}}
                <div wire:scroll
                    class="h-fit max-h-[calc(100vh-96px)] p-4 overflow-y-auto overflow-x-clip bg-[{{ $preferences['color_primary'] }}]/10 backdrop-blur-sm border-0 border-transparent rounded-lg">
                    <div
                        class="mb-2 p-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg">
                        <div
                            class="p-2 bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-lg">
                            <h1
                                class="text-[{{ $preferences['color_text'] }}] text-center text-[calc({{'4px+' . $preferences['font_size'] . 'px' }})] font-semibold">
                                Following</h1>
                        </div>
                    </div>
                    <div
                        class="mb-2 p-2 bg-[{{ $preferences['color_secondary'] }}] border-0 border-transparent rounded-lg">
                        <div
                            class="p-2 bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-lg">
                            <h1
                                class="text-[{{ $preferences['color_text'] }}] text-center text-[calc({{'4px+' . $preferences['font_size'] . 'px' }})] font-semibold">
                                Chat</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($user->id == Auth::id())
    <div>
        <livewire:account-setting :user="$user" :preferences="$preferences" />
        <livewire:profile-setting :user="$user" :preferences="$preferences" />
        <livewire:preference-setting :user="$user" :preferences="$preferences" />
    </div>
    @endif
    <x-nav :preferences="$preferences" />
</div>