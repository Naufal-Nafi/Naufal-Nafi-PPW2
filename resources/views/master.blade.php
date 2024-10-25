<!-- resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    @vite('resources/sass/app.scss', 'resources/js/app.js')
</head>
<body>
    <header>
        <h1>Website Laravel Sederhana</h1>
        <nav>
            <a href="/home">Home</a>
            <a href="/about">About</a>
            <a href="/contact">Contact</a>
        </nav>
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer>
        <p>&copy; 2024 Simple Laravel Website</p>
    </footer>
</body>
</html>


