@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Comment</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>
                        <h3>
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                        </h3>
                        <p>
                            Added {{ $post->created_at->diffForHumans() }}
                            by {{ $post->user->name }}
                        </p>
                    </td>
                    <td>
                        @if ($post->comments_count)
                            <p>{{ $post->comments_count }} comments</p>
                        @else
                            <p>No comments yet!</p>
                        @endif
                    </td>
                    <td>
                        <div class="container xs">
                            <div class="row justify-content-start">
                                @can('update', $post)
                                    <div class="col-6 col-sm-3">
                                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">
                                            Edit
                                        </a>
                                    </div>
                                @endcan
                                @can('delete', $post)
                                    <div class="col-6 col-sm-3">
                                        <form method="POST" class="fm-inline"
                                            action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                                            @csrf
                                            @method('DELETE')

                                            <input type="submit" value="Delete!" class="btn btn-danger" />
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <p>No blog posts yet!</p>
            @endforelse


    </table>

@endsection('content')
