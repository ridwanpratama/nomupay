<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Forgot Password | Nomupay</title>
    <link href="<?php echo base_url();?>assets/landing/css/style.css" rel="stylesheet">
</head>

<body class="bg-body-secondary" style="background-image: url(<?php echo base_url();?>assets/landing/images/hero-area/banner-bg.png); background-repeat: no-repeat; background-size: cover; background-position: center;">
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h4>Forgot Password</h4>
                            <?php if (isset($validation)): ?>
                                <div class="alert alert-warning">
                                    <?php echo $validation->listErrors()?>
                                </div>
                            <?php endif;?>
                            <form action="<?php echo base_url(); ?>auth/send-reset-link" method="post">
                                <?php echo csrf_field()?>
                                <div class="form-group mb-3">
                                    <input type="text" name="phone" id="phone" placeholder="Phone" class="form-control" required>
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
    <script>
        const phoneInput = document.getElementById('phone');

        phoneInput.addEventListener('input', function(event) {
            let phoneNumber = event.target.value.replace(/\D/g, '');
            if (phoneNumber.startsWith('628')) {
                phoneNumber = '08' + phoneNumber.substring(3);
            }

            let formattedPhoneNumber;
            if (phoneNumber.length <= 4) {
                formattedPhoneNumber = phoneNumber;
            } else if (phoneNumber.length <= 7) {
                formattedPhoneNumber = `${phoneNumber.slice(0, 4)}-${phoneNumber.slice(4)}`;
            } else if (phoneNumber.length <= 11) {
                formattedPhoneNumber = `${phoneNumber.slice(0, 4)}-${phoneNumber.slice(4, 7)}-${phoneNumber.slice(7)}`;
            } else {
                formattedPhoneNumber = `${phoneNumber.slice(0, 4)}-${phoneNumber.slice(4, 8)}-${phoneNumber.slice(8, 12)}`;
            }

            event.target.value = formattedPhoneNumber;
        });
    </script>
</body>

</html>