

<?php $__env->startSection('admin_content'); ?>
    <h1 class="mb-4">Detail Pesanan #<?php echo e($order->order_number); ?></h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Detail Pelanggan & Pengiriman</div>
                <div class="card-body">
                    <p><strong>Nama Pelanggan:</strong> <?php echo e($order->user->name ?? 'Pengguna Dihapus'); ?></p>
                    <p><strong>Email Pelanggan:</strong> <?php echo e($order->user->email ?? '-'); ?></p>
                    <p><strong>Nomor Telepon:</strong> <?php echo e($order->phone_number ?? '-'); ?></p>
                    <p><strong>Alamat Pengiriman:</strong> <?php echo e($order->shipping_address); ?></p>
                    <p><strong>Metode Pembayaran:</strong> <?php echo e($order->payment_method); ?></p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Produk Dipesan</div>
                <div class="card-body">
                    <?php if($order->orderItems->isEmpty()): ?>
                        <p>Tidak ada item dalam pesanan ini.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga Satuan</th>
                                        <th>Kuantitas</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php if($item->product): ?>
                                                    <a href="<?php echo e(route('products.show', $item->product->slug)); ?>" target="_blank"><?php echo e($item->product->name); ?></a>
                                                <?php else: ?>
                                                    <?php echo e($item->product_name ?? 'Produk Dihapus'); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?></td>
                                            <td><?php echo e($item->quantity); ?></td>
                                            <td>Rp <?php echo e(number_format($item->price * $item->quantity, 0, ',', '.')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <h5 class="text-end mt-3">Total Pesanan: Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></h5>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Status Pesanan</div>
                <div class="card-body">
                    <p>Status Saat Ini:
                        <span class="badge fs-6 <?php echo e($order->status == 'pending' ? 'bg-warning text-dark' :
                            ($order->status == 'processing' ? 'bg-info' :
                            ($order->status == 'shipped' ? 'bg-primary' :
                            ($order->status == 'delivered' ? 'bg-success' : 'bg-danger')))); ?>"><?php echo e(ucfirst($order->status)); ?></span>
                    </p>

                    <form action="<?php echo e(route('admin.orders.updateStatus', $order->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="mb-3">
                            <label for="status" class="form-label">Ubah Status</label>
                            <select class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="status" name="status" required>
                                <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="processing" <?php echo e($order->status == 'processing' ? 'selected' : ''); ?>>Processing</option>
                                <option value="shipped" <?php echo e($order->status == 'shipped' ? 'selected' : ''); ?>>Shipped</option>
                                <option value="delivered" <?php echo e($order->status == 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                                <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ProjectAkhir\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>