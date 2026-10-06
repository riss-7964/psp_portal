<?php
class Student {
    private $conn;
    private $table = "students";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $ic, $program, $marks) {
        $query = "INSERT INTO " . $this->table . " (name, ic, program, marks) VALUES (:name, :ic, :program, :marks)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":ic", $ic);
        $stmt->bindParam(":program", $program);
        $stmt->bindParam(":marks", $marks);
        return $stmt->execute();
    }

    public function update($id, $name, $ic, $program, $marks) {
        $query = "UPDATE " . $this->table . " SET name = :name, ic = :ic, program = :program, marks = :marks WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":ic", $ic);
        $stmt->bindParam(":program", $program);
        $stmt->bindParam(":marks", $marks);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>