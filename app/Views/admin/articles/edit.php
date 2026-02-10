<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Edit Artikel - Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-edit me-2"></i>Edit Artikel</h1>
        <div>
            <a href="/articles/<?= $article['slug'] ?>" target="_blank" class="btn btn-info me-2">
                <i class="fas fa-eye me-2"></i>Preview
            </a>
            <a href="<?= base_url('admin/articles') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Artikel: <?= esc($article['title']) ?></h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/articles/update/' . $article['id']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <!-- Judul -->
                        <div class="mb-3">
                            <label class="form-label">Judul Artikel</label>
                            <input type="text" name="title" class="form-control <?= (isset($validation) && $validation->hasError('title')) ? 'is-invalid' : '' ?>" 
                                   value="<?= old('title', $article['title']) ?>" required>
                            <?php if(isset($validation) && $validation->hasError('title')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('title') ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Gambar Utama -->
                        <div class="mb-3">
                            <label class="form-label">Gambar Utama</label>
                            <?php if($article['image']): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/articles/' . $article['image']) ?>" 
                                     class="img-thumbnail" width="150" alt="Current Image">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="remove_image" id="removeImage" value="1">
                                    <label class="form-check-label text-danger" for="removeImage">
                                        Hapus gambar ini
                                    </label>
                                </div>
                            </div>
                            <?php endif; ?>
                            <input type="file" name="image" class="form-control <?= (isset($validation) && $validation->hasError('image')) ? 'is-invalid' : '' ?>" 
                                   accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar</small>
                            <?php if(isset($validation) && $validation->hasError('image')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('image') ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Kategori & Tags -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= (old('category_id', $article['category_id']) == $cat['id']) ? 'selected' : '' ?>>
                                        <?= esc($cat['name']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tags</label>
                                <?php 
                                $selectedTags = explode(',', $article['tag']);
                                ?>
                                <select name="tags[]" class="form-select" multiple>
                                    <?php foreach($tags as $tag): ?>
                                    <option value="<?= $tag['id'] ?>" <?= in_array($tag['id'], $selectedTags) ? 'selected' : '' ?>>
                                        <?= esc($tag['title']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-muted">Tahan Ctrl untuk memilih multiple tags</small>
                            </div>
                        </div>

                        <!-- Konten -->
                        <div class="mb-3">
                            <label class="form-label">Konten Artikel</label>
                            <textarea name="content" id="editor" rows="15" class="form-control" required><?= old('content', $article['content']) ?></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/articles') ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Artikel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Article Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Artikel</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-link text-primary me-2"></i>
                            <strong>Slug:</strong> <?= $article['slug'] ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-calendar text-primary me-2"></i>
                            <strong>Dibuat:</strong> <?= date('d M Y H:i', strtotime($article['created_at'])) ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-edit text-primary me-2"></i>
                            <strong>Terakhir Diubah:</strong> <?= date('d M Y H:i', strtotime($article['updated_at'])) ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-heart text-primary me-2"></i>
                            <strong>Likes:</strong> <?= $article['like_count'] ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-comment text-primary me-2"></i>
                            <strong>Komentar:</strong> <?= $article['comment_count'] ?>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Actions -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <form action="<?= base_url('admin/articles/'.$article['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Hapus artikel ini?')">
                                <i class="fas fa-trash me-2"></i>Hapus Artikel
                            </button>
                        </form>
                        <a href="/articles/<?= $article['slug'] ?>" target="_blank" class="btn btn-info">
                            <i class="fas fa-external-link-alt me-2"></i>Lihat di Website
                        </a>
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
    CKEDITOR.replace('editor', {
        height: 300
    });

    // Image preview for new image
    document.querySelector('input[name="image"]')?.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.querySelector('.card-body img');
                if (preview) {
                    preview.src = e.target.result;
                }
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
<?= $this->endSection() ?>