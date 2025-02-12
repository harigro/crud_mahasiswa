<?php
namespace Apps\Controllers;

use Flight;
use Apps\Models\Mahasiswa;
use League\Plates\Engine;

class MahasiswaController {
    private $mahasiswa;
    private $templates;

    public function __construct() {
        $this->mahasiswa = new Mahasiswa();
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    public function index() {
        echo $this->templates->render('mahasiswa/index', ['items' => $this->mahasiswa->getAllDataMahasiswa()]);
    }

    public function register() {
        echo $this->templates->render('mahasiswa/form', []);
    }

    public function storeRegistrasi(callable $redirectTo): void {
        if (Flight::request()->method === "POST") {
            $nama = trim($_POST['nama_lengkap'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $kata_sandi = trim($_POST['password'] ?? '');
            $k_kata_sandi = trim($_POST['konfirmasi_password'] ?? '');
    
            if ($nama === '' || $email === '' || $kata_sandi === '' || $k_kata_sandi === '' ) {
                echo $this->templates->render('mahasiswa/404');
            } else {
                $this->mahasiswa->createRegistarsi($nama, $email, $kata_sandi);
                $_SESSION['username'] = $nama;
            $redirectTo();
            exit;
            }
        }
    }

    public function storeMahasiswa(callable $redirectTo): void {
        if (Flight::request()->method === "POST") {
            $nama = trim($_POST['nama'] ?? '');
            $nim = trim($_POST['nim'] ?? '');
            $jurusan = trim($_POST['jurusan'] ?? '');
            $email = trim($_POST['email'] ?? '');
    
            if ($nama === '' || $nim === '' || $jurusan === '' || $email === '') {
                echo $this->templates->render('mahasiswa/404');
            } else {
                $this->mahasiswa->createDataMahasiswa($nama, $nim, $jurusan, $email);
            $redirectTo();
            exit;
            }
        }
    }

    public function deleteMahasiswa(callable $redirectTo): void {
        if (Flight::request()->method === "POST") {
            $id = $_POST['id'];
            $this->mahasiswa->deleteDataMahasiswa($id);
            $redirectTo();
            exit;
        }
    }

    public function updateMahasiswa(callable $redirectTo): void {
        if (Flight::request()->method === "POST") {
            $id = trim($_POST['id'] ?? '');
            $nama = trim($_POST['nama'] ?? '');
            $nim = trim($_POST['nim'] ?? '');
            $jurusan = trim($_POST['jurusan'] ?? '');
            $email = trim($_POST['email'] ?? '');
    
            if ($id === '' || $nama === '' || $nim === '' || $jurusan === '' || $email === '') {
                echo $this->templates->render('mahasiswa/404');
            } else {
                $this->mahasiswa->updateDataMahasiswa($id, $nama, $nim, $jurusan, $email);
            $redirectTo();
            exit;
            }
        }
    }
    
}
