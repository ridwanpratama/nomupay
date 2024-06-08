<?= $this->extend("layouts/master") ?>

<?= $this->section("content") ?>
<div class="content mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card current-balance shadow mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Current Balance</h5>
                            <p class="card-text">Rp <?= number_format($userBalance["balance"], 0, ",", ".") ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card income mb-4">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-container me-3">
                                <i class="fa-solid fa-arrow-trend-up text-primary fs-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title">Income</h5>
                                <p class="card-text">Rp 2,3000,000</p>
                            </div>
                        </div>
                    </div>
                    <div class="card outcome">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-container me-3">
                                <i class="fa-solid fa-arrow-trend-down text-info fs-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title">Expenses</h5>
                                <p class="card-text">Rp 2,3000,000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card category mb-4">
                <div class="card-body">
                    <h5 class="card-title">Category</h5>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card category">
                <div class="card-body">
                    <h5 class="card-title">Latest Transaction</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">NomuPay</p>
                                <p class="mb-0"><span class="text-light badge text-bg-danger">Sent</span> 20 Maret 2024</p>
                            </div>
                            <div>
                                <p class="mb-0">Rp 2,3000,000</p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">Coffee</p>
                                <p class="mb-0"><span class="text-light badge text-bg-primary">Receive</span> 20 Maret 2024</p>
                            </div>
                            <div>
                                <p class="mb-0">Rp 200,000</p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">General</p>
                                <p class="mb-0"><span class="text-light badge text-bg-danger">Sent</span> 20 Maret 2024</p>
                            </div>
                            <div>
                                <p class="mb-0">Rp 300,000</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("script") ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById("myChart");

    new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Receive", "Send", "Topup"],
            datasets: [{
                label: "# of Votes",
                data: [12, 19, 3],
                borderWidth: 1,

            }, ],
        },
        options: {
            plugins: {
                customCanvasBackgroundColor: {
                    color: 'transparent',
                },
                legend: {
                    display: true,
                    labels: {
                        position: 'bottom'
                    }
                }
            }
        },
    });
</script>
<?= $this->endSection() ?>