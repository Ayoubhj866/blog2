@extends('layout')

@section('title', 'statistiques des postes')

@section('content')
    <h1>Etat des posts par catégorie</h1>
    <div class="mt-4">
        <table class="table table-light">
            <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Nombre de Posts</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tableData as $category => $postCount)
                    <tr>
                        <td>{{ $category }}</td>
                        <td>{{ $postCount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
