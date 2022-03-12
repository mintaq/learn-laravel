@forelse ($comments as $comment)
    <p>
        <span class="text-muted">[{{ $comment->user->name }}]</span>
        {{ $comment->content }}
    </p>
    @component('components.updated', ['date' => $comment->created_at, 'userId' => $comment->user->id])
    @endcomponent
@empty
    <p>No comments!</p>
@endforelse
