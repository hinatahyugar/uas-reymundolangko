<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Manajemen Artikel - Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-newspaper me-2"></i>Manajemen Artikel</h1>
        <a href="<?= base_url('admin/articles/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Artikel
        </a>
    </div>

    <!-- Articles Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Artikel</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="articlesTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">ID</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($articles as $article): ?>
                        <?php 
                        $userModel = new \App\Models\UserModel();
                        $user = $userModel->find($article['user_id']);
                        $categoryModel = new \App\Models\CategoryModel();
                        $category = $categoryModel->find($article['category_id']);
                        ?>
                        <tr>
                            <td><?= $article['id'] ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?= base_url('uploads/articles/' . ($article['image'] ?? 'default.jpg')) ?>" 
                                         class="rounded me-2" width="40" height="40" style="object-fit: cover;">
                                    <div>
                                        <strong><?= esc($article['title']) ?></strong>
                                        <div class="text-muted small"><?= substr(strip_tags($article['content']), 0, 50) ?>...</div>
                                    </div>
                                </div>
                            </td>
                            <td><?= $category['name'] ?? '-' ?></td>
                            <td><?= $user['name'] ?? '-' ?></td>
                            <td><?= date('d M Y', strtotime($article['created_at'])) ?></td>
                            <td>
                                <span class="badge bg-success">Published</span>
                            </td>
                            <td>
                                <a href="/articles/<?= $article['slug'] ?>" target="_blank" class="btn btn-sm btn-info" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/articles/edit/'.$article['id']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?= base_url('admin/articles/'.$article['id']) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus artikel ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#articlesTable').DataTable({
            "order": [[0, "desc"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            }
        });
    });
</script>
<?= $this->endSection() ?>