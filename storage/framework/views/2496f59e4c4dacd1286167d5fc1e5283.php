

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <?php if($product->image): ?>
                    <img src="<?php echo e(asset($product->image)); ?>" class="card-img-top img-fluid" alt="<?php echo e($product->name); ?>" style="max-height: 400px; object-fit: contain;">
                <?php else: ?>
                    <img src="https://via.placeholder.com/400x400?text=No+Image" class="card-img-top img-fluid" alt="No Image" style="max-height: 400px; object-fit: contain;">
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <h1><?php echo e($product->name); ?></h1>
            <p class="text-muted mb-2">Kategori: <a href="<?php echo e(route('home', ['category' => $product->category->slug])); ?>" class="text-decoration-none"><?php echo e($product->category->name ?? 'Tidak Ada'); ?></a></p>
            <h3 class="text-primary mb-3">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></h3>

            <p class="lead"><?php echo e($product->description); ?></p>

            <div class="mb-3">
                <strong>Stok Tersedia:</strong>
                <?php if($product->stock > 0): ?>
                    <span class="badge bg-success fs-6"><?php echo e($product->stock); ?></span>
                <?php else: ?>
                    <span class="badge bg-danger fs-6">Stok Habis</span>
                <?php endif; ?>
            </div>

            <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3 d-flex align-items-center">
                    <label for="quantity" class="form-label me-2 mb-0">Kuantitas:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="<?php echo e($product->stock); ?>" style="width: 80px;" <?php echo e($product->stock == 0 ? 'disabled' : ''); ?>>
                </div>
                <button type="submit" class="btn btn-primary btn-lg" <?php echo e($product->stock == 0 ? 'disabled' : ''); ?>>
                    <i class="fas fa-shopping-cart me-2"></i> Tambahkan ke Keranjang
                </button>
            </form>

            <div class="mt-4">
                <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary">Kembali ke Produk</a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ProjectAkhir\resources\views/products/show.blade.php ENDPATH**/ ?>