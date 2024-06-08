<!-- Modal -->
<div class="modal fade" id="addRecipient" tabindex="-1" aria-labelledby="addRecipient" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Recipient</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url(); ?>mypanel/send/add-recipient" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3 justify-content-between">
                        <input type="text" name="phone-num" id="add-phone" class="form-control mb-3" placeholder="Enter Phone" required>
                        <p class="text-muted mt-1 recipient-name d-none" id="recipient-name"></p>
                        <button class="btn btn-warning float-end btn-sm" type="button" id="check-user">Check User</button>
                        <button class="btn btn-primary float-end btn-sm d-none" id="submit-recipient" type="submit">Submit</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>