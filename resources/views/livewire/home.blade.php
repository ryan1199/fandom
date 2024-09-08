<div class="w-full h-full max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} overflow-y-auto">
    <div class="w-full container h-fit mx-auto p-2 flex flex-col space-x-0 space-y-2">
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
            <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                    Fandom
                    </span>
                </div>
                @livewire(FandomList::class, ['preferences' => $preferences], key('public-fandom-list-' . rand()))
            </div>
            <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                    Gallery
                    </span>
                </div>
                @livewire(GalleryListHome::class, ['preferences' => $preferences], key('public-gallery-list-' . rand()))
            </div>
            <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                    Post
                    </span>
                </div>
                @livewire(PostListHome::class, ['preferences' => $preferences], key('public-post-list-' . rand()))
            </div>
            @auth
                <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                    <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                        Updates from your friends
                        </span>
                    </div>
                    <div class="w-full h-fit flex flex-col space-x-0 space-y-4">
                        @livewire(UserFollowsGalleryListHome::class, ['preferences' => $preferences], key('user-follows-gallery-list-' . rand()))
                        @livewire(UserFollowsPostListHome::class, ['preferences' => $preferences], key('user-follows-post-list-' . rand()))
                    </div>
                </div>
                <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg">
                    <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                        <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                        Updates from your fandoms
                        </span>
                    </div>
                    <div class="w-full h-fit flex flex-col space-x-0 space-y-4">
                        @livewire(UserFandomsGalleryListHome::class, ['preferences' => $preferences], key('user-fandoms-gallery-list-' . rand()))
                        @livewire(UserFandomsPostListHome::class, ['preferences' => $preferences], key('user-fandoms-post-list-' . rand()))
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>