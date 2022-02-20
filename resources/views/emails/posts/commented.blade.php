<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

</style>

<p> Hi {{ $comment->commentable->user->name }}</p>

<p> Someone has commented on your blog post <a
        href="{{ route('posts.show', ['post' => $comment->commentable->id]) }}">
        {{ $comemnt->commentable->title }}</a></p>

<hr>


