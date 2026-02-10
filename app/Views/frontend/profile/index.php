<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('title') ?>
Profil Saya - Beauty Fashion Shop
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
/* PROFILE PAGE STYLES */
.profile-page {
    padding: 2rem 0;
    background: #f8f9fa;
    min-height: calc(100vh - 300px);
}

/* Page Header */
.profile-header {
    margin-bottom: 2.5rem;
}

.profile-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
}

.profile-subtitle {
    color: #666;
    font-size: 0.95rem;
}

/* Profile Layout */
.profile-layout {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 2rem;
}

/* Sidebar */
.profile-sidebar {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    height: fit-content;
    position: sticky;
    top: 20px;
}

.profile-avatar {
    text-align: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #eee;
}

.avatar-circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), #7a1fd1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
    font-size: 2.5rem;
    font-weight: 600;
    position: relative;
    overflow: hidden;
}

.avatar-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-initials {
    font-size: 2.5rem;
}

.avatar-upload-btn {
    position: absolute;
    bottom: 0;
    right: 0;
    background: white;
    color: var(--primary-color);
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid var(--primary-color);
    cursor: pointer;
    transition: all 0.2s;
}

.avatar-upload-btn:hover {
    background: var(--primary-color);
    color: white;
}

.avatar-upload-form {
    display: none;
}

.user-name {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.25rem;
}

.user-email {
    color: #666;
    font-size: 0.9rem;
    word-break: break-all;
}

.profile-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.menu-item {
    margin-bottom: 0.5rem;
}

.menu-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    color: #555;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s;
}

.menu-link:hover {
    background: #f8f9fa;
    color: var(--primary-color);
}

