@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    <p>Added {{ $post->created_at->diffForHumans() }}</p>
    <p>Currently read by {{ $counter }} people</p>

    @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5)
        <strong>New!</strong>
    @endif

    <h4>Tags</h4>
    <ul>
        @forelse ($post->tags as $tag)
            <a href="{{ route('posts.tags.index', ['id' => $tag->id]) }}"
                class="badge badge-success badge-lg">{{ $tag->name }}</a>
        @empty
        @endforelse
    </ul>

    <h4>Comments</h4>
    @forelse ($post->comments as $comment)
        <p>
            <span class="text-muted">[{{ $comment->created_at }}]</span> {{ $comment->content }}
        </p>
    @empty
        <p>No comments!</p>
    @endforelse
@endsection('content')
