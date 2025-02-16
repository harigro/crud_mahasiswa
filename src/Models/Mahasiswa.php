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

            $stmt = $this->db->prepare("INSERT INTO registrasi (nama, email, kata_sandi) VALUES (:nama, :email, :kata_sandi)");
            $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':kata_sandi', $kata_sandi, PDO::PARAM_STR);
            $stmt->execute();

            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Error createRegistrasi: " . $e->getMessage());
        }
    }

    public function createDataMahasiswa($nama, $nim, $jurusan, $email) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("INSERT INTO mahasiswa (nama_mahasiswa, nim, jurusan, email) VALUES (:nama, :nim, :jurusan, :email)");
            $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindParam(':jurusan', $jurusan, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Error createDataMahasiswa: " . $e->getMessage());
        }
    }

    public function deleteDataMahasiswa($id) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Error deleteDataMahasiswa: " . $e->getMessage());
        }
    }

    public function updateDataMahasiswa($id, $nama, $nim, $jurusan, $email) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("UPDATE mahasiswa SET nama_mahasiswa = :nama, nim = :nim, jurusan = :jurusan, email = :email WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindParam(':jurusan', $jurusan, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Error updateDataMahasiswa: " . $e->getMessage());
        }
    }

    public function SearchDataMahasiswa($nim) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE nim = :nim");
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error SearchDataMahasiswa: " . $e->getMessage());
            return false;
        }
    }
}
