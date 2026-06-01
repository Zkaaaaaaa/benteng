<!DOCTYPE html>
<html lang="{{ request()->routeIs('client.index') ? 'en' : 'nl' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Benteng Indonesische Delicatessen')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset_version('assets/css/style.css') }}">
    @stack('styles')
</head>

<body>

    @include('layouts.client.navbar')

    <main>
        @yield('content')
    </main>

    <script src="{{ asset_version('assets/js/client.js') }}" defer></script>
    @stack('scripts')
</body>

</html>
