<?php
namespace Apps\Models;

use Apps\Database;
use PDO;

class Telephone {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM regis");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nama, $telepon) {
        $stmt = $this->db->prepare("INSERT INTO regis (nama, telepon) VALUES (?, ?)");
        return $stmt->execute([$nama, $telepon]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM belanja WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
