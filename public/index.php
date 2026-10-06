<?php
require_once '../includes/session.php';

// Jika action tidak dinyatakan dalam URL, tetapkan nilai laluan (default) terus ke 'login'
$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        require_once '../controllers/AuthController.php';
        (new AuthController())->login();
        break;

    case 'logout':
        require_once '../controllers/AuthController.php';
        (new AuthController())->logout();
        break;

    case 'profile':
        require_once '../controllers/ProfileController.php';
        (new ProfileController())->index();
        break;

    case 'change_password':
        require_once '../controllers/PasswordController.php';
        (new PasswordController())->change();
        break;

    case 'students':
        require_once '../controllers/StudentController.php';
        (new StudentController())->index();
        break;

    case 'create_student':
        require_once '../controllers/StudentController.php';
        (new StudentController())->create();
        break;

    case 'edit_student':
        require_once '../controllers/StudentController.php';
        (new StudentController())->edit();
        break;

    case 'delete_student':
        require_once '../controllers/StudentController.php';
        (new StudentController())->delete();
        break;

    default:
        // Jika action yang ditaip tidak wujud, hantar semula ke 'login'
        require_once '../controllers/AuthController.php';
        (new AuthController())->login();
        break;
}
?>