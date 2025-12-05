@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/siglog.css') }}">
@endpush

@section('content')
    <div class="container">

    <div id="naaan">

    <div id="slogan">
        <span id="maj">Welcome Back </br>To Photopotam</span></br>
        <span id="sous_titre">Our Dream View</span>
    </div>

    <div id="login_div">
        <form method="post">
            @csrf
        <h1>Se connecter</h1>

            <input name="email" type="email" placeholder="Adresse e-mail" required>
            <input name="password" type="password" placeholder="Mot de passe" required>
            <button type="submit">Se Connecter</button>

            <span>Pas encore de compte ? <a href="/signin"> S'inscrire</a></span>

        </form>
    </div>
    </div>
    <div id="appareil"><img src="{{ asset('img/appareil.png') }}"></div>

</div>
@endsection