<?php

require '../vendor/autoload.php';

use League\Plates\Engine as PlatesEngine;
use Apps\Controllers\MahasiswaController;

session_start();
// Tambahkan Plates ke Flight
Flight::set('plates', [PlatesEngine::class, __DIR__ . '/../src/views']);

// Middleware untuk pengecekan sesi
Flight::before('start', function() {
    $allowedRoutes = ['/register', '/register/store']; // Halaman yang boleh diakses tanpa login
    if (!isset($_SESSION['username']) && !in_array(Flight::request()->url, $allowedRoutes)) {
        Flight::redirect('/register'); // Jika belum login, arahkan ke halaman register
        exit;
    }
});


// Route utama
Flight::route('/', [MahasiswaController::class, 'index']);
Flight::route('/register', [MahasiswaController::class, 'register']);
Flight::route('POST /register/store', function() {
    $controller = new MahasiswaController();
    $controller->store(fn() => Flight::redirect('/'));
});

// Mulai aplikasi
Flight::start();
