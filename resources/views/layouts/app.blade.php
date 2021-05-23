<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tres en Raya</title>

    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
    <div class="container mx-auto max-w-md mt-5">
        <div class="flex items-center justify-center text-yellow-600 text-2xl font-extrabold">
            <h1>Tres en Raya</h1>
        </div>
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
