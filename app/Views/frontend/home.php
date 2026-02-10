<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('title') ?>
Home - Rey Beauty Fashion
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style> 
/* ===== BANNER STYLES ===== */
.banner-main::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        rgba(0,0,0,0.15) 0%,
        rgba(0,0,0,0.45) 60%,
        rgba(0,0,0,0.6) 100%
    );
    z-index: 2;
}

.banner-modern {
    padding: 60px 0 40px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    margin-bottom: 40px;
}

.banner-main {
    border-radius: 20px;
    overflow: hidden;
    min-height: 400px;
    position: relative;
    margin-bottom: 30px;
}

.banner-main-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.banner-main-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.9);
}

.banner-content {
    position: relative;
    z-index: 2;
    border-radius: 15px;
}

@media (max-width: 992px) {
    .banner-content {
        margin-top: 20px;
    }
}

@media (max-width: 768px) {
    .banner-modern {
        padding: 40px 0 30px;
    }
    
    .banner-main {
        min-height: 300px;
    }
    
    .banner-top h1 {
        font-size: 2rem;
    }
    
    .banner-top p {
        font-size: 1rem;
    }
}

.banner-top h1 {
    font-size: 2.8rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.banner-top p {
    font-size: 1.2rem;
    max-width: 700px;
    margin: 0 auto 25px;
}

.btn-shop-now {
    background: #ffffff;
    color: var(--primary-color);
    font-weight: 600;
    padding: 10px 28px;
    border-radius: 50px;
    border: 2px solid var(--primary-color);
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.btn-shop-now:hover {
    background: var(--primary-color);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.featured-product-card {
    height: 200px;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.featured-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(138, 43, 226, 0.15);
}

.product-thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.featured-product-card:hover .product-thumb {
    transform: scale(1.05);
}

.product-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    padding: 20px;
    color: white;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}

.featured-product-card:hover .product-overlay {
    transform: translateY(0);
}

.product-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    z-index: 2;
}

/* ===== HOME PAGE STYLES ===== */
.home-page {
    overflow-x: hidden; /* Prevent horizontal scroll */
}

/* Category Cards - FIX GRID for Mobile */
.category-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* 5 columns on desktop */
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.category-card {
    display: block;
    text-align: center;
    text-decoration: none;
    transition: transform 0.3s ease;
}

.category-card:hover {
    transform: translateY(-5px);
}

.category-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
    font-size: 2rem;
    transition: all 0.3s ease;
}

