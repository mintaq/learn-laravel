@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    <p>Added {{ $post->created_at->diffForHumans() }}</p>

    @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5)
        <strong>New!</strong>
    @endif

    <h4>Comments</h4>
    @forelse ($post->comments as $comment)
        <p>
        <span class="text-muted">[{{ $comment->created_at }}]</span> {{ $comment->content }}</p>
    @empty
        <p>No comments!</p>
    @endforelse
@endsection('content')
