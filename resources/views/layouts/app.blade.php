<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }} class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ config('app.name', 'StudentCoins') }}</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    @include('partials.header')
    <main class="container">
        @yield('content')
    </main>
</body>
</html>
