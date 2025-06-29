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
    

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
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
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <img src="<?php echo e(asset('storage/jenna.jpg')); ?>" alt="Jenna Hijab Fashion" style="height: 80px;"> 
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('home')); ?>"><i class="fa-solid fa-box me-1"></i> Produk</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('cart.index')); ?>"><i class="fa-solid fa-shopping-cart me-1"></i> Keranjang
                            <?php if(session('cart')): ?>
                                (<span class="badge bg-secondary"><?php echo e(count(session('cart'))); ?></span>)
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if(auth()->guard('web')->guest()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>"><i class="fa-solid fa-right-to-bracket me-1"></i> Login</a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>"><i class="fa-solid fa-user-plus me-1"></i> Register</a> 
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user-circle me-1"></i> <?php echo e(Auth::user()->name); ?> 
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?php echo e(route('orders.history')); ?>"><i class="fa-solid fa-history me-1"></i> Riwayat Pesanan</a></li> 
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item"><i class="fa-solid fa-sign-out-alt me-1"></i> Logout</button> 
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    
</body>
</html><?php /**PATH C:\laragon\www\ProjectAkhir\resources\views/layouts/app.blade.php ENDPATH**/ ?>