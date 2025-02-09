<?php
namespace Apps\Controllers;

use Flight;
use Apps\Models\Telephone;
use League\Plates\Engine;

class TelephoneController {
    private $telephone;
    private $templates;

    public function __construct() {
        session_start();
        $this->telephone = new Telephone();
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    public function index() {
        echo $this->templates->render('telephone/index', ['items' => $this->telephone->getAllDataMahasiswa()]);
    }

    public function register() {
        echo $this->templates->render('telephone/form', []);
    }

    public function store(callable $redirectTo): void {
        if (Flight::request()->method === "POST") {
            $nama = trim($_POST['nama_lengkap'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $kata_sandi = trim($_POST['password'] ?? '');
            $k_kata_sandi = trim($_POST['konfirmasi_password'] ?? '');

            echo $nama, $email, $kata_sandi, $k_kata_sandi; 
    
            if ($nama === '' || $email === '' || $kata_sandi === '' || $k_kata_sandi === '' ) {
                echo $this->templates->render('Telephone/404');
            } else {
                $this->telephone->create($nama, $email, $kata_sandi);
            $redirectTo();
            exit;
            }
        }
    }
    
    
    public function delete(string $id): void {
        $this->telephone->delete($id);
        header("Location: index.php");
        exit;
    }
    
}
