<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>App Ternak Terack</title>

    <link rel="icon" 
          href='data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
          <text y="70" font-size="80">🐄</text></svg>' 
          type="image/svg+xml">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5 text-center">
        {{-- <h1 class="mb-4">🐄 App Ternak Terack</h1> --}}
        @yield('content')
    </div>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    @yield('scripts')
</body>

</html>