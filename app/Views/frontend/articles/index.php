<?= $this->extend('frontend/layouts/master') ?>

<?= $this->section('title') ?>
<?= $title ?> - Beauty Fashion Shop
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
/* ARTICLES PAGE STYLES */
.articles-page {
    padding: 2rem 0;
}

.page-header {
    margin-bottom: 2.5rem;
}

.page-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
}

.page-description {
    color: #666;
    font-size: 0.95rem;
    max-width: 700px;
}

/* Main Layout */
.articles-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 2rem;
}

/* Articles Grid */
.articles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.article-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid #eee;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
}

.article-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(138, 43, 226, 0.1);
    border-color: var(--primary-color);
}

.article-image {
    height: 180px;
    overflow: hidden;
    position: relative;
}

.article-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.article-card:hover .article-image img {
    transform: scale(1.05);
}

.article-category {
    position: absolute;
    top: 12px;
    left: 12px;
    background: var(--primary-color);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
    z-index: 2;
}

.article-body {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.article-date {
    font-size: 0.8rem;
    color: #888;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.article-title {
    font-size: 1.1rem;
    font-weight: 600;
    line-height: 1.4;
    margin-bottom: 0.75rem;
}

.article-title a {
    color: #333;
    text-decoration: none;
    transition: color 0.2s;
}

.article-title a:hover {
    color: var(--primary-color);
}

.article-excerpt {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.article-meta {
    margin-top: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.article-author {
    font-size: 0.85rem;
    color: #666;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.article-author i {
    color: var(--primary-color);
}

.article-stats {
    display: flex;
    gap: 1rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.8rem;
    color: #888;
}

.stat-item i {
    font-size: 0.9rem;
}

/* Sidebar */
.articles-sidebar {
    position: sticky;
    top: 20px;
    height: fit-content;
}

.sidebar-section {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #eee;
}

.sidebar-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #333;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--primary-color);
}

/* Categories */
.category-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.category-item {
    margin-bottom: 0.75rem;
}

.category-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #555;
    text-decoration: none;
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    transition: all 0.2s;
}

.category-link:hover {
    background: #f8f9fa;
    color: var(--primary-color);
    padding-left: 1rem;
}

.category-count {
    background: #f0f0f0;
    color: #666;
    padding: 0.2rem 0.6rem;
    border-radius: 12px;
    font-size: 0.8rem;
}

/* Popular Articles */
.popular-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.popular-item {
    padding: 0.75rem 0;
    border-bottom: 1px solid #eee;
}

.popular-item:last-child {
    border-bottom: none;
}

.popular-link {
    display: block;
    text-decoration: none;
    color: #333;
    font-weight: 500;
    font-size: 0.9rem;
    line-height: 1.4;
    transition: color 0.2s;
}

.popular-link:hover {
    color: var(--primary-color);
}

.popular-meta {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-top: 0.5rem;
    font-size: 0.8rem;
    color: #888;
}

/* Newsletter */
.newsletter-form {
    margin-top: 1rem;
}

.newsletter-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
}

.newsletter-btn {
    width: 100%;
    padding: 0.75rem;
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s;
}

.newsletter-btn:hover {
    background: #7a1fd1;
}

/* Empty State */
.empty-articles {
    text-align: center;
    padding: 3rem 1rem;
    background: #f8f9fa;
    border-radius: 12px;
    grid-column: 1 / -1;
}

.empty-icon {
    font-size: 3rem;
    color: #ddd;
    margin-bottom: 1rem;
}

