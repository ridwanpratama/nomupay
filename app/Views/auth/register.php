<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Register | Nomupay</title>
    <link href="<?= base_url(); ?>assets/landing/css/style.css" rel="stylesheet">
</head>

<body class="bg-body-secondary" style="background-image: url(<?= base_url(); ?>assets/landing/images/hero-area/banner-bg.png); background-repeat: no-repeat; background-size: cover; background-position: center;">
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h4>Register User</h4>
                        <?php if (session()->has('errors')) : ?>
                            <div class="alert alert-danger">
                                <ul class="py-0 my-0">
                                    <?php foreach (session('errors') as $error) : ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo base_url(); ?>/auth/register" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group mb-3">
                                <input type="text" name="name" placeholder="Name" value="<?= set_value('name') ?>" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="phone" id="phone" placeholder="Phone" value="<?= set_value('phone') ?>" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="password" placeholder="Password" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control" required>
                            </div>
                            <div>
                                <p class="text-center">Already have an account? <a href="<?= base_url(); ?>auth/login">Sign In</a></p>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', function() {
            let phoneNumber = this.value.replace(/\D/g, '');
            if (phoneNumber.startsWith('62')) {
                phoneNumber = '0' + phoneNumber.slice(2);
            }

            if (phoneNumber.length >= 4) {
                phoneNumber = phoneNumber.replace(/(\d{4})/g, '$1-');
            }
            if (phoneNumber.length > 4 && phoneNumber.endsWith('-')) {
                phoneNumber = phoneNumber.slice(0, -1);
            }
            this.value = phoneNumber;
        });
    </script>
</body>

</html>