.category-icon.batik { background: linear-gradient(135deg, #8a2be2, #6a1fb9); }
.category-icon.fashion { background: linear-gradient(135deg, #ff6b6b, #ee5a52); }
.category-icon.accessories { background: linear-gradient(135deg, #4ecdc4, #44a08d); }
.category-icon.shoes { background: linear-gradient(135deg, #ffe66d, #f9c74f); }
.category-icon.bags { background: linear-gradient(135deg, #9d4edd, #7b2cbf); }

.category-card:hover .category-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 10px 20px rgba(138, 43, 226, 0.3);
}

.category-name {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.25rem;
    font-size: 1rem;
}

.category-count {
    font-size: 0.85rem;
    color: #666;
}

/* Product Grid - FIX untuk Mobile (3 kolom, full width) */
.product-grid-home {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.product-card-home {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid #eee;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    width: 100%; /* Ensure full width */
}

.product-card-home:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(138, 43, 226, 0.12);
    border-color: var(--primary-color);
}

.product-img-home {
    height: 200px;
    overflow: hidden;
    position: relative;
}

.product-img-home img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card-home:hover .product-img-home img {
    transform: scale(1.05);
}

.discount-badge-home {
    position: absolute;
    top: 12px;
    left: 12px;
    background: linear-gradient(135deg, #ff4757, #ff3838);
    color: white;
    padding: 0.3rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    z-index: 2;
}

.product-body-home {
    padding: 1.25rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.product-title-home {
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.4;
    margin-bottom: 0.75rem;
    color: #333;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 44px;
}

.product-price-home {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.2rem;
    display: block;
}

.product-price-old-home {
    color: #999;
    text-decoration: line-through;
    font-size: 0.9rem;
    margin-left: 0.5rem;
}

.rating-home {
    font-size: 0.85rem;
    margin-bottom: 0.75rem;
}

.btn-add-cart-home {
    background: linear-gradient(135deg, var(--primary-color), #7a1fd1);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 0.75rem;
    width: 100%;
    font-weight: 500;
    transition: all 0.3s ease;
    margin-top: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-add-cart-home:hover {
    background: linear-gradient(135deg, #7a1fd1, #6a1fb9);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(138, 43, 226, 0.3);
}

/* CTA Section - MINIMALIS & RESPONSIF */
.cta-section {
    background: linear-gradient(135deg, var(--primary-color), #7a1fd1);
    border-radius: 16px;
    padding: 3rem 1.5rem;
    color: white;
    text-align: center;
    margin: 3rem auto;
    max-width: 900px;
    width: 100%;
    position: relative;
    overflow: hidden;
}

.cta-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.cta-section::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -30%;
    width: 150px;
    height: 150px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
}

.cta-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 1rem;
    position: relative;
    z-index: 1;
}

.cta-description {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    z-index: 1;
}

.cta-form {
    max-width: 500px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.cta-input {
    width: 100%;
    padding: 0.875rem 1.25rem;
    border: none;
    border-radius: 50px;
    font-size: 1rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.cta-input:focus {
    outline: none;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.cta-btn {
    background: white;
    color: var(--primary-color);
    border: none;
    border-radius: 50px;
    padding: 0.875rem 2rem;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-top: 1rem;
    width: 100%;
}

.cta-btn:hover {
    background: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

.cta-note {
    font-size: 0.85rem;
    opacity: 0.7;
    margin-top: 1.5rem;
    position: relative;
    z-index: 1;
}

/* RESPONSIVE FIXES */
@media (max-width: 1200px) {
    .category-grid {
        grid-template-columns: repeat(4, 1fr); /* 4 columns on tablet */
    }
}

@media (max-width: 992px) {
    .category-grid {
        grid-template-columns: repeat(3, 1fr); /* 3 columns on small tablet */
    }
    
    .product-grid-home {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    }
    
    .cta-title {
        font-size: 1.6rem;
    }
}

@media (max-width: 768px) {
    /* FIX UTAMA: 3 KOLOM FULL WIDTH DI MOBILE */
    .category-grid {
        grid-template-columns: repeat(3, 1fr); /* 3 columns on mobile */
        gap: 1rem;
    }
    
    .product-grid-home {
        grid-template-columns: repeat(2, 1fr); /* 2 columns on mobile */
        gap: 1rem;
        margin-left: 0;
        margin-right: 0;
        width: 100%;
    }
    
    /* Ensure product cards take full width of grid cell */
    .product-card-home {
        margin: 0;
        width: 100%;
    }
    
    .product-img-home {
        height: 180px;
    }
    
    .cta-section {
        padding: 2rem 1rem;
        border-radius: 12px;
        margin: 2rem 0;
    }
    
    .cta-title {
        font-size: 1.4rem;
    }
    
    .cta-description {
        font-size: 0.95rem;
    }
}

@media (max-width: 576px) {
    /* FIX UTAMA: 3 KOLOM FULL WIDTH DI SMALL MOBILE */
    .category-grid {
        grid-template-columns: repeat(3, 1fr); /* Tetap 3 kolom */
        gap: 0.75rem;
    }
    
    .category-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .category-name {
        font-size: 0.9rem;
    }
    
    .category-count {
        font-size: 0.75rem;
    }
    
    .product-grid-home {
        grid-template-columns: repeat(2, 1fr); /* Tetap 2 kolom untuk produk */
        gap: 0.75rem;
    }
    
    .product-img-home {
        height: 160px;
    }
    
    .product-body-home {
        padding: 1rem;
    }
    
    .product-title-home {
        font-size: 0.9rem;
        min-height: 40px;
    }
    
    .product-price-home {
        font-size: 1.1rem;
    }
    
    .btn-add-cart-home {
        padding: 0.6rem;
        font-size: 0.9rem;
    }
    
    .cta-section {
        padding: 1.5rem 1rem;
    }
    
    .cta-title {
        font-size: 1.2rem;
    }
    
    .cta-btn {
        padding: 0.75rem 1.5rem;
    }
}

@media (max-width: 400px) {
    .category-grid {
        grid-template-columns: repeat(2, 1fr); /* 2 columns on very small screens */
    }
    
    .product-grid-home {
        grid-template-columns: 1fr; /* 1 column on very small screens */
    }
}

/* Section Headers */
.section-header {
    text-align: center;
    margin-bottom: 2rem;
}

.section-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.section-subtitle {
    color: #666;
    font-size: 1rem;
    max-width: 600px;
    margin: 0 auto;
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- BANNER SECTION -->
<section class="banner-modern">
    <div class="container-fluid">
        <!-- Bagian atas dengan overlay text dan foto utama -->
        <div class="banner-main position-relative mb-4">
            <div class="row align-items-center">
                <!-- Teks overlay di sebelah kanan -->
                <div class="col-lg-5 offset-lg-7 text-lg-end text-center">
                    <div class="banner-content text-white p-4 p-lg-5">
                        <h1 class="display-5 fw-bold mb-3">Pilihan Produk Berkualitas dan Premium</h1>
                        <p class="lead mb-4">Temukan koleksi fashion terbaru dengan kualitas terbaik. Diskon hingga 20% untuk produk pilihan.</p>
                        <a href="<?= base_url('/products') ?>" class="btn btn-shop-now">
                            Belanja Sekarang
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Foto utama (background) -->
            <div class="banner-main-img">
                <img src="<?= base_url('images/banner.png') ?>"
                     alt="Fashion Collection"
                     class="img-fluid">
            </div>
        </div>
        
        <!-- 3 foto produk di bawah (gunakan 3 produk pertama dari $products) -->
        <div class="row g-3">
            <?php 
            // Ambil 3 produk pertama dari $products
            $count = 0;
            foreach($products as $product): 
                if($count >= 3) break;
                
                // Cek gambar produk
                $productImage = !empty($product['image']) ? base_url('uploads/products/' . $product['image']) : 
                               'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80';
            ?>
            <div class="col-md-4">
                <a href="<?= base_url('/products/' . $product['id']) ?>" class="text-decoration-none">
                    <div class="featured-product-card position-relative overflow-hidden rounded-3">
                        <img src="<?= $productImage ?>" 
                             alt="<?= esc($product['title']) ?>" 
                             class="img-fluid product-thumb">
                        
                        <?php if(isset($product['discount']) && $product['discount'] > 0): ?>
                        <div class="product-badge bg-danger">
                            -<?= $product['discount'] ?>%
                        </div>
                        <?php endif; ?>
                        
                        <div class="product-overlay">
                            <div class="product-info">
                                <h6 class="mb-1 fw-bold"><?= esc($product['title']) ?></h6>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="price fw-bold">
                                        Rp <?= number_format($product['price'] ?? 0, 0, ',', '.') ?>
                                    </span>
                                    <?php if(isset($product['discount']) && $product['discount'] > 0): ?>
                                    <span class="old-price text-decoration-line-through">
                                        Rp <?= number_format(($product['price'] ?? 0) * (1 + ($product['discount'] ?? 0)/100), 0, ',', '.') ?>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php 
                $count++;
            endforeach; 
            ?>
        </div>
    </div>
</section>
<!-- END BANNER -->

<div class="container home-page">
    <!-- Featured Categories -->
    <div class="section-header">
        <h2 class="section-title">Kategori Populer</h2>
        <p class="section-subtitle">Telusuri koleksi kami berdasarkan kategori</p>
    </div>
    
    <div class="category-grid">
        <?php 
        // Mapping icon berdasarkan nama kategori
        $categoryIcons = [
            'Batik' => 'fas fa-palette',
            'Fashion' => 'fas fa-tshirt',
            'Accessories' => 'fas fa-gem',
            'Shoes' => 'fas fa-shoe-prints',
            'Bags' => 'fas fa-bag-shopping'
        ];
        
        foreach($categories as $cat): 
            $icon = $categoryIcons[$cat['name']] ?? 'fas fa-tag';
            $slug = strtolower($cat['name']);
        ?>
        <a href="<?= base_url('/categories/' . $cat['slug']) ?>" class="category-card">
            <div class="category-icon <?= $slug ?>">
                <i class="<?= $icon ?>"></i>
            </div>
            <div class="category-name"><?= esc($cat['name']) ?></div>
            <div class="category-count"><?= ($cat['product_count'] ?? 0) ?> produk</div>
        </a>
        <?php endforeach; ?>
    </div>

    <!-- Featured Products -->
    <div class="section-header">
        <h2 class="section-title">Produk Terbaru</h2>
        <p class="section-subtitle">Koleksi terbaru yang siap memenuhi gaya Anda</p>
    </div>
    
    <div class="product-grid-home">
        <?php foreach($products as $product): 
            // Hitung harga diskon
            $finalPrice = $product['price'];
            if (isset($product['discount']) && $product['discount'] > 0) {
                $finalPrice = $product['price'] * (1 - $product['discount']/100);
            }
            
            // Cek gambar produk
            $imagePath = 'uploads/products/' . $product['image'];
            $imageExists = !empty($product['image']) && file_exists(FCPATH . $imagePath);
            $imageUrl = $imageExists ? base_url($imagePath) : 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80';
        ?>
        <div class="product-card-home">
            <div class="product-img-home">
                <img src="<?= $imageUrl ?>" alt="<?= esc($product['title']) ?>">
                
                <?php if(isset($product['discount']) && $product['discount'] > 0): ?>
                <div class="discount-badge-home">
                    -<?= $product['discount'] ?>%
                </div>
                <?php endif; ?>
            </div>
            
            <div class="product-body-home">
                <h3 class="product-title-home">
                    <a href="<?= base_url('/products/' . $product['id']) ?>" class="text-decoration-none text-dark">
                        <?= esc($product['title']) ?>
                    </a>
                </h3>
                
                <div class="d-flex align-items-center mb-2">
                    <div class="rating-home text-warning">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <small class="text-muted ms-2">(4.5)</small>
                </div>
                
                <div class="mb-3">
                    <span class="product-price-home">
                        Rp <?= number_format($finalPrice, 0, ',', '.') ?>
                    </span>
                    <?php if(isset($product['discount']) && $product['discount'] > 0): ?>
                    <span class="product-price-old-home">
                        Rp <?= number_format($product['price'], 0, ',', '.') ?>
                    </span>
                    <?php endif; ?>
                </div>
                
                <button class="btn-add-cart-home" onclick="addToCartHome(<?= $product['id'] ?>)">
                    <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                </button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- CTA Section - MINIMALIS & RESPONSIF -->
    <div class="cta-section">
        <h3 class="cta-title">Bergabung dengan Newsletter Kami</h3>
        <p class="cta-description">
            Dapatkan promo eksklusif dan update produk terbaru langsung di inbox Anda
        </p>
        
        <form class="cta-form" id="newsletterForm">
            <div class="mb-3">
                <input type="email" class="form-control cta-input" placeholder="Email Anda" required>
            </div>
            <button type="submit" class="cta-btn">
                Subscribe <i class="fas fa-paper-plane ms-2"></i>
            </button>
        </form>
        
        <p class="cta-note">Dengan berlangganan, Anda menyetujui Kebijakan Privasi kami</p>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Add to cart function untuk home page
function addToCartHome(productId) {
    fetch('<?= base_url("/cart/add/") ?>' + productId, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            'quantity': 1,
            'csrf_test_name': '<?= csrf_hash() ?>'
        })
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Update cart count di header
            if (data.cart_count !== undefined) {
                let cartCountEl = document.getElementById('cart-count');
                if (data.cart_count > 0) {
                    if (!cartCountEl) {
                        // Create cart count jika belum ada
                        const cartIcon = document.querySelector('.cart-icon');
                        cartCountEl = document.createElement('span');
                        cartCountEl.id = 'cart-count';
                        cartCountEl.className = 'cart-count';
                        cartIcon.appendChild(cartCountEl);
                    }
                    cartCountEl.textContent = data.cart_count;
                } else if (cartCountEl) {
                    cartCountEl.remove();
                }
            } else {
                // Fallback jika tidak ada cart_count di response
                let count = parseInt($('#cart-count').text()) || 0;
                $('#cart-count').text(count + 1);
            }
            
            // Show success notification
            showNotification('Produk berhasil ditambahkan ke keranjang!', 'success');
        } else {
            if (data.redirect) {
                window.location.href = data.redirect;
            } else {
                showNotification(data.message || 'Gagal menambahkan produk', 'error');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Harap Login Terlebih Dahulu.', 'error');
    });
}

// Newsletter form submission
document.getElementById('newsletterForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.querySelector('input[type="email"]').value;
    
    if (!email) {
        showNotification('Masukkan email Anda', 'warning');
        return;
    }
    
    // Simulasi subscription
    showNotification('Terima kasih! Anda telah berlangganan newsletter kami.', 'success');
    this.querySelector('input[type="email"]').value = '';
});

// Helper function for notifications
function showNotification(message, type) {
    const alertClass = type === 'success' ? 'alert-success' : 
                       type === 'error' ? 'alert-danger' : 'alert-warning';
    const icon = type === 'success' ? 'check-circle' : 
                 type === 'error' ? 'exclamation-triangle' : 'exclamation-circle';
    
    const notification = document.createElement('div');
    notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px; max-width: 400px;';
    notification.innerHTML = `
        <i class="fas fa-${icon} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}
</script>
<?= $this->endSection() ?>