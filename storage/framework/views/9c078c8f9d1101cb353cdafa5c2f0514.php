

<?php $__env->startSection('admin_content'); ?>
    <h1 class="mb-4">Daftar Pesanan</h1>

    <?php if($orders->isEmpty()): ?>
        <div class="alert alert-info">Belum ada pesanan yang masuk.</div>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No. Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th>Tanggal Pesan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($order->order_number); ?></td>
                                    <td><?php echo e($order->user->name ?? 'Pengguna Dihapus'); ?></td> 
                                    <td>Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></td>
                                    <td><?php echo e($order->payment_method); ?></td>
                                    <td>
                                        <span class="badge <?php echo e($order->status == 'pending' ? 'bg-warning text-dark' :
                                            ($order->status == 'processing' ? 'bg-info' :
                                            ($order->status == 'shipped' ? 'bg-primary' :
                                            ($order->status == 'delivered' ? 'bg-success' : 'bg-danger')))); ?>"><?php echo e(ucfirst($order->status)); ?></span>
                                    </td>
                                    <td><?php echo e($order->created_at->format('d M Y H:i')); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn btn-info btn-sm">Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    <?php echo e($orders->links()); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ProjectAkhir\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>