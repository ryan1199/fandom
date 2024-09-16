<div x-data="{ administration: @entangle('administration') }" class="w-full h-full {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg select-none overflow-clip">
    <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-4">
        <div class="w-fit {{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
            <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
              Create a request
            </span>
        </div>
        <div class="w-full h-full flex flex-col space-x-0 space-y-2 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
            <p class="font-semibold">Rules:</p>
            <ol class="pl-8 flex flex-col space-x-0 space-y-2 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-decimal list-outside">
                <li>Request title maximum length is 50 characters</li>
                <li>Request description maximum length is 500 characters</li>
            </ol>
        </div>
        @if ($errors->any())
            <div class="w-full h-full flex flex-col space-x-0 space-y-1 {{ 'text-[calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.sm)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} select-none">
                <p class="font-semibold">Errors:</p>
                <ul class="pl-4 flex flex-col space-x-0 space-y-1 text-pretty {{ 'marker:text-' . $preferences['color_2'] . '-500' }} list-disc list-outside">
                    @foreach ($errors->all() as $error)
                        <li wire:key="{{ 'fandom-create-error-' . $loop->index }}">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="w-full h-fit flex flex-col space-x-0 space-y-4">
            <div class="w-full h-fit p-2 flex flex-row space-x-4 space-y-0 items-center border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg select-none">
                <div :class="administration == false ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="administration = false" class="w-full h-fit p-2 text-center font-semibold border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg cursor-pointer">Non Administration</div>
                <div :class="administration == true ? '{{ 'text-' . $preferences['color_2'] . '-500' }}' : ''" x-on:click="administration = true" class="w-full h-fit p-2 text-center font-semibold border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg cursor-pointer">Administration</div>
            </div>
            <div x-cloak x-show="administration" class="w-full h-fit flex flex-col space-x-0 space-y-4">
                <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-4 border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                    <p>Managers</p>
                    @foreach ($managers as $manager)
                        <div wire:key="{{ $manager->user->username }}" class="w-full h-fit p-2 flex flex-row space-x-2 space-y-0 justify-between items-center border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                            <div class="@if ($user != null && $user->username == $manager->user->username) font-semibold @endif">{{ $manager->user->username }}</div>
                            <div class="w-fit h-fit flex flex-row space-x-1 space-y-0 items-center">
                                @foreach ($command_list_for_manager as $command_for_manager)
                                    <div wire:key="{{ $command_for_manager . '-' . $manager->user->username }}" wire:click="selectCommandForUser('{{ $manager->user->username }}', '{{ $command_for_manager }}')" class="w-fit h-fit p-1 @if ($user != null && $user->username == $manager->user->username && $command != null && $command == $command_for_manager) font-semibold @endif border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg cursor-pointer">{{ $command_for_manager }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    @if ($managers->hasPages())
                        <div>{{ $managers->links('vendor.livewire.simple-tailwind' ,['preferences' => $preferences]) }}</div>
                    @endif
                </div>
                <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-4 border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                    <p>Members</p>
                    @foreach ($members as $member)
                        <div wire:key="{{ $member->user->username }}" class="w-full h-fit p-2 flex flex-row space-x-2 space-y-0 justify-between items-center border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                            <div class="@if ($user != null && $user->username == $member->user->username) font-semibold @endif">{{ $member->user->username }}</div>
                            <div class="w-fit h-fit flex flex-row space-x-1 space-y-0 items-center">
                                @foreach ($command_list_for_member as $command_for_member)
                                    <div wire:key="{{ $command_for_member . '-' . $member->user->username }}" wire:click="selectCommandForUser('{{ $member->user->username }}', '{{ $command_for_member }}')" class="w-fit h-fit p-1 @if ($user != null && $user->username == $member->user->username && $command != null && $command == $command_for_member) font-semibold @endif border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg cursor-pointer">{{ $command_for_member }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    @if ($members->hasPages())
                        <div>{{ $members->links('vendor.livewire.simple-tailwind' ,['preferences' => $preferences]) }}</div>
                    @endif
                </div>
                <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-4 border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                    <p>Banned users</p>
                    @foreach ($banned_users as $banned_user)
                        <div wire:key="{{ $banned_user->user->username }}" class="w-full h-fit p-2 flex flex-row space-x-2 space-y-0 justify-between items-center border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                            <div class="@if ($user != null && $user->username == $banned_user->user->username) font-semibold @endif">{{ $banned_user->user->username }}</div>
                            <div class="w-fit h-fit flex flex-row space-x-1 space-y-0 items-center">
                                <div wire:click="selectCommandForUser('{{ $banned_user->user->username }}', 'unban')" class="w-fit h-fit p-1 @if ($user != null && $user->username == $banned_user->user->username && $command != null && $command == 'unban') font-semibold @endif border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg cursor-pointer">unban</div>
                            </div>
                        </div>
                    @endforeach
                    @if ($banned_users->hasPages())
                        <div>{{ $banned_users->links('vendor.livewire.simple-tailwind' ,['preferences' => $preferences]) }}</div>
                    @endif
                </div>
                <div class="w-full h-fit p-4 flex flex-col space-x-0 space-y-4 border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                    <p>Unbanned users</p>
                    @foreach ($unbanned_users as $unbanned_user)
                        <div wire:key="{{ $unbanned_user->username }}" class="w-full h-fit p-2 flex flex-row space-x-2 space-y-0 justify-between items-center border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                            <div class="@if ($user != null && $user->username == $unbanned_user->username) font-semibold @endif">{{ $unbanned_user->username }}</div>
                            <div class="w-fit h-fit flex flex-row space-x-1 space-y-0 items-center">
                                <div wire:click="selectCommandForUser('{{ $unbanned_user->username }}', 'ban')" class="w-fit h-fit p-1 @if ($user != null && $user->username == $unbanned_user->username && $command != null && $command == 'ban') font-semibold @endif border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg cursor-pointer">ban</div>
                            </div>
                        </div>
                    @endforeach
                    @if ($unbanned_users->hasPages())
                        <div>{{ $unbanned_users->links('vendor.livewire.simple-tailwind' ,['preferences' => $preferences]) }}</div>
                    @endif
                </div>
            </div>
        </div>
        <form wire:submit="createRequest">
            @csrf
            <div class="w-full h-fit flex flex-col space-x-0 space-y-2 justify-center {{ 'selection:bg-' . $preferences['color_2'] . '-500' }} {{ 'selection:text-' . $preferences['color_2'] . '-50' }}">
                <label for="title" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
                    <span class="font-medium text-left select-none">Title</span>
                    <input wire:model="title" type="text" id="title" placeholder="Change fandom's image cover" class="w-full form-textarea {{ 'placeholder:text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50/10' }} border @error('name') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" required>
                </label>
                <label for="description" class="flex flex-col space-x-0 space-y-2 justify-between items-stretch">
                    <span class="font-medium text-left select-none">Description</span>
                    <textarea wire:model="description" name="description" id="description" placeholder="The current fandom's image cover is not the latest" cols="30" rows="5" class="w-full form-textarea {{ 'placeholder:text-' . $preferences['color_2'] . '-900' }} {{ 'bg-' . $preferences['color_2'] . '-50/10' }} border @error('description') {{ 'border-' . $preferences['color_2'] . '-500' }} @else {{ 'border-' . $preferences['color_2'] . '-200' }} @enderror {{ 'accent-[' . $preferences['color_2'] . ']' }} {{ 'caret-[' . $preferences['color_2'] . ']' }} {{ 'hover:border-' . $preferences['color_2'] . '-500' }} {{ 'focus:border-' . $preferences['color_2'] . '-500' }} rounded-lg animation" required></textarea>
                </label>
                <button type="submit" class="w-fit h-fit p-2 self-end font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} select-none animation-button">Create</button>
            </div>
        </form>
    </div>
</div>