<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Admin Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Page Title -->
<h1 class="page-title">
    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
    <small class="text-muted fs-6">Overview & Statistics</small>
</h1>

<!-- Statistik Cards -->
<div class="row">
    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="card-icon blue">
                <i class="fas fa-box"></i>
            </div>
            <div class="card-value"><?= $totalProducts ?></div>
            <div class="card-label">Total Produk</div>
            <div class="mt-2 small text-muted">
                <i class="fas fa-arrow-up text-success me-1"></i> 12% from last month
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="card-icon green">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-value"><?= $totalUsers ?></div>
            <div class="card-label">Total Users</div>
            <div class="mt-2 small text-muted">
                <i class="fas fa-arrow-up text-success me-1"></i> 8% from last month
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="card-icon orange">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="card-value"><?= $totalOrders ?></div>
            <div class="card-label">Total Orders</div>
            <div class="mt-2 small text-muted">
                <i class="fas fa-arrow-up text-success me-1"></i> 15% from last month
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="card-icon purple">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-value">Rp 28.5M</div>
            <div class="card-label">Total Revenue</div>
            <div class="mt-2 small text-muted">
                <i class="fas fa-arrow-up text-success me-1"></i> 22% from last month
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders & Top Products -->
<div class="row mt-4">
    <div class="col-md-8">
        <div class="data-table">
            <div class="table-header">
                <h5><i class="fas fa-history me-2"></i> Recent Orders</h5>
                <a href="<?= base_url('admin/orders') ?>" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($recentOrders as $order): ?>
                        <tr>
                            <td><strong>#<?= $order['no_invoice'] ?? 'INV-' . $order['id'] ?></strong></td>
                            <td>Customer <?= $order['user_id'] ?></td>
                            <td><?= date('d M Y', strtotime($order['created_at'] ?? 'now')) ?></td>
                            <td>Rp <?= number_format($order['total'] ?? 0, 0, ',', '.') ?></td>
                            <td>
                                <?php
                                $status = $order['status_cart'] ?? 'pending';
                                $badgeClass = [
                                    'pending' => 'pending',
                                    'completed' => 'completed',
                                    'paid' => 'active',
                                    'canceled' => 'canceled'
                                ][$status] ?? 'pending';
                                ?>
                                <span class="status-badge <?= $badgeClass ?>"><?= ucfirst($status) ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="data-table">
            <div class="table-header">
                <h5><i class="fas fa-fire me-2"></i> Top Products</h5>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($topProducts as $product): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" 
                                         class="rounded me-2" width="40" height="40" alt="Product">
                                    <div>
                                        <div class="fw-bold"><?= substr($product['title'], 0, 20) ?>...</div>
                                        <small class="text-muted"><?= $product['category_id'] == 1 ? 'Batik' : 'Fashion' ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                            <td>
                                <span class="<?= $product['stock'] > 0 ? 'text-success' : 'text-danger' ?>">
                                    <?= $product['stock'] ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="row mt-4">
    <div class="col-12">
        <div class="dashboard-card">
            <h5 class="mb-3"><i class="fas fa-chart-line me-2"></i> Monthly Overview</h5>
            <div class="row text-center">
                <div class="col-md-2 col-6 mb-3">
                    <div class="text-primary fw-bold fs-4">150</div>
                    <div class="text-muted small">Orders Today</div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="text-success fw-bold fs-4">Rp 15M</div>
                    <div class="text-muted small">Revenue Today</div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="text-info fw-bold fs-4">45</div>
                    <div class="text-muted small">New Users</div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="text-warning fw-bold fs-4">12</div>
                    <div class="text-muted small">Pending Orders</div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="text-danger fw-bold fs-4">3</div>
                    <div class="text-muted small">Out of Stock</div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="text-purple fw-bold fs-4">98%</div>
                    <div class="text-muted small">Satisfaction</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>