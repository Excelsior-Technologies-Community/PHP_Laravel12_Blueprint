<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Laravel Blueprint Project')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        [data-bs-theme="light"] body {
            background: #f4f6f9;
        }

        [data-bs-theme="dark"] body {
            background: #0d1117;
            color: #c9d1d9;
        }

        body {
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

        [data-bs-theme="dark"] .table-hover tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
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

        /* Dark mode overrides */
        [data-bs-theme="dark"] .card {
            background: #1f1f30;
            border-color: #2a2a40;
        }

        [data-bs-theme="dark"] .card-header {
            background: #1f1f30 !important;
            border-color: #2a2a40;
        }

        [data-bs-theme="dark"] .table-dark {
            background: #13131a !important;
        }

        [data-bs-theme="dark"] .table-dark th {
            color: #e9ecef;
        }

        [data-bs-theme="dark"] .bg-secondary {
            background: #4a4a5a !important;
        }

        [data-bs-theme="dark"] .badge.bg-success {
            background: #208754 !important;
        }

        [data-bs-theme="dark"] .btn-light {
            background: #f8f9fa;
            color: #212529;
        }

        [data-bs-theme="dark"] .btn-light:hover {
            background: #e9ecef;
            color: #212529;
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

                <a href="{{ route('dashboard') }}"
                   class="btn btn-light btn-sm fw-semibold">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>

                <a href="{{ route('products.index') }}"
                   class="btn btn-light btn-sm fw-semibold">
                    <i class="bi bi-grid"></i>
                    Products
                </a>

                <a href="{{ route('categories.index') }}"
                   class="btn btn-light btn-sm fw-semibold">
                    <i class="bi bi-tag-fill"></i>
                    Categories
                </a>

                <a href="{{ route('products.create') }}"
                   class="btn btn-warning btn-sm fw-semibold">
                    <i class="bi bi-plus-circle"></i>
                    Add Product
                </a>

                <a href="{{ route('categories.create') }}"
                   class="btn btn-warning btn-sm fw-semibold">
                    <i class="bi bi-plus-circle"></i>
                    Add Category
                </a>

                <button id="theme-toggle"
                   class="btn btn-light btn-sm fw-semibold"
                   title="Toggle Dark Mode">
                    <i class="bi bi-moon"></i>
                </button>
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
                &copy; {{ date('Y') }} Laravel Blueprint Project |
                Built with Laravel 12, Bootstrap 5 &amp; Blueprint CRUD Generator
            </small>

        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dark Mode Script -->
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const currentTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', currentTheme);
        updateThemeIcon(currentTheme);

        themeToggle.addEventListener('click', function() {
            let theme = document.documentElement.getAttribute('data-bs-theme');
            theme = theme === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);
            updateThemeIcon(theme);
        });

        function updateThemeIcon(theme) {
            const icon = document.querySelector('#theme-toggle i');
            if (theme === 'dark') {
                icon.className = 'bi bi-sun';
            } else {
                icon.className = 'bi bi-moon';
            }
        }
    </script>

</body>

</html>
