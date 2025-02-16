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
            $stmt->execute([
                ':nama' => $nama,
                ':email' => $email,
                ':kata_sandi' => $kata_sandi
            ]);

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
            $stmt->execute([
                ':nama' => $nama,
                ':nim' => $nim,
                ':jurusan' => $jurusan,
                ':email' => $email
            ]);

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
            $stmt->execute([
                ':id' => $id
            ]);

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
            $stmt->execute([
                ':id' => $id,
                ':nama' => $nama,
                ':nim' => $nim,
                ':jurusan' => $jurusan,
                ':email' => $email
            ]);

            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Error updateDataMahasiswa: " . $e->getMessage());
        }
    }

    public function SearchDataMahasiswa($nim) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE nim = :nim");
            $stmt->execute([
                ':nim' => $nim
            ]);
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error SearchDataMahasiswa: " . $e->getMessage());
            return false;
        }
    }
}
