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
        <a href="/signin">signin</a>
        <a href="/login">login</a>
        </nav>
    </header>

    <main class="content">
        @yield('content')
    </main>

    <footer>
        <span>Photopotam - 2025. All rights reserved, Property of LEGRAND Alexandre and BAL Matéo. MMI CORPORATION</span>
    </footer>

</body>
</html>