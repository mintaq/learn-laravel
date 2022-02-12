@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
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
                                    @if ($post->trashed())
                                        <del>
                                    @endif
                                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                                    @if ($post->trashed())
                                        </del>
                                    @endif
                                </h3>
                                <p>
                                    Added {{ $post->created_at->diffForHumans() }}
                                    by {{ $post->user->name }}
                                </p>
                                <p>
                                    @forelse ($post->tags as $tag)
                                    <a href="{{ route('posts.tags.index', ['id' => $tag->id]) }}"
                                        class="badge badge-success badge-lg">{{ $tag->name }}</a>
                                @empty
                                @endforelse
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
                                        @auth
                                            @can('update', $post)
                                                <div class="col-6 col-sm-3">
                                                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                                        class="btn btn-primary">
                                                        Edit
                                                    </a>
                                                </div>
                                            @endcan
                                        @endauth
                                        @auth
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
                                        @endauth
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <p>No blog posts yet!</p>
                    @endforelse
            </table>
        </div>
        <div class="col-4">
            <div class="container">
                <div class="row">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Most Commented</h5>
                            <p class="card-text">What people are currently talking about</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostCommented as $post)
                                <li class="list-group-item">
                                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Most Active</h5>
                            <p class="card-text">User with most posts written</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostActive as $user)
                                <li class="list-group-item">
                                    {{ $user->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Most Active Last Moth</h5>
                            <p class="card-text">User with most posts written last month</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostActiveLastMonth as $user)
                                <li class="list-group-item">
                                    {{ $user->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
