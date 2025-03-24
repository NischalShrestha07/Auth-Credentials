<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page ?? 'Lokta-Imports' }}</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" href="https://loktaapp.com/images/favicon_20250123_112559.png">

    @yield('cssLinks')

    <style>
        body {
            background-color: rgba(233, 233, 233, 0.605)
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}"><span class="text-primary">Lokta</span> <span class="text-white">Imports</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-4" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Dashboard Link -->
                    <li class="nav-item">
                        <a class="nav-link active {{ $page == 'Dashboard' ? 'fw-bold text-warning' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <!-- Products Link -->
                    <li class="nav-item">
                        <a class="nav-link active {{ $page == 'Products' ? ' fw-bold  text-warning' : '' }}" href="{{ route('product') }}">Products</a>
                    </li>
                    <!-- Sub Categories Link -->
                    <li class="nav-item">
                        <a class="nav-link active {{ $page == 'Sub Category' ? 'fw-bold text-warning' : '' }}" href="{{ route('subcategory') }}">Sub Categories</a>
                    </li>
                    <!-- Categories Link -->
                    <li class="nav-item">
                        <a class="nav-link active {{ $page == 'Category' ? 'fw-bold text-warning' : '' }}" href="{{ route('category') }}">Categories</a>
                    </li>
                </ul>
                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmLogout">Logout</a>
                @include('layouts.logoutModal')
            </div>
        </div>
    </nav>

    @yield('body')
    <footer class="mt-5 text-center bg-light py-3">
        <p class="mb-0">&copy; Copyright 2025 Lokta. Developed by Lokta.</p>
    </footer>

    @yield('js')

    <!-- JavaScript for handling logout -->
    <script>
        document.querySelectorAll(".logout-button").forEach(function(button) {
            button.addEventListener("click", function() {
                const url = this.getAttribute("data-url") || "/logout";
                document.getElementById("logoutForm").action = url;
            });
        });
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
