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
                            <p class="card-text">Rp <?= number_format($userBalance["balance"], 0, ",", ",") ?></p>
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
                                <p class="card-text">Rp <?= number_format($income, 0, ",", ",") ?></p>
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
                                <p class="card-text">Rp <?= number_format($expenses['amount'], 0, ",", ",") ?></p>
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
                        <?php foreach ($latestTransactions['data'] as $transaction) : ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0"><?= $transaction['category'] ?> <span class="text-light badge <?php if ($transaction['type'] == 'Income') echo('bg-primary'); else echo('bg-danger') ?>">
                                    <?= $transaction['type'] ?></span></p>
                                    <p class="mb-0">
                                    </p>
                                    <span><?= date('d M Y - H:i:s', strtotime($transaction['created_at'])); ?></span>
                                </div>
                                <div>
                                    <p class="mb-0">Rp <?= number_format($transaction['amount'], 0, ",", ",") ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
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
                label: "Transaction",
                data: [<?= $latestTransactions['receivedCount'] ?>, <?= $latestTransactions['transactionCount'] ?>, <?= $latestTransactions['receivedCount'] ?>],
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