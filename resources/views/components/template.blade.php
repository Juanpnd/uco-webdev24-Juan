<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Toko online dengan berbagai macam produk berkualitas. Temukan sepatu, kaos, dan celana favorit Anda.">
    <meta name="keywords" content="toko online, sepatu, kaos, celana, belanja online">
    <title>{{ $title ?? 'Toko online saya' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4p889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Default Light Mode */
        .hero {
            background-color: #f8f9fa; /* Light background */
            color: black; /* Default text color */
            transition: background-color 0.3s, color 0.3s;
        }

        .hero-title, .hero-subtitle {
            transition: color 0.3s;
        }

        /* Dark Mode */
        /* Dark Mode */

        .navbar {
            background-color: #f8f9fa;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #000;
        }

        .navbar-light .navbar-nav .nav-link.active {
            color: #007bff;
        }

        .btn-light {
            background-color: #f8f9fa;
            color: #000;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #121212;
            color: white;
        }

        .navbar.dark-mode {
            background-color: #333;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: white;
        }

        .navbar-dark .navbar-nav .nav-link.active {
            color: #007bff;
        }

        .btn-light.dark-mode {
            background-color: #333;
            color: #fff;
        }

        .form-control.dark-mode {
            background-color: #333;
            color: white;
            border: 1px solid #444;
        }

        .form-control.dark-mode::placeholder {
            color: #aaa;
        }

        .toast.dark-mode {
            background-color: #444;
        }

        .btn-close.white {
            color: white;
        }

        /* Position Dark Mode Toggle */
        .form-check.form-switch {
            position: fixed;
            bottom: 1rem;
            left: 1rem;
        }
    </style>
</head>

<body>
    <!-- Navbar Section -->
    <nav class="navbar py-0 navbar-expand-lg d-block">
        <div class="d-flex container-fluid">
            <!-- Logo Section -->
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <img src="{{ asset('image/Adidas Logo.jpg') }}" style="height:50px" alt="Logo">
            </a>

            <!-- Filter & Cart Section -->
            <div class="d-flex gap-2 py-2">
                <!-- Filter Form -->
                <form class="input-group" role="filter" action="{{ route('products.filter') }}" method="GET">
                    <input class="form-control" type="number" name="min_price" placeholder="Min price" aria-label="Min Price">
                    <input class="form-control" type="number" name="max_price" placeholder="Max price" aria-label="Max Price">
                    <button class="btn btn-light border" type="submit">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                </form>

                <!-- Navbar Toggle Button -->
                <button class="btn btn-white border navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCategories" aria-controls="navbarCategories" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <!-- Cart Button -->
                <a href="{{ route('cart.index') }}" class="btn btn-white border" aria-label="View cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
        </div>

        <!-- Category Links Section -->
        <div class="collapse navbar-collapse justify-content-center bg-light" id="navbarCategories">
            <ul class="navbar-nav mb-2 mb-lg-0 text-center overflow-x-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.list') ? 'active' : '' }}" aria-current="page" href="{{ route('products.list') }}">All products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.shoes') ? 'active' : '' }}" aria-current="page" href="{{ route('products.shoes') }}">Shoes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.tshirts') ? 'active' : '' }}" aria-current="page" href="{{ route('products.tshirts') }}">T-Shirts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.shorts') ? 'active' : '' }}" aria-current="page" href="{{ route('products.shorts') }}">Shorts</a>
                </li>

                <!-- Login & Logout Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>

            <!-- Search Form -->
            <form class="d-flex" role="search" action="{{ route('products.search') }}" method="GET">
                <input class="form-control me-2" type="text" name="query" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit" aria-label="Search button">Search</button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    {{ $slot }}

    <!-- Dark Mode Toggle -->
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="darkModeSwitch">
        <label class="form-check-label" for="darkModeSwitch"></label>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const darkModeSwitch = document.getElementById('darkModeSwitch');
            const isDarkMode = localStorage.getItem('darkMode') === 'true';

            if (isDarkMode) {
                document.body.classList.add('dark-mode');
            }

            darkModeSwitch.checked = isDarkMode;

            darkModeSwitch.addEventListener('change', function () {
                document.body.classList.toggle('dark-mode');
                localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
            });
        });
    </script>
</body>
</html>
