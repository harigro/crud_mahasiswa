<?php

require '../vendor/autoload.php';

use League\Plates\Engine as PlatesEngine;
use Apps\Controllers\MahasiswaController;

// Setup Template Engine (Plates)
Flight::set('plates', (function () {
    $plates = new PlatesEngine(__DIR__ . '/../src/Views');
    $plates->addData([
        'escape' => fn($string) => htmlspecialchars($string, ENT_QUOTES, 'UTF-8')
    ]);
    return $plates;
})());

// Middleware untuk Cek Sesi
Flight::before('start', function() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['username']) && !in_array(Flight::request()->url, ['/register', '/register/store'])) {
        Flight::redirect('/register');
        exit;
    }
});

// Set Controller
Flight::set('mahasiswaController', new MahasiswaController());

// Routing
Flight::route('/', [MahasiswaController::class, 'index']);
Flight::route('/register', [MahasiswaController::class, 'register']);

// Menyimpan hasil registrasi
Flight::route('POST /register/store', function() {
    Flight::get('mahasiswaController')->storeRegistrasi(fn() => Flight::redirect('/'));
});

// Menyimpan data mahasiswa
Flight::route('POST /data/mahasiswa/store', function() {
    Flight::get('mahasiswaController')->storeMahasiswa(fn() => Flight::redirect('/'));
});

// Menghapus data mahasiswa
Flight::route('POST /data/mahasiswa/delete', function() {
    Flight::get('mahasiswaController')->deleteMahasiswa(fn() => Flight::redirect('/'));
});

// Memperbarui data mahasiswa
Flight::route('POST /data/mahasiswa/update', function() {
    Flight::get('mahasiswaController')->updateMahasiswa(fn() => Flight::redirect('/'));
});

// Mulai Aplikasi
Flight::start();
