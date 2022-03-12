@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}" enctype="multipart/form-data"
        class="form-horizontal">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-4">
                <img src="" alt="" class="img-thumbnail avatar">
                <div class="card mt-4">
                    <div class="card-body">
                        <h6>Upload a different photo</h6>
                        <input type="file" class="form-control-file" name="avatar">
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <label for="">Name: </label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" value="Save change">
                </div>
            </div>
        </div>
    </form>
@endsection
