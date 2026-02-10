<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Admin Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Page Header Compact -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1 text-gray-800">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard Overview
        </h1>
        <small class="text-muted">Welcome back, <?= session()->get('userName') ?? 'Admin' ?>! Here's your store analytics</small>
    </div>
    <div class="text-end">
        <small class="text-muted"><?= date('d M Y, H:i') ?></small>
    </div>
</div>

<!-- Statistik Cards - REAL DATA & COMPACT -->
<div class="row g-2 mb-4">
    <div class="col-6 col-md-3">
        <div class="card-stat bg-white border-0 rounded-lg shadow-sm p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-primary-light text-primary rounded-circle p-2 me-3">
                    <i class="fas fa-box fs-5"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="stat-value h4 mb-0 fw-bold text-gray-800"><?= number_format($totalProducts, 0, ',', '.') ?></div>
                    <div class="stat-label text-muted small">Total Produk</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card-stat bg-white border-0 rounded-lg shadow-sm p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-success-light text-success rounded-circle p-2 me-3">
                    <i class="fas fa-users fs-5"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="stat-value h4 mb-0 fw-bold text-gray-800"><?= number_format($totalUsers, 0, ',', '.') ?></div>
                    <div class="stat-label text-muted small">Total Users</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card-stat bg-white border-0 rounded-lg shadow-sm p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-warning-light text-warning rounded-circle p-2 me-3">
                    <i class="fas fa-shopping-cart fs-5"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="stat-value h4 mb-0 fw-bold text-gray-800"><?= number_format($totalOrders, 0, ',', '.') ?></div>
                    <div class="stat-label text-muted small">Total Orders</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card-stat bg-white border-0 rounded-lg shadow-sm p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-purple-light text-purple rounded-circle p-2 me-3">
                    <i class="fas fa-dollar-sign fs-5"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="stat-value h4 mb-0 fw-bold text-gray-800">
                        Rp <?= number_format($totalRevenue, 0, ',', '.') ?>
                    </div>
                    <div class="stat-label text-muted small">Total Revenue</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Today's Quick Stats -->
<div class="row g-2 mb-4">
    <div class="col-12">
        <div class="card border-0 rounded-lg shadow-sm">
            <div class="card-body p-3">
                <div class="row g-2">
                    <div class="col-4 col-sm-2">
                        <div class="text-center p-2">
                            <div class="h5 mb-1 text-primary fw-bold"><?= $ordersToday ?></div>
                            <small class="text-muted">Orders Today</small>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2">
                        <div class="text-center p-2">
                            <div class="h5 mb-1 text-success fw-bold">
                                Rp <?= number_format($todayRevenue, 0, ',', '.') ?>
                            </div>
                            <small class="text-muted">Revenue Today</small>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2">
                        <div class="text-center p-2">
                            <div class="h5 mb-1 text-info fw-bold"><?= $newUsersToday ?></div>
                            <small class="text-muted">New Users</small>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2">
                        <div class="text-center p-2">
                            <div class="h5 mb-1 text-warning fw-bold"><?= $pendingOrders ?></div>
                            <small class="text-muted">Pending Orders</small>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2">
                        <div class="text-center p-2">
                            <div class="h5 mb-1 text-danger fw-bold"><?= $outOfStock ?></div>
                            <small class="text-muted">Out of Stock</small>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2">
                        <div class="text-center p-2">
                            <div class="h5 mb-1 text-purple fw-bold"><?= $activeRate ?>%</div>
                            <small class="text-muted">Active Products</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders & Top Products -->
