@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de la Peinture</h1>
    <div class="card">
        <div class="card-body">
            @if($peinture->image)
                <img src="{{ asset('storage/' . $peinture->image) }}" alt="Peinture" class="img-fluid">
            @endif
            <h3 class="mt-3">{{ $peinture->title }}</h3>
            <p>{{ $peinture->description }}</p>
            <p><strong>Prix:</strong> {{ number_format($peinture->price, 2) }} MAD</p>
            <a href="{{ route('peintures.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>
@endsection