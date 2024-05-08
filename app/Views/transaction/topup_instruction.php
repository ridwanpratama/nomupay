<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topup Instruction</title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .card-body div {
            margin-bottom: 10px;
        }

        .card-body strong {
            font-weight: bold;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="text-align: center; font-size: 24px; margin-bottom: 20px;">Topup Instruction</div>

        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $orderData = $createOrder;
                    ?>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div>
                                <strong>Nomor VA:</strong> <?= htmlspecialchars($orderData['data']['nomor_va']) ?>
                            </div>

                            <div>
                                <strong>Payment Instructions:</strong>
                                <?= html_entity_decode($orderData['data']['panduan_pembayaran']) ?>
                            </div>
                            <div>
                                <strong>Payment ID:</strong> <?= htmlspecialchars($trxId) ?>
                            </div>
                            <div>
                                <strong>Payment URL:</strong>
                                <a href="<?= htmlspecialchars($orderData['data']['pay_url']) ?>" target="_blank">Pay Now</a>
                            </div>

                            <div>
                                <strong>Total to Pay:</strong> <?= number_format($orderData['data']['total_bayar']) ?>
                            </div>

                            <div>
                                <strong>Total Received:</strong> <?= number_format($orderData['data']['total_diterima']) ?>
                            </div>

                            <div>
                                <strong>Transaction ID:</strong> <?= htmlspecialchars($orderData['data']['trx_id']) ?>
                            </div>
                            <div>
                                <input type="hidden" name="trx_id" id="trx_id" value="<?= $trxId; ?>">
                                <strong>Status: </strong> <span style="text-transform: capitalize;" id="status" class="bg-primary p-2 rounded text-white">Pending</span>
                                <div class="float-end mt-3">
                                    <button type="button" class="refresh btn btn-secondary mt-3">Refresh</button>
                                    <a href="<?= base_url(); ?>mypanel/transaction" class="btn btn-info mt-3">Back to Mypanel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js" integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            refreshStatus();
        });

        function refreshStatus() {
            const refreshBtn = document.querySelector('.refresh');
            refreshBtn.addEventListener('click', () => {
                const trxId = document.getElementById('trx_id').value;
                console.log(trxId);
                // Fetch a new CSRF token
                axios.get('/mypanel/csrf-token')
                    .then(response => {
                        const csrfToken = response.data.csrfToken;
                        axios.get('check-topup', {
                                params: {
                                    trx_id: trxId
                                },
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => {
                                const status = response.data.status;
                                document.getElementById('status').innerHTML = status;
                                document.getElementById('status').classList.remove('bg-primary');
                                document.getElementById('status').classList.add('bg-success');
                            })
                            .catch(error => {
                                alert("Something went wrong. Please contact support.");
                            });
                    })
                    .catch(error => {
                        alert("Something went wrong. Please contact support.");
                    });
            });
        }
    </script>
</body>

</html>