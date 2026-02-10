<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('title') ?>
Shopping Cart - Beauty Fashion Shop
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
/* CART PAGE */
.cart-page {
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

/* Cart Status */
.empty-cart {
    text-align: center;
    padding: 3rem 1rem;
}

.empty-cart-icon {
    font-size: 3rem;
    color: #ddd;
    margin-bottom: 1rem;
}

.empty-cart-title {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.empty-cart-text {
    color: #888;
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}

.btn-continue-shopping {
    background: var(--primary-color);
    color: white;
    padding: 0.6rem 1.5rem;
    border-radius: 5px;
    text-decoration: none;
    font-size: 0.9rem;
    display: inline-block;
}

.btn-continue-shopping:hover {
    background: #7a1fd1;
    color: white;
}

/* Cart Table */
.cart-table-container {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.cart-table {
    width: 100%;
    border-collapse: collapse;
}

.cart-table thead {
    background: #f8f9fa;
}

.cart-table th {
    padding: 0.75rem 1rem;
    text-align: left;
    font-weight: 600;
    color: #555;
    font-size: 0.85rem;
    border-bottom: 1px solid #eee;
}

.cart-table td {
    padding: 1rem;
    border-bottom: 1px solid #eee;
    vertical-align: middle;
}

/* Cart Item */
.cart-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.cart-item-img {
    width: 70px;
    height: 70px;
    border-radius: 5px;
    overflow: hidden;
    flex-shrink: 0;
}

.cart-item-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.cart-item-info {
    flex-grow: 1;
}

.cart-item-title {
    font-size: 0.9rem;
    font-weight: 500;
    color: #333;
    margin-bottom: 0.25rem;
    line-height: 1.3;
}

.cart-item-category {
    font-size: 0.75rem;
    color: #888;
}

/* Quantity Controls */
.quantity-controls {
    display: inline-flex;
    align-items: center;
    border: 1px solid #ddd;
    border-radius: 4px;
    overflow: hidden;
}

.qty-btn {
    width: 28px;
    height: 28px;
    background: #f8f9fa;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.8rem;
    color: #555;
    user-select: none;
}

.qty-btn:hover {
    background: #e9ecef;
}

.qty-input {
    width: 40px;
    height: 28px;
    border: none;
    border-left: 1px solid #ddd;
    border-right: 1px solid #ddd;
    text-align: center;
    font-size: 0.85rem;
    background: white;
}

.btn-remove-item {
    background: none;
    border: none;
    color: #dc3545;
    cursor: pointer;
    font-size: 1rem;
    padding: 0.25rem;
    transition: color 0.2s;
}

.btn-remove-item:hover {
    color: #c82333;
}

/* Price */
.item-price {
    font-weight: 600;
    color: #333;
    font-size: 0.95rem;
}

.item-subtotal {
    font-weight: 600;
    color: var(--primary-color);
    font-size: 1rem;
}

/* Cart Summary */
.cart-summary {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1.5rem;
    margin-top: 1.5rem;
}

.summary-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #333;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
}

.summary-label {
    color: #666;
}

.summary-value {
    font-weight: 500;
    color: #333;
}

.summary-total {
    border-top: 1px solid #ddd;
    padding-top: 0.75rem;
    margin-top: 0.75rem;
    font-weight: 600;
    color: var(--primary-color);
    font-size: 1.1rem;
}

/* Cart Actions */
.cart-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.btn-update-cart {
    background: white;
    color: var(--primary-color);
    border: 1px solid var(--primary-color);
    padding: 0.6rem 1.5rem;
    border-radius: 5px;
    font-size: 0.9rem;
    text-decoration: none;
}

.btn-update-cart:hover {
    background: #f8f9fa;
}

.btn-checkout {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 0.6rem 1.5rem;
    border-radius: 5px;
    font-size: 0.9rem;
    font-weight: 500;
    flex-grow: 1;
}

.btn-checkout:hover {
    background: #7a1fd1;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .cart-table {
        display: block;
    }
    
    .cart-table thead {
        display: none;
    }
    
    .cart-table tr {
        display: block;
        margin-bottom: 1rem;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 1rem;
        background: white;
    }
    
    .cart-table td {
        display: block;
        padding: 0.5rem 0;
        border: none;
        text-align: left;
    }
    
    .cart-table td:before {
        content: attr(data-label);
        float: left;
        font-weight: 600;
        color: #666;
        font-size: 0.8rem;
        width: 100px;
    }
    
    .cart-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .cart-item-img {
        width: 100%;
        height: 120px;
        margin-bottom: 0.5rem;
    }
    
    .cart-actions {
        flex-direction: column;
    }
    
    .btn-checkout,
    .btn-update-cart {
        width: 100%;
        text-align: center;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container cart-page">
    <h1 class="page-title">Shopping Cart</h1>
    
    <?php if(empty($cart) || empty($cart['details'] ?? [])): 
?>
    <div class="empty-cart">
        <div class="empty-cart-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <h3 class="empty-cart-title">Your cart is empty</h3>
        <p class="empty-cart-text">Looks like you haven't added any items to your cart yet.</p>
        <a href="<?= base_url('/products') ?>" class="btn-continue-shopping">
            <i class="fas fa-arrow-left me-1"></i> Continue Shopping
        </a>
    </div>
<?php else: ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table-container">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cartItems">
                            <?php 
                            $cartTotal = 0;
                            foreach($cart['details'] as $item): 
                                $subtotal = $item['qty'] * $item['harga'];
                                $cartTotal += $subtotal;
                            ?>
                            <tr class="cart-item-row" data-id="<?= $item['id'] ?>">
                                <td data-label="Product">
                                    <div class="cart-item">
                                        <div class="cart-item-img">
                                            <img src="<?= base_url('uploads/products/' . ($item['image'] ?? 'default.jpg')) ?>" 
                                                 alt="<?= esc($item['title'] ?? 'Product') ?>"
                                                 onerror="this.src='https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80'">
                                        </div>
                                        <div class="cart-item-info">
                                            <div class="cart-item-title"><?= esc($item['title'] ?? 'Product') ?></div>
                                            <div class="cart-item-category">SKU: PROD-<?= str_pad($item['product_id'], 4, '0', STR_PAD_LEFT) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Price" class="item-price">
                                    Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                                </td>
                                <td data-label="Quantity">
                                    <div class="quantity-controls">
                                        <button type="button" class="qty-btn" onclick="updateQuantity(<?= $item['id'] ?>, -1)">-</button>
                                        <input type="text" class="qty-input" id="qty_<?= $item['id'] ?>" 
                                               value="<?= $item['qty'] ?>" data-price="<?= $item['harga'] ?>" readonly>
                                        <button type="button" class="qty-btn" onclick="updateQuantity(<?= $item['id'] ?>, 1)">+</button>
                                    </div>
                                </td>
                                <td data-label="Subtotal" class="item-subtotal" id="subtotal_<?= $item['id'] ?>">
                                    Rp <?= number_format($subtotal, 0, ',', '.') ?>
                                </td>
                                <td data-label="Action">
                                    <button type="button" class="btn-remove-item" onclick="removeItem(<?= $item['id'] ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="cart-actions">
                    <a href="<?= base_url('/checkout') ?>" class="btn-update-cart">
                        <i class="fas fa-arrow-left me-1"></i> Continue Shopping
                    </a>
                    <button type="button" class="btn-update-cart" onclick="updateAllQuantities()">
                        <i class="fas fa-sync-alt me-1"></i> Update Cart
                    </button>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3 class="summary-title">Order Summary</h3>
                    
                    <div class="summary-row">
                        <span class="summary-label">Subtotal</span>
                        <span class="summary-value" id="summarySubtotal">Rp <?= number_format($cartTotal, 0, ',', '.') ?></span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="summary-label">Shipping</span>
                        <span class="summary-value">-</span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="summary-label">Tax</span>
                        <span class="summary-value">Rp 0</span>
                    </div>
                    
                    <div class="summary-row summary-total">
                        <span class="summary-label">Total</span>
                        <span class="summary-value" id="summaryTotal">Rp <?= number_format($cartTotal, 0, ',', '.') ?></span>
                    </div>
                    
                    <button type="button" class="btn-checkout" onclick="checkoutCart()">
                        <i class="fas fa-lock me-1"></i> Proceed to Checkout
                    </button>
                    
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt me-1"></i>
                            Secure checkout • 30-day returns • Free shipping on orders over Rp 500k
                        </small>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                </div>
                <p>Updating cart...</p>
            </div>
        </div>
    </div>
</div>

<!-- Custom Confirm Modal -->
<div class="modal fade" id="checkoutConfirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <i class="fas fa-shopping-bag me-2 text-primary"></i>
                    Lanjutkan ke Checkout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-4">
                    <i class="fas fa-shopping-cart fa-3x text-primary"></i>
                </div>
                <h5 class="mb-3">Lanjutkan ke pembayaran?</h5>
                <p class="text-muted mb-0">
                    Anda akan diarahkan ke halaman checkout untuk menyelesaikan pesanan.
                </p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-primary" id="confirmCheckoutBtn">
                    <i class="fas fa-check me-1"></i> Ya, Lanjutkan
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
let cartItems = {};
let isUpdating = false;

// Initialize hanya jika ada item
function initializeCart() {
    const cartRows = document.querySelectorAll('.cart-item-row');
    if (cartRows.length === 0) return;
    
    cartRows.forEach(row => {
        const id = row.dataset.id;
        const qtyInput = document.getElementById('qty_' + id);
        if (qtyInput) {
            cartItems[id] = parseInt(qtyInput.value);
        }
    });
    
    calculateTotals();
}

function updateQuantity(itemId, change) {
    if (isUpdating) return;
    
    const qtyInput = document.getElementById('qty_' + itemId);
    if (!qtyInput) return;
    
    let newQty = parseInt(qtyInput.value) + change;
    if (newQty < 1) newQty = 1;
    
    qtyInput.value = newQty;
    cartItems[itemId] = newQty;
    calculateSubtotal(itemId);
    calculateTotals();
}

function removeItem(itemId) {
    if (isUpdating) return;
    
    if (!confirm('Remove this item from cart?')) return;
    
    isUpdating = true;
    $('#updateModal').modal('show');
    
    fetch('/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: 'id=' + itemId + '&qty=0'
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Remove row
            const row = document.querySelector(`.cart-item-row[data-id="${itemId}"]`);
            if (row) {
                row.style.transition = 'opacity 0.3s';
                row.style.opacity = '0';
                
                setTimeout(() => {
                    row.remove();
                    
                    // Update totals
                    calculateTotals();
                    
                    // Check if cart is empty
                    if (document.querySelectorAll('.cart-item-row').length === 0) {
                        location.reload();
                    }
                    
                    // Update cart count
                    updateCartCount(-1);
                }, 300);
            }
        } else {
            alert(data.message || 'Failed to remove item');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Network error. Please try again.');
    })
    .finally(() => {
        isUpdating = false;
        $('#updateModal').modal('hide');
    });
}

function updateAllQuantities() {
    if (isUpdating) return;
    
    isUpdating = true;
    $('#updateModal').modal('show');
    
    const updates = [];
    
    for (const [itemId, qty] of Object.entries(cartItems)) {
        const qtyInput = document.getElementById('qty_' + itemId);
        if (qtyInput && parseInt(qtyInput.value) !== qty) {
            updates.push({
                id: itemId,
                qty: qtyInput.value
            });
        }
    }
    
    if (updates.length === 0) {
        isUpdating = false;
        $('#updateModal').modal('hide');
        return;
    }
    
    // Update satu per satu untuk error handling lebih baik
    let completed = 0;
    let errors = [];
    
    updates.forEach(update => {
        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'id=' + update.id + '&qty=' + update.qty
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                errors.push(data.message || 'Update failed for item ' + update.id);
            } else {
                // Update local cart items
                cartItems[update.id] = parseInt(update.qty);
            }
        })
        .catch(error => {
            errors.push('Network error for item ' + update.id);
        })
        .finally(() => {
            completed++;
            
            if (completed === updates.length) {
                // All requests completed
                if (errors.length === 0) {
                    // Recalculate all subtotals
                    document.querySelectorAll('.cart-item-row').forEach(row => {
                        const itemId = row.dataset.id;
                        calculateSubtotal(itemId);
                    });
                    
                    calculateTotals();
                    showNotification('Cart updated successfully', 'success');
                } else {
                    showNotification('Some items failed to update: ' + errors.join(', '), 'error');
                }
                
                isUpdating = false;
                $('#updateModal').modal('hide');
            }
        });
    });
}

