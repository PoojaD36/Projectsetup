<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Your custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/usercss/products.css') }}">
</head>

<body>

    @include('User-dashboard.layouts.header')
 
    @yield('content')


    <script src="{{ asset('frontend/userjs/products.js') }}"></script>
    @stack('scripts')
 @include('User-dashboard.layouts.footer')


 </body>
</html>