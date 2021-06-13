<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Blaze') }} | Blaze Scaffolding</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
    </head>
    <body class="font-sans antialiased leading-normal bg-white text-gray-600">
        @inertia
    </body>

    <script src="{{ mix('js/app.js') }}"></script>
</html>
