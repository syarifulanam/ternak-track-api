<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>App Ternak Terack</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        @yield('content')
    </div>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    @yield('scripts')
</body>

</html>
