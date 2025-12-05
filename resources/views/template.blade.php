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
        <nav>
        <a href="/">index</a>
        <a href="/album">album</a>
        @guest
        <a href="/register">signin</a>
        <a href="/login">login</a>
        @endguest
        </nav>
    </header>

    @auth
        <h1>Bonjour {{Auth::user()->name}}</h1>
        
        <a href="/create_album">Créer un album</a>

        <a href="{{route("logout")}}"
           onclick="document.getElementById('logout').submit(); return false;">Logout</a>
        <form id="logout" action="{{route("logout")}}" method="post">
            @csrf
        </form>
    @endauth

    <main class="content">
        @yield('content')
    </main>

    <footer>
        <span>Photopotam - 2025. All rights reserved, Property of LEGRAND Alexandre and BAL Matéo. MMI CORPORATION</span>
    </footer>

</body>
</html>