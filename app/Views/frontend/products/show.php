<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
/* PRODUCT DETAIL */
.product-detail-container {
    padding: 2rem 0;
}

/* Breadcrumb */
.breadcrumb-nav {
    font-size: 0.85rem;
    margin-bottom: 1.5rem;
}

.breadcrumb-nav a {
    color: #666;
    text-decoration: none;
}

.breadcrumb-nav a:hover {
    color: var(--primary-color);
}

/* Product Gallery */
.product-gallery {
    position: relative;
}

.main-image {
    border-radius: 8px;
    overflow: hidden;
    background: #f8f9fa;
    margin-bottom: 0.75rem;
}

.main-image img {
    width: 100%;
    height: auto;
    display: block;
}

.thumbnail-container {
    display: flex;
    gap: 0.5rem;
}

.thumbnail-item {
    width: 70px;
    height: 70px;
    border-radius: 5px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    transition: border-color 0.2s;
}

.thumbnail-item.active {
    border-color: var(--primary-color);
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Product Info */
.product-info {
    padding-left: 2rem;
}

@media (max-width: 768px) {
    .product-info {
        padding-left: 0;
        margin-top: 1.5rem;
    }
}

.product-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
    line-height: 1.3;
}

.product-sku {
    font-size: 0.8rem;
    color: #888;
    margin-bottom: 1rem;
}

.product-price-container {
    margin-bottom: 1rem;
}

.current-price {
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--primary-color);
}

.original-price {
    font-size: 1rem;
    color: #999;
    text-decoration: line-through;
    margin-left: 0.5rem;
}

.discount-badge {
    background: #ff4757;
    color: white;
    padding: 0.2rem 0.5rem;
    border-radius: 3px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-left: 0.5rem;
    vertical-align: middle;
}

/* Stock Status */
.stock-status {
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}

.stock-status.in-stock {
    color: #28a745;
}

.stock-status.out-of-stock {
    color: #dc3545;
}

/* Product Actions */
.product-actions {
    margin-bottom: 1.5rem;
}

.quantity-selector {
    display: inline-flex;
    align-items: center;
    margin-right: 1rem;
    margin-bottom: 1rem;
}

.quantity-btn {
    width: 32px;
    height: 32px;
    border: 1px solid #ddd;
    background: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    user-select: none;
}

.quantity-input {
    width: 50px;
    height: 32px;
    border: 1px solid #ddd;
    border-left: none;
    border-right: none;
    text-align: center;
    font-size: 0.9rem;
}

.action-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.btn-add-to-cart {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 0.6rem 1.5rem;
    border-radius: 5px;
    font-weight: 500;
    font-size: 0.9rem;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-add-to-cart:hover {
    background: #7a1fd1;
}

.btn-wishlist {
    background: white;
    color: #666;
    border: 1px solid #ddd;
    padding: 0.6rem 1rem;
    border-radius: 5px;
    font-size: 0.9rem;
    transition: all 0.2s;
}

.btn-wishlist:hover {
    border-color: var(--primary-color);
    color: var(--primary-color);
}

/* Product Meta */
.product-meta {
    font-size: 0.85rem;
    color: #666;
    border-top: 1px solid #eee;
    padding-top: 1rem;
    margin-top: 1.5rem;
}

.meta-item {
    display: flex;
    margin-bottom: 0.5rem;
}

.meta-label {
    width: 100px;
    color: #888;
}

/* Tabs */
.product-tabs {
    margin-top: 3rem;
}

.nav-tabs-custom {
    border-bottom: 1px solid #eee;
}

.nav-tabs-custom .nav-link {
    border: none;
    color: #666;
    font-weight: 500;
    padding: 0.75rem 1.5rem;
    margin-bottom: -1px;
}

.nav-tabs-custom .nav-link.active {
    color: var(--primary-color);
    border-bottom: 2px solid var(--primary-color);
    background: none;
}

.tab-content {
    padding: 1.5rem 0;
}

/* Related Products */
.related-products {
    margin-top: 3rem;
}

.section-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: #333;
}

.related-item {
    text-decoration: none;
    color: inherit;
    display: block;
    transition: transform 0.2s;
}

.related-item:hover {
    transform: translateY(-3px);
}

.related-image {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 5px;
    margin-bottom: 0.5rem;
}

.related-title {
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 0.25rem;
    color: #333;
    line-height: 1.3;
}

.related-price {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--primary-color);
}

/* Social Share */
.social-share {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 1rem;
}

.share-text {
    font-size: 0.85rem;
    color: #666;
}

.share-icon {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.8rem;
    text-decoration: none;
    transition: opacity 0.2s;
}

