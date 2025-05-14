<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Amazon Clone')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('frontend/usercss/style.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @include('User-dashboard.partials.header')

    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    @include('User-dashboard.partials.footer')
    @include('User-dashboard.partials.cart-sidebar')

    <script src="{{ asset('frontend/userjs/script.js') }}"></script>
    @stack('scripts')
</body>
</html>