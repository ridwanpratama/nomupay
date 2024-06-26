<?= $this->extend("layouts/master") ?>

<?= $this->section("content") ?>
<div class="content mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card current-balance shadow mb-4">
                <div class="card-body">
                    <h5 class="card-title">Current Balance</h5>
                    <p class="card-text">Rp <?= number_format($userBalance["balance"], 0, ",", ",") ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-success topup" data-bs-toggle="modal" data-bs-target="#topupModal">
                <div class="card-body">
                    <h5 class="card-title">Topup</h5>
                    <p class="card-text"><i class="fas fa-arrow-up"></i> Click to topup</p>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-4">
            <div class="card withdraw">
                <div class="card-body">
                    <h5 class="card-title">Withdraw</h5>
                    <p class="card-text"><i class="fas fa-arrow-right"></i> Click to withdraw</p>
                </div>
            </div> -->
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Transaction</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Pay URL</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($topUpHistory as $topup) : ?>
                                    <tr>
                                        <td><?= date('d-m-Y H:i', strtotime($topup['created_at'])) ?></td>
                                        <td>Topup</td>
                                        <td>In</td>
                                        <td><?= $topup['payment_method'] ?></td>
                                        <td>
                                            <?php if (time() < strtotime('+1 hour', strtotime($topup['created_at'])) || $topup['status'] == 'Pending' && $topup['status'] != 'Success' && $topup['payment_link']) : ?>
                                                <a href="<?= $topup['payment_link'] ?>" class="btn btn-warning btn-sm" target="_blank">Pay Now</a>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-secondary btn-sm" disabled>Pay Now</button>
                                            <?php endif; ?>
                                        </td>
                                        <td>Rp <?= number_format($topup['amount'], 0, ',', ',') ?></td>
                                        <td>
                                            <?php
                                            if ($topup['status'] == 'Success') {
                                                echo '<span class="badge bg-success">Success</span>';
                                            } elseif (time() > strtotime('+1 hour', strtotime($topup['created_at']))) {
                                                echo '<span class="badge bg-danger">Failed</span>';
                                            } elseif ($topup['status'] == 'Pending') {
                                                echo '<span class="badge bg-warning">Pending</span>';
                                            } else {
                                                echo '<span class="badge bg-danger">Failed</span>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include("transaction/topup") ?>
<?= $this->endSection() ?>
<?= $this->section("script") ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js" integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        initEvent();
        setPaymentMethodSelectValue();
    });

    function initEvent() {
        const amountInput = document.getElementById('amount');

        amountInput.addEventListener('input', function() {
            amountInput.value = formatNumber(amountInput.value);
        });
    }

    function formatNumber(num) {
        num = num.replace(/[^0-9]/g, '');
        return num.replace(/,/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function setPaymentMethodSelectValue() {
        document.getElementById('payment_method_type').addEventListener('change', function() {
            const selectedType = this.value;
            axios.get('transaction/payment-method?type=' + selectedType)
                .then(function(response) {
                    const paymentMethods = response.data;
                    const paymentMethodSelect = document.getElementById('payment_method_id');
                    paymentMethodSelect.innerHTML = '<option value="">Select Payment Method</option>';
                    paymentMethods.forEach(function(method) {
                        var option = document.createElement('option');
                        option.value = method.id;
                        option.text = method.name;
                        paymentMethodSelect.appendChild(option);
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching payment methods:', error);
                });
        });
    }
</script>
<?= $this->endSection() ?>