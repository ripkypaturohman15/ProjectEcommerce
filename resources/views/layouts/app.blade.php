<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Hijab Store</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    {{-- AKHIR GOOGLE FONTS --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Gaya kustom untuk ikon di navbar jika diperlukan */
        .navbar-nav .nav-link i {
            margin-right: 5px;
        }
        .dropdown-menu .dropdown-item i {
            margin-right: 5px;
        }
        /* Tambahkan gaya untuk nama brand Anda */
        .navbar-brand {
            font-family: 'Playfair Display', serif; /* <--- Ganti 'Playfair Display' dengan nama font Anda */
            font-size: 1.8rem; /* Ukuran font yang lebih besar */
            font-weight: 700; /* Tebal font */
            color: #333; /* Warna font, sesuaikan */
            /* Anda bisa menambahkan text-shadow, letter-spacing, dll. */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('storage/jenna.jpg') }}" alt="Jenna Hijab Fashion" style="height: 80px;"> {{-- Sesuaikan tinggi logo --}}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}"><i class="fa-solid fa-box me-1"></i> Produk</a> {{-- Ikon Produk --}}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}"><i class="fa-solid fa-shopping-cart me-1"></i> Keranjang
                            @if(session('cart'))
                                (<span class="badge bg-secondary">{{ count(session('cart')) }}</span>)
                            @endif
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @guest('web')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket me-1"></i> Login</a> {{-- Ikon Login --}}
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="fa-solid fa-user-plus me-1"></i> Register</a> {{-- Ikon Register --}}
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user-circle me-1"></i> {{ Auth::user()->name }} {{-- Ikon User --}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('orders.history') }}"><i class="fa-solid fa-history me-1"></i> Riwayat Pesanan</a></li> {{-- Ikon Riwayat Pesanan --}}
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fa-solid fa-sign-out-alt me-1"></i> Logout</button> {{-- Ikon Logout --}}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @yield('content')
    </div>

    
</body>
</html>