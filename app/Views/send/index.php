<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
    <div class="content mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card current-balance shadow mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Current Balance</h5>
                        <p class="card-text">Rp 2,3000,000</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="card-title d-inline-block me-2">Recipient</h5>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addReceipent">+ Add</button>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0">Noer Faizir Rohman</p>
                                </div>
                                <div>
                                    <p class="mb-0">08XXXXXXXXXX</p>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0">Nur Annisa Fitriyani</p>
                                </div>
                                <div>
                                    <p class="mb-0">08XXXXXXXXXX</p>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0"> I V Agung Eko Priyono</p>
                                </div>
                                <div>
                                    <p class="mb-0">08XXXXXXXXXX</p>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0">Hindir</p>
                                </div>
                                <div>
                                    <p class="mb-0">08XXXXXXXXXX</p>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0">Muhammad Ridwan Pratama</p>
                                </div>
                                <div>
                                    <p class="mb-0">08XXXXXXXXXX</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-success qr-pay current-balance mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Payment</h5>
                        <p class="card-text"><i class="fas fa-qrcode"></i> Click here to pay</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Send Money</h5>
                        <form action="">
                            <div class="mb-3">
                                <label for="recipient" class="form-label">Recipient</label>
                                <select class="form-select mb-3" id="recipient"
                                    onchange="checkCustomInput(this)">
                                    <option value="">Select Recipient</option>
                                    <option value="">Noer Faizir Rohman</option>
                                    <option value="">Nur Annisa Fitriyani</option>
                                    <option value="">I V Agung Eko Priyono</option>
                                    <option value="customRecipient">New Recipient</option>
                                </select>
                                <input type="text" class="form-control d-none" id="customRecipientInput"
                                    placeholder="Enter new recipient">
                            </div>


                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="text" class="form-control" id="amount">
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <input type="text" class="form-control" id="note">
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->include('send/add-receipent') ?>
<?= $this->endSection() ?>