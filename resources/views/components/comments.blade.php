<div class="post__comments flex flex-col p-1">
    @if($post != null && $post->comments->count() > 5)
        <x-throttle />
    @endif
    @foreach($comments as $comment)
        <x-comment :comment="$comment" />
    @endforeach
</div>
<div class="w-full flex items-center justify-center">
    <form class="flex items-center justify-between w-4/5">
        <textarea placeholder="write a comment" name="body" cols="40"></textarea>
        <button style="color:white" class="p-2 m-1 write-comment">Comment</button>
    </form>
</div>
