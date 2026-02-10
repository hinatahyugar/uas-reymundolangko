<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Pengaturan Website - Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-cog me-2"></i>Pengaturan Website</h1>
    </div>

    <!-- Settings Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Website</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/settings/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Toko</label>
                                <input type="text" name="name" class="form-control" 
                                       value="<?= old('name', $config['name'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Logo Toko</label>
                                <input type="file" name="logo" class="form-control" accept="image/*">
                                <?php if(isset($config['logo']) && $config['logo']): ?>
                                <small class="text-muted">Logo saat ini: <?= $config['logo'] ?></small>
                                <div class="mt-2">
                                    <img src="<?= base_url('images/' . ($config['logo'] ?? 'logo.png')) ?>" 
                                         alt="Logo" class="img-thumbnail" width="100">
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="address" class="form-control" rows="3" required><?= old('address', $config['address'] ?? '') ?></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Telepon</label>
                                <input type="text" name="phone" class="form-control" 
                                       value="<?= old('phone', $config['phone'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" 
                                       value="<?= old('email', $config['email'] ?? '') ?>" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Website Info Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Sistem</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-code text-primary me-2"></i>
                            <strong>Framework:</strong> CodeIgniter 4
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-database text-primary me-2"></i>
                            <strong>Database:</strong> MySQL
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-calendar text-primary me-2"></i>
                            <strong>Versi:</strong> 1.0.0
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-user text-primary me-2"></i>
                            <strong>Developer:</strong> Beauty Fashion Team
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('/') ?>" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-external-link-alt me-2"></i>Lihat Website
                        </a>
                        <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <button class="btn btn-outline-danger" onclick="clearCache()">
                            <i class="fas fa-broom me-2"></i>Bersihkan Cache
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function clearCache() {
        if(confirm('Yakin ingin membersihkan cache?')) {
            fetch('<?= base_url("admin/settings/clear-cache") ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert('Cache berhasil dibersihkan!');
                } else {
                    alert('Gagal membersihkan cache.');
                }
            });
        }
    }
</script>
<?= $this->endSection() ?>