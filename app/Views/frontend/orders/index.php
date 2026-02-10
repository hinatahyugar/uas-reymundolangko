<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('title') ?>
Pesanan Saya - Beauty Fashion Shop
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
.orders-page {
    padding: 2rem 0;
}

.page-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--primary-color);
}

.empty-orders {
    text-align: center;
    padding: 3rem 1rem;
}

.empty-icon {
    font-size: 3rem;
    color: #ddd;
    margin-bottom: 1rem;
}

.order-card {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border-left: 4px solid var(--primary-color);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.order-info h5 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #333;
}

.order-date {
    color: #666;
    font-size: 0.85rem;
}

.order-status {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.order-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.detail-item span:first-child {
    color: #666;
    margin-right: 0.5rem;
}

.order-actions {
    display: flex;
    gap: 0.5rem;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.btn-small {
    padding: 0.3rem 0.75rem;
    font-size: 0.8rem;
    border-radius: 4px;
    text-decoration: none;
}

.btn-view {
    background: var(--primary-color);
    color: white;
}

.btn-view:hover {
    background: #7a1fd1;
    color: white;
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container orders-page">
    <h1 class="page-title">Pesanan Saya</h1>
    
    <?php if(empty($orders)): ?>
        <div class="empty-orders">
            <div class="empty-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <h3>Belum ada pesanan</h3>
            <p class="text-muted mb-3">Anda belum melakukan pembelian apapun</p>
            <a href="<?= base_url('/products') ?>" class="btn btn-primary">
                <i class="fas fa-shopping-bag me-2"></i> Mulai Belanja
            </a>
        </div>
    <?php else: ?>
        <?php foreach($orders as $order): ?>
        <div class="order-card">
            <div class="order-header">
                <div class="order-info">
                    <h5>#<?= $order['no_invoice'] ?></h5>
                    <div class="order-date">
                        <?= date('d F Y', strtotime($order['created_at'])) ?>
                    </div>
                </div>
                <div class="order-status status-<?= $order['status_cart'] ?>">
                    <?php
                    $statusLabels = [
                        'checkout' => 'Menunggu Pembayaran',
                        'paid' => 'Dibayar',
                        'shipped' => 'Dikirim',
                        'completed' => 'Selesai',
                        'canceled' => 'Dibatalkan'
                    ];
                    echo $statusLabels[$order['status_cart']] ?? $order['status_cart'];
                    ?>
                </div>
            </div>
            
            <div class="order-details">
                <div class="detail-item">
                    <span>Total:</span>
                    <strong>Rp <?= number_format($order['total'], 0, ',', '.') ?></strong>
                </div>
                <div class="detail-item">
                    <span>Status Pembayaran:</span>
                    <span><?= ucfirst($order['status_pembayaran']) ?></span>
                </div>
            </div>
            
            <div class="order-actions">
                <a href="<?= base_url('/orders/' . $order['id']) ?>" class="btn-small btn-view">
                    <i class="fas fa-eye me-1"></i> Lihat Detail
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>