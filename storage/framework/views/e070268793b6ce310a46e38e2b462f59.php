

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4">Riwayat Pesanan Anda</h1>

    <?php if($orders->isEmpty()): ?>
        <div class="alert alert-info text-center">
            Anda belum memiliki riwayat pesanan.
            <a href="<?php echo e(route('home')); ?>" class="alert-link">Mulai belanja sekarang!</a>
        </div>
    <?php else: ?>
        <div class="list-group">
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('orders.show', $order->id)); ?>" class="list-group-item list-group-item-action mb-3">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Pesanan #<?php echo e($order->order_number); ?></h5>
                        <small class="text-muted"><?php echo e($order->created_at->format('d M Y, H:i')); ?></small>
                    </div>
                    <p class="mb-1">
                        Total: <strong>Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></strong>
                    </p>
                    <p class="mb-1">
                        Status:
                        <span class="badge <?php echo e($order->status == 'pending' ? 'bg-warning text-dark' :
                            ($order->status == 'processing' ? 'bg-info' :
                            ($order->status == 'shipped' ? 'bg-primary' :
                            ($order->status == 'delivered' ? 'bg-success' : 'bg-danger')))); ?>"><?php echo e(ucfirst($order->status)); ?></span>
                    </p>
                    <small class="text-muted">Klik untuk melihat detail pesanan.</small>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <?php echo e($orders->links()); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ProjectAkhir\resources\views/orders/history.blade.php ENDPATH**/ ?>