<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('title') ?><?= $title ?? 'Tentang Kami' ?><?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    /* ===== ABOUT PAGE STYLES ===== */
    /* Minimalis, rapi, tidak banyak ruang kosong */
    
    .about-hero {
        background: linear-gradient(135deg, rgba(138,43,226,0.05) 0%, rgba(255,255,255,1) 100%);
        padding: 40px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .about-hero h1 {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 15px;
        letter-spacing: -0.5px;
    }
    
    .about-hero p {
        font-size: 1.1rem;
        color: #555;
        max-width: 800px;
        line-height: 1.6;
    }
    
    /* Company Info Card - Minimalis */
    .info-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
        transition: all 0.2s ease;
        height: 100%;
    }
    
    .info-card:hover {
        border-color: var(--primary-color);
        box-shadow: 0 5px 15px rgba(138,43,226,0.05);
    }
    
    .info-icon {
        width: 48px;
        height: 48px;
        background: rgba(138,43,226,0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
    }
    
    .info-icon i {
        font-size: 24px;
        color: var(--primary-color);
    }
    
    .info-card h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 12px;
        letter-spacing: -0.3px;
    }
    
    .info-card p {
        color: #666;
        margin-bottom: 5px;
        font-size: 0.95rem;
        line-height: 1.5;
    }
    
    .info-card .small-text {
        color: #888;
        font-size: 0.85rem;
    }
    
    /* Statistik Card - Tanpa padding berlebih */
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #f0f0f0;
        text-align: center;
        transition: all 0.2s ease;
    }
    
    .stat-card:hover {
        border-color: var(--primary-color);
        background: rgba(138,43,226,0.02);
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        line-height: 1.2;
        margin-bottom: 5px;
    }
    
    .stat-label {
        color: #666;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }
    
    /* Visi Misi Section - Minimal */
    .vm-section {
        background: white;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
        margin-bottom: 20px;
    }
    
    .vm-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
    
    .vm-title i {
        color: var(--primary-color);
        margin-right: 12px;
        font-size: 1.5rem;
    }
    
    .vm-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .vm-list li {
        padding: 8px 0;
        display: flex;
        align-items: flex-start;
        color: #555;
        font-size: 0.95rem;
        border-bottom: 1px dashed #f0f0f0;
    }
    
    .vm-list li:last-child {
        border-bottom: none;
    }
    
    .vm-list li i {
        color: var(--primary-color);
        margin-right: 12px;
        font-size: 0.9rem;
        margin-top: 4px;
    }
    
    /* Map Container - Responsif */
    .map-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #f0f0f0;
        height: 250px;
    }
    
    .map-container iframe {
        width: 100%;
        height: 100%;
        display: block;
    }
    
    /* Divider minimal */
    .divider {
        margin: 30px 0;
        border-top: 1px solid #f0f0f0;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .about-hero {
            padding: 30px 0;
        }
        
        .about-hero h1 {
            font-size: 1.8rem;
        }
        
        .about-hero p {
            font-size: 1rem;
        }
        
        .stat-number {
            font-size: 1.8rem;
        }
        
        .info-card {
            padding: 20px;
        }
        
        .vm-section {
            padding: 20px;
        }
    }
    
    @media (max-width: 576px) {
        .about-hero h1 {
            font-size: 1.5rem;
        }
        
        .stat-card {
            padding: 15px;
        }
        
        .stat-number {
            font-size: 1.6rem;
        }
        
        .info-icon {
            width: 42px;
            height: 42px;
        }
        
        .info-icon i {
            font-size: 20px;
        }
    }
    
    /* Hilangkan padding berlebih di container */
    .container {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    /* Row spacing minimal */
    .row {
        margin-left: -10px;
        margin-right: -10px;
    }
    
    .col, [class*="col-"] {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    /* No margin bottom on last elements */
    .mb-0-custom {
        margin-bottom: 0 !important;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- ABOUT HERO - MINIMALIS -->
<section class="about-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <h1>Tentang <?= esc($config['name'] ?? 'Beauty Fashion') ?></h1>
                <p class="mb-0">
                    Kami berkomitmen memberikan produk fashion berkualitas dengan harga terjangkau. 
                    Berdiri sejak 2020, kami telah melayani ribuan pelanggan di seluruh Indonesia.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- COMPANY INFO - GRID 4 KOLOM (TANPA RUANG KOSONG) -->
<section class="mb-4">
    <div class="container">
        <div class="row g-3"> <!-- g-3 = gap kecil, tidak berlebihan -->
            
            <!-- Alamat -->
            <div class="col-md-6 col-lg-3">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Alamat</h3>
                    <p><?= esc($config['address'] ?? 'Jl. Rante Dame 1, Kota Kupang') ?></p>
                    <span class="small-text">Kantor Pusat</span>
                </div>
            </div>
            
            <!-- Telepon -->
            <div class="col-md-6 col-lg-3">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h3>Telepon</h3>
                    <p><?= esc($config['phone'] ?? '(082) 2661-58487') ?></p>
                    <span class="small-text">Senin - Jumat, 9AM - 6PM</span>
                </div>
            </div>
            
            <!-- Email -->
            <div class="col-md-6 col-lg-3">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Email</h3>
                    <p><?= esc($config['email'] ?? 'reylangko@info.com') ?></p>
                    <span class="small-text">Balas dalam 1x24 jam</span>
                </div>
            </div>
            
            <!-- Jam Operasional -->
            <div class="col-md-6 col-lg-3">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Jam Operasional</h3>
                    <p>Senin - Jumat: 09.00 - 18.00</p>
                    <span class="small-text">Sabtu: 09.00 - 14.00</span>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- STATISTIK REAL-TIME - TANPA BANYAK RUANG KOSONG -->
<section class="mb-4">
    <div class="container">
        <div class="row g-3">
            
            <!-- Total Produk -->
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number"><?= number_format($stats['products'] ?? 0, 0, ',', '.') ?></div>
                    <div class="stat-label">Produk</div>
                </div>
            </div>
            
            <!-- Total Pelanggan -->
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number"><?= number_format($stats['customers'] ?? 0, 0, ',', '.') ?></div>
                    <div class="stat-label">Pelanggan</div>
                </div>
            </div>
            
            <!-- Total Order Sukses -->
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number"><?= number_format($stats['orders'] ?? 0, 0, ',', '.') ?></div>
                    <div class="stat-label">Order Sukses</div>
                </div>
            </div>
            
            <!-- Total Artikel -->
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number"><?= number_format($stats['articles'] ?? 0, 0, ',', '.') ?></div>
                    <div class="stat-label">Artikel</div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- VISI & MISI - 2 KOLOM SEJAJAR -->
<section class="mb-4">
    <div class="container">
        <div class="row g-3">
            
            <!-- Visi -->
            <div class="col-md-6">
                <div class="vm-section h-100">
                    <div class="vm-title">
                        <i class="fas fa-bullseye"></i>
                        Visi Kami
                    </div>
                    <ul class="vm-list">
                        <li>
                            <i class="fas fa-check-circle"></i>
                            Menjadi destinasi fashion terpercaya di Indonesia
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            Memberikan pengalaman belanja yang menyenangkan
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            Mengangkat produk lokal ke kancah nasional
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            Inovasi berkelanjutan dalam fashion
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Misi -->
            <div class="col-md-6">
                <div class="vm-section h-100">
                    <div class="vm-title">
                        <i class="fas fa-rocket"></i>
                        Misi Kami
                    </div>
                    <ul class="vm-list">
                        <li>
                            <i class="fas fa-check-circle"></i>
                            Menyediakan produk berkualitas dengan harga bersaing
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            Pelayanan cepat dan ramah untuk setiap pelanggan
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            Pengiriman tepat waktu ke seluruh Indonesia
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            Mendukung UMKM fashion lokal
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- LOKASI & PANGGILAN ACTION - 2 KOLOM -->
<section class="mb-5">
    <div class="container">
        <div class="row g-3">
            
            <!-- Google Maps -->
            <div class="col-lg-7">
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126093.3835463737!2d123.531929!3d-10.183333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c568e9b5a0b8b6d%3A0x5b5c5a5a5a5a5a5a!2sKupang%2C%20Kota%20Kupang%2C%20Nusa%20Tenggara%20Timur!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
            
            <!-- Call to Action -->
            <div class="col-lg-5">
                <div class="info-card h-100 d-flex flex-column justify-content-center">
                    <div class="info-icon mb-3">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="mb-2">Butuh Bantuan?</h3>
                    <p class="mb-3" style="color: #555;">
                        Tim customer service kami siap membantu Anda 24/7. 
                        Jangan ragu untuk menghubungi kami melalui WhatsApp atau email.
                    </p>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        <a href="https://wa.me/6282266158487" class="btn btn-success btn-sm px-4 py-2" target="_blank">
                            <i class="fab fa-whatsapp me-2"></i> WhatsApp
                        </a>
                        <a href="/contact" class="btn btn-outline-secondary btn-sm px-4 py-2">
                            <i class="fas fa-envelope me-2"></i> Kontak
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- DIVIDER MINIMAL -->
<div class="divider"></div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Tidak ada script khusus - halaman ini static & cepat
    console.log('About page loaded - minimalist & clean');
</script>
<?= $this->endSection() ?>