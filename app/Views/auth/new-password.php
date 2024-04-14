<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Reset Password | Nomupay</title>
    <link href="<?= base_url(); ?>assets/landing/css/style.css" rel="stylesheet">
</head>

<body class="bg-body-secondary" style="background-image: url(<?= base_url(); ?>assets/landing/images/hero-area/banner-bg.png); background-repeat: no-repeat; background-size: cover; background-position: center;">
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h4>Reset Password</h4>
                        <?php if (session()->has('errors')) : ?>
                            <div class="alert alert-danger">
                                <?php
                                $errors = session()->get('errors');
                                if (is_array($errors)) {
                                    foreach ($errors as $error) {
                                        echo $error . '<br>';
                                    }
                                } else {
                                    echo $errors;
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= base_url(); ?>auth/reset-password" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="token" value="<?= $_GET['token'] ?>">
                            <div class="form-group mb-3">
                                <input type="password" name="password" placeholder="New Password" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>