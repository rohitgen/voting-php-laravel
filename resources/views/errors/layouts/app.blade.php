<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header>
    <!-- Add your header content here -->
</header>

<main>
    <div class="container">
        @yield('content')
    </div>
</main>

<footer>
    <!-- Add your footer content here -->
</footer>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