.empty-title {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.empty-text {
    color: #888;
    margin-bottom: 1.5rem;
}

/* Pagination */
.articles-pagination {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.pagination-list {
    display: flex;
    gap: 0.5rem;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border: 1px solid #ddd;
    border-radius: 8px;
    color: #555;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.2s;
}

.pagination-link:hover {
    background: #f8f9fa;
    border-color: #ccc;
}

.pagination-link.active {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

/* Responsive */
@media (max-width: 992px) {
    .articles-layout {
        grid-template-columns: 1fr;
    }
    
    .articles-sidebar {
        position: static;
    }
    
    .articles-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
}

@media (max-width: 768px) {
    .articles-grid {
        grid-template-columns: 1fr;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .article-image {
        height: 160px;
    }
}

@media (max-width: 576px) {
    .articles-page {
        padding: 1.5rem 0;
    }
    
    .article-body {
        padding: 1.25rem;
    }
    
    .article-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }
    
    .article-stats {
        width: 100%;
        justify-content: space-between;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container articles-page">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Artikel & Tips Fashion</h1>
        <p class="page-description">
            Temukan inspirasi gaya, tips fashion terbaru, dan artikel menarik seputar batik dan fashion 
            dari Beauty Fashion Shop Kupang. Tingkatkan penampilan Anda dengan tips dari ahli kami.
        </p>
    </div>

    <div class="articles-layout">
        <!-- Main Content -->
        <main class="articles-main">
            <?php if(empty($articles)): ?>
                <div class="empty-articles">
                    <div class="empty-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h3 class="empty-title">Belum ada artikel</h3>
                    <p class="empty-text">Artikel akan segera tersedia.</p>
                </div>
            <?php else: ?>
                <div class="articles-grid">
                    <?php foreach($articles as $article): ?>
                    <article class="article-card">
                        <div class="article-image">
                            <?php
                            // Cek apakah gambar artikel ada
                            $imagePath = 'uploads/articles/' . $article['image'];
                            $imageExists = !empty($article['image']) && file_exists(FCPATH . $imagePath);
                            $imageUrl = $imageExists ? base_url($imagePath) : 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80';
                            ?>
                            <img src="<?= $imageUrl ?>" alt="<?= esc($article['title']) ?>">
                            <div class="article-category">
                                <?= $article['category_name'] ?? 'Uncategorized' ?>
                            </div>
                        </div>
                        
                        <div class="article-body">
                            <div class="article-date">
                                <i class="far fa-calendar"></i>
                                <?= date('d M Y', strtotime($article['created_at'])) ?>
                            </div>
                            
                            <h2 class="article-title">
                                <a href="<?= base_url('/articles/' . $article['slug']) ?>">
                                    <?= esc($article['title']) ?>
                                </a>
                            </h2>
                            
                            <p class="article-excerpt">
                                <?php
                                // Buat excerpt dari konten
                                $content = strip_tags($article['content']);
                                $excerpt = strlen($content) > 120 ? substr($content, 0, 120) . '...' : $content;
                                echo esc($excerpt);
                                ?>
                            </p>
                            
                            <div class="article-meta">
                                <div class="article-author">
                                    <i class="fas fa-user"></i>
                                    <?= $article['author_name'] ?? 'Admin' ?>
                                </div>
                                
                                <div class="article-stats">
                                    <span class="stat-item">
                                        <i class="fas fa-heart"></i>
                                        <?= $article['like_count'] ?>
                                    </span>
                                    <span class="stat-item">
                                        <i class="fas fa-comment"></i>
                                        <?= $article['comment_count'] ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination -->
                <?php if($pager): ?>
                <div class="articles-pagination">
                    <?= $pager->links() ?>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </main>
        
        <!-- Sidebar -->
        <aside class="articles-sidebar">
            <!-- Categories -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">Kategori Artikel</h3>
                <ul class="category-list">
                    <?php foreach($categories as $cat): ?>
                    <li class="category-item">
                        <a href="<?= base_url('/categories/' . $cat['slug']) ?>" class="category-link">
                            <span><?= $cat['name'] ?></span>
                            <span class="category-count">
                                <?php
                                // Hitung jumlah artikel per kategori (bisa dioptimasi di controller)
                                $articleCount = count(array_filter($articles, function($art) use ($cat) {
                                    return $art['category_id'] == $cat['id'];
                                }));
                                echo $articleCount;
                                ?>
                            </span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
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
            
            <!-- Newsletter -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">Berlangganan</h3>
                <p style="font-size: 0.9rem; color: #666; margin-bottom: 1rem;">
                    Dapatkan artikel terbaru langsung ke email Anda.
                </p>
                <form class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="Email Anda" required>
                    <button type="submit" class="newsletter-btn">
                        <i class="fas fa-paper-plane me-2"></i> Berlangganan
                    </button>
                </form>
            </div>
        </aside>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
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