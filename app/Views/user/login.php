<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
</head>

<body class="auth-page">
    <div id="login-wrapper">
        <h1>Sign In</h1>
        
        <?php if (session()->getFlashdata('flash_msg')): ?>
            <div class="alert alert-error is-visible">
                <?= session()->getFlashdata('flash_msg') ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="InputForEmail">Email Address</label>
                <input type="email" name="email" id="InputForEmail" 
                       value="<?= set_value('email') ?>" 
                       placeholder="name@example.com">
            </div>

            <div class="form-group">
                <label for="InputForPassword">Password</label>
                <input type="password" name="password" id="InputForPassword" 
                       placeholder="••••••••">
            </div>

            <button type="submit" class="btn btn-default w-100">Login to Dashboard</button>
        </form>

        <div class="divider"></div>

        <p class="text-sm text-muted">
            Belum memiliki akun? 
            <a href="<?= base_url('user/register') ?>" class="text-accent">Daftar sekarang</a>
        </p>
    </div>
</body>
</html>