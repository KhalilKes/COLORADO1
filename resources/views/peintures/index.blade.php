@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Catalogue des Peintures</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('peintures.create') }}" class="btn btn-primary mb-3">Ajouter une Peinture</a>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peintures as $peinture)
                <tr>
                    <td>{{ $peinture->id }}</td>
                    <td>
                        @if($peinture->image)
                            <img src="{{ asset('storage/' . $peinture->image) }}" alt="Peinture" width="100">
                        @else
                            <span>Aucune image</span>
                        @endif
                    </td>
                    <td>{{ $peinture->title }}</td>
                    <td>{{ $peinture->description }}</td>
                    <td>{{ number_format($peinture->price, 2) }} MAD</td>
                    <td>
                        <a href="{{ route('peintures.show', $peinture->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('peintures.edit', $peinture->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('peintures.destroy', $peinture->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
