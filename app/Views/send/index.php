<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<div class="content mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card current-balance shadow mb-4">
                <div class="card-body">
                    <h5 class="card-title">Current Balance</h5>
                    <p class="card-text">Rp <?= number_format($userBalance["balance"], 0, ",", ".") ?></p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title d-inline-block me-2">Recipient</h5>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addRecipient">+ Add</button>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($recipients as $recipient) : ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0"><?= $recipient['name'] ?></p>
                                </div>
                                <div>
                                    <p class="mb-0"><?= $recipient['phone'] ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-success qr-pay current-balance mb-4" data-bs-toggle="modal" data-bs-target="#sendQR">
                <div class="card-body">
                    <h5 class="card-title">Send Money</h5>
                    <p class="card-text"><i class="fas fa-qrcode"></i> Upload QR to Send Money</p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Send Money</h5>
                    <form action="<?= base_url(); ?>mypanel/send/send-money" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="recipient" class="form-label">Recipient</label>
                            <select class="form-select mb-3" name="recipient-tf" id="recipient" onchange="checkCustomInput(this)" required>
                                <option value="">Select Recipient</option>
                                <?php foreach ($recipients as $recipient) : ?>
                                    <option value="<?= $recipient['id'] ?>"><?= $recipient['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="text" class="form-control d-none" id="customRecipientInput" placeholder="Enter new recipient">
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="text" class="form-control" name="amount-tf" id="amount-tf" required>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <input type="text" class="form-control" id="note" name="note-tf" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('send/add-recipient') ?>
<?= $this->include('send/upload-qr') ?>
<?= $this->endSection() ?>
<?= $this->section("script") ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js" integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        initEvent();

        const phoneInput = document.getElementById('add-phone');
        phoneInput.addEventListener('input', function() {

            let phoneNumber = this.value.replace(/\D/g, '');
            if (phoneNumber.startsWith('62')) {
                phoneNumber = '0' + phoneNumber.slice(2);
            } else if (phoneNumber.length >= 4) {
                phoneNumber = phoneNumber.replace(/(\d{4})/g, '$1-');
            } else if (phoneNumber.length > 4 && phoneNumber.endsWith('-')) {
                phoneNumber = phoneNumber.slice(0, -1);
            }
            this.value = phoneNumber;
        });

        const amountInput = document.getElementById('amount-tf');
        amountInput.addEventListener('input', function() {
            amountInput.value = formatNumber(amountInput.value);
        });

        const amountInputQr = document.getElementById('amount-qr');
        amountInputQr.addEventListener('input', function() {
            amountInputQr.value = formatNumber(amountInputQr.value);
        });
    });


    function initEvent() {
        const checkBtn = document.getElementById('check-user');

        checkBtn.addEventListener('click', function() {
            checkUser();
        });
    }

    function checkUser() {
        const phone = document.getElementById('add-phone').value;
        axios.get('check-user-phone?phone-num=' + phone)
            .then(function(response) {
                if (response.data.success == true) {
                    document.getElementById('check-user').classList.add('d-none');
                    document.getElementById('submit-recipient').classList.remove('d-none');
                    document.getElementById('recipient-name').innerHTML = 'Name: ' + response.data.name;
                    document.getElementById('recipient-name').classList.remove('d-none');
                    document.getElementById('add-phone').readOnly = true;
                } else {
                    clearInputRecipient();
                    alert('User not found');
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
    }

    function clearInputRecipient() {
        document.getElementById('add-phone').value = '';
        document.getElementById('check-user').classList.remove('d-none');
        document.getElementById('submit-recipient').classList.add('d-none');
        document.getElementById('recipient-name').innerHTML = '';
        document.getElementById('recipient-name').classList.add('d-none');
    }

    function formatNumber(num) {
        num = num.replace(/[^0-9]/g, '');
        return num.replace(/,/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }
</script>

<?= $this->endSection() ?>