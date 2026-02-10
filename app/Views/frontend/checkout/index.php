<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('title') ?>
Checkout - Beauty Fashion Shop
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
/* CHECKOUT PAGE - FIXED LEFT, SCROLLABLE RIGHT */
.checkout-page {
    padding: 1.5rem 0;
    min-height: calc(100vh - 200px);
}

.page-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-color);
    position: sticky;
    top: 0;
    background: white;
    z-index: 10;
    padding-top: 0.5rem;
}

/* Checkout Steps */
.checkout-steps {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    position: relative;
    background: white;
    padding: 0.75rem;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.checkout-steps:before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 2px;
    background: #eee;
    transform: translateY(-50%);
    z-index: 1;
}

.step {
    text-align: center;
    position: relative;
    z-index: 2;
    flex: 1;
}

.step-number {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #eee;
    color: #888;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin: 0 auto 0.5rem;
    font-size: 0.9rem;
    border: 3px solid white;
}

.step.active .step-number {
    background: var(--primary-color);
    color: white;
}

.step-label {
    font-size: 0.75rem;
    color: #888;
    white-space: nowrap;
}

.step.active .step-label {
    color: var(--primary-color);
    font-weight: 500;
}

/* MAIN CHECKOUT LAYOUT */
.checkout-layout {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

@media (min-width: 992px) {
    .checkout-layout {
        flex-direction: row;
        height: calc(100vh - 250px);
        min-height: 500px;
        gap: 1.5rem;
    }
}

/* LEFT SIDE - ORDER SUMMARY (FIXED) */
.order-summary-side {
    flex: 0 0 auto;
    background: white;
    border-radius: 8px;
    padding: 1.25rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    max-height: 500px;
    overflow-y: auto;
}

@media (min-width: 992px) {
    .order-summary-side {
        width: 380px;
        max-height: calc(100vh - 250px);
        position: sticky;
        top: 100px;
        align-self: flex-start;
    }
}

/* RIGHT SIDE - CHECKOUT FORM (SCROLLABLE) */
.checkout-form-side {
    flex: 1;
    background: white;
    border-radius: 8px;
    padding: 1.25rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    overflow-y: auto;
}

@media (min-width: 992px) {
    .checkout-form-side {
        max-height: calc(100vh - 250px);
        overflow-y: auto;
    }
}

/* Scrollbar styling */
.checkout-form-side::-webkit-scrollbar,
.order-summary-side::-webkit-scrollbar {
    width: 6px;
}

.checkout-form-side::-webkit-scrollbar-track,
.order-summary-side::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.checkout-form-side::-webkit-scrollbar-thumb,
.order-summary-side::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.checkout-form-side::-webkit-scrollbar-thumb:hover,
.order-summary-side::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Section Titles */
.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #eee;
    position: sticky;
    top: 0;
    background: white;
    z-index: 5;
}

/* Order Items in Summary */
.order-items-summary {
    margin-bottom: 1rem;
}

.order-item-summary {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #f0f0f0;
}

.order-item-summary:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.item-img-summary {
    width: 50px;
    height: 50px;
    border-radius: 5px;
    overflow: hidden;
    flex-shrink: 0;
    margin-right: 0.75rem;
}

.item-img-summary img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-info-summary {
    flex-grow: 1;
    min-width: 0; /* Untuk ellipsis */
}

.item-title-summary {
    font-size: 0.85rem;
    font-weight: 500;
    margin-bottom: 0.25rem;
    color: #333;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.item-details-summary {
    font-size: 0.75rem;
    color: #666;
}

.item-price-summary {
    font-weight: 600;
    color: var(--primary-color);
    font-size: 0.9rem;
    text-align: right;
    flex-shrink: 0;
    margin-left: 0.5rem;
}

/* Order Total */
.order-total-summary {
    border-top: 1px solid #ddd;
    padding-top: 1rem;
    margin-top: 1rem;
}

