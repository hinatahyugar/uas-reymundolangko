<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Detail Produk - <?= esc($product['title']) ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
.product-detail-page .card {
    border-radius: 10px;
    border: 1px solid #e3e6f0;
}

.product-detail-page .card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
    padding: 1rem 1.25rem;
}

.product-detail-page .badge {
    font-size: 0.85em;
    padding: 0.4em 0.8em;
}

.product-detail-page .product-image {
    border-radius: 8px;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    max-height: 400px;
    object-fit: contain;
    background: #f8f9fa;
    padding: 10px;
}

.product-detail-page .info-label {
    font-weight: 600;
    color: #5a5c69;
    min-width: 150px;
    display: inline-block;
}

.product-detail-page .info-value {
    color: #3a3b45;
    font-weight: 500;
}

.product-detail-page .price-badge {
    font-size: 1.5rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
}

.product-detail-page .description-box {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1.5rem;
    border-left: 4px solid #4e73df;
    max-height: 300px;
    overflow-y: auto;
}

.product-detail-page .marketplace-links .list-group-item {
    border: none;
    border-bottom: 1px solid #e3e6f0;
    padding: 0.75rem 0;
}

.product-detail-page .marketplace-links .list-group-item:last-child {
    border-bottom: none;
}

.product-detail-page .stat-card {
    transition: transform 0.2s;
}

.product-detail-page .stat-card:hover {
    transform: translateY(-3px);
}

.product-detail-page .btn-action {
    min-width: 120px;
}

