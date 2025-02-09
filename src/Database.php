<?php
namespace Apps;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $config = require __DIR__ . '/config.php';
        try {
            $this->pdo = new PDO("mysql:host={$config['database']['host']}", $config['database']['username'], $config['database']['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Membuat database jika belum ada
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS {$config['database']['dbname']}");
            $this->pdo->exec("USE {$config['database']['dbname']}");

            // Tabel register untuk menyimpan akun pengguna
            $this->pdo->exec("
                CREATE TABLE IF NOT EXISTS {$config['database']['table_registrasi']} (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nama VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    kata_sandi VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                );
            ");

            // Tabel crud_mahasiswa untuk menyimpan data mahasiswa yang terkait dengan pengguna
            $this->pdo->exec("
                CREATE TABLE IF NOT EXISTS {$config['database']['table_mahasiswa']} (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nama_mahasiswa VARCHAR(100) NOT NULL,
                    nim VARCHAR(20) NOT NULL UNIQUE,
                    jurusan VARCHAR(100) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                );
            ");

        } catch (PDOException $e) {
            die("❌ Gagal membuat database: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }
}
