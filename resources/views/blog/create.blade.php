@extends('layout')

@section('title', 'edit' . $post->title)


@section('content')

    <div class=" py-4 d-flex justify-content-between align-items-center">
        <h4 class="text-dashed">Create new post</h4>
        <a class="btn btn-sm btn-primary" href="{{ route('blog.index') }}"> Liste des posts</a>
    </div>

    @include('blog.form')


@endsection
