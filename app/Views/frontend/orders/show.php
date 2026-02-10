<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('title') ?>
Invoice #<?= $order['no_invoice'] ?> - Beauty Fashion Shop
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
/* ORDER DETAIL */
.order-detail-page {
    padding: 2rem 0;
    background: #f8f9fa;
    min-height: 100vh;
}

.page-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--primary-color);
}

/* Invoice Card */
.invoice-card {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    margin-bottom: 2rem;
}

.invoice-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #eee;
}

.invoice-info h2 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.invoice-date {
    color: #666;
    font-size: 0.9rem;
}

.order-status {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
}

.status-checkout { background: #fff3cd; color: #856404; }
.status-paid { background: #d4edda; color: #155724; }
.status-shipped { background: #cce5ff; color: #004085; }
.status-completed { background: #d1ecf1; color: #0c5460; }
.status-canceled { background: #f8d7da; color: #721c24; }

/* Invoice Details */
.invoice-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.detail-section h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.75rem;
}

.detail-item {
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.detail-label {
    color: #666;
    display: inline-block;
    width: 120px;
}

/* Order Items */
.order-items {
    margin-top: 2rem;
}

.items-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.items-table th {
    background: #f8f9fa;
    padding: 0.75rem 1rem;
    text-align: left;
    font-weight: 600;
    color: #555;
    font-size: 0.85rem;
    border-bottom: 2px solid #dee2e6;
}

.items-table td {
    padding: 1rem;
    border-bottom: 1px solid #eee;
    vertical-align: middle;
}

.item-product {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.item-img {
    width: 60px;
    height: 60px;
    border-radius: 5px;
    overflow: hidden;
    flex-shrink: 0;
}

.item-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-info h5 {
    font-size: 0.95rem;
    font-weight: 500;
    margin-bottom: 0.25rem;
    color: #333;
}

.item-sku {
    font-size: 0.8rem;
    color: #888;
}

.text-right {
    text-align: right;
}

/* Order Summary */
.order-summary {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 2px solid #dee2e6;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
}

.summary-label {
    color: #666;
}

.summary-value {
    font-weight: 500;
    color: #333;
}

.summary-total {
    font-weight: 700;
    color: var(--primary-color);
    font-size: 1.2rem;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #ddd;
}

/* Order Actions */
.order-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eee;
}

.btn-action {
    padding: 0.6rem 1.5rem;
    border-radius: 5px;
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s;
}

.btn-print {
    background: var(--primary-color);
    color: white;
    border: none;
}

.btn-print:hover {
    background: #7a1fd1;
    color: white;
}

.btn-back {
    background: #6c757d;
    color: white;
}

.btn-back:hover {
    background: #5a6268;
    color: white;
}

/* Payment Instructions */
.payment-instructions {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1.5rem;
    margin-top: 2rem;
    border-left: 4px solid var(--primary-color);
}

.payment-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #333;
}

.payment-steps {
    list-style: none;
    padding: 0;
}

.payment-steps li {
    margin-bottom: 1rem;
    padding-left: 1.5rem;
    position: relative;
    font-size: 0.9rem;
    line-height: 1.5;
}

.payment-steps li:before {
    content: counter(step);
    counter-increment: step;
    position: absolute;
    left: 0;
    top: 0;
    width: 24px;
    height: 24px;
    background: var(--primary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {
    .invoice-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .items-table {
        display: block;
        overflow-x: auto;
    }
    
    .order-actions {
        flex-direction: column;
    }
    
    .btn-action {
        width: 100%;
        justify-content: center;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container order-detail-page">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/orders') ?>">Pesanan Saya</a></li>
            <li class="breadcrumb-item active">Invoice #<?= $order['no_invoice'] ?></li>
        </ol>
    </nav>

    <div class="invoice-card">
        <!-- Invoice Header -->
        <div class="invoice-header">
            <div class="invoice-info">
                <h2>INVOICE #<?= $order['no_invoice'] ?></h2>
                <div class="invoice-date">
                    Tanggal: <?= date('d F Y H:i', strtotime($order['created_at'])) ?>
                </div>
            </div>
            
            <div class="order-status status-<?= $order['status_cart'] ?>">
                <?php
                $statusLabels = [
                    'cart' => 'Keranjang',
                    'checkout' => 'Checkout',
                    'paid' => 'Dibayar',
                    'shipped' => 'Dikirim',
                    'completed' => 'Selesai',
                    'canceled' => 'Dibatalkan'
                ];
                echo $statusLabels[$order['status_cart']] ?? $order['status_cart'];
                ?>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details">
            <div class="detail-section">
                <h4>Informasi Pesanan</h4>
                <div class="detail-item">
                    <span class="detail-label">No. Invoice:</span>
                    <strong><?= $order['no_invoice'] ?></strong>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tanggal:</span>
                    <?= date('d F Y', strtotime($order['created_at'])) ?>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Status:</span>
                    <?= $statusLabels[$order['status_cart']] ?? $order['status_cart'] ?>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Pembayaran:</span>
                    <?= ucfirst($order['status_pembayaran']) ?>
                </div>
            </div>
            
            <div class="detail-section">
                <h4>Informasi Pelanggan</h4>
                <div class="detail-item">
                    <span class="detail-label">Nama:</span>
                    <?= session()->get('userName') ?>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Email:</span>
                    <?= session()->get('userEmail') ?>
                </div>
                <div class="detail-item">
                    <span class="detail-label">ID Pelanggan:</span>
                    USR-<?= str_pad(session()->get('userId'), 4, '0', STR_PAD_LEFT) ?>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="order-items">
            <h4>Detail Produk</h4>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($order['details'] as $item): ?>
                    <tr>
                        <td>
                            <div class="item-product">
                                <div class="item-img">
                                    <img src="<?= base_url('uploads/products/' . $item['image']) ?>" 
                                         alt="<?= esc($item['title']) ?>"
                                         onerror="this.src='https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80'">
                                </div>
                                <div class="item-info">
                                    <h5><?= esc($item['title']) ?></h5>
                                    <div class="item-sku">SKU: PROD-<?= str_pad($item['product_id'], 4, '0', STR_PAD_LEFT) ?></div>
                                </div>
                            </div>
                        </td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td><?= $item['qty'] ?></td>
                        <td class="text-right">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <div class="summary-row">
                <span class="summary-label">Subtotal</span>
                <span class="summary-value">Rp <?= number_format($order['total'], 0, ',', '.') ?></span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Biaya Pengiriman</span>
                <span class="summary-value">Rp 0</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Pajak</span>
                <span class="summary-value">Rp 0</span>
            </div>
            <div class="summary-row summary-total">
                <span class="summary-label">Total Pembayaran</span>
                <span class="summary-value">Rp <?= number_format($order['total'], 0, ',', '.') ?></span>
            </div>
        </div>

        <!-- Order Actions -->
        <div class="order-actions">
            <a href="<?= base_url('/orders') ?>" class="btn-action btn-back">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Pesanan
            </a>
            <button onclick="window.print()" class="btn-action btn-print">
                <i class="fas fa-print me-1"></i> Cetak Invoice
            </button>
        </div>

        <!-- Payment Instructions (tampilkan jika status belum paid) -->
        <?php if($order['status_pembayaran'] == 'pending'): ?>
        <div class="payment-instructions">
            <h5 class="payment-title">Instruksi Pembayaran</h5>
            <ol class="payment-steps">
                <li>Transfer ke rekening berikut:</li>
                <li><strong>Bank BCA</strong>: 123-456-7890 (a.n. Beauty Fashion Shop)</li>
                <li><strong>Bank Mandiri</strong>: 098-765-4321 (a.n. Beauty Fashion Shop)</li>
                <li>Total transfer: <strong>Rp <?= number_format($order['total'], 0, ',', '.') ?></strong></li>
                <li>Setelah transfer, konfirmasi melalui WhatsApp: <strong>0812-3456-7890</strong></li>
                <li>Pesanan akan diproses setelah pembayaran dikonfirmasi</li>
            </ol>
        </div>
        <?php endif; ?>
    </div>

    <!-- Order Notes -->
    <div class="alert alert-info mt-3">
        <i class="fas fa-info-circle me-2"></i>
        <strong>Catatan:</strong> Simpan invoice ini sebagai bukti pembayaran. Untuk pertanyaan, hubungi Customer Service di (021) 123-4567.
    </div>
</div>

<!-- Print Styles -->
<style media="print">
@media print {
    body * {
        visibility: hidden;
    }
    .order-detail-page, .order-detail-page * {
        visibility: visible;
    }
    .order-detail-page {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        background: white;
        padding: 0;
    }
    .btn-action, .breadcrumb, .alert {
        display: none !important;
    }
    .invoice-card {
        box-shadow: none;
        border: 1px solid #ddd;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Print invoice
    window.printInvoice = function() {
        window.print();
    };
    
    // Copy invoice number
    document.getElementById('copyInvoiceBtn')?.addEventListener('click', function() {
        const invoiceNo = '<?= $order['no_invoice'] ?>';
        navigator.clipboard.writeText(invoiceNo).then(function() {
            alert('Nomor invoice disalin: ' + invoiceNo);
        });
    });
});
</script>
<?= $this->endSection() ?>