<div wire:scroll class="w-full h-hit max-h-[calc(100vh-160px)] p-2 flex flex-col space-x-0 space-y-2 overflow-y-auto overflow-x-clip text-[{{ $preferences['color_text'] }}] bg-[{{ $preferences['color_primary'] }}] border-0 border-transparent rounded-lg">
    <div class="w-full h-fit flex flex-row justify-between items-center {{ 'text-[calc('.$preferences['font_size'] . 'px+2px)]' }}">
        <div>Post @if($mode == 'create') Create @else Edit @endif</div>
        <div class="p-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">Save Post</div>
    </div>
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
        <div class="{{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">Title</div>
        <ul class="{{ 'text-[calc('.$preferences['font_size'] . 'px-2px)]' }}">
            <li>Rules:</li>
            <li>Must not empty</li>
            <li>5 - 50 digit characters</li>
            <li>Must unique</li>
        </ul>
        <input type="text" class="form-input border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg" placeholder="Post Title">
    </div>
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
        <div class="{{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">Description</div>
        <ul class="{{ 'text-[calc('.$preferences['font_size'] . 'px-2px)]' }}">
            <li>Rules:</li>
            <li>Must not empty</li>
            <li>10 - 100 digit characters</li>
        </ul>
        <textarea class="form-input border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg" placeholder="Post Description"></textarea>
    </div>
    <div class="w-full h-fit p-2 flex flex-col space-x-0 space-y-2 border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg">
        <div class="{{ 'text-[calc('.$preferences['font_size'] . 'px)]' }}">Tags</div>
        <ul class="{{ 'text-[calc('.$preferences['font_size'] . 'px-2px)]' }}">
            <li>Rules:</li>
            <li>Must not empty</li>
            <li>1 - 100 digit characters</li>
            <li>No space</li>            
            <li>Separate with comma for more than one tag</li>
            <li>Example: Funny,Cute</li>
        </ul>
        <textarea class="form-input border {{ 'border-['.$preferences['color_secondary'].']' }} rounded-lg" placeholder="Post Tags"></textarea>
    </div>
</div>