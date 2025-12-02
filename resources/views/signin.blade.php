@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/siglog.css') }}">
@endpush

@section('content')
    <div class="container">

    <div id="naaan">
    <div id="slogan">
        <span id="maj">Welcome to Photopotam</span></br>
        <span id="sous_titre">Our Dream View</span>
    </div>

    <div id="signin_div">
        <form method="post">
            @csrf
        <h1>S'inscrire</h1>

            <input name="username" type="text" placeholder="Nom d'utilisateur" required>
            <input name="email" type="email" placeholder="Adresse e-mail" required>
            <input name="password" type="password" placeholder="Mot de passe" required>
            <input name="password_confirmation" type="password" placeholder="Confirmer le mot de passe" required>
            <button type="submit">S'inscrire</button>

            <span>Déjà un compte ? <a href="/login">Se connecter</a></span>

        </form>
    </div>
    </div>
    <div id="appareil"><img src="{{ asset('img/appareil.png') }}"></div>

</div>
@endsection