.menu-link.active {
    background: linear-gradient(135deg, var(--primary-color), #7a1fd1);
    color: white;
}

.menu-link i {
    width: 20px;
    text-align: center;
}

/* Main Content */
.profile-content {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

/* Profile Info */
.profile-info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.info-card {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 1.5rem;
    border-left: 4px solid var(--primary-color);
}

.info-title {
    font-size: 0.85rem;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.info-value {
    font-size: 1.1rem;
    color: #333;
    font-weight: 500;
    word-break: break-word;
}

.info-value.empty {
    color: #999;
    font-style: italic;
}

/* Forms */
.profile-form-section {
    margin-bottom: 2.5rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #eee;
}

.section-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.section-title i {
    color: var(--primary-color);
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label {
    display: block;
    font-weight: 500;
    color: #444;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-label .required {
    color: #ff4757;
}

.form-control-custom {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.2s;
    background: white;
}

.form-control-custom:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(138, 43, 226, 0.1);
}

.form-control-custom:disabled {
    background: #f8f9fa;
    color: #666;
    cursor: not-allowed;
}

.form-text {
    font-size: 0.85rem;
    color: #666;
    margin-top: 0.5rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.btn-primary-custom {
    background: linear-gradient(135deg, var(--primary-color), #7a1fd1);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary-custom:hover {
    background: linear-gradient(135deg, #7a1fd1, #6a1fb9);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(138, 43, 226, 0.2);
}

.btn-outline-custom {
    background: white;
    color: #555;
    border: 1px solid #ddd;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-outline-custom:hover {
    background: #f8f9fa;
    border-color: #ccc;
}

/* Recent Orders */
.orders-table {
    width: 100%;
    border-collapse: collapse;
}

.orders-table th {
    text-align: left;
    padding: 1rem;
    background: #f8f9fa;
    color: #666;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #eee;
}

.orders-table td {
    padding: 1rem;
    border-bottom: 1px solid #eee;
    color: #333;
}

.order-status {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.status-pending { background: #fff3cd; color: #856404; }
.status-paid { background: #d1ecf1; color: #0c5460; }
.status-shipped { background: #d4edda; color: #155724; }
.status-completed { background: #c3e6cb; color: #155724; }
.status-canceled { background: #f8d7da; color: #721c24; }

/* Password Strength */
.password-strength {
    height: 4px;
    background: #eee;
    border-radius: 2px;
    margin-top: 0.5rem;
    overflow: hidden;
}

.strength-meter {
    height: 100%;
    width: 0%;
    border-radius: 2px;
    transition: width 0.3s, background 0.3s;
}

.strength-weak { background: #ff4757; width: 33%; }
.strength-medium { background: #ffa502; width: 66%; }
.strength-strong { background: #2ed573; width: 100%; }

/* Notifications */
.alert-notification {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert-warning {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

/* Responsive */
@media (max-width: 992px) {
    .profile-layout {
        grid-template-columns: 1fr;
    }
    
    .profile-sidebar {
        position: static;
    }
    
    .profile-info-grid {
        grid-template-columns: 1fr;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .profile-content {
        padding: 1.5rem;
    }
    
    .orders-table {
        display: block;
        overflow-x: auto;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn-primary-custom,
    .btn-outline-custom {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .profile-page {
        padding: 1.5rem 0;
    }
    
    .profile-title {
        font-size: 1.5rem;
    }
    
    .avatar-circle {
        width: 80px;
        height: 80px;
    }
    
    .avatar-initials {
        font-size: 2rem;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container profile-page">
    <!-- Page Header -->
    <div class="profile-header">
        <h1 class="profile-title">Profil Saya</h1>
        <p class="profile-subtitle">Kelola informasi profil Anda untuk keamanan akun</p>
    </div>

    <!-- Notifications -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert-notification alert-success">
            <i class="fas fa-check-circle"></i>
            <div><?= session()->getFlashdata('success') ?></div>
        </div>
    <?php endif; ?>
    
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert-notification alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <div><?= session()->getFlashdata('error') ?></div>
        </div>
    <?php endif; ?>
    
    <?php if(session()->getFlashdata('errors')): ?>
        <div class="alert-notification alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    <?php foreach(session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <div class="profile-layout">
        <!-- Sidebar -->
        <aside class="profile-sidebar">
            <!-- Avatar -->
            <div class="profile-avatar">
                <div class="avatar-circle">
                    <?php if($user['profile_photo_path']): ?>
                        <img src="<?= base_url('writable/uploads/profiles/' . $user['profile_photo_path']) ?>" 
                             alt="<?= esc($user['name']) ?>">
                    <?php else: ?>
                        <div class="avatar-initials">
                            <?= substr($user['name'], 0, 1) ?>
                        </div>
                    <?php endif; ?>
                    
                    <label for="profilePhotoInput" class="avatar-upload-btn" title="Upload foto">
                        <i class="fas fa-camera"></i>
                    </label>
                    <form id="avatarUploadForm" class="avatar-upload-form" 
                          action="<?= base_url('/profile/upload-photo') ?>" 
                          method="post" enctype="multipart/form-data">
                        <input type="file" id="profilePhotoInput" name="profile_photo" accept="image/*" style="display: none;">
                        <input type="hidden" name="csrf_test_name" value="<?= csrf_hash() ?>">
                    </form>
                </div>
                
                <div class="user-name"><?= esc($user['name']) ?></div>
                <div class="user-email"><?= esc($user['email']) ?></div>
            </div>

            <!-- Menu -->
            <ul class="profile-menu">
                <li class="menu-item">
                    <a href="#profile-info" class="menu-link active">
                        <i class="fas fa-user"></i>
                        <span>Informasi Profil</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#password-change" class="menu-link">
                        <i class="fas fa-lock"></i>
                        <span>Ganti Password</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('/orders') ?>" class="menu-link">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Pesanan Saya</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('/logout') ?>" class="menu-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Keluar</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="profile-content">
            <!-- Profile Info Cards -->
            <div class="profile-info-grid">
                <div class="info-card">
                    <div class="info-title">Anggota Sejak</div>
                    <div class="info-value">
                        <?= date('d M Y', strtotime($user['created_at'])) ?>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-title">Peran</div>
                    <div class="info-value">
                        <?= $user['role'] == 'admin' ? 'Administrator' : 'Pelanggan' ?>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-title">Telepon</div>
                    <div class="info-value <?= empty($user['phone']) ? 'empty' : '' ?>">
                        <?= !empty($user['phone']) ? esc($user['phone']) : 'Belum diisi' ?>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-title">Total Pesanan</div>
                    <div class="info-value">
                        <?= count($orders) ?> pesanan
                    </div>
                </div>
            </div>

            <!-- Update Profile Form -->
            <section id="profile-info" class="profile-form-section">
                <h3 class="section-title">
                    <i class="fas fa-user-edit"></i>
                    Informasi Profil
                </h3>
                
                <form action="<?= base_url('/profile/update') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                Nama Lengkap <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   class="form-control-custom"
                                   value="<?= old('name', $user['name']) ?>"
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">
                                Email <span class="required">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-control-custom"
                                   value="<?= old('email', $user['email']) ?>"
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone" class="form-label">
                                Nomor Telepon
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   class="form-control-custom"
                                   value="<?= old('phone', $user['phone'] ?? '') ?>"
                                   placeholder="Contoh: 081234567890">
                            <div class="form-text">Format: 10-15 digit angka</div>
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="address" class="form-label">
                                Alamat Lengkap
                            </label>
                            <textarea id="address" 
                                      name="address" 
                                      class="form-control-custom"
                                      rows="4"
                                      placeholder="Masukkan alamat lengkap Anda"><?= old('address', $user['address'] ?? '') ?></textarea>
                            <div class="form-text">Minimal 10 karakter</div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-primary-custom">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <button type="reset" class="btn-outline-custom">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>
                </form>
            </section>

            <!-- Change Password Form -->
            <section id="password-change" class="profile-form-section">
                <h3 class="section-title">
                    <i class="fas fa-key"></i>
                    Ganti Password
                </h3>
                
                <form action="<?= base_url('/profile/change-password') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="current_password" class="form-label">
                                Password Saat Ini <span class="required">*</span>
                            </label>
                            <input type="password" 
                                   id="current_password" 
                                   name="current_password" 
                                   class="form-control-custom"
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label for="new_password" class="form-label">
                                Password Baru <span class="required">*</span>
                            </label>
                            <input type="password" 
                                   id="new_password" 
                                   name="new_password" 
                                   class="form-control-custom"
                                   required
                                   oninput="checkPasswordStrength(this.value)">
                            <div class="password-strength">
                                <div id="passwordStrength" class="strength-meter"></div>
                            </div>
                            <div class="form-text">Minimal 6 karakter, mengandung huruf besar, kecil, dan angka</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password" class="form-label">
                                Konfirmasi Password Baru <span class="required">*</span>
                            </label>
                            <input type="password" 
                                   id="confirm_password" 
                                   name="confirm_password" 
                                   class="form-control-custom"
                                   required
                                   oninput="checkPasswordMatch()">
                            <div id="passwordMatch" class="form-text"></div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-primary-custom">
                            <i class="fas fa-key"></i> Ganti Password
                        </button>
                    </div>
                </form>
            </section>

            <!-- Recent Orders -->
            <section class="profile-form-section">
                <h3 class="section-title">
                    <i class="fas fa-history"></i>
                    Pesanan Terbaru
                </h3>
                
                <?php if(empty($orders)): ?>
                    <div class="text-center py-4">
                        <i class="fas fa-shopping-cart fa-2x text-muted mb-3"></i>
                        <p class="text-muted mb-0">Belum ada pesanan</p>
                        <a href="<?= base_url('/products') ?>" class="btn-primary-custom mt-3 d-inline-flex">
                            <i class="fas fa-shopping-bag me-2"></i> Mulai Belanja
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orders as $order): ?>
                                <tr>
                                    <td><?= $order['no_invoice'] ?></td>
                                    <td><?= date('d M Y', strtotime($order['created_at'])) ?></td>
                                    <td>Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                                    <td>
                                        <span class="order-status status-<?= $order['status_cart'] ?>">
                                            <?php 
                                            $statusText = [
                                                'cart' => 'Keranjang',
                                                'checkout' => 'Checkout',
                                                'paid' => 'Dibayar',
                                                'shipped' => 'Dikirim',
                                                'completed' => 'Selesai',
                                                'canceled' => 'Dibatalkan'
                                            ];
                                            echo $statusText[$order['status_cart']] ?? $order['status_cart'];
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('/orders/' . $order['id']) ?>" class="btn-outline-custom btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="<?= base_url('/orders') ?>" class="btn-outline-custom">
                            <i class="fas fa-list me-2"></i> Lihat Semua Pesanan
                        </a>
                    </div>
                <?php endif; ?>
            </section>
        </main>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Password strength checker
function checkPasswordStrength(password) {
    const meter = document.getElementById('passwordStrength');
    let strength = 0;
    
    if (password.length >= 6) strength++;
    if (password.match(/[a-z]/)) strength++;
    if (password.match(/[A-Z]/)) strength++;
    if (password.match(/[0-9]/)) strength++;
    if (password.match(/[^a-zA-Z0-9]/)) strength++;
    
    meter.className = 'strength-meter';
    if (strength <= 2) {
        meter.classList.add('strength-weak');
    } else if (strength <= 4) {
        meter.classList.add('strength-medium');
    } else {
        meter.classList.add('strength-strong');
    }
}

// Password match checker
function checkPasswordMatch() {
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const matchText = document.getElementById('passwordMatch');
    
    if (!newPassword || !confirmPassword) {
        matchText.textContent = '';
        matchText.className = 'form-text';
        return;
    }
    
    if (newPassword === confirmPassword) {
        matchText.textContent = '✓ Password cocok';
        matchText.className = 'form-text text-success';
    } else {
        matchText.textContent = '✗ Password tidak cocok';
        matchText.className = 'form-text text-danger';
    }
}

// Profile photo upload
document.getElementById('profilePhotoInput').addEventListener('change', function() {
    if (this.files && this.files[0]) {
        const file = this.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        
        if (!allowedTypes.includes(file.type)) {
            alert('Hanya file JPG, JPEG, dan PNG yang diizinkan.');
            this.value = '';
            return;
        }
        
        if (file.size > maxSize) {
            alert('Ukuran file maksimal 2MB.');
            this.value = '';
            return;
        }
        
        if (confirm('Upload foto profil?')) {
            document.getElementById('avatarUploadForm').submit();
        } else {
            this.value = '';
        }
    }
});

// Menu navigation
document.querySelectorAll('.menu-link').forEach(link => {
    link.addEventListener('click', function(e) {
        if (this.getAttribute('href').startsWith('#')) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                // Update active menu
                document.querySelectorAll('.menu-link').forEach(item => {
                    item.classList.remove('active');
                });
                this.classList.add('active');
                
                // Scroll to section
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
});

// Form validation
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        let isValid = true;
        const requiredFields = this.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.style.borderColor = '#ff4757';
                isValid = false;
            } else {
                field.style.borderColor = '#ddd';
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Harap isi semua field yang wajib diisi.');
        }
    });
});

// Reset form button
document.querySelectorAll('button[type="reset"]').forEach(button => {
    button.addEventListener('click', function() {
        const form = this.closest('form');
        if (form && confirm('Reset semua perubahan?')) {
            form.reset();
            
            // Reset password strength meter
            const meter = document.getElementById('passwordStrength');
            if (meter) {
                meter.className = 'strength-meter';
                meter.style.width = '0%';
            }
            
            // Reset password match text
            const matchText = document.getElementById('passwordMatch');
            if (matchText) {
                matchText.textContent = '';
                matchText.className = 'form-text';
            }
        }
    });
});
</script>
<?= $this->endSection() ?>