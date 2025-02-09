<?php

require '../vendor/autoload.php';

use League\Plates\Engine as PlatesEngine;
use Apps\Controllers\TelephoneController;

// Tambahkan Plates ke Flight
Flight::set('plates', [PlatesEngine::class, __DIR__ . '/../src/views']);

// Middleware untuk pengecekan sesi
Flight::before('start', function() {
    $allowedRoutes = ['/register', '/register/store']; // Halaman yang boleh diakses tanpa login
    if (!isset($_SESSION['user_id']) && !in_array(Flight::request()->url, $allowedRoutes)) {
        Flight::redirect('/register'); // Jika belum login, arahkan ke halaman register
        exit;
    }
});


// Route utama
Flight::route('/', [TelephoneController::class, 'index']);
Flight::route('/register', [TelephoneController::class, 'register']);

// Mulai aplikasi
Flight::start();
