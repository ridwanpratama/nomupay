<!-- Modal -->
<div class="modal fade" id="sendQR" tabindex="-1" aria-labelledby="sendQR" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Send Money</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url(); ?>mypanel/send/send-qr" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group mb-1">
                        <label for="qr-upload" class="form-label">Upload Receiver's QR</label>
                        <input type="file" class="form-control" name="qr-file" id="qr-upload" required>
                    </div>
                    <div class="form-group mb-1">
                        <label for="amount-qr" class="form-label">Amount</label>
                        <input type="text" class="form-control" name="amount-qr" id="amount-qr" required></label>
                    </div>
                    <div class="form-group mb-1">
                        <label for="note-qr" class="form-label">Note</label>
                        <input type="text" class="form-control" name="note-qr" id="note-qr"></label>
                    </div>
                    <button type="submit" class="btn btn-primary float-end mt-2">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>