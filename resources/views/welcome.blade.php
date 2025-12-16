<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="mt-6">
<h1 class="text-3xl font-bold">Welcome to the Books App!</h1>
<ul>
    @if (Route::has('login'))
        @auth
            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
        @else
        <li><a href="{{ route('login') }}">Anmeldung</a></li>
            @if (Route::has('register'))
                <li><a href="{{ route('register') }}">Registrierung</a></li>
            @endif
        @endauth
    @endif
</ul>
</body>
</html>
