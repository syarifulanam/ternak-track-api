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
    <style>
        body {
            overflow-x: hidden;
            font-family: "Segoe UI", Arial, sans-serif;
            font-size: 0.875rem;
            background-color: #fdfdfd;
            color: #212529;
        }

        .sidebar {
            width: 220px;
            position: fixed;
            top: 60px;
            left: 0;
            height: calc(100vh - 60px);
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
            padding: 0.5rem 0.75rem;
            z-index: 1000;
            overflow-y: auto;
        }

        main {
            margin-left: 220px;
            padding: 1.25rem;
            margin-top: 60px;
        }

        .sidebar .nav-link {
            color: #343a40;
            font-size: 0.82rem;
            padding: 0.45rem 0.75rem 0.45rem 1rem;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
            text-align: left;
            transition: all 0.2s ease-in-out;
            /* margin-bottom: 2px; */
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active,
        .sidebar .nav-link.fw-bold {
            color: #495057;
            background-color: #e9ecef;
            font-weight: 500;
        }

        .sidebar-heading {
            color: #6c757d;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 1.25rem;
            margin-bottom: 0.5rem;
            padding-left: 1rem;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: #ced4da;
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background-color: #adb5bd;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                {{-- <h1 class="mb-4">🐄 App Ternak Terack</h1> --}}
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    @yield('scripts')
</body>

</html>
