<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aguacate By Kathe">
    <meta name="author" content="Creative Tim">
    <title><?= $this->renderSection('title') ?> - AguacateByKathe</title>
    <!-- Estilos Ivan -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/ecommerce/styleI.css" type="text/css">
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url() ?>/assets/img/brand/logonegro.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/argon.css?v=1.2.0" type="text/css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/ingcustom.css" type="text/css">
    <?= $this->renderSection('css') ?>
</head>

<body>
    <?= $this->include('admin/layout_structure/sidebar') ?>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <?= $this->include('admin/layout_structure/navbar') ?>

        <?= $this->renderSection('content') ?>
        
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="<?= base_url() ?>/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Optional JS -->
    <script src="<?= base_url() ?>/assets/vendor/clipboard/dist/clipboard.min.js"></script>
    <!-- Argon JS -->
    <script src="<?= base_url() ?>/assets/js/argon.js?v=1.2.0"></script>
    <?= $this->renderSection('js') ?>
</body>

</html>