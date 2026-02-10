<?php
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\MenuModel;

// Ambil menu dari database jika model ada, jika tidak gunakan default
$menuModel = new MenuModel();
$menuItems = $menuModel->where('category_id', 1) // 1 = frontend menu
                      ->where('status', '1') // status aktif
                      ->where('parent_id', 0) // parent utama
                      ->orderBy('order', 'ASC')
                      ->findAll();

// Get session data with proper defaults
$isLoggedIn = session()->get('isLoggedIn') ?? false;
$userName = session()->get('userName') ?? '';
$userRole = session()->get('userRole') ?? 'user';
$cartCount = session()->get('cartCount') ?? 0;

// Untuk mendapatkan count cart yang real-time
$cartModel = new \App\Models\CartModel();
if ($isLoggedIn) {
    $userId = session()->get('userId');
    $cart = $cartModel->where('user_id', $userId)
                     ->where('status_cart', 'cart')
                     ->first();
    
    if ($cart) {
        $cartDetailModel = new \App\Models\CartDetailModel();
        $cartItems = $cartDetailModel->where('cart_id', $cart['id'])->findAll();
        $cartCount = array_sum(array_column($cartItems, 'qty'));
    }
}

// PERBAIKAN: Gunakan service('request') untuk mengakses request di view
$searchKeyword = service('request')->getGet('search') ?? '';
?>
<header class="main-header">
    <div class="container">
        <!-- Desktop Top Bar (Logo + Search + Icons) - TAMPIL DI DESKTOP SAJA -->
        <div class="d-none d-lg-flex align-items-center justify-content-between py-3 desktop-top-bar">
            <!-- Logo -->
            <div class="desktop-logo">
                <a class="navbar-brand" href="<?= base_url('/') ?>">
                    <img src="<?= base_url('images/logo.png') ?>" alt="Logo" class="logo-dark">
                </a>
            </div>
            
            <!-- Search Bar (Tengah) -->
            <div class="desktop-search flex-grow-1 mx-4" style="max-width: 600px;">
                <form action="<?= base_url('/products') ?>" method="get" class="w-100">
                    <div class="input-group position-relative">
                        <input type="text" 
                               class="form-control rounded-pill py-2 pe-5" 
                               name="search" 
                               placeholder="Cari produk fashion, batik, aksesoris..." 
                               value="<?= esc($searchKeyword) ?>"
                               style="height: 45px;">
                        <button type="submit" 
                                class="btn position-absolute end-0 top-50 translate-middle-y me-2 rounded-circle search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Desktop Icons (User & Cart) -->
            <div class="desktop-icons d-flex align-items-center gap-3">
                <?php if($isLoggedIn): ?>
                    <div class="dropdown">
                        <a href="#"
                           class="header-icon dropdown-toggle d-flex align-items-center"
                           id="userDropdown"
                           data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2"></i>
                            <span><?= esc($userName) ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                            <?php if($userRole === 'admin'): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>">
                                        <i class="fas fa-tachometer-alt me-2"></i> Admin
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            <?php endif; ?>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('/profile') ?>">
                                    <i class="fas fa-user me-2"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('/orders') ?>">
                                    <i class="fas fa-shopping-bag me-2"></i> Orders
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="<?= base_url('/logout') ?>">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?= base_url('/login') ?>" class="header-icon d-flex align-items-center">
                        <i class="fas fa-user-circle me-2"></i>
                        <span>Login</span>
                    </a>
                <?php endif; ?>

                <!-- Cart -->
                <a href="<?= base_url('/cart') ?>" class="header-icon cart-icon position-relative d-flex align-items-center">
                    <i class="fas fa-shopping-cart me-2"></i>
                    <span>Cart</span>
                    <?php if($cartCount > 0): ?>
                    <span id="cart-count" class="cart-count"><?= $cartCount ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>

        <!-- Mobile Layout -->
        <nav class="navbar navbar-expand-lg navbar-light py-3 d-lg-none">
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-between align-items-center w-100">
                    
                    <!-- Left Side: Burger + Logo -->
                    <div class="d-flex align-items-center mobile-left">
                        <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand me-3" href="<?= base_url('/') ?>">
                            <img src="<?= base_url('images/logo.png') ?>" alt="Logo" class="logo-dark">
                        </a>
                    </div>

                    <!-- Right Side: Icons (User, Cart, Search Toggle) -->
                    <div class="d-flex align-items-center mobile-right">
                        <?php if($isLoggedIn): ?>
                            <div class="dropdown me-2">
                                <a href="#"
                                   class="header-icon dropdown-toggle d-flex align-items-center"
                                   id="userDropdownMobile"
                                   data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                    <?php if($userRole === 'admin'): ?>
                                        <li>
                                            <a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>">
                                                <i class="fas fa-tachometer-alt me-2"></i> Admin
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                    <?php endif; ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url('/profile') ?>">
                                            <i class="fas fa-user me-2"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url('/orders') ?>">
                                            <i class="fas fa-shopping-bag me-2"></i> Orders
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="<?= base_url('/logout') ?>">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a href="<?= base_url('/login') ?>" class="header-icon me-2">
                                <i class="fas fa-user-circle"></i>
                            </a>
                        <?php endif; ?>

                        <!-- Cart -->
                        <a href="<?= base_url('/cart') ?>" class="header-icon cart-icon position-relative me-2">
                            <i class="fas fa-shopping-cart"></i>
                            <?php if($cartCount > 0): ?>
                            <span id="cart-count-mobile" class="cart-count"><?= $cartCount ?></span>
                            <?php endif; ?>
                        </a>

                        <!-- Mobile Search Toggle -->
                        <button class="header-icon search-toggle-btn"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#mobileSearch">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Mobile Search -->
        <div class="collapse d-lg-none" id="mobileSearch">
            <div class="container py-3">
                <form action="<?= base_url('/products') ?>" method="get">
                    <div class="input-group">
                        <input type="text" 
                               class="form-control rounded-pill" 
                               name="search" 
                               placeholder="Cari produk..." 
                               value="<?= esc($searchKeyword) ?>">
                        <button class="btn btn-primary rounded-pill ms-2" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Main Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav mx-auto nav-menu">
                <?php 
                // Jika ada menu dari database, gunakan itu
                if (!empty($menuItems)): 
                    foreach($menuItems as $item): 
                        // Cek apakah menu punya children
                        $children = $menuModel->where('parent_id', $item['id'])
                                             ->where('status', '1')
                                             ->orderBy('order', 'ASC')
                                             ->findAll();
                ?>
                    <?php if(!empty($children) && $item['type'] == '1'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?= base_url($item['slug']) ?>" role="button" data-bs-toggle="dropdown">
                                <?= esc($item['name']) ?>
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach($children as $child): ?>
                                    <li><a class="dropdown-item" href="<?= base_url($child['slug']) ?>"><?= esc($child['name']) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?= current_url() == base_url($item['slug']) ? 'active' : '' ?>" 
                               href="<?= base_url($item['slug']) ?>">
                               <?= esc($item['name']) ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                
                <?php else: 
                    // Fallback menu jika database kosong
                    $fallbackMenu = [
                        ['name' => 'Home', 'slug' => '/', 'type' => '0'],
                        ['name' => 'Products', 'slug' => '#', 'type' => '1', 'children' => [
                            ['name' => 'Batik', 'slug' => '/categories/batik'],
                            ['name' => 'Fashion', 'slug' => '/categories/fashion'],
                            ['name' => 'Accessories', 'slug' => '/categories/accessories'],
                            ['name' => 'Shoes', 'slug' => '/categories/shoes'],
                            ['name' => 'Bags', 'slug' => '/categories/bags']
                        ]],
                        ['name' => 'Articles', 'slug' => '/articles', 'type' => '0'],
                        ['name' => 'About', 'slug' => '/about', 'type' => '0'],
                        ['name' => 'Contact', 'slug' => '/contact', 'type' => '0']
                    ];
                    
                    foreach($fallbackMenu as $item): ?>
                        <?php if(isset($item['children']) && $item['type'] == '1'): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <?= esc($item['name']) ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach($item['children'] as $child): ?>
                                        <li><a class="dropdown-item" href="<?= base_url($child['slug']) ?>"><?= esc($child['name']) ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link <?= current_url() == base_url($item['slug']) ? 'active' : '' ?>" 
                                   href="<?= base_url($item['slug']) ?>">
                                   <?= esc($item['name']) ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>

<style>
/* Base Styles */
.main-header {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* Logo */
.navbar-brand img {
    height: 40px;
    width: auto;
}

/* Header Icons */
.header-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #333;
    padding: 8px 12px;
    border-radius: 8px;
    transition: all 0.25s ease;
    min-height: 40px;
}

.header-icon i {
    font-size: 20px;
    color: var(--primary-color, #8a2be2);
}

.header-icon:hover {
    background: rgba(138, 43, 226, 0.1);
    color: var(--primary-color, #8a2be2);
}

/* Cart Badge */
.cart-count {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ff4757;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

/* Search Button */
.search-btn {
    background: transparent;
    border: none;
    width: 38px;
    height: 38px;
    color: #666;
}

.search-btn:hover {
    background: rgba(0,0,0,0.05);
    color: var(--primary-color);
}

.search-toggle-btn {
    background: none;
    border: none;
    color: #333;
    padding: 8px;
}

/* ===== DESKTOP LAYOUT (992px ke atas) ===== */
@media (min-width: 992px) {
    .desktop-top-bar {
        display: flex !important;
        align-items: center;
        width: 100%;
    }
    
    .desktop-logo {
        flex: 0 0 auto;
    }
    
    .desktop-search {
        flex: 1;
        max-width: 600px;
        margin: 0 2rem;
    }
    
    .desktop-icons {
        flex: 0 0 auto;
        display: flex !important;
    }
    
    /* Desktop search bar */
    .desktop-search .form-control {
        border-radius: 30px !important;
        border: 1px solid #ddd;
        padding-left: 45px;
        height: 45px;
        font-size: 0.95rem;
    }
    
    .desktop-search .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(138, 43, 226, 0.25);
    }
    
    /* Desktop icons styling */
    .desktop-icons .header-icon {
        padding: 8px 15px;
        font-size: 0.95rem;
    }
    
    .desktop-icons .header-icon span {
        display: inline;
        margin-left: 5px;
    }
    
    .desktop-icons .dropdown .header-icon {
        padding-right: 8px;
    }
    
    .desktop-icons .cart-icon {
        padding-left: 15px;
        padding-right: 15px;
    }
}

/* ===== MOBILE LAYOUT (di bawah 992px) ===== */
@media (max-width: 991px) {
    .desktop-top-bar {
        display: none !important;
    }
    
    .navbar {
        padding: 0.5rem 0;
    }
    
    .main-header .container {
        padding: 0 15px;
    }
    
    .mobile-left {
        flex: 1;
    }
    
    .mobile-right {
        display: flex !important;
        justify-content: flex-end;
        gap: 8px;
    }
    
    /* Hide text on mobile icons */
    .header-icon span,
    .dropdown-toggle span {
        display: none !important;
    }
    
    .header-icon {
        min-width: 40px;
        min-height: 40px;
        padding: 8px;
    }
    
    /* Adjust burger button */
    .navbar-toggler {
        padding: 4px 8px;
        margin-right: 8px;
    }
    
    /* Mobile search form */
    #mobileSearch .form-control {
        height: 45px;
        border: 1px solid #ddd;
    }
    
    #mobileSearch .btn-primary {
        height: 45px;
        padding: 0 20px;
        background: var(--primary-color);
        border: none;
    }
}

/* ===== NAVIGATION MENU (Umum) ===== */
.nav-menu {
    display: flex;
    justify-content: center;
    gap: 2rem;
    width: 100%;
}

.nav-link {
    padding: 0.5rem 1rem !important;
    font-weight: 500;
    color: #333;
}

.nav-link.active {
    color: var(--primary-color) !important;
    font-weight: 600;
}

.nav-link:hover {
    color: var(--primary-color) !important;
}

/* Active menu item */
.nav-link.active {
    color: var(--primary-color) !important;
    font-weight: 600;
}

/* Dropdown styling */
.dropdown-menu {
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-radius: 8px;
    padding: 8px 0;
    min-width: 200px;
}

.dropdown-item {
    padding: 10px 16px;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
}

.dropdown-item i {
    width: 20px;
    margin-right: 10px;
    color: #666;
}

.dropdown-item:hover {
    background-color: rgba(138, 43, 226, 0.1);
    color: var(--primary-color);
}

/* Search bar styling umum */
.search-bar .form-control {
    border-radius: 30px !important;
    border: 1px solid #ddd;
    padding-left: 45px;
    height: 45px;
    font-size: 0.95rem;
}

.search-bar .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(138, 43, 226, 0.25);
}

