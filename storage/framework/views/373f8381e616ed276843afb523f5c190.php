

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4">Keranjang Belanja Anda</h1>

    <?php if(empty($cart)): ?>
        <div class="alert alert-info text-center">
            Keranjang belanja Anda kosong. <a href="<?php echo e(route('home')); ?>">Mulai belanja sekarang!</a>
        </div>
    <?php else: ?>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Kuantitas</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if($item['image']): ?>
                                                <img src="<?php echo e(asset($item['image'])); ?>" alt="<?php echo e($item['name']); ?>" style="width: 60px; height: 60px; object-fit: cover; margin-right: 15px; border-radius: 5px;">
                                            <?php else: ?>
                                                <img src="https://via.placeholder.com/60x60?text=No+Img" alt="No Image" style="width: 60px; height: 60px; object-fit: cover; margin-right: 15px; border-radius: 5px;">
                                            <?php endif; ?>
                                            <div>
                                                <a href="<?php echo e(route('products.show', $item['slug'] ?? '#')); ?>" class="text-decoration-none text-dark fw-bold">
                                                    <?php echo e($item['name']); ?>

                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp <?php echo e(number_format($item['price'], 0, ',', '.')); ?></td>
                                    <td>
                                        <form action="<?php echo e(route('cart.update', $id)); ?>" method="POST" class="d-flex align-items-center">
                                            <?php echo csrf_field(); ?>
                                            <input type="number" name="quantity" value="<?php echo e($item['quantity']); ?>" min="1" class="form-control form-control-sm me-2" style="width: 70px;" onchange="this.form.submit()">
                                            
                                        </form>
                                    </td>
                                    <td>Rp <?php echo e(number_format($item['price'] * $item['quantity'], 0, ',', '.')); ?></td>
                                    <td>
                                        <form action="<?php echo e(route('cart.remove', $id)); ?>" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded">
            <h4 class="mb-0">Total Belanja:</h4>
            <h4 class="mb-0 text-primary">Rp <?php echo e(number_format($total, 0, ',', '.')); ?></h4>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary me-md-2">Lanjutkan Belanja</a>
            <a href="<?php echo e(route('checkout.index')); ?>" class="btn btn-success">Checkout</a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ProjectAkhir\resources\views/cart/index.blade.php ENDPATH**/ ?>