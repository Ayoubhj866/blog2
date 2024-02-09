@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



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
        <textarea class="form-control @error('content')  is-invalid @enderror" name="content" id="content"
            placeholder="Contenu du blog">{{ old('content', $post->content) }}</textarea>
        <div id="title" class="invalid-feedback">
            @error('content')
                {{ $message }}
            @enderror
        </div>
    </div>


    {{-- Category --}}
    <div class="form-group  pt-2">
        <div class="mb-3">
            <select class="form-select @error('category_id')  is-invalid @enderror " id="category" form-select-lg"
                name="category_id" id="category_id">
                <option disabled>Selectionner une catégorie</option>
                @foreach ($categories as $categorie)
                    <option @selected(old('category_id', $post->category_id) === $categorie->id) class="option" value="{{ $categorie->id }}">
                        {{ $categorie->name }}</option>
                @endforeach
            </select>
            <div id="category_id" class="invalid-feedback">
                @error('category_id')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>

    {{-- 1 - stocker les tags dans un tableau --}}
    @php
        $tagsIds = $post->tags()->pluck('id'); //représente les id des tags qui sont déja dans la base de donnée correspondants au poste actuelle
    @endphp


    {{-- Tags --}}
    <div class="form-group  pt-2">
        <div class="mb-3">
            <select class="form-select @error('tags')  is-invalid @enderror " id="tag_id" form-select-lg"
                name="tags[]" multiple>
                <option disabled>Selectionner des tags (click ctl to select multuple tags)</option>
                @foreach ($tags as $tag)
                    <option @selected($tagsIds->contains($tag->id)) class="option" value="{{ $tag->id }}">
                        {{ $tag->name }}</option>
                @endforeach
            </select>
            <div id="tag_id" class="invalid-feedback">
                @error('tags')
                    {{ $message }}
                @enderror
            </div>
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
