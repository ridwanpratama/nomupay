<!-- Modal -->
<div class="modal fade" id="topupModal" tabindex="-1" aria-labelledby="topupModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="topupModal">Topup</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url(); ?>mypanel/transaction/topup" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="image" class="form-label">Amount</label>
                        <input type="text" name="amount" class="form-control" id="amount" placeholder="Min 15.000" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method_type" class="form-label">Payment Method Type</label>
                        <select name="payment_method_type" id="payment_method_type" class="form-select">
                            <option value="">Select Payment Method Type</option>
                            <?php foreach ($paymentMethodTypes as $payment_method_type) : ?>
                                <option value="<?= $payment_method_type['id'] ?>"><?= $payment_method_type['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method_id" class="form-label">Payment Method</label>
                        <select name="payment_method_id" id="payment_method_id" class="form-select">
                            <option value="">Select Payment Method</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary float-end">Topup</button>
                </form>
            </div>
        </div>
    </div>
</div>