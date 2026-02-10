<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Data Produk - Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">
        <i class="fas fa-box me-2"></i> Data Produk
    </h1>
    <a href="<?= base_url('admin/products/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i> Tambah Produk
    </a>
</div>

<!-- Alert -->
<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<!-- Tabel Produk -->
<div class="data-table">
    <div class="table-header">
        <h5>Daftar Produk</h5>
        <div class="input-group" style="width: 300px;">
            <input type="text" class="form-control" placeholder="Cari produk...">
            <button class="btn btn-outline-secondary" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($products)): ?>
                <tr>
                    <td colspan="7" class="text-center py-4">
                        <i class="fas fa-box-open fa-2x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada produk</p>
                    </td>
                </tr>
                <?php else: ?>
                <?php $no = 1; foreach($products as $product): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="<?= base_url('uploads/products/' . $product['image']) ?>" 
                                 class="rounded me-3" width="50" height="50" 
                                 onerror="this.src='https://via.placeholder.com/50'">
                            <div>
                                <div class="fw-bold"><?= $product['title'] ?></div>
                                <small class="text-muted">ID: <?= $product['id'] ?></small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-info"><?= $product['category_name'] ?? 'Uncategorized' ?></span>
                    </td>
                    <td>
                        <div class="fw-bold text-primary">Rp <?= number_format($product['price'], 0, ',', '.') ?></div>
                        <?php if($product['discount'] > 0): ?>
                        <small class="text-danger"><s>Rp <?= number_format($product['price'] * (1 + $product['discount']/100), 0, ',', '.') ?></s></small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="<?= $product['stock'] > 10 ? 'text-success' : ($product['stock'] > 0 ? 'text-warning' : 'text-danger') ?>">
                            <?= $product['stock'] ?>
                        </span>
                    </td>
                    <td>
                        <span class="status-badge <?= $product['status'] == 'active' ? 'active' : 'pending' ?>">
                            <?= ucfirst($product['status']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="<?= base_url('admin/products/' . $product['id']) ?>" class="btn btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?= base_url('admin/products/edit/' . $product['id']) ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $product['id'] ?>)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="table-footer p-3 border-top d-flex justify-content-between">
        <div class="text-muted">Menampilkan <?= count($products) ?> produk</div>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" action="">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    document.getElementById('deleteForm').action = '<?= base_url('admin/products') ?>/' + id;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
<?= $this->endSection() ?>