<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Data Order - Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-shopping-cart me-2"></i>Data Order</h1>
        <div class="btn-group">
            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-download me-2"></i>Export
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item export-pdf" href="#" data-status="" data-date="">
                        <i class="fas fa-file-pdf me-2"></i>Export ke PDF
                    </a>
                </li>
                <li>
                    <a class="dropdown-item export-excel" href="#" data-status="" data-date="">
                        <i class="fas fa-file-excel me-2"></i>Export ke Excel
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Order</h6>
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm w-auto" id="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="cart">Cart</option>
                    <option value="checkout">Checkout</option>
                    <option value="paid">Paid</option>
                    <option value="shipped">Shipped</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                </select>
                <input type="date" class="form-control form-control-sm w-auto" id="filterDate">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="ordersTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Total</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $order): ?>
                        <tr>
                            <td>
                                <strong class="text-primary"><?= $order['no_invoice'] ?></strong>
                            </td>
                            <td>
                                <div>
                                    <strong><?= esc($order['user_name']) ?></strong>
                                    <div class="text-muted small"><?= $order['user_email'] ?></div>
                                </div>
                            </td>
                            <td><?= date('d M Y H:i', strtotime($order['created_at'])) ?></td>
                            <td>
                                <?php
                                $statusColors = [
                                    'cart' => 'secondary',
                                    'checkout' => 'info',
                                    'paid' => 'warning',
                                    'shipped' => 'primary',
                                    'completed' => 'success',
                                    'canceled' => 'danger'
                                ];
                                $statusLabels = [
                                    'cart' => 'Cart',
                                    'checkout' => 'Checkout',
                                    'paid' => 'Paid',
                                    'shipped' => 'Shipped',
                                    'completed' => 'Completed',
                                    'canceled' => 'Canceled'
                                ];
                                ?>
                                <span class="badge bg-<?= $statusColors[$order['status_cart']] ?? 'secondary' ?>">
                                    <?= $statusLabels[$order['status_cart']] ?? $order['status_cart'] ?>
                                </span>
                            </td>
                            <td>
                                <?php
                                $paymentColors = [
                                    'pending' => 'warning',
                                    'paid' => 'success',
                                    'failed' => 'danger'
                                ];
                                ?>
                                <span class="badge bg-<?= $paymentColors[$order['status_pembayaran']] ?? 'secondary' ?>">
                                    <?= ucfirst($order['status_pembayaran']) ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <strong>Rp <?= number_format($order['total'], 0, ',', '.') ?></strong>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= base_url('admin/orders/'.$order['id']) ?>" class="btn btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url('admin/orders/invoice/'.$order['id']) ?>" target="_blank" class="btn btn-warning" title="Invoice">
                                        <i class="fas fa-file-invoice"></i>
                                    </a>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" 
                                            data-bs-toggle="dropdown" title="Ubah Status">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <h6 class="dropdown-header">Ubah Status Order</h6>
                                        <?php foreach(['cart','checkout','paid','shipped','completed','canceled'] as $status): ?>
                                        <form action="<?= base_url('admin/orders/status/'.$order['id']) ?>" method="post" class="dropdown-item p-0">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="status" value="<?= $status ?>">
                                            <button type="submit" class="dropdown-item" 
                                                    onclick="return confirm('Ubah status ke <?= ucfirst($status) ?>?')">
                                                <?= ucfirst($status) ?>
                                            </button>
                                        </form>
                                        <?php endforeach; ?>
                                        <div class="dropdown-divider"></div>
                                        <form action="<?= base_url('admin/orders/'.$order['id']) ?>" method="post" class="dropdown-item p-0">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="dropdown-item text-danger" 
                                                    onclick="return confirm('Hapus order ini?')">
                                                <i class="fas fa-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Order (Bulan Ini)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count($orders) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Pendapatan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp <?= number_format(array_sum(array_column($orders, 'total')), 0, ',', '.') ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Order Selesai
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?= count(array_filter($orders, fn($o) => $o['status_cart'] == 'completed')) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Menunggu Pembayaran
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count(array_filter($orders, fn($o) => $o['status_pembayaran'] == 'pending')) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        // DataTable
        var table = $('#ordersTable').DataTable({
            "order": [[2, "desc"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            },
            "pageLength": 25,
            "responsive": true
        });

        // Status filter
        $('#filterStatus').on('change', function() {
            var status = $(this).val();

            $('.export-pdf, .export-excel').data('status', status);

            if (status) {
                table.column(3).search(status).draw();
            } else {
                table.column(3).search('').draw();
            }
        });

        // Date filter
        $('#filterDate').on('change', function() {
            var date = $(this).val();

            $('.export-pdf, .export-excel').data('date', date);

            if (date) {
                var dateObj = new Date(date);
                var formatted = dateObj.getDate() + ' ' + 
                    dateObj.toLocaleString('id-ID', { month: 'short' }) + ' ' + 
                    dateObj.getFullYear();

                table.column(2).search(formatted).draw();
            } else {
                table.column(2).search('').draw();
            }
        });
    });

    // PDF Export
$('.export-pdf').on('click', function(e) {
    e.preventDefault();

    var status = $('#filterStatus').val();
    var date = $('#filterDate').val();

    var url = '<?= base_url('admin/orders/export/pdf') ?>';
    var params = [];

    if (status) params.push('status=' + encodeURIComponent(status));
    if (date) params.push('date=' + encodeURIComponent(date));

    if (params.length > 0) {
        url += '?' + params.join('&');
    }

    window.open(url, '_blank');
});

// Excel Export
$('.export-excel').on('click', function(e) {
    e.preventDefault();

    var status = $('#filterStatus').val();
    var date = $('#filterDate').val();

    var url = '<?= base_url('admin/orders/export/excel') ?>';
    var params = [];

    if (status) params.push('status=' + encodeURIComponent(status));
    if (date) params.push('date=' + encodeURIComponent(date));

    if (params.length > 0) {
        url += '?' + params.join('&');
    }

    window.location.href = url;
});

</script>
<?= $this->endSection() ?>