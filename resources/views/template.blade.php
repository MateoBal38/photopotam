<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('css')
    <title>Photopotam</title>
</head>
<body>
    
    <header>
        <div class="container site-header">
            <div class="logo">
                <div class="mark"></div>
                <div>Photopotam</div>
            </div>
            <nav class="site-nav">
                <a href="/">Accueil</a>
                <a href="/album">Albums</a>
                @guest
                <a href="{{ route('register') }}">S'inscrire</a>
                <a href="{{ route('login') }}">Se connecter</a>
                @endguest
                @auth
                <a href="{{ route('album.create') }}" class="btn ghost">Nouveau</a>
                <a href="/perso" class="btn ghost">Mon espace</a>
                <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout').submit();" class="btn ghost">Logout</a>
                <form id="logout" action="{{route('logout')}}" method="post" style="display:none">@csrf</form>
                @endauth
            </nav>
        </div>
    </header>

    <main class="content">
        @yield('content')
    </main>

    <footer>
        <span>Photopotam - 2025. All rights reserved, Property of LEGRAND Alexandre and BAL Matéo. MMI CORPORATION</span>
    </footer>

</body>
</html>