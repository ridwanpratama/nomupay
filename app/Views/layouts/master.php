<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include("layouts/partials/head") ?>
    <?= $this->renderSection("style") ?>
</head>

<body class="bg-body-secondary">
    <div class="container-fluid">
        <div class="row">
            <?= $this->include("layouts/partials/sidebar") ?>
            <main class="col-md-9 ml-sm-auto col-lg-10 p-md-4 main">
                <?= $this->include("layouts/partials/topbar") ?>
                <?= $this->renderSection("content") ?>
            </main>
        </div>
    </div>

    <?= $this->include("layouts/partials/script") ?>
    <?= $this->renderSection("script") ?>
</body>

</html>
