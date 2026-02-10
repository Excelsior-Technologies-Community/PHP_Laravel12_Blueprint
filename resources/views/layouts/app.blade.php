<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Laravel App')</title>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a href="/" class="navbar-brand">Laravel Blueprint Project</a>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
