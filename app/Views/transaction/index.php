<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
    <div class="content mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card current-balance shadow mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Current Balance</h5>
                        <p class="card-text">Rp 2,3000,000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success topup">
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
<?= $this->endSection() ?>