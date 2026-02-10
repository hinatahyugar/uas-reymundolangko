<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('title') ?>
<?= $category['name'] ?? 'Kategori' ?> - Beauty Fashion Shop
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
/* CATEGORY PAGE */
.category-page {
    padding: 2rem 0;
}

/* Category Header */
.category-header {
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.category-title-container {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 0.5rem;
}

.category-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    flex-shrink: 0;
}

.category-icon.batik { background: linear-gradient(135deg, #8a2be2, #7a1fd1); }
.category-icon.fashion { background: linear-gradient(135deg, #ff6b6b, #ee5a52); }
.category-icon.accessories { background: linear-gradient(135deg, #4ecdc4, #44a08d); }
.category-icon.shoes { background: linear-gradient(135deg, #ffe66d, #f9c74f); }
.category-icon.bags { background: linear-gradient(135deg, #9d4edd, #7b2cbf); }

.category-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #333;
    margin: 0;
}

.category-meta {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    color: #666;
    font-size: 0.9rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.meta-item i {
    color: var(--primary-color);
}

/* Category Description */
.category-description {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border-left: 4px solid var(--primary-color);
}

.description-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #333;
}

.description-text {
    color: #555;
    font-size: 0.95rem;
    line-height: 1.6;
    margin: 0;
}

/* Products Grid */
.products-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.products-count {
    font-size: 0.95rem;
    color: #666;
}

.products-sort {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.sort-label {
    font-size: 0.9rem;
    color: #666;
}

.sort-select {
    padding: 0.4rem 0.75rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 0.9rem;
    background: white;
    cursor: pointer;
}

/* Product Grid */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.product-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid #eee;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(138, 43, 226, 0.12);
    border-color: var(--primary-color);
}

.product-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: linear-gradient(135deg, #ff4757, #ff3838);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    z-index: 2;
}

.product-body {
    padding: 1.25rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.product-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #333;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 44px;
}

.product-category {
    font-size: 0.8rem;
    color: #888;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.product-price {
    margin-top: auto;
}

.current-price {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--primary-color);
    display: block;
}

.original-price {
    font-size: 0.9rem;
    color: #999;
    text-decoration: line-through;
    margin-left: 0.5rem;
}

.product-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
}

.btn-view {
    flex: 1;
    background: white;
    color: var(--primary-color);
    border: 1px solid var(--primary-color);
    padding: 0.5rem;
    border-radius: 5px;
    font-size: 0.85rem;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-view:hover {
    background: var(--primary-color);
    color: white;
}

.btn-cart {
    width: 40px;
    height: 40px;
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
    flex-shrink: 0;
}

.btn-cart:hover {
    background: #7a1fd1;
}

/* Empty State */
.empty-products {
    text-align: center;
    padding: 3rem 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    margin: 2rem 0;
}

.empty-icon {
    font-size: 3rem;
    color: #ddd;
    margin-bottom: 1rem;
}

.empty-title {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.empty-text {
    color: #888;
    margin-bottom: 1.5rem;
}

/* Category Navigation */
.category-navigation {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #eee;
}

.nav-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #333;
}

.category-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.category-tag {
    background: #f8f9fa;
    color: #555;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.2s;
    border: 1px solid #eee;
}

.category-tag:hover {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.category-tag.active {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

/* Responsive */
@media (max-width: 768px) {
    .category-title-container {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
    
    .category-icon {
        margin: 0 auto;
    }
    
    .category-meta {
        justify-content: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .products-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 1rem;
    }
    
    .product-image {
        height: 160px;
    }
    
    .product-actions {
        flex-direction: column;
    }
    
    .btn-view {
        width: 100%;
    }
    
    .btn-cart {
        width: 100%;
        height: 40px;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container category-page">
    <!-- Category Header -->
    <div class="category-header">
        <div class="category-title-container">
            <?php
            // Tentukan icon berdasarkan nama kategori
            $categoryIcons = [
                'Batik' => 'fas fa-palette',
                'Fashion' => 'fas fa-tshirt',
                'Accessories' => 'fas fa-gem',
                'Shoes' => 'fas fa-shoe-prints',
                'Bags' => 'fas fa-bag-shopping'
            ];
            $icon = $categoryIcons[$category['name']] ?? 'fas fa-tag';
            $slug = strtolower($category['name']);
            ?>
            <div class="category-icon <?= $slug ?>">
                <i class="<?= $icon ?>"></i>
            </div>
            <h1 class="category-title"><?= $category['name'] ?></h1>
        </div>
        
        <div class="category-meta">
            <div class="meta-item">
                <i class="fas fa-box"></i>
                <span><?= count($products) ?> Produk</span>
            </div>
            <div class="meta-item">
                <i class="fas fa-star"></i>
                <span>Koleksi Terbaru</span>
            </div>
            <div class="meta-item">
                <i class="fas fa-check-circle"></i>
                <span>Kualitas Premium</span>
            </div>
        </div>
    </div>

    <!-- Category Description -->
    <div class="category-description">
        <h3 class="description-title">Tentang Kategori <?= $category['name'] ?></h3>
        <p class="description-text">
            Jelajahi koleksi <?= strtolower($category['name']) ?> terbaik kami dengan desain modern dan kualitas premium. 
            Setiap produk dipilih dengan teliti untuk memberikan pengalaman berbelanja terbaik.
            <?php if($category['name'] == 'Batik'): ?>
                Batik autentik dengan motif tradisional dan warna yang tahan lama.
            <?php elseif($category['name'] == 'Fashion'): ?>
                Pakaian fashion terkini dengan bahan nyaman dan desain trendi.
            <?php elseif($category['name'] == 'Accessories'): ?>
                Aksesoris elegan yang melengkapi penampilan sehari-hari.
            <?php elseif($category['name'] == 'Shoes'): ?>
                Sepatu dengan kenyamanan maksimal untuk berbagai aktivitas.
            <?php elseif($category['name'] == 'Bags'): ?>
                Tas dengan fungsi dan gaya yang sesuai kebutuhan modern.
            <?php endif; ?>
            Dapatkan produk terbaik dengan harga kompetitif dan jaminan kepuasan.
        </p>
    </div>

    <!-- Products Section -->
    <div class="products-header">
        <h2 class="section-title">Produk <?= $category['name'] ?></h2>
        <div class="products-count">
            Menampilkan <?= count($products) ?> produk
        </div>
        <!--
        <div class="products-sort">
            <span class="sort-label">Urutkan:</span>
            <select class="sort-select" id="sortProducts">
                <option value="newest">Terbaru</option>
                <option value="price_asc">Harga: Rendah ke Tinggi</option>
                <option value="price_desc">Harga: Tinggi ke Rendah</option>
                <option value="popular">Terpopuler</option>
            </select>
        </div>
        -->
    </div>

    <?php if(empty($products)): ?>
        <div class="empty-products">
            <div class="empty-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <h3 class="empty-title">Belum ada produk</h3>
            <p class="empty-text">Produk dalam kategori ini sedang tidak tersedia.</p>
            <a href="<?= base_url('/products') ?>" class="btn btn-primary">
                <i class="fas fa-shopping-bag me-2"></i> Lihat Semua Produk
            </a>
        </div>
    <?php else: ?>
        <div class="products-grid" id="productsContainer">
            <?php foreach($products as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <a href="<?= base_url('/products/' . $product['id']) ?>">
                        <img src="<?= base_url('uploads/products/' . $product['image']) ?>" 
                             alt="<?= esc($product['title']) ?>"
                             onerror="this.src='https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'">
                    </a>
                    
                    <?php if($product['discount'] > 0): ?>
                    <div class="product-badge">
                        -<?= $product['discount'] ?>%
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="product-body">
                    <a href="<?= base_url('/products/' . $product['id']) ?>" class="text-decoration-none">
                        <h3 class="product-title"><?= esc($product['title']) ?></h3>
                    </a>
                    
                    <div class="product-category">
                        <i class="fas fa-tag"></i>
                        <?= $category['name'] ?>
                    </div>
                    
                    <div class="product-price">
                        <?php
                        $finalPrice = $product['price'];
                        if ($product['discount'] > 0) {
                            $finalPrice = $product['price'] * (1 - $product['discount']/100);
                        }
                        ?>
                        <span class="current-price">
                            Rp <?= number_format($finalPrice, 0, ',', '.') ?>
                        </span>
                        
                        <?php if($product['discount'] > 0): ?>
                        <span class="original-price">
                            Rp <?= number_format($product['price'], 0, ',', '.') ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="product-actions">
                        <a href="<?= base_url('/products/' . $product['id']) ?>" class="btn-view">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
                        <button class="btn-cart" onclick="addToCart(<?= $product['id'] ?>, 1)">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Category Navigation -->
    <div class="category-navigation">
        <h3 class="nav-title">Kategori Lainnya</h3>
        <div class="category-tags">
            <?php
            // Anda perlu ambil semua kategori dari database
            // Untuk sekarang saya buat hardcoded dulu
            $allCategories = [
                ['name' => 'Batik', 'slug' => 'batik'],
                ['name' => 'Fashion', 'slug' => 'fashion'],
                ['name' => 'Accessories', 'slug' => 'accessories'],
                ['name' => 'Shoes', 'slug' => 'shoes'],
                ['name' => 'Bags', 'slug' => 'bags']
            ];
            
            foreach($allCategories as $cat):
                if($cat['name'] == $category['name']) continue;
            ?>
            <a href="<?= base_url('/categories/' . $cat['slug']) ?>" class="category-tag">
                <?= $cat['name'] ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Add to Cart Modal -->
<div class="modal fade" id="addToCartModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <i class="fas fa-check-circle fa-3x text-success"></i>
                </div>
                <h5 class="mb-2">Berhasil!</h5>
                <p class="text-muted mb-0">Produk ditambahkan ke keranjang</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Lanjut Belanja
                </button>
                <a href="<?= base_url('/cart') ?>" class="btn btn-primary btn-sm">
                    Lihat Keranjang
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function addToCart(productId, quantity = 1) {
    // Tampilkan loading state
    const button = event.target.closest('.btn-cart') || event.target;
    const originalHTML = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    button.disabled = true;
    
    fetch('/cart/add/' + productId, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/x-www-form-urlencoded',
            'Accept': 'application/json'
        },
        body: new URLSearchParams({
            'quantity': quantity,
            'csrf_test_name': '<?= csrf_hash() ?>'
        })
    })
    .then(response => {
        button.innerHTML = originalHTML;
        button.disabled = false;
        
        // Cek jika response redirect ke login (non-AJAX)
        if (response.redirected) {
            window.location.href = response.url;
            return;
        }
        
        return response.json();
    })
    .then(data => {
        if (data && data.success) {
            // Update cart count
            if (data.cart_count !== undefined) {
                $('#cart-count').text(data.cart_count);
            } else {
                let count = parseInt($('#cart-count').text()) || 0;
                $('#cart-count').text(count + 1);
            }
            
            // Show success modal
            $('#addToCartModal').modal('show');
            
            // Auto close modal after 3 seconds
            setTimeout(() => {
                $('#addToCartModal').modal('hide');
            }, 3000);
        } else if (data && data.redirect) {
            // Redirect ke login
            window.location.href = data.redirect;
        } else if (data && data.message) {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        button.innerHTML = originalHTML;
        button.disabled = false;
        showNotification('Terjadi kesalahan. Silakan coba lagi atau login.', 'error');
    });
}

function showNotification(message, type) {
    // Hapus notifikasi lama
    const oldNotifications = document.querySelectorAll('.custom-notification');
    oldNotifications.forEach(n => n.remove());
    
    // Tentukan warna berdasarkan type
    const alertClass = type === 'error' ? 'alert-danger' : 
                       type === 'warning' ? 'alert-warning' : 'alert-success';
    const icon = type === 'error' ? 'exclamation-triangle' : 
                 type === 'warning' ? 'exclamation-circle' : 'check-circle';
    
    const notification = document.createElement('div');
    notification.className = `alert ${alertClass} alert-dismissible fade show custom-notification`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        max-width: 400px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    `;
    notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas fa-${icon} me-2 fs-5"></i>
            <div class="flex-grow-1">${message}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove setelah 5 detik
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Load cart count saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    fetch('/cart/count', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        return { count: 0 };
    })
    .then(data => {
        const cartCountEl = document.getElementById('cart-count');
        if (cartCountEl && data.count !== undefined) {
            cartCountEl.textContent = data.count;
        }
    })
    .catch(error => {
        console.error('Error loading cart count:', error);
    });
});
</script>
<?= $this->endSection() ?>