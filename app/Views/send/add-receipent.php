<!-- Modal -->
<div class="modal fade" id="addReceipent" tabindex="-1" aria-labelledby="addReceipent" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addReceipent">Add Recipient</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <?= csrf_field() ?>
                    <div class="mb-3 justify-content-between">
                        <input type="text" name="" class="form-control" placeholder="Enter Phone" required>
                        <button class="btn btn-primary float-end btn-sm mt-3">Check User</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>