@extends('layouts.app')

@section('title', 'Contact Page')

@section('content')
    <h1>Contact</h1>

    @can('home.secret')
        <a href="{{ route('home.secret') }}">Secret page</a>
    @endcan
@endsection
