<?php
require_once '../config/database.php';

$db = (new Database())->getConnection();
$ic = '020101071234';
$password = 'password123';

// Generasi hash baru khusus untuk server php anda
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$query = "UPDATE users SET password = :password WHERE ic = :ic";
$stmt = $db->prepare($query);
$stmt->bindParam(':password', $hashedPassword);
$stmt->bindParam(':ic', $ic);

if ($stmt->execute()) {
    echo "<h3>Berjaya! Password telah di-reset.</h3>";
    echo "<p><strong>No IC:</strong> $ic</p>";
    echo "<p><strong>Password:</strong> $password</p>";
    echo "<a href='index.php'>Klik sini untuk Log Masuk</a>";
} else {
    echo "Gagal mengemaskini pangkalan data.";
}
?>