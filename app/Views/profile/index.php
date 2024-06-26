<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="content mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title d-inline-block me-2">Profile</h5>
                    </div>
                    <div class="text-center">
                        <?php if (isset($profile['image'])): ?>
                            <img src="<?= base_url('uploads/profile/' . $profile['image']) ?>" class="img-fluid" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;" alt="profile-image">
                        <?php else: ?>
                            <img src="assets/img/profile.png" class="img-fluid" width="150" height="150" alt="profile-image" onerror="this.onerror=null; this.src='<?= base_url(); ?>assets/img/profile.png';">
                        <?php endif ?>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">Name</p>
                            </div>
                            <div>
                                <p class="mb-0"><?= session()->get('name') ?></p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">Email</p>
                            </div>
                            <div>
                                <p class="mb-0"><?= session()->get('email') ?></p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">Phone</p>
                            </div>
                            <div>
                                <p class="mb-0"><?= session()->get('phone') ?></p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">Address</p>
                            </div>
                            <div>
                                <p class="mb-0"><?= $profile['address'] ?? '-' ?></p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">City</p>
                            </div>
                            <div>
                                <p class="mb-0"><?= $profile['city'] ?? '-' ?></p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">Postal Code</p>
                            </div>
                            <div>
                                <p class="mb-0"><?= $profile['postal_code'] ?? '-' ?></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card shadow mt-4">
                <div class="card-body">
                    <h5 class="card-title d-inline-block me-2">Update Password</h5>
                    <?php if (session()->has('errors')) : ?>
                        <div class="alert alert-warning">
                            <?php
                                $errors = session()->get('errors');
                                if (is_array($errors)) {
                                    foreach ($errors as $error) {
                                        echo $error . '<br>';
                                    }
                                } else {
                                    echo $errors;
                                }
                            ?>
                        </div>
                    <?php elseif (session()->has('success')) : ?>
                        <div class="alert alert-success">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url(); ?>mypanel/profile/update-password" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="old-password" class="form-label">Old Password</label>
                            <input type="password" class="form-control" name="old-password" id="old-password">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New
                                Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm New
                                Password</label>
                            <input type="password" class="form-control" name="confirm-password" id="confirm-password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update Profile</h5>

                    <?php if (session()->has('berhasil')) : ?>
                        <div class="alert alert-success">
                            <?= session()->get('berhasil') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url(); ?>mypanel/profile/update" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <input type="hidden" name="user_id" value="<?= session()->get('id') ?>" required>
                        <input type="hidden" name="id" value="<?= $profile['id'] ?? '' ?>">
                        <input type="hidden" name="image_exist" value="<?= $profile['image'] ?? '' ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" value="<?= session()->get('name') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span style="color: red;">*</span></label>
                            <input type="email" class="form-control" name="email" id="email" value="<?= session()->get('email') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="phone" id="phone" value="<?= session()->get('phone') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address" value="<?= $profile['address'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" name="city" id="city" value="<?= $profile['city'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" name="postal_code" id="postal_code" value="<?= $profile['postal_code'] ?? '' ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>