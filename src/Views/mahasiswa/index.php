<?php $this->layout('layout') ?>

<h1>Daftar Data Mahasiswa</h1>

<button class="btn btn-primary d-inline my-3 me-2" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Item</button>
<button class="btn btn-secondary d-inline my-3 ms-2" data-bs-toggle="modal" data-bs-target="#modalBahrui">Bahrui Item</button>



<main class="table-responsive">
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
                        <div class="d-flex gap-2">
                            <form method="POST" action="./data/mahasiswa/delete">
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php $this->insert('mahasiswa/modal/tambah_data'); ?>
<?php $this->insert('mahasiswa/modal/bahrui_data'); ?>