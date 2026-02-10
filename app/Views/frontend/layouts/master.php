<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title') ?? 'Beauty Fashion Shop' ?></title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS Kustom (INLINE/EMBEDDED - sesuai aturan) -->
    <style>
        :root {
            --primary-color: #8a2be2; /* UNGU sebagai warna utama */
            --secondary-color: #f8f9fa;
            --text-dark: #333;
            --text-light: #666;
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: var(--text-dark);
            background-color: #fefefe;
        }

        /* HEADER */
        .main-header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-dark {
            height: 70px;
        }

        .top-bar {
            background: var(--primary-color);
            color: white;
            font-size: 0.9rem;
            padding: 8px 0;
        }

        .top-bar a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        .search-bar {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
        }

        .search-bar input {
            border-radius: 30px;
            padding-left: 45px;
            border: 1px solid #ddd;
            height: 45px;
        }

        .search-bar button {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--primary-color);
        }

        .nav-menu a {
            color: var(--text-dark);
            font-weight: 500;
            padding: 10px 15px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .nav-menu a:hover {
            color: var(--primary-color);
        }

        .cart-icon {
            position: relative;
            font-size: 1.5rem;
            color: var(--text-dark);
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }



        .btn-primary-custom {
            background: white;
            color: var(--primary-color);
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            background: var(--primary-color);
            color: white;
            box-shadow: 0 5px 15px rgba(138, 43, 226, 0.3);
        }

        /* PRODUK GRID */
        .product-card {
            border: 1px solid #eee;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 25px;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }

        .product-img {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        .product-body {
            padding: 20px;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .product-price {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.3rem;
        }

        .product-price-old {
            color: var(--text-light);
            text-decoration: line-through;
            margin-left: 10px;
            font-size: 0.9rem;
        }

        .btn-add-cart {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            width: 100%;
            font-weight: 500;
            transition: background 0.3s;
        }

        .btn-add-cart:hover {
            background: #7a1fd1;
        }

        /* FOOTER */
        .main-footer {
            background: #222;
            color: #ccc;
            padding: 50px 0 20px;
            margin-top: 60px;
        }

        .footer-title {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .footer-links a {
            color: #aaa;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }

        .copyright {
            border-top: 1px solid #444;
            padding-top: 20px;
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: #888;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
          
            .logo-dark {
                height: 50px;
            }
        }

        
/* FEATURED PRODUCT CARD */
.featured-product-card {
    height: 200px;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.featured-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(138, 43, 226, 0.15);
}

.product-thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.featured-product-card:hover .product-thumb {
    transform: scale(1.05);
}

.product-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    padding: 20px;
    color: white;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}

.featured-product-card:hover .product-overlay {
    transform: translateY(0);
}

.product-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    z-index: 2;
}

/* KATEGORI ICON BERDASARKAN NAMA */
.category-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    background: linear-gradient(135deg, var(--primary-color), #7a1fd1);
    color: white;
    font-size: 2rem;
    transition: all 0.3s ease;
}

.category-icon.batik {
    background: linear-gradient(135deg, #8a2be2, #6a1fb9);
}
.category-icon.fashion {
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
}
.category-icon.accessories {
    background: linear-gradient(135deg, #4ecdc4, #44a08d);
}
.category-icon.shoes {
    background: linear-gradient(135deg, #ffe66d, #f9c74f);
}
.category-icon.bags {
    background: linear-gradient(135deg, #9d4edd, #7b2cbf);
}

.category-card:hover .category-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 10px 20px rgba(138, 43, 226, 0.3);
}

/* PRODUK CARD SERAGAM */
.product-card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    background: white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(138, 43, 226, 0.15);
}

.product-img-wrapper {
    height: 250px;
    overflow: hidden;
    position: relative;
}

.product-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card:hover .product-img {
    transform: scale(1.05);
}

.product-body {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.product-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: var(--text-dark);
    line-height: 1.4;
    min-height: 44px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-price-container {
    margin-top: auto;
}

.product-price {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.3rem;
    display: block;
}

.product-price-old {
    color: #999;
    text-decoration: line-through;
    font-size: 0.9rem;
    margin-left: 5px;
}

.discount-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: linear-gradient(135deg, #ff4757, #ff3838);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    z-index: 2;
}

.btn-add-cart {
    background: linear-gradient(135deg, var(--primary-color), #7a1fd1);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 12px;
    width: 100%;
    font-weight: 600;
    transition: all 0.3s ease;
    margin-top: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-add-cart:hover {
    background: linear-gradient(135deg, #7a1fd1, #6a1fb9);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(138, 43, 226, 0.3);
}

/* GRID RESPONSIVE */
.row.equal-height {
    display: flex;
    flex-wrap: wrap;
}

.row.equal-height > .col-lg-3 {
    display: flex;
    flex-direction: column;
}
    </style>

    <?= $this->renderSection('styles') ?>
</head>
<body>
    <!-- TOP BAR -->
    <div class="top-bar d-none d-md-block">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div>
                    <i class="fas fa-phone me-2"></i> Hubungi: (082) 2661-58487
                    <a href="#"><i class="fas fa-envelope ms-3 me-2"></i> reyylangko@gmail.com</a>
                </div>
                <div>
                    <a href="https://www.instagram.com/hyugaa_r?igsh=cGoycDR4cmExZ2Zo&utm_source=qr" target="_blank">
                        <i class="fab fa-instagram me-2"></i>
                    </a>

                    <a href="https://www.tiktok.com/@hyugaa_r?_r=1&_t=ZS-93luPKzleks" target="_blank">
                        <i class="fab fa-tiktok me-2"></i>
                    </a>

                    <a href="https://wa.me/6282266158487" target="_blank">
                        <i class="fab fa-whatsapp me-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- HEADER -->
    <?= $this->include('frontend/layouts/header') ?>

    

    <!-- CONTENT -->
    <div id="page">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- FOOTER -->
    <?= $this->include('frontend/layouts/footer') ?>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Cart update simulation
        $(document).ready(function() {
            $('.btn-add-cart').click(function() {
                let count = parseInt($('#cart-count').text()) || 0;
                $('#cart-count').text(count + 1);
                alert('Produk ditambahkan ke keranjang!');
            });
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>