.total-row-summary {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.total-row-summary.final {
    font-weight: 600;
    font-size: 1.1rem;
    color: var(--primary-color);
    margin-top: 0.5rem;
    padding-top: 0.5rem;
    border-top: 1px solid #ddd;
}

/* Form Elements */
.form-group {
    margin-bottom: 1rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #555;
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 0.5rem 0.75rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 0.9rem;
    transition: border-color 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(138, 43, 226, 0.1);
}

/* Radio Groups */
.radio-group {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 0.75rem;
}

.radio-option {
    display: flex;
}

.radio-input {
    display: none;
}

.radio-label {
    display: block;
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    transition: all 0.2s;
    flex: 1;
}

.radio-input:checked + .radio-label {
    border-color: var(--primary-color);
    background: rgba(138, 43, 226, 0.05);
    box-shadow: 0 0 0 1px var(--primary-color);
}

.radio-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #333;
    font-size: 0.9rem;
}

.radio-desc {
    font-size: 0.75rem;
    color: #666;
}

/* Checkout Actions */
.checkout-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eee;
    position: sticky;
    bottom: 0;
    background: white;
    z-index: 5;
}

.btn-back {
    background: #6c757d;
    color: white;
    border: none;
    padding: 0.6rem 1.25rem;
    border-radius: 5px;
    font-size: 0.9rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: background 0.2s;
}

.btn-back:hover {
    background: #5a6268;
    color: white;
}

.btn-place-order {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 0.6rem 1.5rem;
    border-radius: 5px;
    font-size: 0.9rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    transition: background 0.2s;
    min-width: 140px;
    justify-content: center;
}

.btn-place-order:hover {
    background: #7a1fd1;
}

.btn-place-order:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Loading Overlay */
.loading-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.9);
    z-index: 9999;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.spinner-large {
    width: 50px;
    height: 50px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid var(--primary-color);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 1rem;
}

.loading-text {
    font-weight: 500;
    color: #333;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 768px) {
    .checkout-steps {
        flex-direction: column;
        gap: 0.75rem;
        align-items: flex-start;
    }
    
    .checkout-steps:before {
        display: none;
    }
    
    .step {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        width: 100%;
    }
    
    .step-number {
        margin: 0;
        flex-shrink: 0;
    }
    
    .checkout-actions {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .btn-back,
    .btn-place-order {
        width: 100%;
        text-align: center;
        justify-content: center;
    }
    
    .radio-group {
        grid-template-columns: 1fr;
    }
}

/* Checkout Content */
.checkout-content {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #eee;
}

/* Order Summary */
.order-summary {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1.5rem;
}

.order-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.order-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.order-item-img {
    width: 60px;
    height: 60px;
    border-radius: 5px;
    overflow: hidden;
    flex-shrink: 0;
    margin-right: 1rem;
}

.order-item-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.order-item-info {
    flex-grow: 1;
}

.order-item-title {
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 0.25rem;
    color: #333;
}

.order-item-details {
    font-size: 0.8rem;
    color: #666;
}

.order-item-price {
    font-weight: 600;
    color: var(--primary-color);
    font-size: 0.9rem;
    text-align: right;
    min-width: 100px;
}

.order-total {
    border-top: 1px solid #ddd;
    padding-top: 1rem;
    margin-top: 1rem;
}

.total-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.total-row.final {
    font-weight: 600;
    font-size: 1.1rem;
    color: var(--primary-color);
    margin-top: 0.5rem;
    padding-top: 0.5rem;
    border-top: 1px solid #ddd;
}

/* Form */
.form-group {
    margin-bottom: 1rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #555;
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 0.5rem 0.75rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 0.9rem;
    transition: border-color 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
}

.radio-group {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.radio-option {
    flex: 1;
    min-width: 150px;
}

.radio-input {
    display: none;
}

.radio-label {
    display: block;
    padding: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    transition: all 0.2s;
}

.radio-input:checked + .radio-label {
    border-color: var(--primary-color);
    background: rgba(138, 43, 226, 0.05);
}

.radio-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #333;
    font-size: 0.9rem;
}

.radio-desc {
    font-size: 0.8rem;
    color: #666;
}

/* Checkout Actions */
.checkout-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eee;
}

