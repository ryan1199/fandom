<div class="w-full max-w-[calc(100vw-24rem)] h-full max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} overflow-y-auto">
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2">
        <div class="flex flex-col space-x-0 space-y-2 py-4">
            <div class="{{ 'text-[calc(theme(fontSize.9xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.9xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold text-center tracking-widest select-none">
                <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-500' }} {{ 'via-' . $preferences['color_2'] . '-500' }} {{ 'to-' . $preferences['color_3'] . '-500' }}">
                Fandom
                </span>
            </div>
            <div class="w-fit h-fit self-center">
                <p class="{{ 'text-[calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.lg)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold text-center tracking-widest">~Hangout place for fans~</p>
                <div
                    x-data="{
                        color_available: [{{ '"' . $preferences['color_1'] . '"' }}, {{ '"' . $preferences['color_2'] . '"' }}, {{ '"' . $preferences['color_3'] . '"' }}],
                        color1: null,
                        color2: null,
                        color3: null,
                        timer: null,
                        num1: null,
                        num2: null,
                        num3: null,
                        init() {
                            this.color_available = [{{ '"' . $preferences['color_1'] . '"' }}, {{ '"' . $preferences['color_2'] . '"' }}, {{ '"' . $preferences['color_3'] . '"' }}];
                            this.timer = setInterval(() => {
                                this.color_available.sort(function(){return 0.2 - Math.random()});
                                this.num1 = Math.floor(Math.random() * 3);
                                this.num2 = Math.floor(Math.random() * 3);
                                this.num3 = Math.floor(Math.random() * 3);
                                this.color1 = this.color_available[0];
                                this.color2 = this.color_available[1];
                                this.color3 = this.color_available[2];
                            }, 100);
                        },
                    }"
                    class="w-full h-1 bg-gradient-to-tr animation" :class="'from-'+color1+'-500 '+'via-'+color2+'-500 '+'to-'+color3+'-500'">
                </div>
            </div>
        </div>
        <div class="flex flex-col space-x-0 space-y-8">
            <div class="flex flex-col space-x-0 space-y-2">
                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                    Fandom
                    </span>
                </div>
                <div class="w-full max-w-full h-fit grid grid-cols-3 gap-2">
                    {{-- with paginate --}}
                    @forelse ($fandoms as $fandom)
                        @livewire(FandomList::class, ['fandom' => $fandom->slug, 'preferences' => $preferences], key('public-fandom-' . $fandom->id))
                    @empty
                        <div class="w-screen max-w-full h-screen max-h-40 p-4 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                No fandoms found
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="flex flex-col space-x-0 space-y-2">
                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                    Gallery
                    </span>
                </div>
                <div class="w-full max-w-full h-fit grid grid-cols-3 gap-2">
                    {{-- with paginate --}}
                    @forelse ($galleries as $gallery)
                        @livewire(GalleryListHome::class, ['gallery' => $gallery->id, 'preferences' => $preferences], key('public-gallery-' . $gallery->id))
                    @empty
                        <div class="w-screen max-w-full h-screen max-h-40 p-4 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                No galleries found
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="flex flex-col space-x-0 space-y-2">
                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                    Post
                    </span>
                </div>
                <div class="w-full max-w-full h-fit grid grid-cols-3 gap-2">
                    {{-- with paginate --}}
                    @forelse ($posts as $post)
                        @livewire(PostListHome::class, ['post' => $post->id, 'preferences' => $preferences], key('public-post-' . $post->id))
                    @empty
                        <div class="w-screen max-w-full h-screen max-h-40 p-4 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                            <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                No posts found
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            @auth
                @if ($userFollowedUsers->isNotEmpty())
                    <div class="flex flex-col space-x-0 space-y-2">
                        <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                            <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                            Updates from your friends
                            </span>
                        </div>
                        @if ($userFollowedUsers['gallery']->isNotEmpty())
                            <div class="w-full max-w-full h-fit grid grid-cols-3 gap-2">
                                {{-- with paginate --}}
                                @foreach ($userFollowedUsers['gallery'] as $userFollowedUserGallery)
                                    @livewire(GalleryListHome::class, ['gallery' => $userFollowedUserGallery->id, 'preferences' => $preferences], key('user-' . Auth::id() . '-followed-user-gallery-' . $userFollowedUserGallery->id))
                                @endforeach
                            </div>
                        @else
                            <div class="w-full max-w-full h-fit grid grid-cols-3 gap-2">
                                <div class="w-screen max-w-full h-screen max-h-40 p-4 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                                    <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                        No galleries found
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($userFollowedUsers['post']->isNotEmpty())
                            <div class="w-full max-w-full h-fit grid grid-cols-3 gap-2">
                                {{-- with paginate --}}
                                @foreach ($userFollowedUsers['post'] as $userFollowedUserPost)
                                    @livewire(PostListHome::class, ['post' => $userFollowedUserPost->id, 'preferences' => $preferences], key('user-' . Auth::id() . '-followed-user-post-' . $userFollowedUserPost->id))
                                @endforeach
                            </div>
                        @else
                            <div class="w-full max-w-full h-fit grid grid-cols-3 gap-2">
                                <div class="w-screen max-w-full h-screen max-h-40 p-4 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                                    <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                        No posts found
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                @if ($userFandoms->isNotEmpty())
                    <div class="flex flex-col space-x-0 space-y-2">
                        <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                            <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                            Updates from your fandoms
                            </span>
                        </div>
                        @if ($userFandoms['gallery']->isNotEmpty())
                            <div class="w-full max-w-full h-fit grid grid-cols-3 gap-2">
                                {{-- with paginate --}}
                                @foreach ($userFandoms['gallery'] as $userFandomrGallery)
                                    @livewire(GalleryListHome::class, ['gallery' => $userFandomrGallery->id, 'preferences' => $preferences], key('user-' . Auth::id() . '-joined-fandom-gallery-' . $userFandomrGallery->id))
                                @endforeach
                            </div>
                        @else
                            <div class="w-full max-w-full h-fit grid grid-cols-3 gap-2">
                                <div class="w-screen max-w-full h-screen max-h-40 p-4 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                                <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                    No galleries found
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($userFandoms['post']->isNotEmpty())
                            <div class="w-full max-w-full h-fit grid grid-cols-3 gap-2">
                                {{-- with paginate --}}
                                @foreach ($userFandoms['post'] as $userFandomrPost)
                                    @livewire(PostListHome::class, ['post' => $userFandomrPost->id, 'preferences' => $preferences], key('user-' . Auth::id() . '-joined-fandom-post-' . $userFandomrPost->id))
                                @endforeach
                            </div>
                        @else
                            <div class="w-full max-w-full h-fit grid grid-cols-3 gap-2">
                                <div class="w-screen max-w-full h-screen max-h-40 p-4 flex flex-row items-center justify-center shadow {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                                    <div class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                                        No posts found
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>