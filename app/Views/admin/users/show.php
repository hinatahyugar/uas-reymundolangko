<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
User: <?= esc($user['name']) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid px-0 px-md-2">
    <!-- Header Compact -->
    <div class="d-flex justify-content-between align-items-center mb-3 py-2 border-bottom">
        <div class="d-flex align-items-center">
            <i class="fas fa-user text-primary me-2 fs-5"></i>
            <h1 class="h4 mb-0 fw-semibold">Detail User</h1>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('admin/users') ?>" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
            <?php if($user['id'] != session()->get('userId')): ?>
            <form action="<?= base_url('admin/users/'.$user['id']) ?>" method="post" class="d-inline">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?')">
                    <i class="fas fa-trash me-1"></i>Hapus
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-3">
        <!-- Profile Section -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <!-- Profile Header -->
                    <div class="d-flex align-items-start mb-3">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>&background=8a2be2&color=fff&size=80" 
                             class="rounded-circle border me-3" width="64" height="64" alt="<?= esc($user['name']) ?>">
                        <div>
                            <h5 class="mb-1 fw-semibold"><?= esc($user['name']) ?></h5>
                            <p class="text-muted small mb-2"><?= esc($user['email']) ?></p>
                            <span class="badge bg-<?= $user['role'] == 'admin' ? 'danger' : 'primary' ?>">
                                <i class="fas fa-<?= $user['role'] == 'admin' ? 'crown' : 'user' ?> me-1"></i>
                                <?= ucfirst($user['role']) ?>
                            </span>
                        </div>
                    </div>

                    <!-- Role Update -->
                    <div class="border-top pt-3">
                        <form action="<?= base_url('admin/users/update-role/'.$user['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <label class="form-label small text-muted mb-1">Ubah Role</label>
                            <div class="input-group input-group-sm">
                                <select name="role" class="form-select form-select-sm">
                                    <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Contact Info -->
                    <div class="border-top pt-3 mt-2">
                        <div class="small">
                            <div class="d-flex align-items-center mb-1">
                                <i class="fas fa-phone text-muted me-2" style="width: 16px;"></i>
                                <span class="text-muted"><?= $user['phone'] ?? '- Belum diisi -' ?></span>
                            </div>
                            <div class="d-flex align-items-start mb-1">
                                <i class="fas fa-map-marker-alt text-muted me-2 mt-1" style="width: 16px;"></i>
                                <span class="text-muted small"><?= $user['address'] ?? '- Belum diisi -' ?></span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt text-muted me-2" style="width: 16px;"></i>
                                <span class="text-muted">Bergabung: <?= date('d M Y', strtotime($user['created_at'])) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats & Content -->
        <div class="col-lg-8">
            <!-- Stats Cards Compact -->
            <div class="row g-2 mb-3">
                <?php
                $db = \Config\Database::connect();
                
                // Total Orders
                $totalOrders = $db->table('carts')->where('user_id', $user['id'])->countAllResults();
                
                // Total Spent
                $totalSpent = $db->table('carts')
                    ->selectSum('total')
                    ->where('user_id', $user['id'])
                    ->where('status_cart', 'completed')
                    ->get()
                    ->getRow();
                
                // Active Orders
                $activeOrders = $db->table('carts')
                    ->where('user_id', $user['id'])
                    ->whereIn('status_cart', ['cart', 'checkout', 'paid', 'shipped'])
                    ->countAllResults();
                
                // Total Articles
                $totalArticles = $db->table('articles')->where('user_id', $user['id'])->countAllResults();
                ?>
                
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-2 text-center">
                            <div class="text-muted small mb-1">Total Order</div>
                            <div class="h5 mb-0 fw-bold text-primary"><?= $totalOrders ?></div>
                            <small class="text-muted">Transaksi</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-2 text-center">
                            <div class="text-muted small mb-1">Total Belanja</div>
                            <div class="h5 mb-0 fw-bold text-success">Rp <?= number_format($totalSpent->total ?? 0, 0, ',', '.') ?></div>
                            <small class="text-muted">Pengeluaran</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-2 text-center">
                            <div class="text-muted small mb-1">Order Aktif</div>
                            <div class="h5 mb-0 fw-bold text-warning"><?= $activeOrders ?></div>
                            <small class="text-muted">Dalam Proses</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-2 text-center">
                            <div class="text-muted small mb-1">Artikel</div>
                            <div class="h5 mb-0 fw-bold text-info"><?= $totalArticles ?></div>
                            <small class="text-muted">Tulisan</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent py-2 px-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-semibold">Order Terbaru</h6>
                        <?php if($totalOrders > 0): ?>
                        <a href="<?= base_url('admin/orders') ?>?user=<?= $user['id'] ?>" class="btn btn-sm btn-outline-primary py-1 px-2">
                            Lihat Semua
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php
                    $recentOrders = $db->table('carts')
                        ->where('user_id', $user['id'])
                        ->orderBy('created_at', 'DESC')
                        ->limit(5)
                        ->get()
                        ->getResultArray();
                    
                    if (!empty($recentOrders)):
                        $statusColors = [
                            'cart' => 'secondary',
                            'checkout' => 'info',
                            'paid' => 'warning',
                            'shipped' => 'primary',
                            'completed' => 'success',
                            'canceled' => 'danger'
                        ];
                    ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th class="pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentOrders as $order): ?>
                                <tr>
                                    <td class="ps-3">
                                        <small class="text-primary"><?= substr($order['no_invoice'], 0, 12) ?>...</small>
                                    </td>
                                    <td><?= date('d/m/y', strtotime($order['created_at'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $statusColors[$order['status_cart']] ?? 'secondary' ?>">
                                            <?= substr(ucfirst($order['status_cart']), 0, 8) ?>
                                        </span>
                                    </td>
                                    <td class="text-end">Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                                    <td class="pe-3">
                                        <div class="d-flex gap-1">
                                            <a href="<?= base_url('admin/orders/'.$order['id']) ?>" class="btn btn-sm btn-outline-info p-1" title="Detail">
                                                <i class="fas fa-eye fs-7"></i>
                                            </a>
                                            <a href="<?= base_url('admin/orders/invoice/'.$order['id']) ?>" target="_blank" class="btn btn-sm btn-outline-warning p-1" title="Invoice">
                                                <i class="fas fa-file-invoice fs-7"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-shopping-cart text-muted fs-3 mb-2"></i>
                        <p class="text-muted mb-0 small">Belum ada order</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Articles (if any) -->
            <?php if($totalArticles > 0): ?>
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-transparent py-2 px-3 border-bottom">
                    <h6 class="mb-0 fw-semibold">Artikel Terbaru</h6>
                </div>
                <div class="card-body p-0">
                    <?php
                    $userArticles = $db->table('articles a')
                        ->select('a.*, c.name as category_name')
                        ->join('categories c', 'c.id = a.category_id')
                        ->where('a.user_id', $user['id'])
                        ->orderBy('a.created_at', 'DESC')
                        ->limit(3)
                        ->get()
                        ->getResultArray();
                    ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($userArticles as $article): ?>
                        <a href="<?= base_url('articles/'.$article['slug']) ?>" target="_blank" 
                           class="list-group-item list-group-item-action border-0 py-2 px-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="w-75">
                                    <div class="fw-medium small text-truncate"><?= esc($article['title']) ?></div>
                                    <div class="d-flex gap-3 mt-1">
                                        <small class="text-muted">
                                            <i class="fas fa-tag me-1"></i><?= $article['category_name'] ?>
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i><?= date('d/m/y', strtotime($article['created_at'])) ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-heart text-danger me-1"></i><?= $article['like_count'] ?>
                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-comment text-info me-1"></i><?= $article['comment_count'] ?>
                                    </small>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php if($totalArticles > 3): ?>
                    <div class="text-center py-2 border-top">
                        <a href="<?= base_url('admin/articles') ?>?author=<?= $user['id'] ?>" class="btn btn-sm btn-outline-primary">
                            Lihat Semua Artikel
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Simple confirmation for actions
    document.addEventListener('DOMContentLoaded', function() {
        // Handle role change form submission
        const roleForm = document.querySelector('form[action*="update-role"]');
        if (roleForm) {
            roleForm.addEventListener('submit', function(e) {
                if (!confirm('Ubah role user?')) {
                    e.preventDefault();
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>

<style>
    /* Minimal CSS for better spacing */
    .container-fluid {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .card {
        border-radius: 8px;
        margin-bottom: 0;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .table td, .table th {
        padding: 0.5rem;
        font-size: 0.875rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    
    .badge {
        font-size: 0.75em;
        padding: 0.25em 0.5em;
    }
    
    .list-group-item {
        border-left: 0;
        border-right: 0;
    }
    
    .list-group-item:first-child {
        border-top: 0;
    }
    
    .list-group-item:last-child {
        border-bottom: 0;
    }
    
    /* Mobile optimizations */
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        
        .card-body {
            padding: 0.75rem;
        }
        
        .h4 {
            font-size: 1.1rem;
        }
        
        .table-responsive {
            font-size: 0.8rem;
        }
        
        .table td, .table th {
            padding: 0.375rem;
        }
        
        .btn {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
        
        .row.g-3 {
            margin-left: -0.25rem;
            margin-right: -0.25rem;
        }
        
        .row.g-3 > [class*="col-"] {
            padding-left: 0.25rem;
            padding-right: 0.25rem;
        }
        
        .row.g-2 {
            margin-left: -0.125rem;
            margin-right: -0.125rem;
        }
        
        .row.g-2 > [class*="col-"] {
            padding-left: 0.125rem;
            padding-right: 0.125rem;
        }
        
        .fs-7 {
            font-size: 0.75rem !important;
        }
        
        .list-group-item {
            padding: 0.5rem 0.75rem;
        }
    }
    
    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 0.25rem;
            padding-right: 0.25rem;
        }
        
        .d-flex.gap-2 {
            gap: 0.25rem !important;
        }
        
        .card-header, .card-body {
            padding: 0.5rem;
        }
        
        .table-responsive {
            font-size: 0.7rem;
        }
        
        .badge {
            font-size: 0.65em;
            padding: 0.2em 0.4em;
        }
        
        .text-truncate {
            max-width: 150px;
        }
    }
</style>