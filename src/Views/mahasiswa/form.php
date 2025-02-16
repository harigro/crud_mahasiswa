<?php $this->layout('registrasi') ?>
<body>
    <div class="container mt-5 border rounded-2 p-4 w-50">
        <h2 class="mb-4">Registrasi</h2>
        <form method="POST" action="./register/store" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama_lengkap" required>
                <div class="invalid-feedback">Nama wajib diisi.</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">Masukkan email yang valid.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="password" name="password" required minlength="6">
                <div class="invalid-feedback">Kata sandi minimal 6 karakter.</div>
            </div>
            <div class="mb-3">
                <label for="konfirmasiPassword" class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" class="form-control" id="konfirmasiPassword" name="konfirmasi_password" required>
                <div class="invalid-feedback">Konfirmasi kata sandi harus sama.</div>
            </div>
            <button type="submit" class="btn btn-primary w-25 my-3">Daftar</button>
        </form>
    </div>
</body>
</html>
