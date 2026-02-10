<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title') ?? 'Admin Dashboard' ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #8a2be2;
            --sidebar-width: 240px;
            --header-height: 64px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fb;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* SIDEBAR */
        #sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #2d1b69 0%, #8a2be2 100%);
            color: white;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 3px 0 15px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 24px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-header h4 {
            color: white;
            margin: 0;
            font-weight: 700;
            font-size: 1.25rem;
            line-height: 1.2;
        }

        .sidebar-header p {
            color: rgba(255,255,255,0.7);
            font-size: 0.875rem;
            margin: 8px 0 0;
            line-height: 1.4;
        }

        .sidebar-menu {
            padding: 16px 0;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 2px;
        }

        .sidebar-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 2px;
        }

        .sidebar-menu a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 14px 20px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
            font-size: 0.95rem;
        }

        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: rgba(255,255,255,0.5);
        }

        .sidebar-menu a.active {
            background: rgba(255,255,255,0.15);
            color: white;
            border-left-color: #ffd700;
            font-weight: 500;
        }

        .sidebar-menu i {
            width: 22px;
            font-size: 1.1rem;
            margin-right: 12px;
            text-align: center;
        }

        .sidebar-menu .badge {
            margin-left: auto;
            background: #ff4757;
            font-size: 0.75rem;
            padding: 3px 6px;
            min-width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.1);
            flex-shrink: 0;
        }

        .sidebar-footer .btn {
            padding: 10px;
            font-size: 0.875rem;
            border-radius: 6px;
        }

        /* MAIN CONTENT */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        #header {
            background: white;
            height: var(--header-height);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: sticky;
            top: 0;
            z-index: 999; /* Increased z-index to be above sidebar */
            flex-shrink: 0;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .sidebar-toggle-btn {
            background: none;
            border: none;
            color: var(--primary-color);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            display: none; /* Hidden by default for desktop */
            margin-right: 12px;
            z-index: 1001; /* Make sure button is clickable */
            position: relative;
        }

        .sidebar-toggle-btn:hover {
            background-color: rgba(138, 43, 226, 0.1);
        }

        .page-title {
            color: #333;
            font-weight: 600;
            font-size: 1.25rem;
            margin: 0;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .notification-icon {
            position: relative;
            color: #555;
            font-size: 1.25rem;
            padding: 6px;
            cursor: pointer;
            z-index: 1001; /* Make sure it's clickable */
        }

        .notification-icon:hover {
            color: var(--primary-color);
        }

        .notification-icon .badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #ff4757;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            z-index: 1001; /* Make sure it's clickable */
        }

        .user-dropdown .dropdown-toggle {
            background: none;
            border: none;
            color: #555;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .user-dropdown .dropdown-toggle:hover {
            background-color: #f5f5f5;
        }

        .user-dropdown img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
            object-fit: cover;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 8px 0;
            min-width: 200px;
            z-index: 1002; /* Above everything */
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
            background-color: #f8f9fa;
        }

        .dropdown-divider {
            margin: 6px 0;
        }

        /* CONTENT AREA */
        .content-wrapper {
            padding: 20px;
            flex: 1;
        }

        /* FOOTER */
        #footer {
            text-align: center;
            padding: 16px 20px;
            color: #666;
            font-size: 0.875rem;
            border-top: 1px solid #eee;
            background: white;
            margin-top: auto;
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 768px) {
            :root {
                --header-height: 60px;
            }

            /* Show sidebar toggle button on mobile */
            .sidebar-toggle-btn {
                display: flex !important;
            }

            /* Sidebar on mobile */
            #sidebar {
                transform: translateX(-100%);
                width: 280px;
                box-shadow: 5px 0 25px rgba(0,0,0,0.15);
            }

            #sidebar.mobile-open {
                transform: translateX(0);
            }

            /* Overlay background when sidebar is open */
            #sidebar.mobile-open::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none; /* We'll handle this with JS */
            }

            /* Main content on mobile */
            #main-content {
                margin-left: 0 !important;
            }

            .content-wrapper {
                padding: 16px;
            }

            /* Header adjustments */
            #header {
                padding: 0 16px;
                background: white !important;
            }

            .header-right {
                gap: 12px;
            }

            .user-dropdown .dropdown-toggle span {
                display: none;
            }

            .notification-icon {
                font-size: 1.2rem;
            }
        }

        @media (min-width: 769px) and (max-width: 992px) {
            :root {
                --sidebar-width: 220px;
            }

            .sidebar-header {
                padding: 20px 12px;
            }

            .sidebar-menu a {
                padding: 12px 16px;
                font-size: 0.9rem;
            }

            .content-wrapper {
                padding: 16px;
            }
        }

        @media (max-width: 576px) {
            .content-wrapper {
                padding: 12px;
            }

            #header {
                padding: 0 12px;
            }

            .sidebar-menu a {
                padding: 12px 16px;
                font-size: 0.9rem;
            }

            .sidebar-header h4 {
                font-size: 1.1rem;
            }
        }

        /* Ensure proper spacing for content */
        .content-wrapper > :first-child {
            margin-top: 0;
        }

        .content-wrapper > :last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <!-- SIDEBAR -->
    <aside id="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-crown me-2"></i>ADMIN PANEL</h4>
            <p>Rey Beauty Fashion</p>
        </div>

        <nav class="sidebar-menu">
            <ul>
                <li>
                    <a href="<?= base_url('admin/dashboard') ?>" 
                       class="<?= strpos(current_url(), '/dashboard') !== false ? 'active' : '' ?>">
                        <i class="fas fa-tachometer-alt"></i> 
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?= base_url('admin/products') ?>">
                        <i class="fas fa-box"></i> 
                        <span>Data Produk</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?= base_url('admin/categories') ?>">
                        <i class="fas fa-tags"></i> 
                        <span>Kategori</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?= base_url('admin/orders') ?>">
                        <i class="fas fa-shopping-cart"></i> 
                        <span>Data Order</span>
                        <span class="badge">5</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?= base_url('admin/users') ?>">
                        <i class="fas fa-users"></i> 
                        <span>Users</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?= base_url('admin/articles') ?>">
                        <i class="fas fa-newspaper"></i> 
                        <span>Artikel</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?= base_url('admin/menu') ?>">
                        <i class="fas fa-bars"></i> 
                        <span>Menu</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?= base_url('admin/reports') ?>">
                        <i class="fas fa-chart-bar"></i> 
                        <span>Laporan Penjualan</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?= base_url('admin/settings') ?>">
                        <i class="fas fa-cog"></i> 
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <a href="<?= base_url('/') ?>" class="btn btn-outline-light w-100" target="_blank">
                <i class="fas fa-external-link-alt me-2"></i> Home
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main id="main-content">
        <!-- HEADER -->
        <header id="header">
            <div class="header-left">
                <button class="sidebar-toggle-btn" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="page-title">
                    <?= $this->renderSection('title') ?? 'Admin Dashboard' ?>
                </div>
            </div>

            <div class="header-right">
                <a href="#" class="notification-icon">
                    <i class="fas fa-bell"></i>
                    <span class="badge">3</span>
                </a>

                <div class="dropdown user-dropdown">
                    <button class="dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('userName') ?? 'Admin') ?>&background=8a2be2&color=fff&size=128" 
                             alt="<?= session()->get('userName') ?? 'Admin' ?>">
                        <span><?= session()->get('userName') ?? 'Admin' ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="<?= base_url('/profile') ?>">
                                <i class="fas fa-user me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= base_url('admin/settings') ?>">
                                <i class="fas fa-cog me-2"></i> Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="<?= base_url('/logout') ?>">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <div class="content-wrapper">
            <?= $this->renderSection('content') ?>
        </div>

        <!-- FOOTER -->
        <footer id="footer">
            <p>&copy; <?= date('Y') ?> Rey Beauty Fashion Admin Panel. All rights reserved.</p>
        </footer>
    </main>

    <!-- SCRIPTS -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            const sidebar = $('#sidebar');
            const sidebarToggle = $('#sidebarToggle');
            let overlay = null;

            // Function to check if mobile
            function isMobile() {
                return window.innerWidth < 768;
            }

            // Function to create overlay
            function createOverlay() {
                if (!overlay) {
                    overlay = $('<div class="sidebar-overlay"></div>');
                    overlay.css({
                        'position': 'fixed',
                        'top': '0',
                        'left': '0',
                        'right': '0',
                        'bottom': '0',
                        'background': 'rgba(0, 0, 0, 0.5)',
                        'z-index': '998',
                        'display': 'none'
                    });
                    $('body').append(overlay);
                    
                    // Close sidebar when clicking overlay
                    overlay.on('click', function() {
                        closeSidebar();
                    });
                }
                return overlay;
            }

            // Function to open sidebar
            function openSidebar() {
                if (!isMobile()) return;
                
                sidebar.addClass('mobile-open');
                const overlay = createOverlay();
                overlay.fadeIn(200);
                $('body').css('overflow', 'hidden');
            }

            // Function to close sidebar
            function closeSidebar() {
                sidebar.removeClass('mobile-open');
                if (overlay) {
                    overlay.fadeOut(200, function() {
                        $(this).remove();
                        overlay = null;
                    });
                }
                $('body').css('overflow', '');
            }

            // Function to toggle sidebar
            function toggleSidebar() {
                if (!isMobile()) return;
                
                if (sidebar.hasClass('mobile-open')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            }

            // Sidebar toggle functionality
            sidebarToggle.on('click', function(e) {
                e.stopPropagation(); // Prevent event bubbling
                toggleSidebar();
            });

            // Close sidebar when clicking on a menu item (mobile)
            $('.sidebar-menu a').on('click', function() {
                if (isMobile()) {
                    setTimeout(closeSidebar, 300);
                }
            });

            // Set active menu based on current URL
            const currentPath = window.location.pathname;
            $('.sidebar-menu a').each(function() {
                const href = $(this).attr('href');
                if (href && currentPath.includes(href.replace(/\/$/, '')) && href !== '/admin') {
                    $(this).addClass('active');
                }
            });

            // Handle window resize
            $(window).on('resize', function() {
                // Close sidebar if resizing from mobile to desktop
                if (!isMobile() && sidebar.hasClass('mobile-open')) {
                    closeSidebar();
                }
                
                // Update toggle button visibility
                if (isMobile()) {
                    sidebarToggle.show();
                } else {
                    sidebarToggle.hide();
                    closeSidebar();
                }
            });

            // Keyboard support (ESC to close sidebar)
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && sidebar.hasClass('mobile-open')) {
                    closeSidebar();
                }
            });

            // Initial setup
            if (isMobile()) {
                sidebarToggle.show();
            } else {
                sidebarToggle.hide();
            }

            // Prevent body scrolling when sidebar is open
            $(document).on('touchmove', function(e) {
                if (sidebar.hasClass('mobile-open')) {
                    e.preventDefault();
                }
            });
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>