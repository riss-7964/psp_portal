<?php
require_once '../config/database.php';
require_once '../models/User.php';
require_once '../includes/session.php';
require_once '../includes/csrf.php';

class PasswordController {
    public function change() {
        checkAuth();
        $message = "";
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
                die("Permintaan CSRF Tidak Sah!");
            }

            $oldPassword = $_POST['old_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($newPassword !== $confirmPassword) {
                $error = "Pengesahan Kata Laluan Baharu Tidak Sejajar!";
            } else {
                $db = (new Database())->getConnection();
                $userModel = new User($db);
                $user = $userModel->getById($_SESSION['user_id']);

                if (password_verify($oldPassword, $user['password'])) {
                    if ($userModel->updatePassword($_SESSION['user_id'], $newPassword)) {
                        $message = "Kata Laluan Berjaya Dikemaskini!";
                    } else {
                        $error = "Gagal Mengemaskini Kata Laluan.";
                    }
                } else {
                    $error = "Kata Laluan Lama Tidak Tepat!";
                }
            }
        }
        require '../views/password/change.php';
    }
}
?>