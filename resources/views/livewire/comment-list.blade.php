<div class="w-full h-fit flex flex-col space-x-0 space-y-4">
    @foreach ($child_comments as $child_comment)
        <div wire:key="{{ rand() }}" x-data="{ {{ 'open_' . $child_comment->id }}: false }" class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 items-start border-l-2 {{ 'border-[' . $preferences['color_secondary'] . ']' }}">
            <div class="w-full h-fit p-2 flex flex-row space-x-4 space-y-0 items-start">
                <a href="{{ route('user', $child_comment->user) }}" class="aspect-square w-[7vh] h-[7vh] block object-cover" draggable="false">
                    <img src="{{ asset('storage/avatars/'.$child_comment->user->avatar->image->url) }}" alt="{{ $child_comment->user->username }}" title="{{ $child_comment->user->username }}" class="aspect-square w-full h-full bg-black border-0 rounded-full object-cover block" draggable="false">
                </a>
                <div x-data="{ {{ 'open_comment_' . $child_comment->id }}: false }" class="w-full flex flex-col space-x-0 space-y-2">
                    <a href="{{ route('user', $child_comment->user) }}" class="font-bold" draggable="false">{{ $child_comment->user->username }}</a>
                    <div class="prose">
                        <p x-on:click="{{ 'open_comment_' . $child_comment->id . ' = ! ' . 'open_comment_' . $child_comment->id }}" :class="{{ 'open_comment_' . $child_comment->id }} ? 'line-clamp-none' : 'line-clamp-2'" class="font-thin text-gray-600">
                            {!! $child_comment->message->text !!}
                        </p>
                    </div>
                    <div class="flex flex-row flex-wrap">
                        <div class="mr-2 flex flex-row space-x-2 space-y-0 items-stretch">
                            <div class="flex flex-col space-x-0 space-y-1 items-center justify-center">
                                @if (in_array(Auth::id(), collect($child_comment->rates)->where('like', true)->pluck('user_id')->toArray()))
                                    <div class="p-2 border-2 {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg select-none cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                        </svg>
                                    </div>
                                @else
                                    <div wire:click="$dispatch('like_comment', { id: {{ $child_comment->id }} })" class="p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg select-none cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                        </svg>
                                    </div>
                                @endif
                                <div>{{ collect($child_comment->rates)->where('like', true)->count() }}</div>
                            </div>
                            <div class="flex flex-col space-x-0 space-y-1 items-center justify-center">
                                @if (in_array(Auth::id(), collect($child_comment->rates)->where('dislike', true)->pluck('user_id')->toArray()))
                                    <div class="p-2 border-2 {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg select-none cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                                        </svg>
                                    </div>
                                @else    
                                    <div wire:click="$dispatch('dislike_comment', { id: {{ $child_comment->id }} })" class="p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg select-none cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                                        </svg>
                                    </div>
                                @endif
                                <div>{{ collect($child_comment->rates)->where('dislike', true)->count() }}</div>
                            </div>
                        </div>
                        <div class="mr-2 flex flex-row space-x-2 space-y-0 items-stretch">
                            <div class="flex flex-col space-x-0 space-y-1 items-center justify-center">
                                <div x-on:click="{{ 'open_' . $child_comment->id . ' = ! ' . 'open_' . $child_comment->id }}" class="p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg select-none cursor-pointer">Replies</div>
                                <div>{{ $child_comment->replied }}</div>
                            </div>
                            <a wire:click="$dispatch('reply_comment', { id: {{ $child_comment->id }} })" href="#commentForm" class="w-fit h-fit p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg select-none cursor-pointer" draggable="false">Reply</a>
                        </div>
                        @auth
                            @if (Auth::id() == $child_comment->user_id)
                                <div wire:click="$dispatch('delete_comment', { id: {{ $child_comment->id }} })" class="w-fit h-fit p-2 border {{ 'border-[' . $preferences['color_secondary'] . ']' }} rounded-lg select-none cursor-pointer">Delete</div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            <div x-cloak x-show="{{ 'open_' . $child_comment->id }}" class="flex flex-col space-x-0 space-y-2">
                <livewire:comment-list :$preferences :$from :$id :reply="$child_comment->id" :$comments :key="rand()" />
            </div>
        </div>
    @endforeach
</div>