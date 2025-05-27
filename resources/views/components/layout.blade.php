<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Mibo' }}</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
        body {
            font-family: Inter, sans-serif;
        }
    </style>

</head>
<body>
    <header class="border-b mb-10">
        <nav class="mx-auto flex max-w-5xl items-center justify-between p-6">
            <a href="/" class="text-2xl underline underline-offset-3 decoration-yellow-300">mibo</a>
            <menu class="flex gap-3">
                <li><a href="/">Beranda</a></li>
            </menu>
            <menu class="flex gap-3">
                @auth
                <li><a href="{{ route('user.account') }}">Akun</a></li>
                @else
                <li><a class="p-2 px-3 bg-black text-white rounded-sm" href="{{ route('login') }}">Log In</a></li>
                <li><a class="p-2 px-3 bg-yellow-300 rounded-sm" href="{{ route('signup') }}">Sign Up</a></li>
                @endauth
            </menu>
        </nav>
    </header>
    <main class="mx-auto max-w-5xl px-6 mb-4">
        {{ $slot }}
    </main>
</body>
</html>