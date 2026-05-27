<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benteng Indonesische Delicatessen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Raleway:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    @stack('styles')
</head>

<body>

    {{-- NAVBAR --}}
    @include('layouts.client.navbar')

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>
