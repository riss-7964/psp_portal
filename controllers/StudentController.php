<?php
require_once '../config/database.php';
require_once '../models/Student.php';
require_once '../includes/session.php';
require_once '../includes/csrf.php';

class StudentController {
    public function index() {
        checkAuth();
        $db = (new Database())->getConnection();
        $studentModel = new Student($db);
        $students = $studentModel->getAll();
        require '../views/students/index.php';
    }

    public function create() {
        checkAuth();
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
                die("Permintaan CSRF Tidak Sah!");
            }

            $name = trim($_POST['name']);
            $ic = trim($_POST['ic']);
            $program = trim($_POST['program']);
            $marks = trim($_POST['marks']);

            $db = (new Database())->getConnection();
            $studentModel = new Student($db);

            if ($studentModel->create($name, $ic, $program, $marks)) {
                header("Location: index.php?action=students");
                exit();
            } else {
                $error = "Gagal Menambah Rekod Pelajar.";
            }
        }
        require '../views/students/create.php';
    }

    public function edit() {
        checkAuth();
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?action=students");
            exit();
        }

        $db = (new Database())->getConnection();
        $studentModel = new Student($db);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
                die("Permintaan CSRF Tidak Sah!");
            }

            $name = trim($_POST['name']);
            $ic = trim($_POST['ic']);
            $program = trim($_POST['program']);
            $marks = trim($_POST['marks']);

            if ($studentModel->update($id, $name, $ic, $program, $marks)) {
                header("Location: index.php?action=students");
                exit();
            } else {
                $error = "Gagal Mengemaskini Rekod Pelajar.";
            }
        }

        $student = $studentModel->getById($id);
        require '../views/students/edit.php';
    }

    public function delete() {
        checkAuth();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = (new Database())->getConnection();
            $studentModel = new Student($db);
            $studentModel->delete($id);
        }
        header("Location: index.php?action=students");
        exit();
    }
}
?>