.btn-back {
    background: #6c757d;
    color: white;
    border: none;
    padding: 0.6rem 1.5rem;
    border-radius: 5px;
    font-size: 0.9rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.btn-back:hover {
    background: #5a6268;
    color: white;
}

.btn-place-order {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 0.6rem 2rem;
    border-radius: 5px;
    font-size: 0.9rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
}

.btn-place-order:hover {
    background: #7a1fd1;
}

.btn-place-order:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Loading */
.loading-spinner {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

.spinner {
    width: 40px;
    height: 40px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid var(--primary-color);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 768px) {
    .checkout-steps {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .checkout-steps:before {
        display: none;
    }
    
    .step {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        width: 100%;
    }
    
    .step-number {
        margin: 0;
        flex-shrink: 0;
    }
    
    .checkout-actions {
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn-back,
    .btn-place-order {
        width: 100%;
        text-align: center;
        justify-content: center;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container checkout-page">
    <!-- Checkout Steps -->
    <div class="checkout-steps">
        <div class="step active">
            <div class="step-number">1</div>
            <div class="step-label">Keranjang</div>
        </div>
        <div class="step active">
            <div class="step-number">2</div>
            <div class="step-label">Checkout</div>
        </div>
        <div class="step">
            <div class="step-number">3</div>
            <div class="step-label">Pembayaran</div>
        </div>
        <div class="step">
            <div class="step-number">4</div>
            <div class="step-label">Selesai</div>
        </div>
    </div>

    <h1 class="page-title">Checkout</h1>

    <div class="checkout-layout">
        <!-- LEFT SIDE - ORDER SUMMARY (FIXED) -->
        <div class="order-summary-side">
            <h3 class="section-title">Ringkasan Pesanan</h3>
            
            <div class="order-items-summary">
                <?php foreach($cart['details'] as $item): ?>
                <div class="order-item-summary">
                    <div class="item-img-summary">
                        <img src="<?= base_url('uploads/products/' . $item['image']) ?>" 
                             alt="<?= esc($item['title']) ?>"
                             onerror="this.src='https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80'">
                    </div>
                    <div class="item-info-summary">
                        <div class="item-title-summary"><?= esc($item['title']) ?></div>
                        <div class="item-details-summary">
                            <?= $item['qty'] ?> × Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                        </div>
                    </div>
                    <div class="item-price-summary">
                        Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="order-total-summary">
                <div class="total-row-summary">
                    <span>Subtotal</span>
                    <span>Rp <?= number_format($cart['total'], 0, ',', '.') ?></span>
                </div>
                <div class="total-row-summary">
                    <span>Pengiriman</span>
                    <span>Rp 0</span>
                </div>
                <div class="total-row-summary">
                    <span>Pajak</span>
                    <span>Rp 0</span>
                </div>
                <div class="total-row-summary final">
                    <span>Total</span>
                    <span>Rp <?= number_format($cart['total'], 0, ',', '.') ?></span>
                </div>
            </div>
            
            <div class="mt-3">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Gratis ongkir untuk pesanan di atas Rp 500.000
                </small>
            </div>
        </div>

        <!-- RIGHT SIDE - CHECKOUT FORM (SCROLLABLE) -->
        <div class="checkout-form-side">
            <form id="checkoutForm">
                <!-- Shipping Address -->
                <div class="mb-4">
                    <h3 class="section-title">Alamat Pengiriman</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" 
                               value="<?= esc($user['name'] ?? '') ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" 
                               value="<?= esc($user['email'] ?? '') ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Alamat Pengiriman *</label>
                        <textarea class="form-control" name="shipping_address" 
                                  rows="3" required 
                                  placeholder="Masukkan alamat lengkap pengiriman (jalan, kota, provinsi, kode pos)"></textarea>
                        <small class="text-muted">Contoh: Jl. Merdeka No. 123, Jakarta Pusat, DKI Jakarta 10110</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Nomor Telepon *</label>
                        <input type="tel" class="form-control" name="phone" 
                               required placeholder="Contoh: 081234567890"
                               pattern="[0-9]{10,13}"
                               title="Masukkan 10-13 digit angka">
                        <small class="text-muted">Format: 10-13 digit angka</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea class="form-control" name="notes" 
                                  rows="2" placeholder="Instruksi khusus untuk pengiriman"></textarea>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="mb-4">
                    <h3 class="section-title">Metode Pembayaran</h3>
                    
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" name="payment_method" 
                                   value="bank_transfer" id="bank_transfer" class="radio-input" checked>
                            <label for="bank_transfer" class="radio-label">
                                <div class="radio-title">Transfer Bank</div>
                                <div class="radio-desc">BCA, Mandiri, BRI</div>
                            </label>
                        </div>
                        
                        <div class="radio-option">
                            <input type="radio" name="payment_method" 
                                   value="cod" id="cod" class="radio-input">
                            <label for="cod" class="radio-label">
                                <div class="radio-title">Bayar di Tempat</div>
                                <div class="radio-desc">Bayar saat barang sampai</div>
                            </label>
                        </div>
                        
                        <div class="radio-option">
                            <input type="radio" name="payment_method" 
                                   value="ewallet" id="ewallet" class="radio-input">
                            <label for="ewallet" class="radio-label">
                                <div class="radio-title">E-Wallet</div>
                                <div class="radio-desc">OVO, GoPay, DANA</div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Shipping Method -->
                <div class="mb-4">
                    <h3 class="section-title">Metode Pengiriman</h3>
                    
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" name="shipping_method" 
                                   value="regular" id="regular" class="radio-input" checked>
                            <label for="regular" class="radio-label">
                                <div class="radio-title">Reguler</div>
                                <div class="radio-desc">3-5 hari kerja</div>
                            </label>
                        </div>
                        
                        <div class="radio-option">
                            <input type="radio" name="shipping_method" 
                                   value="express" id="express" class="radio-input">
                            <label for="express" class="radio-label">
                                <div class="radio-title">Express</div>
                                <div class="radio-desc">1-2 hari kerja</div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Terms -->
                <div class="mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms" style="font-size: 0.85rem;">
                            Saya setuju dengan <a href="#" class="text-primary">Syarat & Ketentuan</a> dan <a href="#" class="text-primary">Kebijakan Privasi</a>
                        </label>
                    </div>
                </div>

                <!-- Checkout Actions -->
                <div class="checkout-actions">
                    <a href="<?= base_url('/cart') ?>" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Keranjang
                    </a>
                    <button type="submit" class="btn-place-order" id="placeOrderBtn">
                        <i class="fas fa-lock me-2"></i> Buat Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner-large"></div>
    <div class="loading-text">Memproses pesanan...</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkoutForm = document.getElementById('checkoutForm');
    const placeOrderBtn = document.getElementById('placeOrderBtn');
    const loadingSpinner = document.getElementById('loadingSpinner');
    
    checkoutForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateForm()) {
            return;
        }
        
        // Show loading
        placeOrderBtn.disabled = true;
        loadingSpinner.style.display = 'flex';
        
        // Collect form data
        const formData = new FormData(checkoutForm);
        
        // Send order request
        fetch('/checkout/process', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Show success message
                showNotification('Order placed successfully!', 'success');
                
                // Redirect to order detail
                setTimeout(() => {
                    window.location.href = data.redirect || '/orders/' + data.orderId;
                }, 1500);
            } else {
                // Show error
                let errorMsg = data.message || 'Failed to place order';
                if (data.errors) {
                    errorMsg += ': ' + Object.values(data.errors).join(', ');
                }
                showNotification(errorMsg, 'error');
                placeOrderBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Network error. Please try again.', 'error');
            placeOrderBtn.disabled = false;
        })
        .finally(() => {
            loadingSpinner.style.display = 'none';
        });
    });
    
    function validateForm() {
        const shippingAddress = checkoutForm.querySelector('[name="shipping_address"]');
        const phone = checkoutForm.querySelector('[name="phone"]');
        const terms = checkoutForm.querySelector('#terms');
        
        if (!shippingAddress.value.trim()) {
            showNotification('Mohon masukkan alamat pengiriman', 'error');
            shippingAddress.focus();
            return false;
        }
        
        if (shippingAddress.value.trim().length < 10) {
            showNotification('Alamat pengiriman minimal 10 karakter', 'error');
            shippingAddress.focus();
            return false;
        }
        
        if (!phone.value.trim()) {
            showNotification('Mohon masukkan nomor telepon', 'error');
            phone.focus();
            return false;
        }
        
        const phoneRegex = /^[0-9]{10,15}$/;
        if (!phoneRegex.test(phone.value.trim())) {
            showNotification('Nomor telepon harus 10-15 digit angka', 'error');
            phone.focus();
            return false;
        }
        
        if (!terms.checked) {
            showNotification('Mohon setujui syarat dan ketentuan', 'error');
            return false;
        }
        
        return true;
    }
    
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 1050; min-width: 300px;';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 5000);
    }
});
</script>
<?= $this->endSection() ?>