<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KISSAPP</title>
    <link rel="stylesheet" href="{{ asset('css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>

</head>
<body>

@yield('main')

<script src="{{ asset('js/semantic.min.js') }}"></script>
<script src="{{ asset('js/kissapp.js') }}"></script>

</body>
</html>