@media (max-width: 768px) {
    .product-detail-page .info-label {
        min-width: 120px;
    }
    
    .product-detail-page .btn-group {
        flex-direction: column;
        width: 100%;
    }
    
    .product-detail-page .btn-group .btn {
        margin-bottom: 0.5rem;
        width: 100%;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid product-detail-page">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2 text-gray-800">
                <i class="fas fa-box-open text-primary me-2"></i>Detail Produk
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/products') ?>">Produk</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group">
            <a href="<?= base_url('products/' . $product['id']) ?>" target="_blank" class="btn btn-info">
                <i class="fas fa-eye me-2"></i>Preview
            </a>
            <a href="<?= base_url('admin/products/edit/' . $product['id']) ?>" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Product Image & Basic Info -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-image me-2"></i>Gambar Produk
                    </h6>
                </div>
                <div class="card-body text-center">
                    <?php if($product['image'] && file_exists(FCPATH . 'uploads/products/' . $product['image'])): ?>
                        <img src="<?= base_url('uploads/products/' . $product['image']) ?>" 
                             class="img-fluid product-image mb-3" 
                             alt="<?= esc($product['title']) ?>">
                    <?php elseif($product['image']): ?>
                        <div class="alert alert-warning mb-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            File gambar tidak ditemukan
                        </div>
                        <div class="text-muted mb-3">
                            <i class="fas fa-image fa-4x"></i>
                        </div>
                    <?php else: ?>
                        <div class="text-muted mb-3">
                            <i class="fas fa-image fa-4x"></i>
                            <p class="mt-2">Tidak ada gambar</p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('admin/products/edit/' . $product['id']) ?>" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit Produk
                        </a>
                        <button type="button" class="btn btn-outline-primary" onclick="copyProductLink()">
                            <i class="fas fa-copy me-2"></i>Copy Link
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i>Informasi Produk
                    </h6>
                    <div>
                        <span class="badge bg-<?= $product['status'] == 'active' ? 'success' : 'secondary' ?>">
                            <?= $product['status'] == 'active' ? 'Aktif' : 'Nonaktif' ?>
                        </span>
                        <span class="badge bg-info ms-2">
                            <?= str_replace('_', ' ', ucfirst($product['type'])) ?>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Product Title -->
                    <h4 class="mb-4 text-dark"><?= esc($product['title']) ?></h4>
                    
                    <!-- Basic Info -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <span class="info-label">ID Produk:</span>
                                <span class="info-value ms-2">#<?= $product['id'] ?></span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="info-label">Slug:</span>
                                <span class="info-value ms-2"><?= $product['slug'] ?></span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="info-label">Kategori:</span>
                                <span class="info-value ms-2">
                                    <?php 
                                    $categoryModel = new \App\Models\CategoryModel();
                                    $category = $categoryModel->find($product['category_id']);
                                    echo $category ? esc($category['name']) : 'Tidak diketahui';
                                    ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <span class="info-label">Dibuat:</span>
                                <span class="info-value ms-2">
                                    <?= date('d M Y H:i', strtotime($product['created_at'])) ?>
                                </span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="info-label">Diupdate:</span>
                                <span class="info-value ms-2">
                                    <?= date('d M Y H:i', strtotime($product['updated_at'])) ?>
                                </span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="info-label">Stok:</span>
                                <span class="info-value ms-2 <?= $product['stock'] <= 0 ? 'text-danger' : ($product['stock'] <= 10 ? 'text-warning' : 'text-success') ?>">
                                    <?= $product['stock'] ?> unit
                                    <?php if($product['stock'] <= 0): ?>
                                        <span class="badge bg-danger ms-2">Habis</span>
                                    <?php elseif($product['stock'] <= 10): ?>
                                        <span class="badge bg-warning ms-2">Sedikit</span>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Price Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card border-left-primary h-100">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Harga Normal
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp <?= number_format($product['price'], 0, ',', '.') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-left-success h-100">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Harga Setelah Diskon
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $finalPrice = $product['price'];
                                        if ($product['discount'] > 0) {
                                            $finalPrice = $product['price'] * (1 - $product['discount']/100);
                                        }
                                        ?>
                                        Rp <?= number_format($finalPrice, 0, ',', '.') ?>
                                        <?php if($product['discount'] > 0): ?>
                                            <small class="text-danger">(-<?= $product['discount'] ?>%)</small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <h6 class="font-weight-bold text-primary mb-2">
                            <i class="fas fa-align-left me-2"></i>Deskripsi Produk
                        </h6>
                        <div class="description-box">
                            <?= nl2br(esc($product['description'])) ?>
                        </div>
                    </div>

                    <!-- Marketplace Links -->
                    <?php if($product['shopee_url'] || $product['tokopedia_url'] || $product['lazada_url'] || $product['bukalapak_url']): ?>
                    <div class="mb-4">
                        <h6 class="font-weight-bold text-primary mb-3">
                            <i class="fas fa-store me-2"></i>Link Marketplace
                        </h6>
                        <div class="marketplace-links">
                            <div class="list-group">
                                <?php if($product['shopee_url']): ?>
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fab fa-shopify text-orange me-2"></i>
                                            <strong>Shopee:</strong>
                                        </div>
                                        <a href="<?= $product['shopee_url'] ?>" target="_blank" class="btn btn-sm btn-outline-orange">
                                            <i class="fas fa-external-link-alt me-1"></i> Kunjungi
                                        </a>
                                    </div>
                                    <small class="text-muted d-block mt-1"><?= $product['shopee_url'] ?></small>
                                </div>
                                <?php endif; ?>
                                
                                <?php if($product['tokopedia_url']): ?>
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-store text-green me-2"></i>
                                            <strong>Tokopedia:</strong>
                                        </div>
                                        <a href="<?= $product['tokopedia_url'] ?>" target="_blank" class="btn btn-sm btn-outline-green">
                                            <i class="fas fa-external-link-alt me-1"></i> Kunjungi
                                        </a>
                                    </div>
                                    <small class="text-muted d-block mt-1"><?= $product['tokopedia_url'] ?></small>
                                </div>
                                <?php endif; ?>
                                
                                <?php if($product['lazada_url']): ?>
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-shopping-bag text-red me-2"></i>
                                            <strong>Lazada:</strong>
                                        </div>
                                        <a href="<?= $product['lazada_url'] ?>" target="_blank" class="btn btn-sm btn-outline-red">
                                            <i class="fas fa-external-link-alt me-1"></i> Kunjungi
                                        </a>
                                    </div>
                                    <small class="text-muted d-block mt-1"><?= $product['lazada_url'] ?></small>
                                </div>
                                <?php endif; ?>
                                
                                <?php if($product['bukalapak_url']): ?>
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-shopping-cart text-purple me-2"></i>
                                            <strong>Bukalapak:</strong>
                                        </div>
                                        <a href="<?= $product['bukalapak_url'] ?>" target="_blank" class="btn btn-sm btn-outline-purple">
                                            <i class="fas fa-external-link-alt me-1"></i> Kunjungi
                                        </a>
                                    </div>
                                    <small class="text-muted d-block mt-1"><?= $product['bukalapak_url'] ?></small>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats & Actions -->
    <div class="row">
        <!-- Quick Stats -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-bar me-2"></i>Statistik Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card border-left-primary stat-card">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Terjual
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= rand(0, 50) ?>
                                    </div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2">
                                            <i class="fas fa-arrow-up"></i> 12%
                                        </span>
                                        <span>Bulan ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-left-success stat-card">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Dilihat
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= rand(100, 500) ?>
                                    </div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2">
                                            <i class="fas fa-arrow-up"></i> 8%
                                        </span>
                                        <span>Bulan ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-left-info stat-card">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Rating
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        4.5
                                    </div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-left-warning stat-card">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Wishlist
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= rand(5, 30) ?>
                                    </div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2">
                                            <i class="fas fa-arrow-up"></i> 5%
                                        </span>
                                        <span>Bulan ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt me-2"></i>Aksi Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('admin/products/edit/' . $product['id']) ?>" class="btn btn-primary btn-action">
                            <i class="fas fa-edit me-2"></i> Edit Produk
                        </a>
                        <a href="<?= base_url('products/' . $product['id']) ?>" target="_blank" class="btn btn-info btn-action">
                            <i class="fas fa-eye me-2"></i> Preview Frontend
                        </a>
                        <button type="button" class="btn btn-success btn-action" onclick="duplicateProduct()">
                            <i class="fas fa-copy me-2"></i> Duplikat Produk
                        </button>
                        <button type="button" class="btn btn-warning btn-action" onclick="toggleStatus()">
                            <i class="fas fa-power-off me-2"></i> 
                            <?= $product['status'] == 'active' ? 'Nonaktifkan' : 'Aktifkan' ?>
                        </button>
                        <button type="button" class="btn btn-danger btn-action" onclick="confirmDelete()">
                            <i class="fas fa-trash me-2"></i> Hapus Produk
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus produk ini?</p>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>PERHATIAN:</strong> Tindakan ini tidak dapat dibatalkan. Semua data produk akan dihapus permanen.
                </div>
                <p><strong>Produk yang akan dihapus:</strong></p>
                <ul>
                    <li>ID: #<?= $product['id'] ?></li>
                    <li>Nama: <?= esc($product['title']) ?></li>
                    <li>Gambar: <?= $product['image'] ? 'Akan dihapus' : 'Tidak ada' ?></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <form action="<?= base_url('admin/products/' . $product['id']) ?>" method="post" class="d-inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Copy product link to clipboard
function copyProductLink() {
    const link = '<?= base_url("products/" . $product["id"]) ?>';
    navigator.clipboard.writeText(link).then(() => {
        showNotification('Link produk berhasil disalin!', 'success');
    }).catch(err => {
        console.error('Failed to copy: ', err);
        showNotification('Gagal menyalin link', 'error');
    });
}

// Toggle product status
function toggleStatus() {
    const newStatus = '<?= $product["status"] ?>' === 'active' ? 'inactive' : 'active';
    const statusText = newStatus === 'active' ? 'mengaktifkan' : 'menonaktifkan';
    
    if (confirm(`Apakah Anda yakin ingin ${statusText} produk ini?`)) {
        fetch('<?= base_url("admin/products/update-status/" . $product["id"]) ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: new URLSearchParams({
                'status': newStatus,
                'csrf_test_name': '<?= csrf_hash() ?>'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showNotification(data.message || 'Terjadi kesalahan', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan', 'error');
        });
    }
}

// Duplicate product
function duplicateProduct() {
    if (confirm('Duplikat produk ini?')) {
        fetch('<?= base_url("admin/products/duplicate/" . $product["id"]) ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: new URLSearchParams({
                'csrf_test_name': '<?= csrf_hash() ?>'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                setTimeout(() => {
                    window.location.href = '<?= base_url("admin/products") ?>';
                }, 1500);
            } else {
                showNotification(data.message || 'Terjadi kesalahan', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan', 'error');
        });
    }
}

// Show delete confirmation modal
function confirmDelete() {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

// Notification function
function showNotification(message, type) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const icon = type === 'success' ? 'check-circle' : 'exclamation-triangle';
    
    const notification = document.createElement('div');
    notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        <i class="fas fa-${icon} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => {
        new bootstrap.Tooltip(tooltip);
    });
    
    // Add color classes for marketplace buttons
    document.querySelectorAll('.btn-outline-orange').forEach(btn => {
        btn.style.color = '#ff5722';
        btn.style.borderColor = '#ff5722';
    });
    
    document.querySelectorAll('.btn-outline-green').forEach(btn => {
        btn.style.color = '#4CAF50';
        btn.style.borderColor = '#4CAF50';
    });
    
    document.querySelectorAll('.btn-outline-red').forEach(btn => {
        btn.style.color = '#f44336';
        btn.style.borderColor = '#f44336';
    });
    
    document.querySelectorAll('.btn-outline-purple').forEach(btn => {
        btn.style.color = '#9C27B0';
        btn.style.borderColor = '#9C27B0';
    });
});
</script>
<?= $this->endSection() ?>