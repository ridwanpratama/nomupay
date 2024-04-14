<div class="top-bar-wrapper">
    <div class="breadcrumb-wrapper">
        <h1 class="breadcrumb-heading me-3">Dashboard</h1>
        <div class="breadcrumb-date"><?= date('d F Y') ?></div>
    </div>
    <div class="profile-wrapper">
        <div class="profile-name">Hi! <?= session()->get('name') ?></div>
    </div>
</div>