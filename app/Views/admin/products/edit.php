<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Edit Produk - <?= esc($product['title']) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-edit me-2"></i>Edit Produk</h1>
        <div class="btn-group">
            <a href="<?= base_url('products/' . $product['slug']) ?>" target="_blank" class="btn btn-info">
                <i class="fas fa-eye me-2"></i>Preview
            </a>
            <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Produk</h6>
                </div>
                <div class="card-body">
                    <!-- PERBAIKAN: HANYA SATU FORM TAG -->
                    <form action="<?= base_url('admin/products/update/' . $product['id']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <!-- Judul Produk -->
                        <div class="mb-3">
                            <label class="form-label">Judul Produk <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control <?= (isset($validation) && $validation->hasError('title')) ? 'is-invalid' : '' ?>" 
                                   value="<?= old('title', $product['title']) ?>" required>
                            <?php if(isset($validation) && $validation->hasError('title')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('title') ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Gambar Produk -->
                        <div class="mb-4">
                            <label class="form-label">Gambar Produk</label>
                            <?php if($product['image']): ?>
                            <div class="mb-3">
                                <img src="<?= base_url('uploads/products/' . $product['image']) ?>" 
                                     class="img-thumbnail" width="200" alt="Current Image" id="currentImage">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="remove_image" id="removeImage" value="1">
                                    <label class="form-check-label text-danger" for="removeImage">
                                        Hapus gambar ini
                                    </label>
                                </div>
                            </div>
                            <?php endif; ?>
                            <input type="file" name="image" class="form-control <?= (isset($validation) && $validation->hasError('image')) ? 'is-invalid' : '' ?>" 
                                   accept="image/*" id="imageInput">
                            <small class="text-muted">Ukuran maksimal 2MB, format: JPG, PNG, GIF. Biarkan kosong jika tidak ingin mengganti.</small>
                            <?php if(isset($validation) && $validation->hasError('image')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('image') ?>
                            </div>
                            <?php endif; ?>
                            <div class="mt-2">
                                <img id="imagePreview" src="https://via.placeholder.com/300x200?text=Preview+Gambar+Baru" 
                                     class="img-thumbnail d-none" width="200" alt="Preview">
                            </div>
                        </div>

                        <!-- Kategori & Harga -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= (old('category_id', $product['category_id']) == $cat['id']) ? 'selected' : '' ?>>
                                        <?= esc($cat['name']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="price" class="form-control" 
                                           value="<?= old('price', $product['price']) ?>" min="0" required>
                                </div>
                            </div>
                        </div>

                        <!-- Diskon & Stok -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Diskon (%)</label>
                                <div class="input-group">
                                    <input type="number" name="discount" class="form-control" 
                                           value="<?= old('discount', $product['discount']) ?>" min="0" max="100">
                                    <span class="input-group-text">%</span>
                                </div>
                                <small class="text-muted">Masukkan 0-100, 0 berarti tidak ada diskon</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Stok <span class="text-danger">*</span></label>
                                <input type="number" name="stock" class="form-control" 
                                       value="<?= old('stock', $product['stock']) ?>" min="0" required>
                            </div>
                        </div>

                        <!-- Type & Status -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tipe Produk</label>
                                <select name="type" class="form-select">
                                    <option value="standard" <?= (old('type', $product['type']) == 'standard') ? 'selected' : '' ?>>Standard</option>
                                    <option value="headline" <?= (old('type', $product['type']) == 'headline') ? 'selected' : '' ?>>Headline</option>
                                    <option value="latest_slider" <?= (old('type', $product['type']) == 'latest_slider') ? 'selected' : '' ?>>Latest Slider</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="active" <?= (old('status', $product['status']) == 'active') ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= (old('status', $product['status']) == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label class="form-label">Deskripsi Produk <span class="text-danger">*</span></label>
                            <textarea name="description" id="editor" rows="8" class="form-control" required><?= old('description', $product['description']) ?></textarea>
                        </div>

                        <!-- Marketplace Links -->
                        <div class="card border-primary mb-4">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0"><i class="fas fa-store me-2"></i>Link Marketplace</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Shopee</label>
                                        <input type="url" name="shopee_url" class="form-control" 
                                               value="<?= old('shopee_url', $product['shopee_url']) ?>" 
                                               placeholder="https://shopee.co.id/...">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tokopedia</label>
                                        <input type="url" name="tokopedia_url" class="form-control" 
                                               value="<?= old('tokopedia_url', $product['tokopedia_url']) ?>" 
                                               placeholder="https://tokopedia.com/...">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Lazada</label>
                                        <input type="url" name="lazada_url" class="form-control" 
                                               value="<?= old('lazada_url', $product['lazada_url']) ?>" 
                                               placeholder="https://lazada.co.id/...">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Bukalapak</label>
                                        <input type="url" name="bukalapak_url" class="form-control" 
                                               value="<?= old('bukalapak_url', $product['bukalapak_url']) ?>" 
                                               placeholder="https://bukalapak.com/...">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="fas fa-redo me-2"></i>Reset
                                </button>
                            </div>
                            <div class="btn-group">
                                <a href="<?= base_url('admin/products') ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Produk
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <!-- Product Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Produk</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-hashtag text-primary me-2"></i>
                            <strong>ID:</strong> <?= $product['id'] ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-link text-primary me-2"></i>
                            <strong>Slug:</strong> <?= $product['slug'] ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-calendar text-primary me-2"></i>
                            <strong>Dibuat:</strong> 
                            <?= date('d M Y H:i', strtotime($product['created_at'])) ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-edit text-primary me-2"></i>
                            <strong>Terakhir Diubah:</strong> 
                            <?= date('d M Y H:i', strtotime($product['updated_at'])) ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-tag text-primary me-2"></i>
                            <strong>Harga Setelah Diskon:</strong>
                            <div class="h5 text-success mt-1">
                                <?php
                                $discountedPrice = $product['price'];
                                if ($product['discount'] > 0) {
                                    $discountedPrice = $product['price'] * (1 - $product['discount'] / 100);
                                }
                                ?>
                                Rp <?= number_format($discountedPrice, 0, ',', '.') ?>
                                <?php if($product['discount'] > 0): ?>
                                <small class="text-danger">(-<?= $product['discount'] ?>%)</small>
                                <?php endif; ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="p-3 border rounded">
                                <div class="text-primary mb-1">
                                    <i class="fas fa-shopping-cart fa-2x"></i>
                                </div>
                                <div class="h5 mb-0"><?= rand(0, 50) ?></div>
                                <small class="text-muted">Terjual</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="p-3 border rounded">
                                <div class="text-success mb-1">
                                    <i class="fas fa-eye fa-2x"></i>
                                </div>
                                <div class="h5 mb-0"><?= rand(100, 500) ?></div>
                                <small class="text-muted">Dilihat</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="card shadow border-danger">
                <div class="card-header py-3 bg-danger text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-exclamation-triangle me-2"></i>Zona Berbahaya</h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-3">
                        Tindakan ini tidak dapat dibatalkan. Produk akan dihapus permanen dari database.
                    </p>
                    <form action="<?= base_url('admin/products/' . $product['id']) ?>" method="post" 
                          onsubmit="return confirmDelete()">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Hapus Produk
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<!-- CKEditor CSS (optional) -->
<style>
    .ck-editor__editable {
        min-height: 200px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- FIX: Upgrade CKEditor ke versi LTS terbaru -->
<script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
<script>
    // Inisialisasi CKEditor dengan konfigurasi
    CKEDITOR.replace('editor', {
        height: 200,
        toolbar: [
            ['Bold', 'Italic', 'Underline', 'Strike', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', '-', 'RemoveFormat'],
            ['Format', 'FontSize', 'TextColor', 'BGColor'],
            ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'],
            ['Maximize', 'Source']
        ],
        // Tambahkan CSRF token untuk upload image jika diperlukan
        filebrowserUploadUrl: '<?= base_url("admin/products/upload-image") ?>?<?= csrf_token() ?>=<?= csrf_hash() ?>',
        filebrowserUploadMethod: 'form'
    });

    // Image preview
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const currentImage = document.getElementById('currentImage');
        
        if (this.files && this.files[0]) {
            // Validasi ukuran file (max 2MB)
            if (this.files[0].size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB!');
                this.value = '';
                return;
            }
            
            // Validasi tipe file
            const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!validTypes.includes(this.files[0].type)) {
                alert('Format file harus JPG, PNG, GIF, atau WebP!');
                this.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                
                // Hide current image if exists
                if (currentImage) {
                    currentImage.classList.add('d-none');
                }
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            preview.classList.add('d-none');
            if (currentImage) {
                currentImage.classList.remove('d-none');
            }
        }
    });

    // Remove image checkbox
    document.getElementById('removeImage')?.addEventListener('change', function() {
        const currentImage = document.getElementById('currentImage');
        const preview = document.getElementById('imagePreview');
        const imageInput = document.getElementById('imageInput');
        
        if (this.checked) {
            if (currentImage) {
                currentImage.classList.add('d-none');
            }
            preview.classList.add('d-none');
            // Reset file input jika ada
            if (imageInput) {
                imageInput.value = '';
            }
        } else {
            if (currentImage) {
                currentImage.classList.remove('d-none');
            }
        }
    });

    // Confirm delete dengan sweet alert atau confirm biasa
    function confirmDelete() {
        return confirm('HAPUS PRODUK INI?\n\nTindakan ini tidak dapat dibatalkan.\nSemua data produk akan dihapus permanen.');
    }

    // Auto calculate discounted price dan tampilkan
    function calculateDiscountedPrice() {
        const price = parseFloat(document.querySelector('input[name="price"]').value) || 0;
        const discount = parseFloat(document.querySelector('input[name="discount"]').value) || 0;
        
        let discountedPrice = price;
        if (discount > 0 && discount <= 100) {
            discountedPrice = price * (1 - discount / 100);
        }
        
        // Update tampilan harga diskon di sidebar
        const discountDisplay = document.getElementById('discountedPriceDisplay');
        if (discountDisplay) {
            discountDisplay.innerHTML = `Rp ${discountedPrice.toLocaleString('id-ID')}`;
            if (discount > 0) {
                discountDisplay.innerHTML += ` <small class="text-danger">(-${discount}%)</small>`;
            }
        }
    }

    // Attach event listeners untuk kalkulasi harga
    document.querySelector('input[name="price"]')?.addEventListener('input', calculateDiscountedPrice);
    document.querySelector('input[name="discount"]')?.addEventListener('input', calculateDiscountedPrice);

    // Validasi form sebelum submit
    document.querySelector('form')?.addEventListener('submit', function(e) {
        const price = parseFloat(document.querySelector('input[name="price"]').value) || 0;
        const discount = parseFloat(document.querySelector('input[name="discount"]').value) || 0;
        const stock = parseInt(document.querySelector('input[name="stock"]').value) || 0;
        
        // Validasi harga
        if (price < 0) {
            e.preventDefault();
            alert('Harga tidak boleh negatif!');
            document.querySelector('input[name="price"]').focus();
            return false;
        }
        
        // Validasi diskon
        if (discount < 0 || discount > 100) {
            e.preventDefault();
            alert('Diskon harus antara 0-100%!');
            document.querySelector('input[name="discount"]').focus();
            return false;
        }
        
        // Validasi stok
        if (stock < 0) {
            e.preventDefault();
            alert('Stok tidak boleh negatif!');
            document.querySelector('input[name="stock"]').focus();
            return false;
        }
        
        // Validasi URL marketplace
        const urlInputs = document.querySelectorAll('input[type="url"]');
        urlInputs.forEach(input => {
            if (input.value && !isValidUrl(input.value)) {
                e.preventDefault();
                alert(`URL ${input.previousElementSibling?.textContent || ''} tidak valid!`);
                input.focus();
                return false;
            }
        });
        
        return true;
    });
    
    // Fungsi validasi URL sederhana
    function isValidUrl(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }

    // Inisialisasi kalkulasi harga saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        calculateDiscountedPrice();
        
        // Tambahkan display untuk harga diskon real-time jika belum ada
        const sidebar = document.querySelector('.card-body ul');
        if (sidebar && !document.getElementById('discountedPriceDisplay')) {
            const priceItem = document.createElement('li');
            priceItem.className = 'mb-2';
            priceItem.innerHTML = `
                <i class="fas fa-calculator text-primary me-2"></i>
                <strong>Harga Real-time:</strong>
                <div class="h5 text-success mt-1" id="discountedPriceDisplay">
                    Sedang menghitung...
                </div>
            `;
            sidebar.appendChild(priceItem);
            calculateDiscountedPrice();
        }
    });
</script>
<?= $this->endSection() ?>