<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Tambah Artikel Baru - Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-plus me-2"></i>Tambah Artikel Baru</h1>
        <a href="<?= base_url('admin/articles') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <!-- Create Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Artikel</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/articles/store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <!-- Judul -->
                        <div class="mb-3">
                            <label class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control <?= (isset($validation) && $validation->hasError('title')) ? 'is-invalid' : '' ?>" 
                                   value="<?= old('title') ?>" required>
                            <?php if(isset($validation) && $validation->hasError('title')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('title') ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Gambar Utama -->
                        <div class="mb-3">
                            <label class="form-label">Gambar Utama <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control <?= (isset($validation) && $validation->hasError('image')) ? 'is-invalid' : '' ?>" 
                                   accept="image/*" required>
                            <small class="text-muted">Ukuran maksimal 2MB, format: JPG, PNG, GIF</small>
                            <?php if(isset($validation) && $validation->hasError('image')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('image') ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Kategori & Tags -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= old('category_id') == $cat['id'] ? 'selected' : '' ?>>
                                        <?= esc($cat['name']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tags</label>
                                <select name="tags[]" class="form-select" multiple>
                                    <?php foreach($tags as $tag): ?>
                                    <option value="<?= $tag['id'] ?>"><?= esc($tag['title']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-muted">Tahan Ctrl untuk memilih multiple tags</small>
                            </div>
                        </div>

                        <!-- Konten -->
                        <div class="mb-3">
                            <label class="form-label">Konten Artikel <span class="text-danger">*</span></label>
                            <textarea name="content" id="editor" rows="15" class="form-control" required><?= old('content') ?></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Artikel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Publishing Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Publishing</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="draft" value="draft" checked>
                            <label class="form-check-label" for="draft">
                                Draft
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="published" value="published">
                            <label class="form-check-label" for="published">
                                Published
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="submit" form="articleForm" class="btn btn-success w-100">
                            <i class="fas fa-paper-plane me-2"></i>Publish Sekarang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Image Preview -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Preview Gambar</h6>
                </div>
                <div class="card-body text-center">
                    <img id="imagePreview" src="https://via.placeholder.com/300x200?text=Preview+Gambar" 
                         class="img-fluid rounded" alt="Preview" style="max-height: 200px;">
                    <div class="mt-2">
                        <small class="text-muted">Gambar akan muncul di sini</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    // CKEditor
    CKEDITOR.replace('editor', {
        height: 300
    });

    // Image preview
    document.querySelector('input[name="image"]').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        }
        reader.readAsDataURL(this.files[0]);
    });
</script>
<?= $this->endSection() ?>