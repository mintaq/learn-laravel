@extends('layouts.app')

@section('content')
    @if ($post->image)
        <div
            style="background-image: url('{{ $post->image->url() }}'); min-height: 500px; color: white; text-align: center; background-attachment: fixed;">
            <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
            @else
                <h1>
    @endif
    <h1>{{ $post->title }}

        @if ((new Carbon\Carbon())->diffInDays($post->created_at) < 10)
            <x-badge show="true">
                New Post!
            </x-badge>
        @endif
    </h1>

    @if ($post->image)
        </h1>
        </div>
    @else
        </h1>
    @endif

    <p>{{ $post->content }}</p>

    @component('components.updated', ['date' => $post->created_at, 'name' => $post->user->name])
    @endcomponent
    @component('components.updated', ['date' => $post->updated_at])
        Updated
    @endcomponent
    <p>Currently read by {{ $counter }} people</p>



    <h4 class="mt-3">Tags</h4>
    <ul>
        @forelse ($post->tags as $tag)
            <a href="{{ route('posts.tags.index', ['id' => $tag->id]) }}"
                class="badge badge-success badge-lg">{{ $tag->name }}</a>
        @empty
        @endforelse
    </ul>

    {{-- <div class="mb-2 mt-2">
        @auth
            <form method="POST" action="{{ $route }}">
                @csrf

                <div class="form-group">
                    <textarea type="text" name="content" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Add comment</button>
            </form>
            @errors @enderrors
        @else
            <a href="{{ route('login') }}">Sign-in</a> to post comments!
        @endauth
    </div>
    <hr /> --}}

    <h4>Comments</h4>

    @component('components.comment-form', ['route' => route('posts.comments.store', ['post' => $post->id])])
    @endcomponent

    @component('components.comment-list', ['comments' => $post->comments])
    @endcomponent
@endsection('content')
