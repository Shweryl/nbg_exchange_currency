<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Exchange</title>

    {{-- Select 2 Cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- select 2 cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Styles / Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div class="container-fluid px-0">
        @include('header')

        <main class="container mt-5">
            @yield('content')
        </main>
    </div>

    @stack('js')
    

</body>

</html>
