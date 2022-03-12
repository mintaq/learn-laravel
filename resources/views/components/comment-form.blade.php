<div class="mb-2 mt-2">
    @auth
        <form method="POST" action="{{ $route }}">
            @csrf

            <div class="form-group mb-3">
                <textarea type="text" name="content" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Add comments!</button>
        </form>
        @component('components.errors')
        @endcomponent
    @else
        <a href="{{ route('login') }}">Sign in!</a> to post comments!
    @endauth
</div>
<hr>
