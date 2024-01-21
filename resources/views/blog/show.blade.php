@extends('layout')

@section('title', 'show post')



@section('content')

    <div class=" py-4 d-flex justify-content-between align-items-center">
        <h4 class="text-dashed">Post details</h4>
        <a class="btn btn-sm btn-primary" href="{{ route('blog.index') }}">
            Back</a>
    </div>

    @session('success')
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="myAlert">
            <strong>Cool !</strong> {{ session('success') }}.
            <button type="button" class="btn-close" onclick="closeAlert()" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession


    <div class="row mb-2 mt-5">
        <div class="col-md-6 m-auto">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
                    <h3 class="mb-0">
                        {{ $post->content }}
                    </h3>
                    <div class="mb-1 text-body-secondary">
                        posté {{ $post->created_at->diffForHumans() }}
                    </div>
                    <p class="card-text mb-auto">
                        {{ $post->content }}
                    </p>

                    <a href="{{ route('blog.edit', ['post' => $post->id]) }}" class="icon-link gap-1 icon-link-hover ">
                        Edit
                    </a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg"
                        role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                        focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                            dy=".3em">Thumbnail</text>
                    </svg>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script>
        const mAlert = document.getElementById('myAlert');
        console.log(mAlert);

        function closeAlert() {
            mAlert.style.display = "none";
        }
    </script>
@endsection
