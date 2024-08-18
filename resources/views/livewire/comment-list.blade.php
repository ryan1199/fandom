<div class="w-full h-fit flex flex-col space-x-0 space-y-4">
    @foreach ($child_comments as $child_comment)
        @livewire(CommentDetails::class, ['comment' => $child_comment, 'comments' => $comments, 'reply' => $reply, 'preferences' => $preferences], key('comment-' . $child_comment->id))
    @endforeach
</div>