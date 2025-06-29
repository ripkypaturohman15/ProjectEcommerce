

<?php $__env->startSection('admin_content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Manajemen Produk</h1>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">Tambah Produk Baru</a>
    </div>

    <?php if($products->isEmpty()): ?>
        <div class="alert alert-info">Belum ada produk yang ditambahkan.</div>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td>
                                        <?php if($product->image): ?>
                                            <img src="<?php echo e(url($product->image)); ?>" alt="<?php echo e($product->name); ?>" style="width: 50px; height: 50px; object-fit: cover;">
                                        <?php else: ?>
                                            <img src="https://via.placeholder.com/50x50?text=No+Img" alt="No Image" style="width: 50px; height: 50px; object-fit: cover;">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($product->name); ?></td>
                                    <td><?php echo e($product->category->name ?? 'Tidak Ada Kategori'); ?></td> 
                                    <td>Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></td>
                                    <td><?php echo e($product->stock); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="<?php echo e(route('admin.products.destroy', $product->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
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
                <div class="d-flex justify-content-center">
                    <?php echo e($products->links()); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ProjectAkhir\resources\views/admin/products/index.blade.php ENDPATH**/ ?>