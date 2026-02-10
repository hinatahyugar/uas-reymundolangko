<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <!-- Filter -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="mb-0">Our Products</h1>
            <p class="text-muted">Find your favorite products here</p>
        </div>
        <div class="col-md-4">
            <form action="" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search products..." 
                       value="<?= $search ?>">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar Categories -->
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-tags me-2"></i> Categories</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="/products" class="list-group-item list-group-item-action <?= !$selectedCategory ? 'active' : '' ?>">
                        All Products
                    </a>
                    <?php foreach($categories as $category): ?>
                    <a href="/products?category=<?= $category['id'] ?>" 
                       class="list-group-item list-group-item-action <?= $selectedCategory == $category['id'] ? 'active' : '' ?>">
                        <?= $category['name'] ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="col-lg-9 col-md-8">
            <?php if(empty($products)): ?>
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No products found</h4>
                <p>Try another search or category</p>
            </div>
            <?php else: ?>
            <div class="row">
                <?php foreach($products as $product): ?>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="product-card">
                        <a href="/products/<?= $product['id'] ?>">
                            <img src="<?= base_url('uploads/products/' . $product['image']) ?>" 
                                 class="product-img" alt="<?= $product['title'] ?>"
                                 onerror="this.src='https://via.placeholder.com/300'">
                        </a>
                        <div class="product-body">
                            <h6 class="product-title">
                                <a href="/products/<?= $product['id'] ?>" class="text-dark text-decoration-none">
                                    <?= $product['title'] ?>
                                </a>
                            </h6>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="product-price">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
                                    <?php if($product['discount'] > 0): ?>
                                    <span class="product-price-old">Rp <?= number_format($product['price'] * (1 + $product['discount']/100), 0, ',', '.') ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if($product['discount'] > 0): ?>
                                <span class="badge bg-danger">-<?= $product['discount'] ?>%</span>
                                <?php endif; ?>
                            </div>
                            <button class="btn-add-cart" onclick="addToCart(<?= $product['id'] ?>)">
                                <i class="fas fa-cart-plus me-2"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function addToCart(productId) {
    fetch('/cart/add/' + productId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            // Update cart count
            let count = parseInt($('#cart-count').text()) || 0;
            $('#cart-count').text(count + 1);
        } else {
            alert(data.message);
        }
    });
}
</script>
<?= $this->endSection() ?>