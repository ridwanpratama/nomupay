<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<div class="content mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card current-balance shadow mb-4">
                <div class="card-body">
                    <h5 class="card-title">Current Balance</h5>
                    <p class="card-text">Rp <?= number_format($userBalance['balance'], 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success topup" data-bs-toggle="modal" data-bs-target="#topupModal">
                <div class="card-body">
                    <h5 class="card-title">Topup</h5>
                    <p class="card-text"><i class="fas fa-arrow-up"></i> Click to topup</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card withdraw">
                <div class="card-body">
                    <h5 class="card-title">Withdraw</h5>
                    <p class="card-text"><i class="fas fa-arrow-right"></i> Click to withdraw</p>
                </div>
            </div>
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
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2022-01-01</td>
                                    <td>Payment</td>
                                    <td>Topup</td>
                                    <td>Rp 1,000</td>
                                </tr>
                                <tr>
                                    <td>2022-01-01</td>
                                    <td>Payment</td>
                                    <td>Sent</td>
                                    <td>Rp 1,000</td>
                                </tr>
                                <tr>
                                    <td>2022-01-01</td>
                                    <td>Payment</td>
                                    <td>Receive</td>
                                    <td>Rp 1,000</td>
                                </tr>
                                <tr>
                                    <td>2022-01-01</td>
                                    <td>Payment</td>
                                    <td>Receive</td>
                                    <td>Rp 1,000</td>
                                </tr>
                                <tr>
                                    <td>2022-01-01</td>
                                    <td>Payment</td>
                                    <td>Sent</td>
                                    <td>Rp 1,000</td>
                                </tr>
                                <tr>
                                    <td>2022-01-01</td>
                                    <td>Payment</td>
                                    <td>Topup</td>
                                    <td>Rp 1,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('transaction/topup') ?>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js" integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        return num.replace(/,/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function setPaymentMethodSelectValue() {
        document.getElementById('payment_method_type').addEventListener('change', function() {
            var selectedType = this.value;
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