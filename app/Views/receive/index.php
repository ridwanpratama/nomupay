<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
    <div class="content mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary-subtle shadow">
                    <div class="card-body">
                        <h5 class="card-title">Receive Money</h5>
                        <div class="text-center">
                            <img src="<?= base_url(); ?>assets/img/qr-code.svg" class="img-fluid" alt="qr-account">
                            <p class="card-text fs-3 pb-3"><?= session('phone') ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">How to Receive</h5>
                        <ul>
                            <li>Open the <span class="text-primary fw-bold">NomuPay</span> app in your
                                browser.</li>
                            <li>On the main page, select the <strong><em>Receive</em></strong> menu.</li>
                            <li>You will see your unique NomuPay QR code.</li>
                            <li>Share the QR code with the sender in the following ways:
                                <ul>
                                    <li>Show the QR code directly to the sender.</li>
                                    <li>Save the QR code as an image and share it via messaging apps, email,
                                        or social media.</li>
                                </ul>
                            </li>
                            <li>The sender will upload your QR code in the <strong><em>Send</em></strong>
                                menu.</li>
                            <li>The sender will enter the amount they want to transfer.</li>
                            <li>The sender will confirm the transaction.</li>
                            <li>Your balance will be updated with the amount transferred.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>