<div class="w-full h-screen max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} {{ 'text-' . $preferences['color_2'] . '-900' }} select-none overflow-clip">
    <div class="w-full h-screen max-h-[100vh] p-2 flex flex-row space-x-2 space-y-0 overflow-clip">
        <div class="w-full max-w-xl h-fit max-h-[calc(100vh-1rem)] p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg overflow-y-auto">
            <div class="w-full h-fit flex flex-col space-x-0 space-y-2 break-inside-avoid-column">
                <div class="{{ 'text-[calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.4xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-extrabold">
                    <span class="bg-clip-text text-transparent bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }}">
                      Profile
                    </span>
                </div>
                <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                    <div class="w-full h-[30vh] relative select-none">
                        @if ($cover !== null)
                            <img src="{{ asset('storage/covers/'.$cover->image->url) }}" alt="Cover image {{ $user->username }}" title="Cover image {{ $user->username }}" class="w-full h-[30vh] object-cover block rounded-lg" draggable="false">
                        @else
                            <div class="w-full h-full bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-500' }} {{ 'via-' . $preferences['color_2'] . '-500' }} {{ 'to-' . $preferences['color_3'] . '-500' }} rounded-lg">
                                <div style="background-image: url('{{ asset('cover-white.svg') }}')" class="w-full h-[30vh] bg-repeat bg-center rounded-lg"></div>
                            </div>
                        @endif
                        @if ($avatar !== null)
                            <img src="{{ asset('storage/avatars/'.$avatar->image->url) }}" alt="Avatar image {{ $user->username }}" title="Avatar image {{ $user->username }}" class="block absolute top-0 bottom-0 right-0 left-0 m-auto w-auto h-[15vh] aspect-square object-cover rounded-full" draggable="false">
                        @else
                            <div class="absolute top-0 bottom-0 right-0 left-0 m-auto w-[15vh] h-[15vh] bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-500' }} {{ 'via-' . $preferences['color_2'] . '-500' }} {{ 'to-' . $preferences['color_3'] . '-500' }} rounded-full">
                                <div style="background-image: url('{{ asset('avatar-white.svg') }}')" class="w-full h-full bg-contain bg-repeat bg-center rounded-full"></div>
                            </div>
                        @endif
                    </div>
                    <div class="w-full h-fit flex flex-col space-x-0 space-y-1 text-pretty">
                        <h1 class="w-full text-center {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)+theme(fontSize.base)-' . $preferences['font_size'] . 'px)*1.2)]' }} font-semibold">{{ $user->username }}</h1>
                        <div 
                            @switch($preferences['color_2'])
                                @case('slate')
                                    class="font-thin prose prose-base prose-slate prose-headings:text-slate-900 prose-p:text-slate-900 prose-a:text-slate-900 prose-ol:text-slate-900 prose-ul:text-slate-900 prose-blockquote:text-slate-900 prose-blockquote:border-slate-900 prose-strong:text-slate-900 prose-em:text-slate-900 prose-code:text-slate-100 prose-pre:text-slate-900 prose-hr:border-slate-200 prose-table:text-slate-900 prose-li:text-slate-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-slate-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('gray')
                                    class="font-thin prose prose-base prose-gray prose-headings:text-gray-900 prose-p:text-gray-900 prose-a:text-gray-900 prose-ol:text-gray-900 prose-ul:text-gray-900 prose-blockquote:text-gray-900 prose-blockquote:border-gray-900 prose-strong:text-gray-900 prose-em:text-gray-900 prose-code:text-gray-100 prose-pre:text-gray-900 prose-hr:border-gray-200 prose-table:text-gray-900 prose-li:text-gray-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-gray-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('zinc')
                                    class="font-thin prose prose-base prose-zinc prose-headings:text-zinc-900 prose-p:text-zinc-900 prose-a:text-zinc-900 prose-ol:text-zinc-900 prose-ul:text-zinc-900 prose-blockquote:text-zinc-900 prose-blockquote:border-zinc-900 prose-strong:text-zinc-900 prose-em:text-zinc-900 prose-code:text-zinc-100 prose-pre:text-zinc-900 prose-hr:border-zinc-200 prose-table:text-zinc-900 prose-li:text-zinc-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-zinc-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('neutral')
                                    class="font-thin prose prose-base prose-neutral prose-headings:text-neutral-900 prose-p:text-neutral-900 prose-a:text-neutral-900 prose-ol:text-neutral-900 prose-ul:text-neutral-900 prose-blockquote:text-neutral-900 prose-blockquote:border-neutral-900 prose-strong:text-neutral-900 prose-em:text-neutral-900 prose-code:text-neutral-100 prose-pre:text-neutral-900 prose-hr:border-neutral-200 prose-table:text-neutral-900 prose-li:text-neutral-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-neutral-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('stone')
                                    class="font-thin prose prose-base prose-stone prose-headings:text-stone-900 prose-p:text-stone-900 prose-a:text-stone-900 prose-ol:text-stone-900 prose-ul:text-stone-900 prose-blockquote:text-stone-900 prose-blockquote:border-stone-900 prose-strong:text-stone-900 prose-em:text-stone-900 prose-code:text-stone-100 prose-pre:text-stone-900 prose-hr:border-stone-200 prose-table:text-stone-900 prose-li:text-stone-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-stone-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('red')
                                    class="font-thin prose prose-base prose-red prose-headings:text-red-900 prose-p:text-red-900 prose-a:text-red-900 prose-ol:text-red-900 prose-ul:text-red-900 prose-blockquote:text-red-900 prose-blockquote:border-red-900 prose-strong:text-red-900 prose-em:text-red-900 prose-code:text-red-100 prose-pre:text-red-900 prose-hr:border-red-200 prose-table:text-red-900 prose-li:text-red-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-red-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('orange')
                                    class="font-thin prose prose-base prose-orange prose-headings:text-orange-900 prose-p:text-orange-900 prose-a:text-orange-900 prose-ol:text-orange-900 prose-ul:text-orange-900 prose-blockquote:text-orange-900 prose-blockquote:border-orange-900 prose-strong:text-orange-900 prose-em:text-orange-900 prose-code:text-orange-100 prose-pre:text-orange-900 prose-hr:border-orange-200 prose-table:text-orange-900 prose-li:text-orange-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-orange-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('amber')
                                    class="font-thin prose prose-base prose-amber prose-headings:text-amber-900 prose-p:text-amber-900 prose-a:text-amber-900 prose-ol:text-amber-900 prose-ul:text-amber-900 prose-blockquote:text-amber-900 prose-blockquote:border-amber-900 prose-strong:text-amber-900 prose-em:text-amber-900 prose-code:text-amber-100 prose-pre:text-amber-900 prose-hr:border-amber-200 prose-table:text-amber-900 prose-li:text-amber-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-amber-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('yellow')
                                    class="font-thin prose prose-base prose-yellow prose-headings:text-yellow-900 prose-p:text-yellow-900 prose-a:text-yellow-900 prose-ol:text-yellow-900 prose-ul:text-yellow-900 prose-blockquote:text-yellow-900 prose-blockquote:border-yellow-900 prose-strong:text-yellow-900 prose-em:text-yellow-900 prose-code:text-yellow-100 prose-pre:text-yellow-900 prose-hr:border-yellow-200 prose-table:text-yellow-900 prose-li:text-yellow-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-yellow-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('lime')
                                    class="font-thin prose prose-base prose-lime prose-headings:text-lime-900 prose-p:text-lime-900 prose-a:text-lime-900 prose-ol:text-lime-900 prose-ul:text-lime-900 prose-blockquote:text-lime-900 prose-blockquote:border-lime-900 prose-strong:text-lime-900 prose-em:text-lime-900 prose-code:text-lime-100 prose-pre:text-lime-900 prose-hr:border-lime-200 prose-table:text-lime-900 prose-li:text-lime-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-lime-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('green')
                                    class="font-thin prose prose-base prose-green prose-headings:text-green-900 prose-p:text-green-900 prose-a:text-green-900 prose-ol:text-green-900 prose-ul:text-green-900 prose-blockquote:text-green-900 prose-blockquote:border-green-900 prose-strong:text-green-900 prose-em:text-green-900 prose-code:text-green-100 prose-pre:text-green-900 prose-hr:border-green-200 prose-table:text-green-900 prose-li:text-green-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-green-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('emerald')
                                    class="font-thin prose prose-base prose-emerald prose-headings:text-emerald-900 prose-p:text-emerald-900 prose-a:text-emerald-900 prose-ol:text-emerald-900 prose-ul:text-emerald-900 prose-blockquote:text-emerald-900 prose-blockquote:border-emerald-900 prose-strong:text-emerald-900 prose-em:text-emerald-900 prose-code:text-emerald-100 prose-pre:text-emerald-900 prose-hr:border-emerald-200 prose-table:text-emerald-900 prose-li:text-emerald-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-emerald-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('teal')
                                    class="font-thin prose prose-base prose-teal prose-headings:text-teal-900 prose-p:text-teal-900 prose-a:text-teal-900 prose-ol:text-teal-900 prose-ul:text-teal-900 prose-blockquote:text-teal-900 prose-blockquote:border-teal-900 prose-strong:text-teal-900 prose-em:text-teal-900 prose-code:text-teal-100 prose-pre:text-teal-900 prose-hr:border-teal-200 prose-table:text-teal-900 prose-li:text-teal-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-teal-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('cyan')
                                    class="font-thin prose prose-base prose-cyan prose-headings:text-cyan-900 prose-p:text-cyan-900 prose-a:text-cyan-900 prose-ol:text-cyan-900 prose-ul:text-cyan-900 prose-blockquote:text-cyan-900 prose-blockquote:border-cyan-900 prose-strong:text-cyan-900 prose-em:text-cyan-900 prose-code:text-cyan-100 prose-pre:text-cyan-900 prose-hr:border-cyan-200 prose-table:text-cyan-900 prose-li:text-cyan-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-cyan-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('sky')
                                    class="font-thin prose prose-base prose-sky prose-headings:text-sky-900 prose-p:text-sky-900 prose-a:text-sky-900 prose-ol:text-sky-900 prose-ul:text-sky-900 prose-blockquote:text-sky-900 prose-blockquote:border-sky-900 prose-strong:text-sky-900 prose-em:text-sky-900 prose-code:text-sky-100 prose-pre:text-sky-900 prose-hr:border-sky-200 prose-table:text-sky-900 prose-li:text-sky-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-sky-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('blue')
                                    class="font-thin prose prose-base prose-blue prose-headings:text-blue-900 prose-p:text-blue-900 prose-a:text-blue-900 prose-ol:text-blue-900 prose-ul:text-blue-900 prose-blockquote:text-blue-900 prose-blockquote:border-blue-900 prose-strong:text-blue-900 prose-em:text-blue-900 prose-code:text-blue-100 prose-pre:text-blue-900 prose-hr:border-blue-200 prose-table:text-blue-900 prose-li:text-blue-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-blue-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('indigo')
                                    class="font-thin prose prose-base prose-indigo prose-headings:text-indigo-900 prose-p:text-indigo-900 prose-a:text-indigo-900 prose-ol:text-indigo-900 prose-ul:text-indigo-900 prose-blockquote:text-indigo-900 prose-blockquote:border-indigo-900 prose-strong:text-indigo-900 prose-em:text-indigo-900 prose-code:text-indigo-100 prose-pre:text-indigo-900 prose-hr:border-indigo-200 prose-table:text-indigo-900 prose-li:text-indigo-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-indigo-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('violet')
                                    class="font-thin prose prose-base prose-violet prose-headings:text-violet-900 prose-p:text-violet-900 prose-a:text-violet-900 prose-ol:text-violet-900 prose-ul:text-violet-900 prose-blockquote:text-violet-900 prose-blockquote:border-violet-900 prose-strong:text-violet-900 prose-em:text-violet-900 prose-code:text-violet-100 prose-pre:text-violet-900 prose-hr:border-violet-200 prose-table:text-violet-900 prose-li:text-violet-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-violet-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('purple')
                                    class="font-thin prose prose-base prose-purple prose-headings:text-purple-900 prose-p:text-purple-900 prose-a:text-purple-900 prose-ol:text-purple-900 prose-ul:text-purple-900 prose-blockquote:text-purple-900 prose-blockquote:border-purple-900 prose-strong:text-purple-900 prose-em:text-purple-900 prose-code:text-purple-100 prose-pre:text-purple-900 prose-hr:border-purple-200 prose-table:text-purple-900 prose-li:text-purple-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-purple-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('fuchsia')
                                    class="font-thin prose prose-base prose-fuchsia prose-headings:text-fuchsia-900 prose-p:text-fuchsia-900 prose-a:text-fuchsia-900 prose-ol:text-fuchsia-900 prose-ul:text-fuchsia-900 prose-blockquote:text-fuchsia-900 prose-blockquote:border-fuchsia-900 prose-strong:text-fuchsia-900 prose-em:text-fuchsia-900 prose-code:text-fuchsia-100 prose-pre:text-fuchsia-900 prose-hr:border-fuchsia-200 prose-table:text-fuchsia-900 prose-li:text-fuchsia-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-fuchsia-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('pink')
                                    class="font-thin prose prose-base prose-pink prose-headings:text-pink-900 prose-p:text-pink-900 prose-a:text-pink-900 prose-ol:text-pink-900 prose-ul:text-pink-900 prose-blockquote:text-pink-900 prose-blockquote:border-pink-900 prose-strong:text-pink-900 prose-em:text-pink-900 prose-code:text-pink-100 prose-pre:text-pink-900 prose-hr:border-pink-200 prose-table:text-pink-900 prose-li:text-pink-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-pink-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('rose')
                                    class="font-thin prose prose-base prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @default
                                    class="font-thin prose prose-base prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @endswitch>
                            {!! $profile->status !!}
                        </div>
                        <div 
                            @switch($preferences['color_2'])
                                @case('slate')
                                    class="font-thin prose prose-base prose-slate prose-headings:text-slate-900 prose-p:text-slate-900 prose-a:text-slate-900 prose-ol:text-slate-900 prose-ul:text-slate-900 prose-blockquote:text-slate-900 prose-blockquote:border-slate-900 prose-strong:text-slate-900 prose-em:text-slate-900 prose-code:text-slate-100 prose-pre:text-slate-900 prose-hr:border-slate-200 prose-table:text-slate-900 prose-li:text-slate-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-slate-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('gray')
                                    class="font-thin prose prose-base prose-gray prose-headings:text-gray-900 prose-p:text-gray-900 prose-a:text-gray-900 prose-ol:text-gray-900 prose-ul:text-gray-900 prose-blockquote:text-gray-900 prose-blockquote:border-gray-900 prose-strong:text-gray-900 prose-em:text-gray-900 prose-code:text-gray-100 prose-pre:text-gray-900 prose-hr:border-gray-200 prose-table:text-gray-900 prose-li:text-gray-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-gray-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('zinc')
                                    class="font-thin prose prose-base prose-zinc prose-headings:text-zinc-900 prose-p:text-zinc-900 prose-a:text-zinc-900 prose-ol:text-zinc-900 prose-ul:text-zinc-900 prose-blockquote:text-zinc-900 prose-blockquote:border-zinc-900 prose-strong:text-zinc-900 prose-em:text-zinc-900 prose-code:text-zinc-100 prose-pre:text-zinc-900 prose-hr:border-zinc-200 prose-table:text-zinc-900 prose-li:text-zinc-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-zinc-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('neutral')
                                    class="font-thin prose prose-base prose-neutral prose-headings:text-neutral-900 prose-p:text-neutral-900 prose-a:text-neutral-900 prose-ol:text-neutral-900 prose-ul:text-neutral-900 prose-blockquote:text-neutral-900 prose-blockquote:border-neutral-900 prose-strong:text-neutral-900 prose-em:text-neutral-900 prose-code:text-neutral-100 prose-pre:text-neutral-900 prose-hr:border-neutral-200 prose-table:text-neutral-900 prose-li:text-neutral-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-neutral-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('stone')
                                    class="font-thin prose prose-base prose-stone prose-headings:text-stone-900 prose-p:text-stone-900 prose-a:text-stone-900 prose-ol:text-stone-900 prose-ul:text-stone-900 prose-blockquote:text-stone-900 prose-blockquote:border-stone-900 prose-strong:text-stone-900 prose-em:text-stone-900 prose-code:text-stone-100 prose-pre:text-stone-900 prose-hr:border-stone-200 prose-table:text-stone-900 prose-li:text-stone-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-stone-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('red')
                                    class="font-thin prose prose-base prose-red prose-headings:text-red-900 prose-p:text-red-900 prose-a:text-red-900 prose-ol:text-red-900 prose-ul:text-red-900 prose-blockquote:text-red-900 prose-blockquote:border-red-900 prose-strong:text-red-900 prose-em:text-red-900 prose-code:text-red-100 prose-pre:text-red-900 prose-hr:border-red-200 prose-table:text-red-900 prose-li:text-red-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-red-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('orange')
                                    class="font-thin prose prose-base prose-orange prose-headings:text-orange-900 prose-p:text-orange-900 prose-a:text-orange-900 prose-ol:text-orange-900 prose-ul:text-orange-900 prose-blockquote:text-orange-900 prose-blockquote:border-orange-900 prose-strong:text-orange-900 prose-em:text-orange-900 prose-code:text-orange-100 prose-pre:text-orange-900 prose-hr:border-orange-200 prose-table:text-orange-900 prose-li:text-orange-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-orange-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('amber')
                                    class="font-thin prose prose-base prose-amber prose-headings:text-amber-900 prose-p:text-amber-900 prose-a:text-amber-900 prose-ol:text-amber-900 prose-ul:text-amber-900 prose-blockquote:text-amber-900 prose-blockquote:border-amber-900 prose-strong:text-amber-900 prose-em:text-amber-900 prose-code:text-amber-100 prose-pre:text-amber-900 prose-hr:border-amber-200 prose-table:text-amber-900 prose-li:text-amber-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-amber-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('yellow')
                                    class="font-thin prose prose-base prose-yellow prose-headings:text-yellow-900 prose-p:text-yellow-900 prose-a:text-yellow-900 prose-ol:text-yellow-900 prose-ul:text-yellow-900 prose-blockquote:text-yellow-900 prose-blockquote:border-yellow-900 prose-strong:text-yellow-900 prose-em:text-yellow-900 prose-code:text-yellow-100 prose-pre:text-yellow-900 prose-hr:border-yellow-200 prose-table:text-yellow-900 prose-li:text-yellow-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-yellow-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('lime')
                                    class="font-thin prose prose-base prose-lime prose-headings:text-lime-900 prose-p:text-lime-900 prose-a:text-lime-900 prose-ol:text-lime-900 prose-ul:text-lime-900 prose-blockquote:text-lime-900 prose-blockquote:border-lime-900 prose-strong:text-lime-900 prose-em:text-lime-900 prose-code:text-lime-100 prose-pre:text-lime-900 prose-hr:border-lime-200 prose-table:text-lime-900 prose-li:text-lime-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-lime-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('green')
                                    class="font-thin prose prose-base prose-green prose-headings:text-green-900 prose-p:text-green-900 prose-a:text-green-900 prose-ol:text-green-900 prose-ul:text-green-900 prose-blockquote:text-green-900 prose-blockquote:border-green-900 prose-strong:text-green-900 prose-em:text-green-900 prose-code:text-green-100 prose-pre:text-green-900 prose-hr:border-green-200 prose-table:text-green-900 prose-li:text-green-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-green-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('emerald')
                                    class="font-thin prose prose-base prose-emerald prose-headings:text-emerald-900 prose-p:text-emerald-900 prose-a:text-emerald-900 prose-ol:text-emerald-900 prose-ul:text-emerald-900 prose-blockquote:text-emerald-900 prose-blockquote:border-emerald-900 prose-strong:text-emerald-900 prose-em:text-emerald-900 prose-code:text-emerald-100 prose-pre:text-emerald-900 prose-hr:border-emerald-200 prose-table:text-emerald-900 prose-li:text-emerald-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-emerald-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('teal')
                                    class="font-thin prose prose-base prose-teal prose-headings:text-teal-900 prose-p:text-teal-900 prose-a:text-teal-900 prose-ol:text-teal-900 prose-ul:text-teal-900 prose-blockquote:text-teal-900 prose-blockquote:border-teal-900 prose-strong:text-teal-900 prose-em:text-teal-900 prose-code:text-teal-100 prose-pre:text-teal-900 prose-hr:border-teal-200 prose-table:text-teal-900 prose-li:text-teal-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-teal-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('cyan')
                                    class="font-thin prose prose-base prose-cyan prose-headings:text-cyan-900 prose-p:text-cyan-900 prose-a:text-cyan-900 prose-ol:text-cyan-900 prose-ul:text-cyan-900 prose-blockquote:text-cyan-900 prose-blockquote:border-cyan-900 prose-strong:text-cyan-900 prose-em:text-cyan-900 prose-code:text-cyan-100 prose-pre:text-cyan-900 prose-hr:border-cyan-200 prose-table:text-cyan-900 prose-li:text-cyan-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-cyan-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('sky')
                                    class="font-thin prose prose-base prose-sky prose-headings:text-sky-900 prose-p:text-sky-900 prose-a:text-sky-900 prose-ol:text-sky-900 prose-ul:text-sky-900 prose-blockquote:text-sky-900 prose-blockquote:border-sky-900 prose-strong:text-sky-900 prose-em:text-sky-900 prose-code:text-sky-100 prose-pre:text-sky-900 prose-hr:border-sky-200 prose-table:text-sky-900 prose-li:text-sky-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-sky-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('blue')
                                    class="font-thin prose prose-base prose-blue prose-headings:text-blue-900 prose-p:text-blue-900 prose-a:text-blue-900 prose-ol:text-blue-900 prose-ul:text-blue-900 prose-blockquote:text-blue-900 prose-blockquote:border-blue-900 prose-strong:text-blue-900 prose-em:text-blue-900 prose-code:text-blue-100 prose-pre:text-blue-900 prose-hr:border-blue-200 prose-table:text-blue-900 prose-li:text-blue-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-blue-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('indigo')
                                    class="font-thin prose prose-base prose-indigo prose-headings:text-indigo-900 prose-p:text-indigo-900 prose-a:text-indigo-900 prose-ol:text-indigo-900 prose-ul:text-indigo-900 prose-blockquote:text-indigo-900 prose-blockquote:border-indigo-900 prose-strong:text-indigo-900 prose-em:text-indigo-900 prose-code:text-indigo-100 prose-pre:text-indigo-900 prose-hr:border-indigo-200 prose-table:text-indigo-900 prose-li:text-indigo-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-indigo-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('violet')
                                    class="font-thin prose prose-base prose-violet prose-headings:text-violet-900 prose-p:text-violet-900 prose-a:text-violet-900 prose-ol:text-violet-900 prose-ul:text-violet-900 prose-blockquote:text-violet-900 prose-blockquote:border-violet-900 prose-strong:text-violet-900 prose-em:text-violet-900 prose-code:text-violet-100 prose-pre:text-violet-900 prose-hr:border-violet-200 prose-table:text-violet-900 prose-li:text-violet-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-violet-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('purple')
                                    class="font-thin prose prose-base prose-purple prose-headings:text-purple-900 prose-p:text-purple-900 prose-a:text-purple-900 prose-ol:text-purple-900 prose-ul:text-purple-900 prose-blockquote:text-purple-900 prose-blockquote:border-purple-900 prose-strong:text-purple-900 prose-em:text-purple-900 prose-code:text-purple-100 prose-pre:text-purple-900 prose-hr:border-purple-200 prose-table:text-purple-900 prose-li:text-purple-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-purple-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('fuchsia')
                                    class="font-thin prose prose-base prose-fuchsia prose-headings:text-fuchsia-900 prose-p:text-fuchsia-900 prose-a:text-fuchsia-900 prose-ol:text-fuchsia-900 prose-ul:text-fuchsia-900 prose-blockquote:text-fuchsia-900 prose-blockquote:border-fuchsia-900 prose-strong:text-fuchsia-900 prose-em:text-fuchsia-900 prose-code:text-fuchsia-100 prose-pre:text-fuchsia-900 prose-hr:border-fuchsia-200 prose-table:text-fuchsia-900 prose-li:text-fuchsia-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-fuchsia-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('pink')
                                    class="font-thin prose prose-base prose-pink prose-headings:text-pink-900 prose-p:text-pink-900 prose-a:text-pink-900 prose-ol:text-pink-900 prose-ul:text-pink-900 prose-blockquote:text-pink-900 prose-blockquote:border-pink-900 prose-strong:text-pink-900 prose-em:text-pink-900 prose-code:text-pink-100 prose-pre:text-pink-900 prose-hr:border-pink-200 prose-table:text-pink-900 prose-li:text-pink-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-pink-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @case('rose')
                                    class="font-thin prose prose-base prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                                    @break
                                @default
                                    class="font-thin prose prose-base prose-rose prose-headings:text-rose-900 prose-p:text-rose-900 prose-a:text-rose-900 prose-ol:text-rose-900 prose-ul:text-rose-900 prose-blockquote:text-rose-900 prose-blockquote:border-rose-900 prose-strong:text-rose-900 prose-em:text-rose-900 prose-code:text-rose-100 prose-pre:text-rose-900 prose-hr:border-rose-200 prose-table:text-rose-900 prose-li:text-rose-900 prose-ol:text-pretty prose-ul:text-pretty marker:text-rose-900 prose-ol:list-decimal prose-ul:list-disc prose-ol:list-inside prose-ul:list-inside"
                            @endswitch>
                            {!! $profile->description !!}
                        </div>
                    </div>
                    @if ($user->id != Auth::id())
                        <div class="w-full h-fit flex flex-row space-x-2 space-y-0 justify-center items-center select-none">
                            @livewire(FollowUnfollowButton::class, ['user1' => Auth::user()->username, 'user2' => $user->username, 'preferences' => $preferences], key('user-' . Auth::id() . '-follow-unfollow-button-for-user-' . $user->id))
                            @livewire(BlockUnblockButton::class, ['user1' => Auth::user()->username, 'user2' => $user->username, 'preferences' => $preferences], key('user-' . Auth::id() . '-block-unblock-button-for-user-' . $user->id))
                            <div wire:click="chatTo" class="w-fit h-fit p-2 font-semibold {{ 'hover:text-' . $preferences['color_2'] . '-500' }} {{ 'bg-' . $preferences['color_2'] . '-50' }} rounded-lg cursor-pointer animation-button">Chat</div>
                        </div>
                    @endif
                    <div class="w-full h-fit max-h-[40vh] flex flex-col space-x-0 space-y-1 text-center overflow-clip overflow-y-auto">
                        {{-- following and follower --}}
                        <div class="w-full h-fit grid grid-cols-2 gap-2">
                            <div class="w-full h-fit mb-1 p-2 break-inside-avoid-column flex flex-col space-x-0 space-y-1 items-center {{ 'bg-' . $preferences['color_2'] . '-50' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                                <div class="w-full flex flex-row justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10 {{ 'text-' . $preferences['color_2'] . '-900' }}">
                                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="w-fit {{ 'text-' . $preferences['color_2'] . '-900' }} text-center tracking-tighter">
                                        {{ $followers }}
                                    </p>
                                </div>
                                <p class="font-semibold {{ 'text-' . $preferences['color_2'] . '-900' }}">Followed</p>
                            </div>
                            <div class="w-full h-fit mb-1 p-2 break-inside-avoid-column flex flex-col space-x-0 space-y-1 items-center {{ 'bg-' . $preferences['color_2'] . '-50' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg">
                                <div class="w-full flex flex-row justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10 {{ 'text-' . $preferences['color_2'] . '-900' }}">
                                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="w-fit {{ 'text-' . $preferences['color_2'] . '-900' }} text-center tracking-tighter">
                                        {{ $following }}
                                    </p>
                                </div>
                                <p class="font-semibold {{ 'text-' . $preferences['color_2'] . '-900' }}">Following</p>
                            </div>
                        </div>
                        {{-- fandom --}}
                        <div class="w-full h-fit grid grid-cols-1 gap-2">
                            @foreach ($user->members as $member)
                                <div wire:key="{{ 'user-' . $user->id . '-fandom-list-fandom-' . $member->fandom->id }}" class="w-full h-fit bg-gradient-to-tr {{ 'from-' . $preferences['color_1'] . '-900' }} {{ 'via-' . $preferences['color_2'] . '-900' }} {{ 'to-' . $preferences['color_3'] . '-900' }} {{ 'selection:bg-' . $preferences['color_2'] . '-50' }} {{ 'selection:text-' . $preferences['color_2'] . '-500' }} rounded-lg">
                                    <div
                                        @if ($member->fandom->cover != null)
                                            style="background-image: url('{{ asset('storage/covers/'.$member->fandom->cover->image->url) }}')"
                                        @else
                                            style="background-image: url('{{ asset('cover-black.svg') }}')"
                                        @endif
                                        class="w-full h-fit p-4 bg-cover bg-no-repeat bg-center rounded-lg">
                                        <div class="w-full max-w-full h-fit p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/10' }} backdrop-blur-xl {{ 'text-' . $preferences['color_2'] . '-100' }} {{ 'selection:bg-' . $preferences['color_2'] . '-50' }} {{ 'selection:text-' . $preferences['color_2'] . '-500' }} rounded-lg">
                                            <h2 class="w-full h-fit overflow-x-scroll max-w-full text-nowrap {{ 'text-[calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)]' }} {{ 'leading-[calc(calc(theme(fontSize.xl)-theme(fontSize.base)+' . $preferences['font_size'] . 'px)*1.2)]' }} font-semibold">{{ $member->fandom->name }}</h2>
                                            <p class="w-full h-fit max-h-20 overflow-y-auto">
                                                {{ $member->fandom->description }}
                                            </p>
                                            <div class="w-full h-fit flex flex-row space-x-2 space-y-0 items-center justify-between">
                                                <div class="{{ 'text-' . $preferences['color_2'] . '-100' }}">Role: {{ $member->role->name }}</div>
                                                <a wire:navigate.hover href="{{ route('fandom-details', $member->fandom) }}" class="self-end" draggable="false" title="{{ $member->fandom->name }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 {{ 'hover:text-' . $preferences['color_2'] . '-500' }} cursor-pointer animation-button">
                                                        <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full h-fit flex flex-col space-x-0 space-y-2 break-inside-avoid-column">
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
                @livewire(UsersPostSearch::class, ['user' => $user->username, 'preferences' => $preferences], key('post-search-for-post-list'))
                @livewire(UsersPostList::class, ['user' => $user->username, 'preferences' => $preferences, 'static' => false], key('post-list'))
            </div>
        </div>
        <div class="w-full h-fit max-h-[calc(100vh-1rem)] p-2 flex flex-col space-x-0 space-y-2 {{ 'bg-' . $preferences['color_2'] . '-50/50' }} backdrop-blur-3xl shadow-sm {{ 'shadow-' . $preferences['color_2'] . '-900' }} rounded-lg break-inside-avoid-column overflow-clip">
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
            <div class="w-full h-fit max-h-full p-2 text-center {{ 'bg-' . $preferences['color_2'] . '-50' }} border {{ 'border-' . $preferences['color_2'] . '-200' }} rounded-lg overflow-y-auto">
                <div class="w-full h-fit flex flex-col space-x-0 space-y-2">
                    @livewire(UsersGallerySearch::class, ['user' => $user->username, 'preferences' => $preferences], key('gallery-search-for-gallery-list'))
                    @livewire(UsersGalleryList::class, ['user' => $user->username, 'preferences' => $preferences, 'static' => false], key('gallery-list'))
                </div>
            </div>
        </div>
    </div>
</div>