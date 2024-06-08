<!-- Modal -->
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategory" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url(); ?>mypanel/settings/add-category" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3 justify-content-between">
                        <div class="form-group">
                            <label for="category-name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category-name" id="category-name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary float-end mt-3"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>