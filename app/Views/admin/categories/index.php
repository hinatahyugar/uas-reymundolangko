<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Data Kategori - Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-tags me-2"></i>Data Kategori</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus me-2"></i>Tambah Kategori
        </button>
    </div>

    <!-- Categories Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="categoriesTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Jumlah Produk</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categories as $category): ?>
                        <tr>
                            <td><?= $category['id'] ?></td>
                            <td>
                                <strong><?= esc($category['name']) ?></strong>
                            </td>
                            <td><?= $category['slug'] ?></td>
                            <td>
                                <span class="badge bg-primary"><?= $category['product_count'] ?? 0 ?> produk</span>
                            </td>
                            <td><?= date('d M Y', strtotime($category['created_at'])) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning me-1" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editCategoryModal"
                                        data-id="<?= $category['id'] ?>"
                                        data-name="<?= esc($category['name']) ?>"
                                        title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="<?= base_url('admin/categories/'.$category['id']) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Hapus kategori <?= esc($category['name']) ?>?')"
                                            title="Hapus">
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

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/categories/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="name" class="form-control" required 
                               placeholder="Contoh: Batik, Fashion, Accessories">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editCategoryForm" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="name" id="editCategoryName" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        // DataTable
        $('#categoriesTable').DataTable({
            "order": [[0, "desc"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            }
        });

        // Edit modal handler
        $('#editCategoryModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            
            var modal = $(this);
            modal.find('#editCategoryName').val(name);
            modal.find('#editCategoryForm').attr('action', '/admin/categories/' + id);
        });
    });
</script>
<?= $this->endSection() ?>