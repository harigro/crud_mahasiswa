<?php
$base_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/';
?>
<?php $this->layout('layout') ?>

<header class="mb-2">
    <h1 class="mb-5">Cari Data Mahasiswa</h1>
</header>
<main class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>NIM</th>
                <th>Jurusan</th>
                <th>Email</th>
                <th>Dibuat Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barusaja as $item): ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= $this->escape($item['nama_mahasiswa']) ?></td>
                    <td><?= $this->escape($item['nim']) ?></td>
                    <td><?= $this->escape($item['jurusan']) ?></td>
                    <td><?= $this->escape($item['email']) ?></td>
                    <td><?= $item['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<footer class="mt-3">
    <a href="<?= $base_url ?>" class="btn btn-secondary px-5 py-2">Kembali</a>
    <div class="py-3 mt-4 text-end">
        <p>&copy; 2025 Data Mahasiswa</p>
    </div>
</footer>

