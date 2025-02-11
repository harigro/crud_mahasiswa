<?php
$base_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- <base href="/CRUD/crud_mahasiswa/public/"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomor Telepon</title>
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?= $this->section('content') ?>
    </div>
    <script src="<?= $base_url ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $base_url ?>assets/js/script_modal_bahrui.min.js"></script>
</body>
</html>
