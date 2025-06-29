

<?php $__env->startSection('admin_content'); ?>
    <h1 class="mb-4">Dashboard Admin</h1>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Produk</h5>
                    <p class="card-text fs-3"><?php echo e($totalProducts); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Pesanan</h5>
                    <p class="card-text fs-3"><?php echo e($totalOrders); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Pesanan Pending</h5>
                    <p class="card-text fs-3"><?php echo e($pendingOrders); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Pengguna</h5>
                    <p class="card-text fs-3"><?php echo e($totalUsers); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Pesanan Terbaru</div>
        <div class="card-body">
            <?php if($recentOrders->isEmpty()): ?>
                <p>Tidak ada pesanan terbaru.</p>
            <?php else: ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No. Pesanan</th>
                            <th>Pengguna</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($order->order_number); ?></td>
                                <td><?php echo e($order->user->name); ?></td>
                                <td>Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></td>
                                <td><span class="badge <?php echo e($order->status == 'pending' ? 'bg-warning' :
                                    ($order->status == 'processing' ? 'bg-info' :
                                    ($order->status == 'shipped' ? 'bg-primary' :
                                    ($order->status == 'delivered' ? 'bg-success' : 'bg-danger')))); ?>"><?php echo e(ucfirst($order->status)); ?></span></td>
                                <td><?php echo e($order->created_at->format('d M Y H:i')); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn btn-sm btn-outline-info">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-link">Lihat Semua Pesanan</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ProjectAkhir\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>