@extends('layout')

@section('title', "s'authentifier")

@section('content')

    @error('invalidInfos')
        <div class="w-100 d-flex justify-content-center py-4 bg-light timeOutAlert">
            <span class="alert alert-danger m-auto w-100">
                {{ $message }}
            </span>
        </div>
    @enderror



    <form action="" method="post" class="col-lg-4 m-auto pt-5">
        @csrf
        <div class="mb-3">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="abc@mail.com"
                    value="{{ old('email') }}" />
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="password" />
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mt-2">
                <button class="btn btn-primary">Se connecter</button>
            </div>
        </div>
    </form>

@endsection
