<!doctype html>
<html lang="en-US">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('assets/frontend/images/favicon.png') }}" />
    <!-- Bootstrap CSS -->
    
    @stack('styles')
</head>

<body>
    <div id="app">
        <div>
            @yield('content')
        </div>
    </div>
    {{-- vue js --}}
    <script src="{{ url('js/app.js') }}" type="text/javascript"></script>
    @stack('scripts')
</body>

</html>
