<?php
// Memuat .env dengan PHP Dotenv
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Mengembalikan konfigurasi
return [
    'database' => [
        'host' => $_ENV['DB_HOST'],   // Host database dari .env
        'dbname' => $_ENV['DB_NAME'], // Nama database dari .env
        'username' => $_ENV['DB_USER'], // Username database dari .env
        'table_mahasiswa' => $_ENV['DB_TABLE_MAHASISWA'], // Tabel mahasiswa dari .env
        'table_registrasi' => $_ENV['DB_TABLE_REGISTRASI'], // Tabel registrasi dari .env
        'password' => $_ENV['DB_PASS']  // Password database dari .env
    ]
];
