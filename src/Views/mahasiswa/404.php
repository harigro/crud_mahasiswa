<?php
$base_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/';
?>
<?php $this->layout('layout') ?>

<div class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="text-center">
        <h1 class="display-1 text-danger">404</h1>
        <p class="lead">Halaman yang Anda cari tidak ditemukan.</p>
        <a href="<?= $base_url ?>" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</div>
