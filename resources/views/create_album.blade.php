@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endpush

@section('content')

<div class="container">

    <h1>Créer un nouvel album</h1>

    <form method='post' action="{{ route('album.store') }}" class="create-form">
        @csrf

        <input name="titre" placeholder="Nom de l'album" required>
        
        <button type='submit'>Créer</button>

    </form>

</div>

@endsection