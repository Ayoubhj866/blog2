@extends('layout')


@section('title', 'liste des posts')

@section('content')


    {{-- Header -- Title --}}

    <div class=" py-4 d-flex justify-content-between align-items-center">
        @isset($filter)
            @if ($filter)
                @if ($filter === 'category')
                    <h4 class="text-dashed">Posts Filtred by category</h4>
                @elseif ($filter === 'tags')
                    <h4 class="text-dashed">Posts Filtred by tag</h4>
                @endif
                <a href="{{ route('blog.index') }}" class="btn btn-sm btn-danger">Cancel filter</a>
            @endif
        @else
            <h4 class="text-dashed"> All posts </h4>
        @endisset

        <a class="btn btn-sm btn-primary" href="{{ route('blog.create') }}"> New post</a>
    </div>

    {{-- Cards  of posts --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($posts as $post)
            {{-- Pour chaque itération on affiche tout ça (card) --}}
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
                        <div class="d-flex justify-content-between align-atems-center">

                            {{-- Category --}}
                            <div class="category">
                                @if ($post->category)
                                    <a href="{{ route('blog.filter', ['value' => $post->category?->name, 'relation' => 'category']) }}"
                                        class="badge badge-primary text-secondary text-decoration-none">
                                        {{ $post->category?->name }}
                                    </a>
                                @endif
                            </div>

                            {{-- Tags span --}}
                            <div class="tags">
                                @if (!$post->tags->isEmpty())
                                    @foreach ($post->tags as $tag)
                                        <a href="{{ route('blog.filter', ['value' => $tag->name, 'relation' => 'tags']) }}"
                                            style="cursor: pointer;"
                                            class="badge rounded-pill text-bg-primary text-decoration-none">{{ $tag?->name }}</a>
                                    @endforeach
                                @endif
                            </div>


                        </div>
                        <p class="card-text">
                            {{ $post->content }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}"
                                    class="btn btn-sm btn-outline-secondary icon-link gap-1 icon-link-hover stretched-link">View</a>
                                <a href="{{ route('blog.edit', ['post' => $post->id]) }}" type="button"
                                    class="btn btn-sm btn-outline-secondary">Edit</a>
                            </div>
                            <small class="text-body-secondary">{{ $post->created_at->diffForHumans() }}</small>
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
