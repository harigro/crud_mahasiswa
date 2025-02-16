<?php
namespace Apps\Models;

use Apps\Database;
use PDO;
use PDOException;

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

    public function createRegistrasi($nama, $email, $kata_sandi) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("INSERT INTO registrasi (nama, email, kata_sandi) VALUES (?, ?, ?)");
            $stmt->execute([$nama, $email, $kata_sandi]);

            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
        }
    }

    public function createDataMahasiswa($nama, $nim, $jurusan, $email) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("INSERT INTO mahasiswa (nama_mahasiswa, nim, jurusan, email) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nama, $nim, $jurusan, $email]);

            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
        }
    }

    public function deleteDataMahasiswa($id) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = ?");
            $stmt->execute([$id]);

            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
        }
    }

    public function updateDataMahasiswa($id, $nama, $nim, $jurusan, $email) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("UPDATE mahasiswa SET nama_mahasiswa = ?, nim = ?, jurusan = ?, email = ? WHERE id = ?");
            $stmt->execute([$nama, $nim, $jurusan, $email, $id]);

            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
        }
    }

    public function SearchDataMahasiswa($nim) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE nim = :nim");
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
        
}
