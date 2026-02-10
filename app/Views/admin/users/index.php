<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
User Management
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid px-0 px-md-2">
    <!-- Compact Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 py-2 border-bottom">
        <div class="d-flex align-items-center">
            <i class="fas fa-users text-primary me-2 fs-5"></i>
            <h1 class="h4 mb-0 fw-semibold">Manajemen User</h1>
        </div>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-plus me-1"></i>Tambah User
        </button>
    </div>

    <!-- Users Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent py-2 px-3 border-bottom">
            <h6 class="mb-0 fw-semibold">Daftar User</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0" id="usersTable">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3" style="width: 60px;">ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th style="width: 120px;">Role</th>
                            <th style="width: 110px;">Daftar</th>
                            <th class="pe-3" style="width: 90px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td class="ps-3">
                                <span class="text-muted small">#<?= $user['id'] ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>&background=8a2be2&color=fff&size=32" 
                                         class="rounded-circle me-2" width="28" height="28">
                                    <div>
                                        <div class="fw-medium small"><?= esc($user['name']) ?></div>
                                        <?php if($user['id'] == session()->get('userId')): ?>
                                        <small class="text-primary"><i class="fas fa-user me-1"></i>Anda</small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="small text-truncate" style="max-width: 180px;"><?= esc($user['email']) ?></div>
                            </td>
                            <td>
                                <form action="<?= base_url('admin/users/update-role/'.$user['id']) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <small class="text-muted"><?= date('d/m/y', strtotime($user['created_at'])) ?></small>
                            </td>
                            <td class="pe-3">
                                <div class="d-flex gap-1">
                                    <a href="<?= base_url('admin/users/'.$user['id']) ?>" class="btn btn-sm btn-outline-info p-1" title="Detail">
                                        <i class="fas fa-eye fs-7"></i>
                                    </a>
                                    <?php if($user['id'] != session()->get('userId')): ?>
                                    <form action="<?= base_url('admin/users/'.$user['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-outline-danger p-1" title="Hapus" 
                                                onclick="return confirm('Hapus user ini?')">
                                            <i class="fas fa-trash fs-7"></i>
                                        </button>
                                    </form>
                                    <?php else: ?>
                                    <button class="btn btn-sm btn-outline-secondary p-1 disabled" title="Tidak dapat menghapus diri sendiri">
                                        <i class="fas fa-trash fs-7"></i>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if(empty($users)): ?>
        <div class="text-center py-4">
            <i class="fas fa-users text-muted fs-3 mb-2"></i>
            <p class="text-muted mb-0 small">Belum ada user terdaftar</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add User Modal (Compact) -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom py-2">
                <h6 class="modal-title mb-0 fw-semibold">Tambah User Baru</h6>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('/do-register') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body p-3">
                    <div class="mb-2">
                        <label class="form-label small text-muted mb-1">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small text-muted mb-1">Email</label>
                        <input type="email" name="email" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small text-muted mb-1">Password</label>
                        <input type="password" name="password" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted mb-1">Role</label>
                        <select name="role" class="form-select form-select-sm">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top py-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        // Inisialisasi DataTable dengan konfigurasi minimal
        $('#usersTable').DataTable({
            "order": [[0, "desc"]],
            "pageLength": 25,
            "lengthChange": false,
            "language": {
                "emptyTable": "Tidak ada data user",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ user",
                "infoEmpty": "Menampilkan 0 hingga 0 dari 0 user",
                "infoFiltered": "(disaring dari total _MAX_ user)",
                "search": "Cari:",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "→",
                    "previous": "←"
                }
            },
            "dom": '<"row"<"col-sm-12"tr>><"row"<"col-sm-6"i><"col-sm-6"p>>',
            "initComplete": function() {
                // Style untuk search box
                $('.dataTables_filter input').addClass('form-control form-control-sm').attr('placeholder', 'Cari user...');
                $('.dataTables_length select').addClass('form-select form-select-sm');
            }
        });

        // Quick role change feedback
        $('select[name="role"]').on('change', function() {
            const form = $(this).closest('form');
            const originalValue = $(this).data('original-value') || $(this).val();
            
            // Tampilkan loading state
            $(this).prop('disabled', true);
            $(this).addClass('disabled');
            
            // Submit form
            form.submit();
        });
    });

    // Quick delete confirmation
    function confirmDelete(userId, userName) {
        if (confirm(`Hapus user "${userName}"?`)) {
            // Form submission handled by native form
            return true;
        }
        return false;
    }