function calculateSubtotal(itemId) {
    const qtyInput = document.getElementById('qty_' + itemId);
    if (!qtyInput) return;
    
    const price = parseFloat(qtyInput?.dataset.price || 0);
    const qty = parseInt(qtyInput?.value || 0);
    const subtotal = price * qty;
    
    const subtotalEl = document.getElementById('subtotal_' + itemId);
    if (subtotalEl) {
        subtotalEl.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    }
}

function calculateTotals() {
    // Cek apakah elemen summary ada
    const summarySubtotal = document.getElementById('summarySubtotal');
    const summaryTotal = document.getElementById('summaryTotal');
    
    if (!summarySubtotal || !summaryTotal) return;
    
    let total = 0;
    
    document.querySelectorAll('.cart-item-row').forEach(row => {
        const itemId = row.dataset.id;
        const qtyInput = document.getElementById('qty_' + itemId);
        if (qtyInput) {
            const price = parseFloat(qtyInput.dataset.price || 0);
            const qty = parseInt(qtyInput.value || 0);
            total += price * qty;
        }
    });
    
    summarySubtotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
    summaryTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
}

function checkoutCart() {
    if (isUpdating) return;
    
    // Show custom modal instead of default confirm
    $('#checkoutConfirmModal').modal('show');
}

// Confirm checkout handler
document.getElementById('confirmCheckoutBtn')?.addEventListener('click', function() {
    window.location.href = '/checkout';
    $('#checkoutConfirmModal').modal('hide');
});

function updateCartCount(change) {
    const cartCount = document.getElementById('cart-count');
    if (cartCount) {
        let current = parseInt(cartCount.textContent) || 0;
        current += change;
        if (current < 0) current = 0;
        cartCount.textContent = current;
    }
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
    }, 3000);
}

// Initialize on load
document.addEventListener('DOMContentLoaded', function() {
    initializeCart();
});
</script>
<?= $this->endSection() ?>