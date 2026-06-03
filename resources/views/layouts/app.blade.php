<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Blueprint Project')</title>


<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: #f4f6f9;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar-custom {
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        box-shadow: 0 4px 15px rgba(0, 0, 0, .15);
    }

    .navbar-brand {
        font-size: 1.4rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .navbar-brand i {
        margin-right: 6px;
    }

    .content-wrapper {
        flex: 1;
    }

    .card {
        border: none;
        border-radius: 15px;
    }

    .card-header {
        border-radius: 15px 15px 0 0 !important;
    }

    .btn {
        border-radius: 10px;
    }

    .table {
        margin-bottom: 0;
    }

    .table-hover tbody tr:hover {
        background: rgba(13, 110, 253, 0.05);
    }

    .footer {
        background: #212529;
        color: #fff;
        padding: 15px 0;
        margin-top: 30px;
    }

    .footer small {
        opacity: .85;
    }

    .page-title {
        font-weight: 700;
    }

    .shadow-custom {
        box-shadow: 0 8px 20px rgba(0,0,0,.08);
    }
</style>

</head>

<body>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">

        <a class="navbar-brand" href="/">
            <i class="bi bi-box-seam-fill"></i>
            Laravel Blueprint Project
        </a>

        <div class="d-flex gap-2">

            <a href="{{ route('products.index') }}"
               class="btn btn-light btn-sm fw-semibold">
                <i class="bi bi-grid"></i>
                Products
            </a>

            <a href="{{ route('products.create') }}"
               class="btn btn-warning btn-sm fw-semibold">
                <i class="bi bi-plus-circle"></i>
                Add Product
            </a>

        </div>

    </div>
</nav>

<!-- Main Content -->
<div class="container py-4 content-wrapper">

    @yield('content')

</div>

<!-- Footer -->
<footer class="footer">
    <div class="container text-center">

        <small>
            © {{ date('Y') }} Laravel Blueprint Project |
            Built with Laravel 12, Bootstrap 5 & Blueprint CRUD Generator
        </small>

    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
