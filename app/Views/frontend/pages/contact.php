<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('title') ?><?= $title ?? 'Kontak Kami' ?><?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    /* ===== CONTACT PAGE STYLES ===== */
    /* Minimalis, rapi, tidak banyak ruang kosong - SELARAS dengan about page */
    
    .contact-hero {
        background: linear-gradient(135deg, rgba(138,43,226,0.05) 0%, rgba(255,255,255,1) 100%);
        padding: 40px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .contact-hero h1 {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 15px;
        letter-spacing: -0.5px;
    }
    
    .contact-hero p {
        font-size: 1.1rem;
        color: #555;
        max-width: 800px;
        line-height: 1.6;
    }
    
    /* Contact Info Cards - Sama dengan about */
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
    
    /* Form Contact - Minimalis, tanpa border berlebihan */
    .contact-form-container {
        background: white;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
        height: 100%;
    }
    
    .form-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    
    .form-title i {
        color: var(--primary-color);
        margin-right: 12px;
        font-size: 1.5rem;
    }
    
    .form-label {
        font-size: 0.9rem;
        font-weight: 500;
        color: #555;
        margin-bottom: 5px;
    }
    
    .form-control, .form-select {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(138,43,226,0.1);
        outline: none;
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }
    
    .btn-submit {
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 25px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
    }
    
    .btn-submit:hover {
        background: #7a1fd1;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(138,43,226,0.2);
    }
    
    .btn-submit i {
        font-size: 1rem;
    }
    
    /* Social Media Cards */
    .social-card {
        display: flex;
        align-items: center;
        padding: 15px;
        background: white;
        border: 1px solid #f0f0f0;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.2s ease;
        color: #333;
    }
    
    .social-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(138,43,226,0.1);
    }
    
    .social-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 24px;
    }
    
    .social-icon.instagram {
        background: linear-gradient(135deg, #833ab4, #e1306c, #f77737);
        color: white;
    }
    
    .social-icon.tiktok {
        background: #000000;
        color: white;
    }
    
    .social-icon.whatsapp {
        background: #25D366;
        color: white;
    }
    
    .social-icon.facebook {
        background: #4267B2;
        color: white;
    }
    
    .social-info h4 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 3px;
        color: #333;
    }
    
    .social-info span {
        font-size: 0.85rem;
        color: #666;
    }
    
    /* FAQ Minimal */
    .faq-item {
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .faq-item:last-child {
        border-bottom: none;
    }
    
    .faq-question {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
    }
    
    .faq-question i {
        color: var(--primary-color);
        margin-right: 10px;
        font-size: 0.9rem;
    }
    
    .faq-answer {
        color: #666;
        font-size: 0.9rem;
        margin-left: 24px;
        line-height: 1.5;
    }
    
    /* Map Container */
    .map-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #f0f0f0;
        height: 300px;
    }
    
    .map-container iframe {
        width: 100%;
        height: 100%;
        display: block;
    }
    
    /* Alert Message */
    .alert-success {
        background: rgba(37, 211, 102, 0.1);
        border: 1px solid #25D366;
        color: #1a7a3c;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    
    .alert-success i {
        font-size: 1.2rem;
        margin-right: 12px;
        color: #25D366;
    }
    
    /* Divider */
    .divider {
        margin: 30px 0;
        border-top: 1px solid #f0f0f0;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .contact-hero {
            padding: 30px 0;
        }
        
        .contact-hero h1 {
            font-size: 1.8rem;
        }
        
        .contact-hero p {
            font-size: 1rem;
        }
        
        .info-card, .contact-form-container {
            padding: 20px;
        }
        
        .social-card {
            padding: 12px;
        }
        
        .social-icon {
            width: 42px;
            height: 42px;
            font-size: 20px;
        }
    }
    
    @media (max-width: 576px) {
        .contact-hero h1 {
            font-size: 1.5rem;
        }
        
        .info-icon {
            width: 42px;
            height: 42px;
        }
        
        .info-icon i {
            font-size: 20px;
        }
        
        .btn-submit {
            padding: 10px 20px;
        }
    }
    
    /* Utility */
    .container {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .row {
        margin-left: -10px;
        margin-right: -10px;
    }
    
    .col, [class*="col-"] {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .g-3, .gy-3 {
        --bs-gap: 0.8rem !important;
    }
    
    .h-100 {
        height: 100% !important;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- CONTACT HERO - MINIMALIS -->
<section class="contact-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <h1>Hubungi <?= esc($config['name'] ?? 'Beauty Fashion') ?></h1>
                <p class="mb-0">
                    Kami siap membantu Anda. Silakan hubungi kami melalui form kontak, 
                    media sosial, atau kunjungi langsung toko kami.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- FLASH MESSAGE -->
<?php if(session()->getFlashdata('success')): ?>
<div class="container mb-3">
    <div class="alert-success">
        <i class="fas fa-check-circle"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
</div>
<?php endif; ?>

<!-- CONTACT INFO & FORM - 2 KOLOM SEJAJAR -->
<section class="mb-4">
    <div class="container">
        <div class="row g-3">
            
            <!-- LEFT: Contact Info Cards -->
            <div class="col-lg-6">
                <div class="row g-3">
                    <!-- Alamat -->
                    <div class="col-md-6">
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
                    <div class="col-md-6">
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
                    <div class="col-md-6">
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
                    <div class="col-md-6">
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
            
            <!-- RIGHT: Contact Form -->
            <div class="col-lg-6">
                <div class="contact-form-container">
                    <div class="form-title">
                        <i class="fas fa-paper-plane"></i>
                        Kirim Pesan
                    </div>
                    
                    <form action="<?= base_url('/contact/send') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name" placeholder="John Doe" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="john@example.com" required>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">No. WhatsApp</label>
                                <input type="tel" class="form-control" name="phone" placeholder="082266158487">
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Subjek</label>
                                <select class="form-select" name="subject" required>
                                    <option value="" selected disabled>Pilih subjek pesan</option>
                                    <option value="Informasi Produk">Informasi Produk</option>
                                    <option value="Pemesanan">Pemesanan</option>
                                    <option value="Pengiriman">Pengiriman</option>
                                    <option value="Retur/Refund">Retur/Refund</option>
                                    <option value="Kerjasama">Kerjasama</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Pesan</label>
                                <textarea class="form-control" name="message" placeholder="Tulis pesan Anda di sini..." required></textarea>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-paper-plane"></i>
                                    Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- SOCIAL MEDIA - GRID 4 KOLOM -->
<section class="mb-4">
    <div class="container">
        <div class="row g-3">
            
            <div class="col-md-3 col-6">
                <a href="https://www.instagram.com/hyugaa_r?igsh=cGoycDR4cmExZ2Zo&utm_source=qr" target="_blank" class="social-card">
                    <div class="social-icon instagram">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div class="social-info">
                        <h4>Instagram</h4>
                        <span>@hyugaa_r</span>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 col-6">
                <a href="https://www.tiktok.com/@hyugaa_r?_r=1&_t=ZS-93luPKzleks" target="_blank" class="social-card">
                    <div class="social-icon tiktok">
                        <i class="fab fa-tiktok"></i>
                    </div>
                    <div class="social-info">
                        <h4>TikTok</h4>
                        <span>@hyugaa_r</span>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 col-6">
                <a href="https://wa.me/6282266158487" target="_blank" class="social-card">
                    <div class="social-icon whatsapp">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="social-info">
                        <h4>WhatsApp</h4>
                        <span>0822-6615-8487</span>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 col-6">
                <a href="#" class="social-card">
                    <div class="social-icon facebook">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="social-info">
                        <h4>Facebook</h4>
                        <span>Beauty Fashion</span>
                    </div>
                </a>
            </div>
            
        </div>
    </div>
</section>

<!-- FAQ & MAPS - 2 KOLOM -->
<section class="mb-5">
    <div class="container">
        <div class="row g-3">
            
            <!-- FAQ Section -->
            <div class="col-lg-5">
                <div class="info-card h-100">
                    <div class="info-icon">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <h3>Pertanyaan Umum (FAQ)</h3>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-chevron-right"></i>
                            Berapa lama proses pengiriman?
                        </div>
                        <div class="faq-answer">
                            Pengiriman Jawa-Bali 2-3 hari, Luar Jawa 3-7 hari.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-chevron-right"></i>
                            Apakah tersedia COD?
                        </div>
                        <div class="faq-answer">
                            Ya, tersedia COD untuk wilayah Kupang dan sekitarnya.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-chevron-right"></i>
                            Bagaimana cara retur produk?
                        </div>
                        <div class="faq-answer">
                            Hubungi CS dalam 3 hari setelah barang diterima.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <i class="fas fa-chevron-right"></i>
                            Apakah ada garansi?
                        </div>
                        <div class="faq-answer">
                            Garansi 7 hari untuk produk cacat/tidak sesuai.
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <a href="/contact" class="small-text" style="color: var(--primary-color);">
                            Lihat semua FAQ <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            
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
                <div class="mt-2 text-end">
                    <small class="text-muted">
                        <i class="fas fa-map-pin me-1"></i> 
                        <?= esc($config['address'] ?? 'Jl. Rante Dame 1, Kota Kupang') ?>
                    </small>
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
    // Auto-hide flash message after 5 seconds
    setTimeout(function() {
        let alert = document.querySelector('.alert-success');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 5000);
    
    // Form validation enhancement
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            let required = this.querySelectorAll('[required]');
            let isValid = true;
            
            required.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#dc3545';
                    isValid = false;
                } else {
                    field.style.borderColor = '#e0e0e0';
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Harap isi semua field yang wajib diisi.');
            }
        });
    });
</script>
<?= $this->endSection() ?>  