</script>
<?= $this->endSection() ?>

<style>
    .container-fluid {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .card {
        border-radius: 8px;
    }
    
    .table {
        margin-bottom: 0;
    }
    
    .table td, .table th {
        padding: 0.5rem;
        font-size: 0.875rem;
        vertical-align: middle;
    }
    
    .table thead th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #dee2e6;
    }
    
    .table tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.02);
    }
    
    .form-select-sm {
        padding: 0.25rem 1.75rem 0.25rem 0.5rem;
        font-size: 0.8rem;
        height: 28px;
        line-height: 1;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        min-width: 28px;
        min-height: 28px;
    }
    
    .modal-content {
        border-radius: 8px;
    }
    
    .modal-header, .modal-footer {
        padding: 0.75rem 1rem;
    }
    
    .modal-body {
        padding: 1rem;
    }
    
    .form-control-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
    
    /* DataTable custom styling */
    .dataTables_wrapper {
        padding: 0.75rem;
    }
    
    .dataTables_filter {
        margin-bottom: 0.5rem;
    }
    
    .dataTables_filter input {
        width: 200px !important;
        display: inline-block !important;
    }
    
    .dataTables_info {
        font-size: 0.8rem;
        color: #6c757d;
        padding-top: 0.5rem !important;
    }
    
    .dataTables_paginate {
        padding-top: 0.5rem !important;
    }
    
    .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.5rem !important;
        margin: 0 0.125rem !important;
        font-size: 0.8rem !important;
        border-radius: 4px !important;
    }
    
    /* Mobile optimizations */
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        
        .table-responsive {
            font-size: 0.8rem;
        }
        
        .table td, .table th {
            padding: 0.375rem;
        }
        
        .h4 {
            font-size: 1.1rem;
        }
        
        .btn-sm {
            padding: 0.2rem 0.4rem;
            font-size: 0.7rem;
            min-width: 24px;
            min-height: 24px;
        }
        
        .form-select-sm {
            height: 24px;
            font-size: 0.75rem;
        }
        
        .modal-dialog {
            margin: 0.5rem;
        }
        
        .dataTables_wrapper {
            padding: 0.5rem;
        }
        
        .dataTables_filter input {
            width: 150px !important;
        }
        
        /* Responsive table behavior */
        .table td:nth-child(3), /* Email column */
        .table th:nth-child(3) {
            display: none;
        }
        
        .text-truncate {
            max-width: 120px;
        }
    }
    
    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 0.25rem;
            padding-right: 0.25rem;
        }
        
        .table-responsive {
            font-size: 0.75rem;
        }
        
        .table td, .table th {
            padding: 0.25rem;
        }
        
        /* Hide more columns on very small screens */
        .table td:nth-child(5), /* Tanggal Daftar column */
        .table th:nth-child(5) {
            display: none;
        }
        
        .dataTables_filter input {
            width: 120px !important;
            font-size: 0.75rem;
        }
        
        .dataTables_info,
        .dataTables_paginate {
            font-size: 0.7rem !important;
        }
        
        .modal-content {
            margin: 0.25rem;
        }
        
        .modal-header, .modal-footer {
            padding: 0.5rem;
        }
        
        .modal-body {
            padding: 0.75rem;
        }
        
        .rounded-circle {
            width: 24px !important;
            height: 24px !important;
        }
    }
    
    @media (max-width: 400px) {
        /* Ultra-compact mode */
        .table td:nth-child(2) .text-truncate, /* Nama truncate */
        .table td:nth-child(1) .small {
            font-size: 0.7rem;
        }
        
        .dataTables_filter input {
            width: 100px !important;
        }
        
        .btn-sm {
            padding: 0.15rem 0.3rem;
        }
    }
</style>