@extends('layout')


@section('title', 'liste des posts')

@section('content')
    {{-- Title --}}

    <div class=" py-4 d-flex justify-content-between align-items-center">
        <h4 class="text-dashed">Create new post</h4>
        <a class="btn btn-sm btn-primary" href="{{ route('blog.create') }}"> New post</a>
    </div>


    {{-- Cards --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($posts as $post)
            <div class="col">
                <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                            dy=".3em">
                            {{ $post->title }}
                        </text>
                    </svg>
                    <div class="card-body">
                        <div class="cat">
                            <span class="badge badge-primary text-secondary">
                                {{ $post->category->name }}
                            </span>
                        </div>

                        <p class="card-text">
                            {{ $post->content }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}"
                                    type="button" class="btn btn-sm btn-outline-secondary">View</a>
                                <a href="{{ route('blog.edit', ['post' => $post->id]) }}" type="button"
                                    class="btn btn-sm btn-outline-secondary">Edit</a>
                            </div>
                            <small class="text-body-secondary">{{ $post->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4 text-end">
        {{-- pagination --}}
        {{ $posts->links() }}
    </div>



@endsection
