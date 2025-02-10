<?php
namespace Apps\Models;

use Apps\Database;
use PDO;

class Mahasiswa {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllDataMahasiswa() {
        $stmt = $this->db->query("SELECT * FROM mahasiswa");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsernameRegistrasi() {
        $stmt = $this->db->query("SELECT nama FROM registrasi");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function createRegistarsi($nama, $email, $kata_sandi) {
        $stmt = $this->db->prepare("INSERT INTO registrasi (nama, email, kata_sandi) VALUES (?, ?, ?)");
        return $stmt->execute([$nama, $email, $kata_sandi]);
    }

    public function createDataMahasiswa($nama, $nim, $jurusan, $email) {
        $stmt = $this->db->prepare("INSERT INTO mahasiswa (nama_mahasiswa, nim, jurusan, email) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nama, $nim, $jurusan, $email]);
    }

    public function deleteDataMahasiswa($id) {
        $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function updateDataMahasiswa($id, $nama, $nim, $jurusan, $email) {
        $stmt = $this->db->prepare("UPDATE mahasiswa SET nama_mahasiswa = ?, nim = ?, jurusan = ?, email = ? WHERE id = ?");
        return $stmt->execute([$nama, $nim, $jurusan, $email, $id]);
    }
}
