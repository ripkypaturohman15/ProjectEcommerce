<?php $__env->startSection('content'); ?>
<h1 class="mb-4"><i class="fa-solid fa-store me-2"></i> Produk Hijab</h1> 

<div class="row mb-4">
    <div class="col-md-8">
        <form action="<?php echo e(route('home')); ?>" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..." value="<?php echo e(request('search')); ?>">
            <select name="category" class="form-select me-2">
                <option value="">Semua Kategori</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->slug); ?>" <?php echo e(request('category') == $category->slug ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass me-2"></i> Cari</button> 
        </form>
    </div>
</div>

<?php if($products->isEmpty()): ?>
    <div class="alert alert-warning">Tidak ada produk yang ditemukan.</div>
<?php else: ?>
    <div class="row">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <?php if($product->image): ?>
                        <img src="<?php echo e(asset($product->image)); ?>" class="card-img-top" alt="<?php echo e($product->name); ?>" style="height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/200x200?text=No+Image" class="card-img-top" alt="No Image" style="height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo e($product->name); ?></h5>
                        <p class="card-text text-muted"><?php echo e($product->category->name); ?></p>
                        <p class="card-text">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></p>
                        <p class="card-text">Stok: <?php echo e($product->stock); ?></p>
                        <div class="mt-auto">
                            <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-eye me-1"></i> Lihat Detail</a> 
                            <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST" class="d-inline-block">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-primary btn-sm" <?php echo e($product->stock == 0 ? 'disabled' : ''); ?>>
                                    <?php if($product->stock == 0): ?>
                                        <i class="fa-solid fa-circle-xmark me-1"></i> Stok Habis
                                    <?php else: ?>
                                        <i class="fa-solid fa-cart-plus me-1"></i> Tambah Keranjang
                                    <?php endif; ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="d-flex justify-content-center">
        <?php echo e($products->links()); ?>

    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ProjectAkhir\resources\views/welcome.blade.php ENDPATH**/ ?>