<?php
namespace Apps\Models;

use Apps\Database;
use PDO;

class Telephone {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllDataMahasiswa() {
        $stmt = $this->db->query("SELECT * FROM mahasiswa");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsernameRegistrasi() {
        $stmt = $this->db->query("SELECT nama FROM regis");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nama, $email, $kata_sandi) {
        $stmt = $this->db->prepare("INSERT INTO mahasiswa (nama, email, kata_sandi) VALUES (?, ?, ?)");
        return $stmt->execute([$nama, $email, $kata_sandi]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM belanja WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
