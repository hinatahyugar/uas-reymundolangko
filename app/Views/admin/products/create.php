<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Tambah Produk - Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">
        <i class="fas fa-plus-circle me-2"></i> Tambah Produk Baru
    </h1>
    <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<!-- Alert Error -->
<?php if(session()->getFlashdata('errors')): ?>
<div class="alert alert-danger">
    <ul class="mb-0">
        <?php foreach(session()->getFlashdata('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<!-- Form -->
<div class="dashboard-card">
    <form action="<?= base_url('admin/products/store') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        
        <div class="row">
            <div class="col-md-8">
                <!-- Informasi Dasar -->
                <h5 class="mb-3" style="color: var(--primary-color);">
                    <i class="fas fa-info-circle me-2"></i> Informasi Produk
                </h5>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Produk *</label>
                    <input type="text" name="title" class="form-control" 
                           placeholder="Contoh: Batik Tulis Mega Mendung" required
                           value="<?= old('title') ?>">
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kategori *</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= old('category_id') == $cat['id'] ? 'selected' : '' ?>>
                                <?= $cat['name'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jenis Posting</label>
                        <select name="type" class="form-select">
                            <option value="standard">Standard</option>
                            <option value="headline">Headline</option>
                            <option value="latest_slider">Latest Slider</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Harga (Rp) *</label>
                        <input type="number" name="price" class="form-control" 
                               placeholder="500000" min="0" required
                               value="<?= old('price') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Diskon (%)</label>
                        <input type="number" name="discount" class="form-control" 
                               placeholder="0" min="0" max="100"
                               value="<?= old('discount') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Stok *</label>
                        <input type="number" name="stock" class="form-control" 
                               placeholder="100" min="0" required
                               value="<?= old('stock') ?>">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Deskripsi *</label>
                    <textarea name="description" class="form-control" rows="5" 
                              placeholder="Deskripsi lengkap produk..." required><?= old('description') ?></textarea>
                </div>

                <!-- URL Marketplace -->
                <h5 class="mb-3 mt-4" style="color: var(--primary-color);">
                    <i class="fas fa-store me-2"></i> Link Marketplace
                </h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Shopee</label>
                        <input type="url" name="shopee_url" class="form-control" 
                               placeholder="https://shopee.co.id/..." value="<?= old('shopee_url') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tokopedia</label>
                        <input type="url" name="tokopedia_url" class="form-control" 
                               placeholder="https://tokopedia.com/..." value="<?= old('tokopedia_url') ?>">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Lazada</label>
                        <input type="url" name="lazada_url" class="form-control" 
                               placeholder="https://lazada.co.id/..." value="<?= old('lazada_url') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Bukalapak</label>
                        <input type="url" name="bukalapak_url" class="form-control" 
                               placeholder="https://bukalapak.com/..." value="<?= old('bukalapak_url') ?>">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Gambar -->
                <h5 class="mb-3" style="color: var(--primary-color);">
                    <i class="fas fa-image me-2"></i> Gambar Produk
                </h5>
                <div class="mb-4">
                    <label class="form-label fw-bold">Upload Gambar *</label>
                    <div class="border rounded p-3 text-center">
                        <img id="imagePreview" src="https://via.placeholder.com/300x200?text=Preview" 
                             class="img-fluid mb-3 rounded" style="max-height: 200px;">
                        <input type="file" name="image" class="form-control" accept="image/*" required
                               onchange="previewImage(this)">
                        <small class="text-muted d-block mt-2">Format: JPG, PNG, GIF. Max: 2MB</small>
                    </div>
                </div>

                <!-- Status -->
                <h5 class="mb-3" style="color: var(--primary-color);">
                    <i class="fas fa-toggle-on me-2"></i> Status
                </h5>
                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" value="active" 
                               id="statusSwitch" checked>
                        <label class="form-check-label fw-bold" for="statusSwitch">
                            Aktifkan Produk
                        </label>
                    </div>
                    <small class="text-muted">Produk tidak aktif tidak akan ditampilkan di website.</small>
                </div>

                <!-- Tombol Simpan -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save me-2"></i> Simpan Produk
                    </button>
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-redo me-2"></i> Reset Form
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?= $this->endSection() ?>