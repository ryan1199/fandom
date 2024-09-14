<div class="w-full h-screen {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }}">
    <div class="w-full container h-screen mx-auto grid grid-cols-12 grid-flow-row-dense auto-rows-max auto-cols-max gap-2">
        {{-- fandom details --}}
        <div class="w-full h-fit max-h-[100vh] pb-14 p-2 col-span-12 lg:col-span-6 overflow-y-auto">
            <div x-data="{ tab: @entangle('tab').live }" class="w-full h-fit mt-14 p-4 flex flex-col space-x-0 space-y-4 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                {{-- header --}}
                @livewire(FandomProfile::class, ['fandom' => $fandom, 'preferences' => $preferences])
                {{-- nav --}}
                <div>
                    <div class="w-full h-fit {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none">
                        <div class="w-fit max-w-full flex flex-row text-nowrap overflow-x-auto overflow-y-clip">
                            <div :class="tab == 'home' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="tab = 'home'" class="p-4 font-semibold cursor-pointer">Home</div>
                            <div :class="tab == 'post' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="tab = 'post'" class="p-4 font-semibold cursor-pointer">Post</div>
                            <div :class="tab == 'gallery' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="tab = 'gallery'" class="p-4 font-semibold cursor-pointer">Galery</div>
                            <div :class="tab == 'member' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="tab = 'member'" class="p-4 font-semibold cursor-pointer">Member</div>
                            @if (in_array(Auth::id(), $managers))
                                <div :class="tab == 'setting' ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="tab = 'setting'" class="p-4 font-semibold cursor-pointer">Setting</div>
                                {{-- logs --}}
                            @endif
                        </div>
                    </div>
                </div>
                {{-- content --}}
                <div class="w-full h-fit {{ 'selection:bg-' . $preferences['color_2'] . '-500' }} {{ 'selection:text-' . $preferences['color_2'] . '-50' }}">
                    <div x-transition x-cloak x-show="tab == 'home'" class="w-full h-fit flex flex-col space-x-0 space-y-4">
                        {{-- post --}}
                        <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-4 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                                  Recent Posts
                                </span>
                            </div>
                            @livewire(FandomsPostList::class, ['fandom' => $fandom->slug, 'preferences' => $preferences, 'static' => true], key('static-post-list'))
                        </div>
                        {{-- gallery --}}
                        <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-4 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                                  New In Gallery
                                </span>
                            </div>
                            @livewire(FandomsGalleryList::class, ['fandom' => $fandom->slug, 'preferences' => $preferences, 'static' => true], key('static-gallery-list'))
                        </div>
                        {{-- votes --}}
                        <div
                            @auth
                                @if (in_array(Auth::id(), $members))
                                    x-data="{ openFandomsRequestForm: @entangle('openFandomsRequestForm') }"
                                @endif
                            @endauth
                            class="w-full h-fit p-4 flex flex-col space-x-0 space-y-4 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="flex flex-row justify-between items-center">
                                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                                      Requests
                                    </span>
                                </div>
                                @auth
                                    @if (in_array(Auth::id(), $members))
                                        <svg x-on:click="openFandomsRequestForm = ! openFandomsRequestForm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                @endauth
                            </div>
                            <div class="w-full h-fit flex flex-col space-x-0 space-y-4">
                                @if (in_array(Auth::id(), $members))
                                    <div x-cloak x-show="openFandomsRequestForm">
                                        @livewire(FandomsRequestForm::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key('fandoms-request-form-for-fandom-' . $fandom->id))
                                    </div>
                                @endif
                                @livewire(FandomsRequestList::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key('fandoms-request-list-for-fandom-' . $fandom->id))
                            </div>
                        </div>
                    </div>
                    <div x-transition x-cloak x-show="tab == 'post'" class="w-full h-fit">
                        <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-4 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="w-full h-fit flex flex-row justify-between items-center">
                                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                                      Post
                                    </span>
                                </div>
                                @auth
                                    @if (in_array(Auth::id(), $members))
                                        <a wire:navigate.hover href="{{ route('post-management') }}" draggable="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                                                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endif
                                @endauth
                            </div>
                            @livewire(FandomsPostSearch::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key('post-search-for-dynamic-post-list'))
                            @livewire(FandomsPostList::class, ['fandom' => $fandom->slug, 'preferences' => $preferences, 'static' => false], key('dynamic-post-list'))
                        </div>
                    </div>
                    <div x-transition x-cloak x-show="tab == 'gallery'" class="w-full h-fit">
                        <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-4 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="w-full h-fit flex flex-row justify-between items-center">
                                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                                      Gallery
                                    </span>
                                </div>
                                @auth
                                    @if (in_array(Auth::id(), $members))
                                        <a wire:navigate.hover href="{{ route('gallery-management') }}" draggable="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                                                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endif
                                @endauth
                            </div>
                            @livewire(FandomsGallerySearch::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key('gallery-search-for-dynamic-gallery-list'))
                            @livewire(FandomsGalleryList::class, ['fandom' => $fandom->slug, 'preferences' => $preferences, 'static' => false], key('dynamic-gallery-list'))
                        </div>
                    </div>
                    <div x-transition x-cloak x-show="tab == 'member'" class="w-full h-fit">
                        <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-4 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                                  Member
                                </span>
                            </div>
                            @livewire(FandomMemberList::class, ['fandom' => $fandom->slug, 'preferences' => $preferences])
                        </div>
                    </div>
                    @if (in_array(Auth::id(), $managers))
                        <div x-transition x-cloak x-show="tab == 'setting'" class="w-full h-fit">
                            @livewire(FandomSetting::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key('fandom-setting-for-fandom-' . $fandom->id))
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- discusses --}}
        <div @if (in_array(Auth::id(), $managers)) x-data="{ open_discuss_create_component: false }" @endif class="w-full h-fit max-h-[100vh] pb-14 p-2 col-span-12 lg:col-span-6 overflow-y-auto">
            <div class="w-full h-fit mt-14 p-4 flex flex-col space-x-0 space-y-4 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="w-full h-fit p-2 flex flex-row justify-between items-center shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none">
                    <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                            Discusses
                        </span>
                    </div>
                    @if (in_array(Auth::id(), $managers))
                        <svg x-on:click="open_discuss_create_component = ! open_discuss_create_component" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                        </svg>
                    @endif
                </div>
                @if (in_array(Auth::id(), $managers))
                    <div x-cloak x-show="open_discuss_create_component" class="w-full h-fit">
                        @livewire(DiscussCreate::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key('discuss-create-for-fandom-' . $fandom->id))
                    </div>
                @endif
                @if ($discusses->isNotEmpty())
                    <div class="w-full h-fit">
                        @livewire(Discuss::class, ['discuss_ids' => $discusses->pluck('id'), 'preferences' => $preferences, 'from' => 'discussion-for-fandom-' . $fandom->id], key("discussion-for-fandom-" . $fandom->id))
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