.search-bar .btn-primary {
    background: var(--primary-color);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-bar .btn-primary:hover {
    background: #7a1fd1;
}

/* Small mobile optimization */
@media (max-width: 576px) {
    .navbar-brand img {
        height: 35px;
    }
    
    .header-icon {
        padding: 6px;
        min-width: 36px;
        min-height: 36px;
    }
    
    .header-icon i {
        font-size: 18px;
    }
    
    .cart-count {
        width: 16px;
        height: 16px;
        font-size: 10px;
    }
    
    .mobile-right {
        gap: 4px;
    }
}
</style>

<!-- JavaScript -->
<script>
// Update cart count secara real-time
function updateCartCount() {
    fetch('<?= base_url("/cart/count") ?>', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data && data.count !== undefined) {
            // Update desktop cart
            let cartCountEl = document.getElementById('cart-count');
            // Update mobile cart
            let cartCountMobileEl = document.getElementById('cart-count-mobile');
            
            if (data.count > 0) {
                // Desktop
                if (!cartCountEl) {
                    const cartIcon = document.querySelector('.desktop-icons .cart-icon');
                    if (cartIcon) {
                        cartCountEl = document.createElement('span');
                        cartCountEl.id = 'cart-count';
                        cartCountEl.className = 'cart-count';
                        cartIcon.appendChild(cartCountEl);
                    }
                }
                if (cartCountEl) cartCountEl.textContent = data.count;
                
                // Mobile
                if (!cartCountMobileEl) {
                    const cartIconMobile = document.querySelector('.mobile-right .cart-icon');
                    if (cartIconMobile) {
                        cartCountMobileEl = document.createElement('span');
                        cartCountMobileEl.id = 'cart-count-mobile';
                        cartCountMobileEl.className = 'cart-count';
                        cartIconMobile.appendChild(cartCountMobileEl);
                    }
                }
                if (cartCountMobileEl) cartCountMobileEl.textContent = data.count;
            } else {
                // Remove if count is 0
                if (cartCountEl) cartCountEl.remove();
                if (cartCountMobileEl) cartCountMobileEl.remove();
            }
        }
    })
    .catch(error => console.error('Error updating cart count:', error));
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    <?php if($isLoggedIn): ?>
    setTimeout(updateCartCount, 500);
    <?php endif; ?>
    
    // Auto-close mobile search when clicking outside
    document.addEventListener('click', function(e) {
        const mobileSearch = document.getElementById('mobileSearch');
        const searchToggle = document.querySelector('[data-bs-target="#mobileSearch"]');
        
        if (mobileSearch && mobileSearch.classList.contains('show') && 
            !mobileSearch.contains(e.target) && 
            !searchToggle.contains(e.target)) {
            const bsCollapse = new bootstrap.Collapse(mobileSearch);
            bsCollapse.hide();
        }
    });
    
    // Search input debounce
    const searchInputs = document.querySelectorAll('input[name="search"]');
    searchInputs.forEach(input => {
        let debounceTimer;
        input.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                // Live search functionality bisa ditambahkan di sini
                if (this.value.length >= 2) {
                    console.log('Searching for:', this.value);
                }
            }, 300);
        });
    });
});

// Listen for cart updates
document.addEventListener('cartUpdated', updateCartCount);
window.updateCart = updateCartCount;
</script>