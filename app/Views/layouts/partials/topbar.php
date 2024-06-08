<div class="top-bar-wrapper">
    <div class="breadcrumb-wrapper">
        <?php 
            date_default_timezone_set('Asia/Jakarta');
            $hour = date('G');
        ?>
        <h1 class="breadcrumb-heading me-3">
            <?php if ($hour >= 5 && $hour < 11) : ?>
                Good Morning <i class="fa-solid fa-cloud-sun"></i>
            <?php elseif ($hour >= 11 && $hour < 15) : ?>
                Good Afternoon <i class="fa-solid fa-sun"></i>
            <?php elseif ($hour >= 15 && $hour < 18) : ?>
                Good Evening <i class="fa-solid fa-cloud"></i>
            <?php else : ?>
                Good Night <i class="fa-solid fa-moon"></i> 
            <?php endif; ?>
        </h1>
        <div class="breadcrumb-date"><?= date('d F Y') ?></div>
    </div>
    <div class="profile-wrapper">
        <div class="profile-name">Hi! <?= session()->get('name') ?></div>
    </div>
</div>