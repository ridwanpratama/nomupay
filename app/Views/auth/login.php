<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login | Nomupay</title>
    <link href="<?= base_url(); ?>assets/landing/css/style.css" rel="stylesheet">
</head>

<body class="bg-body-secondary" style="background-image: url(<?= base_url(); ?>assets/landing/images/hero-area/banner-bg.png); background-repeat: no-repeat; background-size: cover; background-position: center;">
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h4>Login User</h4>
                        <?php if (session()->getFlashdata('error') !== null) : ?>
                            <div class="alert alert-warning">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('success') !== null) : ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo base_url(); ?>auth/login" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group mb-3">
                                <input type="hidden" name="ip-address" id="ip" value="">
                                <input type="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="password" placeholder="Password" class="form-control" required>
                            </div>
                            <div>
                                <p class="text-center mb-0">Don't have an account? <a href="<?= base_url(); ?>auth/register">Sign Up</a></p>
                                <p class="text-center">or <a href="<?= base_url(); ?>auth/forgot-password">Forgot Password?</a></p>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetch('https://api.ipify.org?format=json')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('ip').value = data.ip;
                });
        });
    </script>
</body>

</html>