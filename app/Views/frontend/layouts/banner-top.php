<style> 
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

    /* BANNER MODERN */
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
    background: rgba(137, 43, 226, 0);
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(138, 43, 226, 0.2);
}

@media (max-width: 992px) {
    .banner-content {
        background: rgba(137, 43, 226, 0);
        margin-top: 20px;
    }
}
 /* RESPONSIVE */
        @media (max-width: 768px) {
            .banner-top h1 {
                font-size: 2rem;
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

</style>

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
                        <a href="/products" class="btn btn-shop-now">
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
        
        <!-- 3 foto produk di bawah -->
        <div class="row g-3">
            <?php
            // Ambil 3 produk terbaru atau promo (sesuaikan dengan data yang ada)
            $featuredProducts = $products ?? [];
            $count = 0;
            
            // Loop untuk 3 produk pertama
            for ($i = 0; $i < min(3, count($featuredProducts)); $i++):
                $product = $featuredProducts[$i];
            ?>
            <div class="col-md-4">
                <a href="/products/<?= $product['id'] ?? '#' ?>" class="text-decoration-none">
                    <div class="featured-product-card position-relative overflow-hidden rounded-3">
                        <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                             alt="<?= esc($product['title'] ?? 'Produk') ?>" 
                             class="img-fluid product-thumb">
                        
                        <!-- Badge diskon jika ada -->
                        <?php if(($product['discount'] ?? 0) > 0): ?>
                        <div class="product-badge bg-danger">
                            -<?= $product['discount'] ?>%
                        </div>
                        <?php endif; ?>
                        
                        <!-- Overlay info produk -->
                        <div class="product-overlay">
                            <div class="product-info">
                                <h6 class="mb-1 fw-bold"><?= esc($product['title'] ?? 'Produk') ?></h6>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="price fw-bold">
                                        Rp <?= number_format($product['price'] ?? 0, 0, ',', '.') ?>
                                    </span>
                                    <?php if(($product['discount'] ?? 0) > 0): ?>
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
            <?php endfor; ?>
        </div>
    </div>
</section>