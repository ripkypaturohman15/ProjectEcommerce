

<?php $__env->startSection('admin_content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Manajemen Kategori</h1>
        <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary">Tambah Kategori Baru</a>
    </div>

    <?php if($categories->isEmpty()): ?>
        <div class="alert alert-info">Belum ada kategori yang ditambahkan.</div>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Jumlah Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($category->name); ?></td>
                                <td><?php echo e($category->slug); ?></td>
                                <td><?php echo e($category->products->count()); ?></td> 
                                <td>
                                    <a href="<?php echo e(route('admin.categories.edit', $category->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua produk di dalamnya TIDAK akan ikut terhapus, namun kategori produk mereka akan menjadi null jika tidak diatur. Periksa controller untuk detailnya.');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <?php echo e($categories->links()); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ProjectAkhir\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>