@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/siglog.css') }}">
@endpush

@section('content')

<div class="container">

<div id="signin_div">
    <form method="post">

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

@endsection