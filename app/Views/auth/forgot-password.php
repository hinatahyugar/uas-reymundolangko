<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Forgot Password' ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #8a2be2;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(rgba(138, 43, 226, 0.05), rgba(138, 43, 226, 0.1));
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .forgot-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            max-width: 450px;
            margin: 0 auto;
        }

        .forgot-header {
            background: var(--primary-color);
            color: white;
            padding: 25px;
            text-align: center;
        }

        .forgot-header h3 {
            margin: 0;
            font-weight: 700;
        }

        .forgot-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(138, 43, 226, 0.25);
        }

        .btn-reset {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: background 0.3s;
        }

        .btn-reset:hover {
            background: #7a1fd1;
        }

        .forgot-footer {
            text-align: center;
            padding-top: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="forgot-card">
            <!-- Header -->
            <div class="forgot-header">
                <h3><i class="fas fa-key me-2"></i> RESET PASSWORD</h3>
                <p class="mb-0 mt-2">Masukkan email Anda</p>
            </div>

            <!-- Body -->
            <div class="forgot-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Kami akan mengirimkan link reset password ke email Anda.
                </div>

                <form action="<?= base_url('/reset-password') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-reset mb-3">
                        <i class="fas fa-paper-plane me-2"></i> KIRIM LINK RESET
                    </button>
                </form>

                <div class="forgot-footer">
                    <p class="mb-0">
                        <a href="<?= base_url('/login') ?>" class="text-primary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>