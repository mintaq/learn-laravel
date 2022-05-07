@component('mail::message')
    # Comment was posted on post you're watching

    Hi {{ $user->name }}

    The body of your message.

    @component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id])])
        View the Blog Post
    @endcomponent

    @component('mail::button', ['url' => route('users.show', ['user' => $comment->user->id])])
        View {{ $comment->user->name }} profile
    @endcomponent

    @component('mail::panel')
        {{ $comment->content }}
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
