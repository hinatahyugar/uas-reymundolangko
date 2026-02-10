<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>404 Page Not Found</title>
    <style>
        :root {
            --primary-color: #8a2be2;
            --bg-color: #f8f9fa;
            --text-color: #333;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .error-container {
            text-align: center;
            max-width: 600px;
            padding: 2rem;
        }
        
        .error-code {
            font-size: 8rem;
            font-weight: 900;
            color: var(--primary-color);
            line-height: 1;
            margin-bottom: 1rem;
        }
        
        .error-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--text-color);
        }
        
        .error-message {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 2rem;
            background: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            border-left: 4px solid var(--primary-color);
            text-align: left;
        }
        
        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s;
            border: 2px solid var(--primary-color);
        }
        
        .btn:hover {
            background: #7a1fd1;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(138, 43, 226, 0.2);
        }
        
        .btn-outline {
            background: transparent;
            color: var(--primary-color);
        }
        
        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
        }
        
        .error-details {
            margin-top: 2rem;
            padding: 1rem;
            background: #fff;
            border-radius: 5px;
            font-family: monospace;
            font-size: 0.9rem;
            text-align: left;
            display: none;
        }
        
        .show-details {
            margin-top: 1rem;
            background: none;
            border: none;
            color: var(--primary-color);
            cursor: pointer;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .error-code {
                font-size: 6rem;
            }
            
            .error-title {
                font-size: 1.5rem;
            }
            
            .error-actions {
                flex-direction: column;
            }
            
            .btn {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        
        <h1 class="error-title">Halaman Tidak Ditemukan</h1>
        
        <div class="error-message">
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?php 
                $message = isset($exception) ? $exception->getMessage() : 'Halaman yang Anda cari tidak ditemukan.';
                ?>
                <strong>Error Message:</strong><br>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                <p>Maaf, halaman yang Anda cari tidak dapat ditemukan.</p>
                <p>Silakan periksa URL atau kembali ke halaman utama.</p>
            <?php endif; ?>
        </div>
        
        <div class="error-actions">
            <a href="<?= base_url('/') ?>" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                </svg>
                Kembali ke Home
            </a>
            
            <a href="javascript:history.back()" class="btn btn-outline">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Kembali ke Halaman Sebelumnya
            </a>
            
            <?php if (session()->get('isLoggedIn') && session()->get('userRole') === 'admin') : ?>
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                </svg>
                Admin Dashboard
            </a>
            <?php endif; ?>
        </div>
        
        <?php if (ENVIRONMENT !== 'production' && isset($exception)) : ?>
        <button class="show-details" onclick="toggleDetails()">
            Tampilkan Detail Error
        </button>
        
        <div class="error-details" id="errorDetails">
            <p><strong>File:</strong> <?= esc($exception->getFile()) ?>:<?= $exception->getLine() ?></p>
            <p><strong>Backtrace:</strong></p>
            <pre><?= esc($exception->getTraceAsString()) ?></pre>
            
            <p><strong>Request:</strong></p>
            <pre><?= esc(var_export($_REQUEST, true)) ?></pre>
            
            <p><strong>Session:</strong></p>
            <pre><?= esc(var_export(session()->get(), true)) ?></pre>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>