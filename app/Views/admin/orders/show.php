<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Detail Order #<?= $order['no_invoice'] ?> - Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-file-invoice me-2"></i>Detail Order</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/orders') ?>">Orders</a></li>
                    <li class="breadcrumb-item active"><?= $order['no_invoice'] ?></li>
                </ol>
            </nav>
        </div>
        <div class="btn-group">
            <a href="<?= base_url('admin/orders/invoice/'.$order['id']) ?>" target="_blank" class="btn btn-primary">
                <i class="fas fa-print me-2"></i>Cetak Invoice
            </a>
            <a href="<?= base_url('admin/orders') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Order Details -->
        <div class="col-lg-8">
            <!-- Order Info Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Order #<?= $order['no_invoice'] ?>
                    </h6>
                    <div class="d-flex gap-2">
                        <span class="badge bg-<?= $order['status_cart'] == 'completed' ? 'success' : 'warning' ?>">
                            <?= strtoupper($order['status_cart']) ?>
                        </span>
                        <span class="badge bg-<?= $order['status_pembayaran'] == 'paid' ? 'success' : 'danger' ?>">
                            <?= strtoupper($order['status_pembayaran']) ?>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Products Table -->
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th width="60">#</th>
                                    <th>Produk</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach($order['details'] as $detail): ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url('uploads/products/'.($detail['image'] ?? 'default.jpg')) ?>" 
                                                 class="rounded me-3" width="50" height="50" style="object-fit: cover;">
                                            <div>
                                                <strong><?= esc($detail['title']) ?></strong>
                                                <div class="text-muted small">SKU: <?= $detail['product_id'] ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">Rp <?= number_format($detail['harga'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?= $detail['qty'] ?></td>
                                    <td class="text-center">
                                        <strong>Rp <?= number_format($detail['subtotal'], 0, ',', '.') ?></strong>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                                    <td class="text-center">
                                        <strong class="text-primary">Rp <?= number_format($order['total'], 0, ',', '.') ?></strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Status Update Form -->
                    <div class="card border-left-primary">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Update Status Order</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/orders/status/'.$order['id']) ?>" method="post" class="row g-3">
                                <?= csrf_field() ?>
                                <div class="col-md-6">
                                    <label class="form-label">Status Order</label>
                                    <select name="status" class="form-select">
                                        <option value="cart" <?= $order['status_cart'] == 'cart' ? 'selected' : '' ?>>Cart</option>
                                        <option value="checkout" <?= $order['status_cart'] == 'checkout' ? 'selected' : '' ?>>Checkout</option>
                                        <option value="paid" <?= $order['status_cart'] == 'paid' ? 'selected' : '' ?>>Paid</option>
                                        <option value="shipped" <?= $order['status_cart'] == 'shipped' ? 'selected' : '' ?>>Shipped</option>
                                        <option value="completed" <?= $order['status_cart'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                                        <option value="canceled" <?= $order['status_cart'] == 'canceled' ? 'selected' : '' ?>>Canceled</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Status Pembayaran</label>
                                    <select name="payment_status" class="form-select">
                                        <option value="pending" <?= $order['status_pembayaran'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="paid" <?= $order['status_pembayaran'] == 'paid' ? 'selected' : '' ?>>Paid</option>
                                        <option value="failed" <?= $order['status_pembayaran'] == 'failed' ? 'selected' : '' ?>>Failed</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Status
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer & Order Info -->
        <div class="col-lg-4">
            <!-- Customer Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Customer</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($order['user_name']) ?>&background=8a2be2&color=fff&size=100" 
                             class="rounded-circle mb-2">
                        <h5><?= esc($order['user_name']) ?></h5>
                        <p class="text-muted"><?= $order['user_email'] ?></p>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <strong>Telepon:</strong> <?= $order['phone'] ?? '-' ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <strong>Alamat:</strong> 
                            <div class="mt-1 small"><?= $order['address'] ?? 'Tidak ada alamat' ?></div>
                        </li>
                    </ul>
                    <div class="text-center mt-3">
                        <a href="mailto:<?= $order['user_email'] ?>" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-envelope me-2"></i>Kirim Email
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order Info Card -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Order</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-hashtag text-primary me-2"></i>
                            <strong>Invoice:</strong> <?= $order['no_invoice'] ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-calendar text-primary me-2"></i>
                            <strong>Tanggal Order:</strong> 
                            <?= date('d M Y H:i', strtotime($order['created_at'])) ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-sync-alt text-primary me-2"></i>
                            <strong>Terakhir Diupdate:</strong> 
                            <?= date('d M Y H:i', strtotime($order['updated_at'])) ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-box text-primary me-2"></i>
                            <strong>Jumlah Item:</strong> 
                            <?= count($order['details']) ?> produk
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-money-bill text-primary me-2"></i>
                            <strong>Total Pembayaran:</strong>
                            <div class="h5 text-primary mt-1">
                                Rp <?= number_format($order['total'], 0, ',', '.') ?>
                            </div>
                        </li>
                    </ul>
                    <hr>
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('admin/orders/invoice/'.$order['id']) ?>" target="_blank" 
                           class="btn btn-success">
                            <i class="fas fa-print me-2"></i>Cetak Invoice
                        </a>
                        <form action="<?= base_url('admin/orders/'.$order['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger w-100" 
                                    onclick="return confirm('Hapus order ini? Aksi tidak dapat dibatalkan.')">
                                <i class="fas fa-trash me-2"></i>Hapus Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>