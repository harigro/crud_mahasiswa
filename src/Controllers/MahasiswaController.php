<?php
namespace Apps\Controllers;

use Apps\Models\Mahasiswa;
use League\Plates\Engine;

class MahasiswaController {
    private $mahasiswa;
    private $templates;

    public function __construct() {
        $this->mahasiswa = new Mahasiswa();
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    // Fungsi untuk validasi token CSRF
    public function validateCsrfToken($token): bool {
        if(hash_equals($_SESSION['csrf_tokens'], $token)) {
            unset($_SESSION['csrf_tokens']);
            return true;
        } else {
            return false;
        }
    }
    
    // halaman utama
    public function index() {
        echo $this->templates->render('mahasiswa/index', ['items' => $this->mahasiswa->getAllDataMahasiswa()]);
        exit;
    }

    // halaman registrasi
    public function register() {
        echo $this->templates->render('mahasiswa/form', []);
        exit;
    }

    // menyimpana data registrasi
    public function storeRegistrasi(callable $redirectTo): void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!isset($_POST["csrf_token"]) || !$this->validateCsrfToken($_POST["csrf_token"])) {
                die("CSRF token tidak valid");
            } else {
                $nama = trim($_POST['nama_lengkap'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $kata_sandi = trim($_POST['password'] ?? '');
                $k_kata_sandi = trim($_POST['konfirmasi_password'] ?? '');

                if ($nama === '' || $email === '' || $kata_sandi === '' || $k_kata_sandi === '') {
                    echo $this->templates->render('mahasiswa/berita/404');
                } else {
                    $this->mahasiswa->createRegistrasi($nama, $email, $kata_sandi);
                    $_SESSION['username'] = $nama;
                    $redirectTo();
                    exit;
                } 
            }
        }
    }

    // menyimpana data mahasiswa
    public function storeMahasiswa(callable $redirectTo, mixed $request): void {
        if ($request->method === "POST") {
            $nama = trim($_POST['nama'] ?? '');
            $nim = trim($_POST['nim'] ?? '');
            $jurusan = trim($_POST['jurusan'] ?? '');
            $email = trim($_POST['email'] ?? '');
    
            if ($nama === '' || $nim === '' || $jurusan === '' || $email === '') {
                echo $this->templates->render('mahasiswa/berita/404');
            } else {
                $this->mahasiswa->createDataMahasiswa($nama, $nim, $jurusan, $email);
                $redirectTo();
                exit;
            }
        }
    }    

    // menyimpana menghapus data mahasiswa
    public function deleteMahasiswa(callable $redirectTo, mixed $request): void {
        if ($request->method === "POST") {
            $id = $_POST['id'];
            $this->mahasiswa->deleteDataMahasiswa($id);
            $redirectTo();
            exit;
        }
    }

    // menyimpana mengedit data mahasiswa
    public function updateMahasiswa(callable $redirectTo, mixed $request): void {
        if ($request->method === "POST") {
            $id = trim($_POST['id'] ?? '');
            $nama = trim($_POST['nama'] ?? '');
            $nim = trim($_POST['nim'] ?? '');
            $jurusan = trim($_POST['jurusan'] ?? '');
            $email = trim($_POST['email'] ?? '');
    
            if ($id === '' || $nama === '' || $nim === '' || $jurusan === '' || $email === '') {
                echo $this->templates->render('mahasiswa/berita/404');
            } else {
                $this->mahasiswa->updateDataMahasiswa($id, $nama, $nim, $jurusan, $email);
            $redirectTo();
            exit;
            }
        }
    }

    // mencari data mahasiswa
    public function searchMahasiswa(mixed $request): void {
        if ($request->method === "POST") {
            $nim = trim($_POST['nim'] ?? '');

            if ($nim === '') {
                echo $this->templates->render('mahasiswa/berita/404');
            } elseif ($this->mahasiswa->SearchDataMahasiswa($nim) === false) {
                echo $this->templates->render('mahasiswa/berita/403');
            } else {
                echo $this->templates->render(
                    'mahasiswa/temukan/databaru', ['barusaja' => $this->mahasiswa->SearchDataMahasiswa($nim)]);               
                exit;
            }
        }
    }

    // keluar dari sesi
    public function keluarSesi(callable $redirectTo): void {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
            $redirectTo();
            exit;
        }
    }
    
}
