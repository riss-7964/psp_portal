<?php
class User {
    private $conn;
    private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getByIC($ic) {
        $query = "SELECT * FROM " . $this->table . " WHERE ic = :ic LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ic", $ic);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT u.id, u.ic, s.name, s.program 
                  FROM " . $this->table . " u 
                  LEFT JOIN students s ON u.ic = s.ic 
                  WHERE u.id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($id, $newPassword) {
        $query = "UPDATE " . $this->table . " SET password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $hashed = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt->bindParam(":password", $hashed);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>