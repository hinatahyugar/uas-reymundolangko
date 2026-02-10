<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
/* ARTICLE DETAIL STYLES */
.article-detail-page {
    padding: 2rem 0;
}

.article-breadcrumb {
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
}

.breadcrumb-list {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.breadcrumb-item {
    color: #666;
}

.breadcrumb-item a {
    color: #666;
    text-decoration: none;
    transition: color 0.2s;
}

.breadcrumb-item a:hover {
    color: var(--primary-color);
}

.breadcrumb-separator {
    margin: 0 0.5rem;
    color: #999;
}

/* Article Layout */
.article-detail-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 2rem;
}

/* Article Header */
.article-header {
    margin-bottom: 2rem;
}

.article-category-badge {
    display: inline-block;
    background: var(--primary-color);
    color: white;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    margin-bottom: 1rem;
}

.article-title {
    font-size: 1.8rem;
    font-weight: 700;
    line-height: 1.4;
    color: #333;
    margin-bottom: 1rem;
}

.article-meta {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    color: #666;
    font-size: 0.9rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.meta-item i {
    color: var(--primary-color);
}

/* Article Image */
.article-featured-image {
    margin-bottom: 2rem;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.article-featured-image img {
    width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: cover;
    display: block;
}

/* Article Content */
.article-content {
    line-height: 1.8;
    color: #444;
    margin-bottom: 2rem;
}

.article-content p {
    margin-bottom: 1.5rem;
    font-size: 1rem;
}

.article-content h2,
.article-content h3 {
    color: #333;
    margin: 2rem 0 1rem;
    font-weight: 600;
}

.article-content h2 {
    font-size: 1.5rem;
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 0.5rem;
}

.article-content h3 {
    font-size: 1.25rem;
}

.article-content ul,
.article-content ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.article-content li {
    margin-bottom: 0.5rem;
}

.article-content blockquote {
    border-left: 4px solid var(--primary-color);
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: #555;
    background: #f9f9f9;
    padding: 1.5rem;
    border-radius: 0 8px 8px 0;
}

/* Article Actions */
.article-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 0;
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    margin: 2rem 0;
}

.like-section {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.btn-like {
    background: white;
    border: 2px solid #ddd;
    color: #666;
    padding: 0.5rem 1.5rem;
    border-radius: 30px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-like:hover {
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.btn-like.liked {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

.share-section {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.share-title {
    font-size: 0.9rem;
    color: #666;
}

.share-buttons {
    display: flex;
    gap: 0.5rem;
}

.share-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: transform 0.2s;
}

.share-btn:hover {
    transform: translateY(-2px);
}

.share-btn.facebook { background: #3b5998; }
.share-btn.twitter { background: #1da1f2; }
.share-btn.whatsapp { background: #25d366; }

/* Related Articles */
.related-section {
    margin-top: 3rem;
}

.section-title {
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: #333;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
}

.related-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid #eee;
}

.related-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.related-image {
    height: 160px;
    overflow: hidden;
}

.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.related-card:hover .related-image img {
    transform: scale(1.05);
}

.related-body {
    padding: 1.25rem;
}

.related-title {
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.4;
    margin-bottom: 0.5rem;
}

.related-title a {
    color: #333;
    text-decoration: none;
    transition: color 0.2s;
}

.related-title a:hover {
    color: var(--primary-color);
}

.related-date {
    font-size: 0.85rem;
    color: #888;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Sidebar (reuse from index) */
.article-sidebar {
    position: sticky;
    top: 20px;
    height: fit-content;
}

/* Responsive */
@media (max-width: 992px) {
    .article-detail-layout {
        grid-template-columns: 1fr;
    }
    
    .article-sidebar {
        position: static;
        order: -1;
    }
}

@media (max-width: 768px) {
    .article-title {
        font-size: 1.5rem;
    }
    
    .article-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }
    
    .article-actions {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
    }
    
    .article-featured-image img {
        max-height: 300px;
    }
}

@media (max-width: 576px) {
    .article-detail-page {
        padding: 1.5rem 0;
    }
    
    .article-title {
        font-size: 1.3rem;
    }
    
    .article-content p {
        font-size: 0.95rem;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container article-detail-page">
    <!-- Breadcrumb -->
    <nav class="article-breadcrumb" aria-label="breadcrumb">
        <ul class="breadcrumb-list">
            <li class="breadcrumb-item">
                <a href="<?= base_url('/') ?>"><i class="fas fa-home me-1"></i> Home</a>
            </li>
            <li class="breadcrumb-separator">/</li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('/articles') ?>">Artikel</a>
            </li>
            <li class="breadcrumb-separator">/</li>
            <li class="breadcrumb-item">
                <?= $article['category_name'] ?>
            </li>
        </ul>
    </nav>

    <div class="article-detail-layout">
        <!-- Main Article -->
        <main class="article-main">
            <!-- Article Header -->
            <header class="article-header">
                <span class="article-category-badge">
                    <?= $article['category_name'] ?>
                </span>
                <h1 class="article-title"><?= esc($article['title']) ?></h1>
                
                <div class="article-meta">
                    <div class="meta-item">
                        <i class="fas fa-user"></i>
                        <span><?= $article['author_name'] ?? 'Admin' ?></span>
                    </div>
                    <div class="meta-item">
                        <i class="far fa-calendar"></i>
                        <span><?= date('d F Y', strtotime($article['created_at'])) ?></span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-eye"></i>
                        <span>1.2k dilihat</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        <span>5 min read</span>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            <?php if($article['image']): ?>
            <div class="article-featured-image">
                <?php
                $imagePath = 'uploads/articles/' . $article['image'];
                $imageExists = !empty($article['image']) && file_exists(FCPATH . $imagePath);
                $imageUrl = $imageExists ? base_url($imagePath) : 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
                ?>
                <img src="<?= $imageUrl ?>" alt="<?= esc($article['title']) ?>">
            </div>
            <?php endif; ?>

            <!-- Article Content -->
            <div class="article-content">
                <?= nl2br(esc($article['content'])) ?>
            </div>

            <!-- Article Actions -->
            <div class="article-actions">
                <div class="like-section">
                    <button class="btn-like" onclick="toggleLike(<?= $article['id'] ?>)">
                        <i class="far fa-heart"></i>
                        <span>Suka</span>
                        <span id="likeCount"><?= $article['like_count'] ?></span>
                    </button>
                </div>
                
                <div class="share-section">
                    <span class="share-title">Bagikan:</span>
                    <div class="share-buttons">
                        <a href="#" class="share-btn facebook" onclick="shareFacebook()">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="share-btn twitter" onclick="shareTwitter()">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="share-btn whatsapp" onclick="shareWhatsApp()">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            <?php if(!empty($related)): ?>
            <section class="related-section">
                <h2 class="section-title">Artikel Terkait</h2>
                <div class="related-grid">
                    <?php foreach($related as $rel): ?>
                    <article class="related-card">
                        <div class="related-image">
                            <?php
                            $relImagePath = 'uploads/articles/' . $rel['image'];
                            $relImageExists = !empty($rel['image']) && file_exists(FCPATH . $relImagePath);
                            $relImageUrl = $relImageExists ? base_url($relImagePath) : 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80';
                            ?>
                            <img src="<?= $relImageUrl ?>" alt="<?= esc($rel['title']) ?>">
                        </div>
                        <div class="related-body">
                            <h3 class="related-title">
                                <a href="<?= base_url('/articles/' . $rel['slug']) ?>">
                                    <?= esc($rel['title']) ?>
                                </a>
                            </h3>
                            <div class="related-date">
                                <i class="far fa-calendar"></i>
                                <?= date('d M Y', strtotime($rel['created_at'])) ?>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
        </main>
        
        <!-- Sidebar -->
        <aside class="article-sidebar">
            <!-- Popular Articles -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">Artikel Populer</h3>
                <ul class="popular-list">
                    <?php foreach($popular as $pop): ?>
                    <li class="popular-item">
                        <a href="<?= base_url('/articles/' . $pop['slug']) ?>" class="popular-link">
                            <?= esc($pop['title']) ?>
                        </a>
                        <div class="popular-meta">
                            <span><i class="far fa-calendar"></i> <?= date('d M', strtotime($pop['created_at'])) ?></span>
                            <span><i class="fas fa-heart"></i> <?= $pop['like_count'] ?></span>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Categories -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">Kategori</h3>
                <ul class="category-list">
                    <?php 
                    // Get all categories (simplified - bisa di-pass dari controller)
                    $categories = (new \App\Models\CategoryModel())->findAll();
                    foreach($categories as $cat): 
                    ?>
                    <li class="category-item">
                        <a href="<?= base_url('/categories/' . $cat['slug']) ?>" class="category-link">
                            <span><?= $cat['name'] ?></span>
                            <span class="category-count"><?= rand(3, 12) ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Newsletter -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">Tips & Update</h3>
                <p style="font-size: 0.9rem; color: #666; margin-bottom: 1rem;">
                    Dapatkan tips fashion eksklusif dan update produk terbaru.
                </p>
                <form class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="Email Anda" required>
                    <button type="submit" class="newsletter-btn">
                        <i class="fas fa-paper-plane me-2"></i> Subscribe
                    </button>
                </form>
            </div>
        </aside>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Like functionality
function toggleLike(articleId) {
    const button = document.querySelector('.btn-like');
    const likeCount = document.getElementById('likeCount');
    const currentCount = parseInt(likeCount.textContent);
    
    if (button.classList.contains('liked')) {
        // Unlike
        button.classList.remove('liked');
        button.innerHTML = '<i class="far fa-heart"></i><span>Suka</span><span id="likeCount">' + (currentCount - 1) + '</span>';
    } else {
        // Like
        button.classList.add('liked');
        button.innerHTML = '<i class="fas fa-heart"></i><span>Suka</span><span id="likeCount">' + (currentCount + 1) + '</span>';
    }
}

// Share functionality
function shareFacebook() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
}

function shareTwitter() {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent(document.title);
    window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank');
}

function shareWhatsApp() {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent(document.title);
    window.open(`https://wa.me/?text=${text}%20${url}`, '_blank');
}

// Newsletter subscription
document.querySelector('.newsletter-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.querySelector('.newsletter-input').value;
    
    if (!email) {
        showNotification('Masukkan email Anda', 'warning');
        return;
    }
    
    // Simulasi subscription
    showNotification('Terima kasih! Anda telah berlangganan newsletter kami.', 'success');
    this.querySelector('.newsletter-input').value = '';
});

// Helper function for notifications
function showNotification(message, type) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-warning';
    
    const notification = document.createElement('div');
    notification.className = `alert ${alertClass} alert-dismissible fade show`;
    notification.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}
</script>
<?= $this->endSection() ?>