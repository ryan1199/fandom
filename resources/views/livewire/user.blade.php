<div class="w-full h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500 select-none overflow-clip">
    <div class="w-full h-screen max-h-[100vh] p-2 flex flex-row space-x-2 space-y-0 bg-zinc-100/95 overflow-clip">
        <div class="w-full max-w-md h-screen max-h-[calc(100vh-16px)] flex flex-col space-x-0 space-y-2 overflow-y-auto">
            <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg break-inside-avoid-column">
                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }}">
                      Profile
                    </span>
                </div>
                <div class="w-full h-[30vh] relative select-none">
                    @if ($user->cover !== null)
                        <img src="{{ asset('storage/covers/'.$user->cover->image->url) }}" alt="Cover image {{ $user->username }}" title="Cover image {{ $user->username }}" class="w-full h-[30vh] object-cover block border border-zinc-200 rounded-lg" draggable="false">
                    @else
                        <div class="w-full h-full bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border border-zinc-200 rounded-lg">
                            <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-[30vh] object-cover block rounded-lg" draggable="false">
                        </div>
                    @endif
                    @if ($user->avatar !== null)
                        <img src="{{ asset('storage/avatars/'.$user->avatar->image->url) }}" alt="Avatar image {{ $user->username }}" title="Avatar image {{ $user->username }}" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[15vh] aspect-square object-cover border-0 rounded-full" draggable="false">
                    @else
                        <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-[15vh] h-[15vh] bg-zinc-50 border-0 rounded-full"></div>
                    @endif
                </div>
                <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2">
                    <div class="w-full h-fit flex flex-col space-x-0 space-y-1 text-pretty">
                        <h1 class="w-full text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)+theme(fontSize.base)-' . $preferences['font_size'] . 'px)*1.2)]' }} font-semibold">{{ $user->username }}</h1>
                        <div class="prose prose-zinc prose-headings:text-zinc-500 prose-p:text-zinc-500 prose-a:text-zinc-500 prose-ol:text-zinc-500 prose-ul:text-zinc-500 prose-blockquote:text-zinc-500 prose-strong:text-zinc-500 prose-em:text-zinc-500 prose-code:text-zinc-500 prose-pre:text-zinc-500 prose-hr:border-zinc-200 prose-table:text-zinc-500 prose-li:text-zinc-500 prose-ol:text-pretty prose-ul:text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} prose-ol:list-decimal prose-ul:list-disc prose-ol:list-outside prose-ul:list-outside">
                            {!! $user->profile->status !!}
                        </div>
                        <div class="prose prose-zinc prose-headings:text-zinc-500 prose-p:text-zinc-500 prose-a:text-zinc-500 prose-ol:text-zinc-500 prose-ul:text-zinc-500 prose-blockquote:text-zinc-500 prose-strong:text-zinc-500 prose-em:text-zinc-500 prose-code:text-zinc-500 prose-pre:text-zinc-500 prose-hr:border-zinc-200 prose-table:text-zinc-500 prose-li:text-zinc-500 prose-ol:text-pretty prose-ul:text-pretty {{ 'marker:text-[' . $preferences['color_2'] . ']' }} prose-ol:list-decimal prose-ul:list-disc prose-ol:list-outside prose-ul:list-outside">
                            {!! $user->profile->description !!}
                        </div>
                    </div>
                    <div class="w-full h-fit max-h-[25vh] flex flex-col space-x-0 space-y-2 text-center overflow-clip overflow-y-auto">
                        <div class="w-full h-fit columns-2 gap-1">
                            <div class="w-full h-fit mb-1 p-2 break-inside-avoid-column flex flex-col space-x-0 space-y-1 items-center bg-zinc-50 border border-zinc-200 {{ 'hover:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation">
                                <div class="w-full flex flex-row justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10 {{ 'text-[' . $preferences['color_2'] . ']' }}">
                                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="w-fit {{ 'text-[' . $preferences['color_2'] . ']' }} text-center tracking-tighter">
                                        @if ($followers >= 1000)
                                            {{ round($followers/1000, 1) . 'k' }}
                                        @else
                                            {{ $followers }}
                                        @endif
                                    </p>
                                </div>
                                <p class="font-semibold {{ 'text-[' . $preferences['color_2'] . ']' }}">Followed</p>
                            </div>
                            <div class="w-full h-fit mb-1 p-2 break-inside-avoid-column flex flex-col space-x-0 space-y-1 items-center bg-zinc-50 border border-zinc-200 {{ 'hover:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation">
                                <div class="w-full flex flex-row justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10 {{ 'text-[' . $preferences['color_2'] . ']' }}">
                                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="w-fit {{ 'text-[' . $preferences['color_2'] . ']' }} text-center tracking-tighter">
                                        @if ($following >= 1000)
                                            {{ round($following/1000, 1) . 'k' }}
                                        @else
                                            {{ $following }}
                                        @endif
                                    </p>
                                </div>
                                <p class="font-semibold {{ 'text-[' . $preferences['color_2'] . ']' }}">Following</p>
                            </div>
                            @foreach ($user->members as $member)
                                <a wire:key="{{ 'fandom' . $member->fandom->id }}" wire:navigate.hover href="{{ route('fandom-details', $member->fandom) }}" class="w-full h-fit mb-1 p-2 break-inside-avoid-column flex flex-col space-x-0 space-y-1 bg-zinc-50 border border-zinc-200 {{ 'hover:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation">
                                    <div class="w-full h-screen max-h-[13vh] flex flex-col space-x-0 space-y-2 overflow-y-auto">
                                        <p class="font-semibold {{ 'text-[' . $preferences['color_2'] . ']' }}">{{ $member->fandom->name }}</p>
                                        <div class="w-full h-[10vh] relative">
                                            @if ($member->fandom->cover !== null)
                                                <img src="{{ asset('storage/covers/'.$member->fandom->cover->image->url) }}" alt="Cover image {{ $member->fandom->name }}" title="Cover image {{ $member->fandom->name }}" class="w-full h-full object-cover block border border-zinc-200 rounded-lg" draggable="false">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} border border-zinc-200 rounded-lg">
                                                    <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-[10vh] object-cover block rounded-lg" draggable="false">
                                                </div>
                                            @endif
                                            @if ($member->fandom->avatar !== null)
                                                <img src="{{ asset('storage/avatars/'.$member->fandom->avatar->image->url) }}" alt="Avatar image {{ $member->fandom->name }}" title="Avatar image {{ $member->fandom->name }}" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[8vh] aspect-square object-cover border-0 rounded-full" draggable="false">
                                            @else
                                                <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[8vh] aspect-square bg-zinc-50 border-0 rounded-full"></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="font-semibold {{ 'text-[' . $preferences['color_2'] . ']' }}">{{ $member->role->name }}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @if ($user->id != Auth::id())
                        <div class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-center items-center select-none">
                            @livewire(FollowUnfollowButton::class, ['user1' => Auth::user(), 'user2' => $user, 'preferences' => $preferences])
                            @livewire(BlockUnblockButton::class, ['user1' => Auth::user(), 'user2' => $user, 'preferences' => $preferences])
                            <div wire:click="chatTo" class="w-fit h-full px-2 font-semibold {{ 'hover:text-[' . $preferences['color_2'] . ']' }} cursor-pointer animation-button">Chat</div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg break-inside-avoid-column">
                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }}">
                      Posts
                    </span>
                </div>
                <div class="w-full h-fit p-2 text-center bg-zinc-50 border border-zinc-200 rounded-lg">
                    <div class="flex flex-col space-x-0 space-y-2">
                        @if (Auth::id() == $user->id)
                            <a href="{{ route('post') }}" class="w-fit h-fit mx-auto px-2 text-center {{ 'hover:text-[' . $preferences['color_2'] . ']' }} font-semibold select-none animation-button" draggable="false"><div>Write a post</div></a>
                            <hr class="border-zinc-200">
                        @endif
                        @if (Auth::id() == $user->id)
                            @forelse ($posts['self'] as $post)
                                <a wire:key="{{ 'post' . $post->id }}" href="{{ route('post.show', $post) }}" class="w-full h-fit p-2 bg-zinc-50 border border-zinc-200 group {{ 'hover:border-[' . $preferences['color_2'] . ']' }} rounded-lg cursor-pointer animation" draggable="false">
                                    <h1 class="w-fit text-left font-semibold {{ 'group-hover:text-[' . $preferences['color_2'] . ']' }} animation">{{ $post->title }}</h1>
                                    <p class="text-right {{ 'group-hover:text-[' . $preferences['color_2'] . ']' }} animation">Published {{ $post->publish->created_at->diffForHumans(['options' => null]) }}</p>
                                </a>
                            @empty
                                <div>You don't have any posts yet</div>
                            @endforelse
                        @else
                            @if (in_array(Auth::id(), $friendlist_id))
                                @forelse ($posts['friend'] as $post)
                                    </div>
                                    <a wire:key="{{ 'post' . $post->id }}" href="{{ route('post.show', $post) }}" class="w-full h-fit p-2 bg-zinc-50 border border-zinc-200 group {{ 'hover:border-[' . $preferences['color_2'] . ']' }} rounded-lg cursor-pointer animation" draggable="false">
                                        <h1 class="w-fit text-left font-semibold {{ 'group-hover:text-[' . $preferences['color_2'] . ']' }} animation">{{ $post->title }}</h1>
                                        <p class="text-right {{ 'group-hover:text-[' . $preferences['color_2'] . ']' }} animation">Published {{ $post->publish->created_at->diffForHumans(['options' => null]) }}</p>
                                    </a>
                                @empty
                                    <div>{{ $user->username }} doesn't have any posts to read</div>
                                @endforelse
                            @else
                                @forelse ($posts['public'] as $post)
                                    <a wire:key="{{ 'post' . $post->id }}" href="{{ route('post.show', $post) }}" class="w-full h-fit p-2 bg-zinc-50 border border-zinc-200 group {{ 'hover:border-[' . $preferences['color_2'] . ']' }} rounded-lg cursor-pointer animation" draggable="false">
                                        <h1 class="w-fit text-left font-semibold {{ 'group-hover:text-[' . $preferences['color_2'] . ']' }} animation">{{ $post->title }}</h1>
                                        <p class="text-right {{ 'group-hover:text-[' . $preferences['color_2'] . ']' }} animation">Published {{ $post->publish->created_at->diffForHumans(['options' => null]) }}</p>
                                    </a>
                                @empty
                                    <div>{{ $user->username }} doesn't have any posts to read</div>
                                @endforelse
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full h-screen max-h-[calc(100vh-16px)] overflow-y-auto">
            <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg break-inside-avoid-column">
                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }}">
                      Images
                    </span>
                </div>
                <div class="w-full h-fit p-2 text-center bg-zinc-50 border border-zinc-200 rounded-lg">
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2">
                        @if (Auth::id() == $user->id)
                            <div class="w-full h-40 flex flex-row items-center justify-center">
                                <a href="{{ route('gallery') }}" class="w-fit h-fit font-semibold {{ 'hover:text-[' . $preferences['color_2'] . ']' }} cursor-pointer animation-button" draggable="false">Upload an image</a>
                            </div>
                        @endif
                        @if (Auth::id() == $user->id)
                            @forelse ($galleries['self'] as $gallery)
                                <a wire:key="{{ 'gallery' . $gallery->id }}" href="{{ route('gallery.show', $gallery) }}" draggable="false">
                                    <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}" class="w-full h-40 object-cover object-center border border-zinc-200 {{ 'hover:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation-button" draggable="false">
                                </a>
                            @empty
                                <div class="w-full h-40 flex flex-row items-center justify-center">You don't have any images yet</div>
                            @endforelse
                        @else
                            @forelse ($galleries['public'] as $gallery)
                                <a wire:key="{{ 'gallery' . $gallery->id }}" href="{{ route('gallery.show', $gallery) }}" draggable="false">
                                    <img src="{{ asset('storage/galleries/'.$gallery->image->url) }}" alt="{{ asset('storage/galleries/'.$gallery->image->url) }}" class="w-full h-40 object-cover object-center border border-zinc-200 {{ 'hover:border-[' . $preferences['color_2'] . ']' }} rounded-lg animation-button" draggable="false">
                                </a>
                            @empty
                                <div class="w-full h-40 flex flex-row items-center justify-center">{{ $user->username }} doesn't have any images to show</div>
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>