<form action="" method="post">
    {{-- csrf pour asurer que cette formulaire est appartient à notre site lors de soumission --}}
    @csrf
    <div class="form-group">
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
            aria-describedby="validationServer03Feedback" placeholder="Titre du blog"
            value="{{ old('title', $post->title) }}" required>
        <div id="title" class="invalid-feedback">
            @error('title')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group  pt-2">
        <textarea class="form-control @error('content')  is-invalid @enderror" aria-describedby="validationServer03Feedback"
            name="content" id="content" placeholder="Contenu du blog">{{ old('content', $post->content) }}</textarea>
        <div id="title" class="invalid-feedback">
            @error('content')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group mt-2">
        @if ($post->id)
            <button class="btn btn-sm btn-danger pt-2">Save changes</button>
        @else
            <button class="btn btn-sm btn-primary pt-2">Create</button>
        @endif
    </div>
</form>
