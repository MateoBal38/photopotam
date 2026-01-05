@extends('template')

@section('content')
<div class="container error-page">
    <div class="error-content">
        <div class="error-code">404</div>
        <h1>Oups ! Page introuvable</h1>
        <p>La page que vous cherchez semble avoir disparu dans les backrooms du web.</p>
        <p>Peut-être qu'elle a été déplacée, supprimée ou annihilée.....</p>
        <a href="/" class="btn">Retour à l'accueil</a>
    </div>
</div>
@endsection