.share-icon:hover {
    opacity: 0.9;
}

.bg-facebook { background: #3b5998; }
.bg-twitter { background: #1da1f2; }
.bg-pinterest { background: #e60023; }
.bg-whatsapp { background: #25d366; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container product-detail-container">
    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav">
        <a href="<?= base_url('/') ?>">Home</a> &gt;
        <a href="<?= base_url('/products') ?>">Products</a> &gt;
        <span><?= esc($product['title']) ?></span>
    </nav>

    <div class="row">
        <!-- Product Gallery -->
        <div class="col-lg-6 col-md-6">
            <div class="product-gallery">
                <div class="main-image">
                    <img src="<?= base_url('uploads/products/' . $product['image']) ?>" 
                         alt="<?= esc($product['title']) ?>"
                         id="mainProductImage"
                         onerror="this.src='https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                </div>
                
                <?php if($product['image']): ?>
                <div class="thumbnail-container">
                    <div class="thumbnail-item active">
                        <img src="<?= base_url('uploads/products/' . $product['image']) ?>" 
                             alt="Thumbnail 1"
                             onclick="changeMainImage(this.src)"
                             onerror="this.src='https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80'">
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6 col-md-6">
            <div class="product-info">
                <h1 class="product-title"><?= esc($product['title']) ?></h1>
                
                <div class="product-price-container">
                    <?php
                    $finalPrice = $product['price'];
                    if ($product['discount'] > 0) {
                        $finalPrice = $product['price'] * (1 - $product['discount']/100);
                    }
                    ?>
                    <span class="current-price">Rp <?= number_format($finalPrice, 0, ',', '.') ?></span>
                    
                    <?php if($product['discount'] > 0): ?>
                    <span class="original-price">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
                    <span class="discount-badge">-<?= $product['discount'] ?>%</span>
                    <?php endif; ?>
                </div>

                <div class="stock-status <?= $product['stock'] > 0 ? 'in-stock' : 'out-of-stock' ?>">
                    <i class="fas fa-<?= $product['stock'] > 0 ? 'check-circle' : 'times-circle' ?> me-1"></i>
                    <?= $product['stock'] > 0 ? 'In Stock (' . $product['stock'] . ' items)' : 'Out of Stock' ?>
                </div>

                <div class="product-description mb-3">
                    <p class="mb-0" style="font-size: 0.9rem; line-height: 1.5; color: #555;">
                        <?= nl2br(esc($product['description'])) ?>
                    </p>
                </div>

                <!-- Product Actions -->
                <div class="product-actions">
                    <div class="quantity-selector">
                        <button class="quantity-btn" onclick="decreaseQuantity()">-</button>
                        <input type="text" class="quantity-input" id="quantity" value="1" readonly>
                        <button class="quantity-btn" onclick="increaseQuantity()">+</button>
                    </div>

                    <div class="action-buttons">
                        <button class="btn-add-to-cart" onclick="addToCart(<?= $product['id'] ?>)">
                            <i class="fas fa-cart-plus"></i>
                            Add to Cart
                        </button>
                        
                        <button class="btn-wishlist">
                            <i class="far fa-heart"></i>
                            Wishlist
                        </button>
                    </div>
                </div>

                <!-- Product Meta -->
                <div class="product-meta">
                    <div class="meta-item">
                        <span class="meta-label">SKU:</span>
                        <span>PROD-<?= str_pad($product['id'], 4, '0', STR_PAD_LEFT) ?></span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Category:</span>
                        <span><?= esc($product['category_name'] ?? 'Uncategorized') ?></span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Product Type:</span>
                        <span><?= ucfirst($product['type']) ?></span>
                    </div>
                </div>

                <!-- Social Share -->
                <div class="social-share">
                    <span class="share-text">Share:</span>
                    <a href="#" class="share-icon bg-facebook" title="Share on Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="share-icon bg-twitter" title="Share on Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="share-icon bg-pinterest" title="Share on Pinterest">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                    <a href="#" class="share-icon bg-whatsapp" title="Share on WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Tabs -->
    <div class="product-tabs">
        <ul class="nav nav-tabs nav-tabs-custom" id="productTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" 
                        data-bs-target="#description" type="button" role="tab">
                    Description
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" 
                        data-bs-target="#shipping" type="button" role="tab">
                    Shipping & Returns
                </button>
            </li>
        </ul>
        
        <div class="tab-content" id="productTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel">
                <p style="font-size: 0.9rem; line-height: 1.6; color: #555;">
                    <?= nl2br(esc($product['description'])) ?>
                </p>
                
                <?php if($product['shopee_url'] || $product['tokopedia_url'] || $product['lazada_url'] || $product['bukalapak_url']): ?>
                <div class="mt-3">
                    <h6 class="mb-2" style="font-size: 0.95rem;">Also available on:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <?php if($product['shopee_url']): ?>
                        <a href="<?= esc($product['shopee_url']) ?>" target="_blank" 
                           class="btn btn-sm btn-outline-secondary" style="font-size: 0.8rem;">
                            <i class="fas fa-shopping-bag me-1"></i> Shopee
                        </a>
                        <?php endif; ?>
                        
                        <?php if($product['tokopedia_url']): ?>
                        <a href="<?= esc($product['tokopedia_url']) ?>" target="_blank" 
                           class="btn btn-sm btn-outline-secondary" style="font-size: 0.8rem;">
                            <i class="fas fa-store me-1"></i> Tokopedia
                        </a>
                        <?php endif; ?>
                        
                        <?php if($product['lazada_url']): ?>
                        <a href="<?= esc($product['lazada_url']) ?>" target="_blank" 
                           class="btn btn-sm btn-outline-secondary" style="font-size: 0.8rem;">
                            <i class="fas fa-truck me-1"></i> Lazada
                        </a>
                        <?php endif; ?>
                        
                        <?php if($product['bukalapak_url']): ?>
                        <a href="<?= esc($product['bukalapak_url']) ?>" target="_blank" 
                           class="btn btn-sm btn-outline-secondary" style="font-size: 0.8rem;">
                            <i class="fas fa-box me-1"></i> Bukalapak
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="tab-pane fade" id="shipping" role="tabpanel">
                <p style="font-size: 0.9rem; line-height: 1.6; color: #555;">
                    • Free shipping on orders over Rp 500,000<br>
                    • Standard delivery: 3-5 business days<br>
                    • Express delivery: 1-2 business days<br>
                    • 30-day return policy<br>
                    • Contact us for international shipping
                </p>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <?php if(!empty($related)): ?>
    <div class="related-products">
        <h3 class="section-title">Related Products</h3>
        <div class="row">
            <?php foreach($related as $item): ?>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-3">
                <a href="<?= base_url('/products/' . $item['id']) ?>" class="related-item">
                    <img src="<?= base_url('uploads/products/' . $item['image']) ?>" 
                         alt="<?= esc($item['title']) ?>" 
                         class="related-image"
                         onerror="this.src='https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80'">
                    <h6 class="related-title"><?= esc($item['title']) ?></h6>
                    <div class="related-price">
                        Rp <?= number_format($item['price'], 0, ',', '.') ?>
                        <?php if($item['discount'] > 0): ?>
                        <small class="text-danger ms-1">-<?= $item['discount'] ?>%</small>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
let quantity = 1;
const maxStock = <?= $product['stock'] ?>;

function increaseQuantity() {
    if (quantity < maxStock) {
        quantity++;
        updateQuantityDisplay();
    }
}

function decreaseQuantity() {
    if (quantity > 1) {
        quantity--;
        updateQuantityDisplay();
    }
}

function updateQuantityDisplay() {
    document.getElementById('quantity').value = quantity;
}

function changeMainImage(src) {
    document.getElementById('mainProductImage').src = src;
}

function addToCart(productId) {
    const qty = quantity;
    
    // Gunakan FormData atau URL encoded
    const formData = new FormData();
    formData.append('quantity', qty);
    
    fetch('/cart/add/' + productId, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => {
        // Cek dulu jika response adalah JSON
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            return response.json();
        } else {
            // Jika bukan JSON, mungkin redirect atau error
            return response.text().then(text => {
                throw new Error('Expected JSON but got: ' + text.substring(0, 100));
            });
        }
    })
    .then(data => {
        if (data.success) {
            // Update cart count
            let count = parseInt($('#cart-count').text()) || 0;
            $('#cart-count').text(count + qty);
            
            // Show success message
            showNotification(data.message || 'Product added to cart successfully!', 'success');
        } else {
            showNotification(data.message || 'Failed to add to cart', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        
        // Cek jika error karena auth/redirect
        if (error.message.includes('Expected JSON')) {
            // Mungkin perlu login, redirect ke login
            showNotification('Please login to add items to cart', 'warning');
            setTimeout(() => {
                window.location.href = '/login?redirect=' + encodeURIComponent(window.location.pathname);
            }, 1500);
        } else {
            showNotification('Error adding to cart. Please try again.', 'error');
        }
    });
}

function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 1050; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    // Add to body
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateQuantityDisplay();
});
</script>
<?= $this->endSection() ?>