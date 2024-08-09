<div class="w-full h-full max-h-[100vh] {{ 'text-[' . $preferences['font_size'] . 'px]' }} {{ 'leading-[calc(' . $preferences['font_size'] . 'px*1.2)]' }} {{ 'font-[' . $preferences['selected_font_family'] . ']' }} text-zinc-500 bg-zinc-100/95 overflow-y-auto">
    <div class="w-full h-fit p-2">
        <div class="w-full h-full grid grid-cols-3 grid-flow-row-dense gap-2">
            @for ($i = 0; $i < 10; $i++)
                <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 bg-zinc-50 border border-zinc-200 rounded-lg">
                    <div class="bg-gradient-to-tr {{ 'from-[' . $preferences['color_1'] . ']' }} {{ 'via-[' . $preferences['color_2'] . ']' }} {{ 'to-[' . $preferences['color_3'] . ']' }} rounded-lg">
                        <img src="{{ asset('login_cover.svg') }}" alt="Login image" title="Login image" class="w-full h-full max-h-[30vh] object-cover block border border-zinc-200 rounded-lg">
                    </div>
                    <div class="w-full h-hit p-2 text-center bg-zinc-50 border border-zinc-200 rounded-lg">
                        <h1>Home page</h1>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ipsam excepturi perferendis
                            libero. Explicabo quaerat vel placeat quos neque vero voluptatem maxime illum rem
                            necessitatibus reprehenderit, deserunt est voluptatum perspiciatis?
                        </p>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>