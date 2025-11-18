<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('css')
    <title>Document</title>
</head>
<body>
    
    <header>

        <a href="/">index</a>
        <a href="/album">album</a>
        <a href="/signin">signin</a>
        <a href="/login">login</a>

    </header>

    @yield('content')


    <footer>

        <span>Photopotam - 2025. All rights reserved</span>
        <span>Property of LEGRAND Alexandre and BAL Matéo. MMI CORPORATION</span>

    </footer>

</body>
</html>