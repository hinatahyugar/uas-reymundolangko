<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Register' ?></title>

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

        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            max-width: 500px;
            margin: 0 auto;
        }

        .register-header {
            background: var(--primary-color);
            color: white;
            padding: 25px;
            text-align: center;
        }

        .register-header h3 {
            margin: 0;
            font-weight: 700;
        }

        .register-body {
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

        .btn-register {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: background 0.3s;
        }

        .btn-register:hover {
            background: #7a1fd1;
        }

        .register-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eee;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-card">
            <!-- Header -->
            <div class="register-header">
                <h3><i class="fas fa-user-plus me-2"></i> REGISTER</h3>
                <p class="mb-0 mt-2">Buat akun baru</p>
            </div>

            <!-- Body -->
            <div class="register-body">
                <!-- Pesan Error -->
                <?php if(session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Form Register -->
                <form action="<?= base_url('/do-register') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" name="name" class="form-control" placeholder="Nama lengkap" 
                                   value="<?= old('name') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="Email" 
                                   value="<?= old('email') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" name="password_confirmation" class="form-control" 
                                   placeholder="Ulangi password" required>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">
                            Saya setuju dengan <a href="#" class="text-primary">Syarat & Ketentuan</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-register mb-3">
                        <i class="fas fa-user-plus me-2"></i> DAFTAR
                    </button>
                </form>

                <div class="register-footer">
                    <p class="mb-0">Sudah punya akun? 
                        <a href="<?= base_url('/login') ?>" class="text-primary fw-bold">Login disini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>