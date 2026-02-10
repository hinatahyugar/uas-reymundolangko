<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Login' ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #8a2be2;
            --secondary-color: #f8f9fa;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(rgba(138, 43, 226, 0.05), rgba(138, 43, 226, 0.1));
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            max-width: 450px;
            margin: 0 auto;
        }

        .login-header {
            background: var(--primary-color);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .login-header h3 {
            margin: 0;
            font-weight: 700;
        }

        .login-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(138, 43, 226, 0.25);
        }

        .btn-login {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background: #7a1fd1;
        }

        .btn-google {
            background: #db4437;
            color: white;
            border-radius: 8px;
            padding: 12px;
            width: 100%;
            margin-bottom: 15px;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #eee;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            color: #666;
        }

        .login-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eee;
            margin-top: 20px;
        }

        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <h3><i class="fas fa-lock me-2"></i> LOGIN</h3>
                <p class="mb-0 mt-2">Masuk ke akun Anda</p>
            </div>

            <!-- Body -->
            <div class="login-body">
                <!-- Pesan Error/Success -->
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <!-- Google Login Button (sesuai PDF) -->
                <div class="text-center mb-4">
                    <a href="#" class="btn btn-google">
                        <i class="fab fa-google me-2"></i> Login with Google
                    </a>
                </div>

                <div class="divider">
                    <span>ATAU</span>
                </div>

                <!-- Form Login -->
                <form action="<?= base_url('/do-login') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <?php if(isset($validation) && $validation->hasError('email')): ?>
                            <div class="text-danger small"><?= $validation->getError('email') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <?php if(isset($validation) && $validation->hasError('password')): ?>
                            <div class="text-danger small"><?= $validation->getError('password') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                        <a href="<?= base_url('/forgot-password') ?>" class="float-end">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn btn-login mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i> LOGIN
                    </button>
                </form>

                <div class="login-footer">
                    <p class="mb-0">Belum punya akun? 
                        <a href="<?= base_url('/register') ?>" class="text-primary fw-bold">Daftar disini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>