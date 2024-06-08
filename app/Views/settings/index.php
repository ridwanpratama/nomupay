<?= $this->extend("layouts/master") ?>

<?= $this->section("content") ?>
<div class="content mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-success-subtle shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Categories</h5>
                        <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategory"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-success">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Desc</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category) : ?>
                                    <tr>
                                        <td><?= $category['name'] ?></td>
                                        <td><?= $category['description'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>mypanel/settings/edit-category/<?= $category['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url() ?>mypanel/settings/delete-category/<?= $category['id'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<!-- 
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Bank Accounts</h5>
                    <form action="<?= base_url() ?>mypanel/settings/update-bank" method="POST">
                        <?= csrf_field() ?>
                        <div class="form-group mb-3">
                            <label for="bank-name">Bank Name</label>
                            <select name="bank-name" id="bank-name" class="form-control" required>
                                <option value="">Select Bank</option>
                                <?php foreach ($banks as $bank) : ?>
                                    <option value="<?= $bank['id'] ?>" <?php echo $bank['id'] == $userProfile['bank_id'] ? 'selected' : '' ?>>
                                        <?= $bank['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="bank-number">Account Number</label>
                            <input type="number" name="bank-number" id="bank-number" class="form-control" value="<?= $userProfile['bank_number'] ?? '' ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary float-end">Save</button>
                    </form>
                </div>
            </div>
        </div> -->
    </div>
</div>
<?= $this->include('settings/add-category') ?>
<?= $this->endSection() ?>