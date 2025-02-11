# CRUD Aplikasi Pendata Mahasiswa dengan Flight PHP & Plates

Aplikasi CRUD untuk mengelola data data mahasiswa menggunakan Flight PHP sebagai framework backend dan Plates sebagai template engine. Aplikasi ini menggunakan arsitektur Model-View-Controller (MVC) dan Bootstrap 5.3.3 untuk tampilan frontend.

## Struktur Direktori

```markdown
/belanja-crud
├── /public
│   ├── index.php
│   ├── .htaccess
│   ├── /assets
│   │   ├── /css
│   │   │   ├── bootstrap.min.css
│   │   ├── /js
│   │   │   ├── bootstrap.bundle.min.js
│   │   │   ├── script_form.min.js
│   │   │   ├── script_modal_bahrui.min.js
├── /src
│   ├── /Controllers
│   │   ├── MahasiswaController.php
│   ├── /Models
│   │   ├── Mahasiswa.php
│   ├── /Views
│   │   ├── mahasiswa
│   │   │   ├── /modal
│   │   │   │   ├── bahrui_data.php
│   │   │   │   ├── tambah_data.php
│   │   │   ├── index.php
│   │   │   ├── 404.php
│   │   │   ├── form.php
│   │   │   ├── list.php
│   │   ├── loyout.php
│   │   ├── registrasi.php
│   ├── config.php
│   ├── Database.php
├── /vendor
├── composer.json
```

## Fitur

1. **Tambah Data Mahasiswa** - Menambahkan data mahasiswa baru ke dalam database.
2. **Tampilkan Data Mahasiswa** - Menampilkan daftar data mahasiswa yang telah tersimpan.
3. **Update Data Mahasiswa** - Mengubah data data mahasiswa yang ada.
4. **Hapus Data Mahasiswa** - Menghapus data mahasiswa dari daftar.
5. **Registasi Pengguna** - Pengguna diharuskan untuk melakukan registrasi untuk bisa menggunakan aplikasi.
6. **Menggunakan Jalur Dinamis** - Aplikasi ini menggunakan `jalur dinamis` yang dibuat oleh `bahasa PHP` untuk mempermudah menemukan jalur folder css dan js serta bisa digunakan baik secara luring maupun daring.

## Persyaratan

- PHP 8.2 atau yang lebih baru.
- Composer untuk mengelola dependensi.
- Database (misalnya MySQL atau SQLite) untuk menyimpan data data mahasiswa.

## Instalasi

1. Clone repositori ini ke direktori lokal:
   
   ```bash
   git clone https://github.com/harigro/crud_mahasiswa.git
   ```

2. Masuk ke direktori proyek:
   
   ```bash
   cd crud_mahasiswa
   ```

3. Jalankan Composer untuk menginstal dependensi:
   
   * Untuk menginstalasi dependensi jalankan perintah
     
     * ```bash
       composer install
       ```
   
   * jika terjadi kesalahan dalam menginstalasi dependensi, coba hapus folder vendor dan composer.lock lalu jalankan perintah 
     
     * ```bash
       composer install
       ```

4. Pastikan konfigurasi database sudah benar di `src/config.php`.

5. Jalankan aplikasi dengan menjalankan `index.php` melalui server lokal (misalnya, menggunakan XAMPP, MAMP, atau PHP built-in server):
   
   ```bash
   php -S localhost:8000 -t public
   ```

6. Akses aplikasi melalui browser dengan mengunjungi `http://localhost:8000`.

## Konfigurasi `.htaccess`

Untuk mengarahkan semua permintaan ke `public/index.php`, buat file `.htaccess` di dalam folder `public` dengan konfigurasi berikut:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
</IfModule>
```

## Pengarahan ke 404

Jika ada inputan yang kosong atau tidak valid, aplikasi akan mengarahkan pengguna ke halaman 404. Anda bisa mengonfigurasi pengecekan input di controller dan memastikan aplikasi mengarah ke `Views/mahasiswa/404.php` jika ada kesalahan.

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE) dan jika ada pertanyaan atau saran, silakan buat **issue** atau **pull request**! 🚀.