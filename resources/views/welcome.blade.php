<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-900 flex items-start justify-center pt-16">

<div class="w-full max-w-2xl bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700 p-8">

    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        Welcome to the Books App!
    </h1>

    <ul class="space-y-3">
        @if (Route::has('login'))
            @auth
                <li>
                    <a href="{{ url('/dashboard') }}"
                       class="inline-flex items-center font-semibold text-indigo-600 hover:text-indigo-700 transition">
                        Dashboard
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center font-semibold text-indigo-600 hover:text-indigo-700 transition">
                        Anmeldung
                    </a>
                </li>

                @if (Route::has('register'))
                    <li>
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center font-semibold text-gray-700 hover:text-gray-900 transition
                                      dark:text-gray-300 dark:hover:text-gray-100">
                            Registrierung
                        </a>
                    </li>
                @endif
            @endauth
        @endif
    </ul>

</div>

</body>
</html>
