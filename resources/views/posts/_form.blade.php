<div class="form-group mb-3">
    <label>Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $post->title ?? null) }}" />
</div>

<div class="form-group mb-3">
    <label>Content</label>
    <input type="text" name="content" class="form-control" value="{{ old('content', $post->content ?? null) }}" />
</div>

<div class="form-group mb-3">
    <label>Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control" />
</div>

@component('components.errors')
@endcomponent
