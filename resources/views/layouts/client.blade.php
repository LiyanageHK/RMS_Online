<!DOCTYPE html>
<html lang="en">
<head>
    <title>Flame & Crust - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/client.css') }}">
<script src="{{ asset('js/client.js') }}" defer></script>

</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">

    @include('partials.client.header')

    <main style="flex: 1;">
        @yield('content')
        @yield('scripts')
    </main>

    @include('partials.client.footer')

</body>

</html>
