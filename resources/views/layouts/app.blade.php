<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>🐄 App Ternak Terack</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    body {
        background-color: #f8f9fc;
        font-family: 'Nunito', sans-serif;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    .sidebar {
        width: 240px;
        background-color: #0d47a1;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        color: white;
        padding-top: 20px;
    }

    .sidebar a {
        color: #fff;
        text-decoration: none;
        padding: 10px 20px;
        display: block;
        font-size: 15px;
    }

    .sidebar a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 6px;
    }

    #content-wrapper {
        margin-left: 240px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        padding-bottom: 0;
        background-color: #f8f9fa;
    }

    .topbar {
        position: fixed;
        top: 0;
        left: 240px;
        right: 0;
        height: 60px;
        background: #fff;
        border-bottom: 1px solid #e3e6f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 30px;
        z-index: 1000;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .content-container {
        width: 100%;
        margin-top: 80px;
        padding: 0;
    }

    .search-card,
    .table-card {
        width: 100%;
        margin: 0;
        padding: 0;
        background: white;
        border-radius: 0;
        box-shadow: none;
    }

    .card-header {
        background: #fff;
        border-bottom: 1px solid #dee2e6;
        font-weight: 600;
        font-size: 15px;
    }

    .table-responsive {
        width: 100%;
        margin: 0;
        padding: 0;
    }

    table.table {
        width: 100%;
        border: 1px solid #dee2e6;
        border-radius: 0;
    }

    table.table th,
    table.table td {
        vertical-align: middle;
    }

    .btn {
        border-radius: 6px;
    }

    .btn-warning {
        color: #fff;
    }

    .sidebar .nav-section {
        font-size: 13px;
        text-transform: uppercase;
        opacity: 0.7;
        margin: 15px 20px 5px;
        font-weight: 600;
    }

    .nav-icon {
        margin-right: 10px;
        width: 18px;
        text-align: center;
    }
</style>

<body class="bg-light">
    @yield('content')

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    @yield('scripts')
</body>

</html>
