<?php
require_once '../config/database.php';
require_once '../models/User.php';
require_once '../includes/csrf.php';

class AuthController {
    public function login() {
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
                die("Permintaan CSRF Tidak Sah!");
            }

            $ic = trim($_POST['ic']);
            $password = trim($_POST['password']);

            $db = (new Database())->getConnection();
            $userModel = new User($db);
            $user = $userModel->getByIC($ic);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_ic'] = $user['ic'];
                header("Location: index.php?action=profile");
                exit();
            } else {
                $error = "No. IC atau Kata Laluan Salah!";
            }
        }
        require '../views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
        exit();
    }
}
?>