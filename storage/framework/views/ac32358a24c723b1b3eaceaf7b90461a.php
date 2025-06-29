<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hijab Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
      body { display: flex; min-height: 100vh; }
        #sidebar { width: 250px; background-color: #343a40; color: white; flex-shrink: 0; }
        #content { flex-grow: 1; padding: 20px; }
        .sidebar-link { color: white; text-decoration: none; display: flex; align-items: center; padding: 10px 15px; }
        .sidebar-link:hover { background-color: #495057; color: white; }
        .sidebar-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .sidebar-heading { padding: 20px 15px; font-size: 1.2rem; border-bottom: 1px solid #495057; }
        .sidebar-logo {
            text-align: center;
            padding: 15px;
            border-bottom: 1px solid #495057;
        }
        .sidebar-logo img {
            max-height: 80px; /* <--- UBAH NILAI INI UNTUK MEMPERBESAR LOGO */
            width: auto;
        }
    </style>
</head>
<body>
    <div id="sidebar" class="d-flex flex-column">
        <div class="sidebar-logo">
            <a href="<?php echo e(route('admin.dashboard')); ?>">
                <img src="<?php echo e(asset('storage/logo.png')); ?>" alt="Admin Logo"> 
            </a>
            <h3 class="mt-2" style="color: white;">Admin Panel</h3>
        </div>

        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a class="sidebar-link" href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-link" href="<?php echo e(route('admin.categories.index')); ?>">
                    <i class="fa-solid fa-tags"></i> Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-link" href="<?php echo e(route('admin.products.index')); ?>">
                    <i class="fa-solid fa-box-open"></i> Produk
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-link" href="<?php echo e(route('admin.orders.index')); ?>">
                    <i class="fa-solid fa-clipboard-list"></i> Pesanan
                </a>
            </li>
        </ul>
        <div class="mt-auto p-3">
            <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Logout Admin
                </button>
            </form>
        </div>
    </div>

    <div id="content">
        <div class="container-fluid">
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
            <?php echo $__env->yieldContent('admin_content'); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\laragon\www\ProjectAkhir\resources\views/layouts/admin.blade.php ENDPATH**/ ?>