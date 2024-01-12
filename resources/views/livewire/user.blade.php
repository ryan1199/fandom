<div class="w-screen h-screen max-h-[100vh] mx-auto p-2 flex flex-col space-x-0 space-y-2 justify-center items-center relative z-0">
    <livewire:alert/>
    <div class="container h-fit max-h-[calc(100%-48px)] overflow-clip">
        <div class="w-full h-fit p-2 bg-gray-50/90 backdrop-blur-sm border-0 border-transparent rounded-lg">
            <div 
                @if($user['id'] == Auth::id()) x-data="{ 
                    setting_modal: @entangle('setting_modal').live,
                    profile_modal: @entangle('profile_modal').live,
                    account_modal: @entangle('account_modal').live,
                    preference_modal: @entangle('preference_modal').live 
                }" @endif 
                wire:scroll 
                class="w-full h-screen max-h-[calc(100vh-96px)] grid grid-cols-3 grid-flow-row-dense auto-cols-max gap-1 overflow-clip">
                <div class="col-span-2 h-screen max-h-[calc(100vh-96px)] pr-1 flex flex-col space-x-0 space-y-2 overflow-y-auto overflow-x-clip">
                    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-black border-0 border-transparent rounded-lg">
                        <div class="bg-gradient-to-tr from-orange-500 via-pink-500 to-indigo-500 relative">
                            <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-full max-h-[30vh] object-cover block">
                            <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-40 h-40 bg-white border-0 border-transparent rounded-full"></div>
                        </div>
                        <div class="w-full h-hit p-2 flex flex-col space-x-0 space-y-2 text-black text-center bg-white border border-black rounded-lg">
                            <div class="w-full h-fit flex flex-row justify-between items-center">
                                <h1 class="w-full text-center">{{ Auth::user()->username }}</h1>
                                @if ($user['id'] == Auth::id())
                                    <div class="relative">
                                        <svg x-on:click="setting_modal = ! setting_modal" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 bg-white">
                                            <path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" clip-rule="evenodd" />
                                        </svg>
                                        <div x-cloak x-show="setting_modal" class="whitespace-nowrap absolute right-0 top-10 p-2 bg-white border border-black rounded-lg">
                                            <div x-on:click="account_modal = ! account_modal">Account setting</div>
                                            <div x-on:click="profile_modal = ! profile_modal">Profile setting</div>
                                            <div x-on:click="preference_modal = ! preference_modal">Preference setting</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ipsam excepturi perferendis libero. Explicabo quaerat vel placeat quos neque vero voluptatem maxime illum rem necessitatibus reprehenderit, deserunt est voluptatum perspiciatis?</p>
                        </div>
                    </div>
                    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-black border-0 border-transparent rounded-lg">
                        <div class="w-full h-hit p-2 text-black text-center bg-white border border-black rounded-lg">
                            <h1>User activity</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ipsam excepturi perferendis libero. Explicabo quaerat vel placeat quos neque vero voluptatem maxime illum rem necessitatibus reprehenderit, deserunt est voluptatum perspiciatis?</p>
                        </div>
                    </div>
                </div>
                <div wire:scroll class="h-screen max-h-[calc(100vh-96px)] pr-1 overflow-y-auto overflow-x-clip">
                    @if ($user['id'] == Auth::id())
                        <div>
                            <livewire:account-setting :user="$user"/>
                            <livewire:profile-setting :user="$user"/>
                            <livewire:preference-setting :user="$user"/>
                        </div>
                    @endif
                    <div class="mb-2 p-2 bg-black border-0 border-transparent rounded-lg">
                        <div class="p-2 bg-white border-0 border-transparent rounded-lg">
                            <h1>Friends</h1>
                        </div>
                    </div>
                    <div class="mb-2 p-2 bg-black border-0 border-transparent rounded-lg">
                        <div class="p-2 bg-white border-0 border-transparent rounded-lg">
                            <h1>Chat</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-nav/>
</div>