<div class="row g-3">
    <!-- Recent Orders -->
    <div class="col-lg-8">
        <div class="card border-0 rounded-lg shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-gray-800">
                        <i class="fas fa-clock me-2"></i>Recent Orders
                    </h6>
                    <a href="<?= base_url('admin/orders') ?>" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 ps-3" style="width: 120px;">Invoice</th>
                                <th class="border-0">Customer</th>
                                <th class="border-0" style="width: 100px;">Date</th>
                                <th class="border-0" style="width: 120px;">Amount</th>
                                <th class="border-0 pe-3" style="width: 100px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recentOrders)): ?>
                                <?php foreach($recentOrders as $order): ?>
                                <tr>
                                    <td class="ps-3">
                                        <a href="<?= base_url('admin/orders/' . $order['id']) ?>" class="text-decoration-none text-primary">
                                            <strong><?= $order['no_invoice'] ?></strong>
                                        </a>
                                    </td>
                                    <td>
                                        <?= $order['user_name'] ?? 'User #' . $order['user_id'] ?>
                                    </td>
                                    <td><?= date('d/m/y', strtotime($order['created_at'])) ?></td>
                                    <td class="fw-semibold">
                                        Rp <?= number_format($order['total'], 0, ',', '.') ?>
                                    </td>
                                    <td class="pe-3">
                                        <?php
                                        $badgeClass = [
                                            'cart' => 'badge bg-secondary',
                                            'checkout' => 'badge bg-warning',
                                            'paid' => 'badge bg-info',
                                            'shipped' => 'badge bg-primary',
                                            'completed' => 'badge bg-success',
                                            'canceled' => 'badge bg-danger'
                                        ][$order['status_cart']] ?? 'badge bg-secondary';
                                        ?>
                                        <span class="<?= $badgeClass ?> badge-sm">
                                            <?= ucfirst($order['status_cart']) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fas fa-inbox me-2"></i>No orders found
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Products -->
    <div class="col-lg-4">
        <div class="card border-0 rounded-lg shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="mb-0 text-gray-800">
                    <i class="fas fa-fire me-2"></i>Top Products
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <?php if (!empty($topProducts)): ?>
                        <?php foreach($topProducts as $index => $product): ?>
                        <div class="list-group-item border-0 px-3 py-2">
                            <div class="d-flex align-items-center">
                                <div class="position-relative me-3">
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                        <?= $index + 1 ?>
                                    </span>
                                    <div class="bg-light rounded p-1" style="width: 40px; height: 40px;">
                                        <?php if($product['image']): ?>
                                            <img src="<?= base_url('uploads/products/' . $product['image']) ?>" 
                                                 alt="<?= $product['title'] ?>" 
                                                 class="img-fluid rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold text-truncate" style="max-width: 150px;">
                                        <?= $product['title'] ?>
                                    </div>
                                    <small class="text-muted"><?= $product['category_name'] ?></small>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold text-gray-800">
                                        Rp <?= number_format($product['price'], 0, ',', '.') ?>
                                    </div>
                                    <small class="<?= $product['stock'] > 10 ? 'text-success' : ($product['stock'] > 0 ? 'text-warning' : 'text-danger') ?>">
                                        Stock: <?= $product['stock'] ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="list-group-item border-0 text-center py-4 text-muted">
                            <i class="fas fa-box-open me-2"></i>No products found
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Status Overview -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 rounded-lg shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="mb-0 text-gray-800">
                    <i class="fas fa-chart-pie me-2"></i>Order Status Overview
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="row g-0">
                    <?php foreach($statuses as $status): ?>
                    <?php
                    $statusColors = [
                        'cart' => 'secondary',
                        'checkout' => 'warning',
                        'paid' => 'info',
                        'shipped' => 'primary',
                        'completed' => 'success',
                        'canceled' => 'danger'
                    ];
                    $count = $statusCounts[$status]['count'] ?? 0;
                    $percentage = $statusCounts[$status]['percentage'] ?? 0;
                    ?>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="p-3 text-center border-end">
                            <div class="h5 mb-1 fw-bold text-<?= $statusColors[$status] ?>">
                                <?= $count ?>
                            </div>
                            <div class="small text-muted mb-2"><?= ucfirst($status) ?></div>
                            <div class="progress" style="height: 4px;">
                                <div class="progress-bar bg-<?= $statusColors[$status] ?>" 
                                     style="width: <?= $percentage ?>%"></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    /* TEMA UNGU SESUAI LAYOUT ANDA */
    :root {
        --primary: #8a2be2;
        --primary-light: #EDE9FE;
        --primary-dark: #7C3AED;
        --success: #10B981;
        --success-light: #D1FAE5;
        --warning: #F59E0B;
        --warning-light: #FEF3C7;
        --danger: #EF4444;
        --danger-light: #FEE2E2;
        --info: #3B82F6;
        --info-light: #DBEAFE;
        --purple: #8a2be2;
        --purple-light: #EDE9FE;
        --gray-800: #1F2937;
        --gray-600: #4B5563;
        --gray-400: #9CA3AF;
        --gray-100: #F3F4F6;
    }

    /* Compact Card Stats */
    .card-stat {
        transition: all 0.2s ease;
        border: 1px solid #E5E7EB !important;
        background: white;
    }
    
    .card-stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(138, 43, 226, 0.1) !important;
        border-color: var(--primary) !important;
    }
    
    .stat-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .bg-primary-light { background-color: rgba(138, 43, 226, 0.1); }
    .bg-success-light { background-color: var(--success-light); }
    .bg-warning-light { background-color: var(--warning-light); }
    .bg-purple-light { background-color: rgba(138, 43, 226, 0.1); }
    .bg-info-light { background-color: var(--info-light); }
    
    .text-purple { color: var(--purple); }
    .bg-purple { background-color: var(--purple) !important; }
    
    /* Badge Size */
    .badge-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    
    /* Rounded Corners */
    .rounded-lg {
        border-radius: 0.75rem !important;
    }
    
    /* Table Compact */
    .table th, .table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.875rem;
    }
    
    .table-hover tbody tr:hover {
        background-color: var(--gray-100);
    }
    
    /* Progress Bar */
    .progress {
        background-color: var(--gray-100);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .stat-value {
            font-size: 1.1rem;
        }
        
        .stat-icon {
            width: 36px;
            height: 36px;
            padding: 0.5rem !important;
        }
        
        .table th, .table td {
            padding: 0.5rem 0.25rem;
            font-size: 0.8125rem;
        }
        
        .card-body {
            padding: 0.75rem !important;
        }
        
        .card-header {
            padding: 0.75rem !important;
        }
    }
    
    @media (max-width: 576px) {
        .h3 { font-size: 1.5rem; }
        .h4 { font-size: 1.25rem; }
        .h5 { font-size: 1rem; }
        .h6 { font-size: 0.875rem; }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    }
</style>
<?= $this->endSection() ?>