<?php

require '../vendor/autoload.php';

use League\Plates\Engine as PlatesEngine;
use Apps\Controllers\MahasiswaController;

// Setup Template Engine (Plates)
Flight::set('plates', [PlatesEngine::class, __DIR__ . '/../src/views']);

// Middleware untuk Cek Sesi
Flight::before('start', function() {
    // Mengaktifkan sesi
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // Mengaktifkan token CSRF
    if (!isset($_SESSION['csrf_tokens'])) {
        $_SESSION['csrf_tokens'] = bin2hex(random_bytes(32));
    }
    // Jika ada cookie "data", simpan ke dalam sesi
    if (isset($_COOKIE['data']) && !isset($_SESSION['username'])) {
        $_SESSION['username'] = $_COOKIE['data'];
    }
    // Mengaktifkan formulir registrasi
    if (!isset($_SESSION['username']) && !in_array(Flight::request()->url, ['/register', '/register/store'])) {
        Flight::redirect('/register');
    }
});

// Set Controller
Flight::set('mahasiswaController', new MahasiswaController());

// Routing
Flight::route('GET /', [MahasiswaController::class, 'index']);
Flight::route('GET /register', [MahasiswaController::class, 'register']);

// Menyimpan hasil registrasi
Flight::route('POST /register/store', function() {
    Flight::get('mahasiswaController')->storeRegistrasi(fn() => Flight::redirect('/'));
});

// Menyimpan data mahasiswa
Flight::route('POST /data/mahasiswa/store', function() {
    Flight::get('mahasiswaController')->storeMahasiswa(fn() => Flight::redirect('/'), Flight::request());
});

// Menghapus data mahasiswa
Flight::route('POST /data/mahasiswa/delete', function() {
    Flight::get('mahasiswaController')->deleteMahasiswa(fn() => Flight::redirect('/'), Flight::request());
});

// Memperbarui data mahasiswa
Flight::route('POST /data/mahasiswa/update', function() {
    Flight::get('mahasiswaController')->updateMahasiswa(fn() => Flight::redirect('/'), Flight::request());
});

// Memperbarui data mahasiswa
Flight::route('GET /data/mahasiswa/cari', function() {
    Flight::get('mahasiswaController')->searchMahasiswa(Flight::request());
});

// keluar aplikasi
Flight::route('/logout', function() {
    Flight::get('mahasiswaController')->keluarSesi(fn() => Flight::redirect('/register'));
});

// Mulai Aplikasi
Flight::start();
