<?php $this->layout('layout') ?>

<h1>Daftar Data Mahasiswa</h1>
<button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Item</button>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Lengkap</th>
            <th>NIM</th>
            <th>Juruasn</th>
            <th>Email</th>
            <th>Dibuat Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['nama_mahasiswa'] ?></td>
                <td><?= $item['nim'] ?></td>
                <td><?= $item['jurusan'] ?></td>
                <td><?= $item['email'] ?></td>
                <td><?= $item['created_at'] ?></td>
                <td>
                    <form method="POST" action="./data/mahasiswa/delete">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="./data/mahasiswa/store">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="number" name="nim" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" name="jurusan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
