<?php

require_once '../config/database.php';
require_once '../models/User.php';
require_once '../includes/session.php';

class ProfileController {

    public function index() {

        // Pastikan user sudah login
        checkAuth();

        // Sambung database
        $db = (new Database())->getConnection();

        $userModel = new User($db);

        $message = "";
        $messageType = "info";


        // =========================================
        // PROSES UPLOAD PROFILE PICTURE
        // =========================================

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Pastikan file dihantar
            if (
                !isset($_FILES['profile_picture']) ||
                $_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK
            ) {

                $message = "Please select a valid image.";
                $messageType = "danger";

            } else {

                $file = $_FILES['profile_picture'];


                // =====================================
                // 1. CHECK FILE SIZE
                // Maximum 2MB
                // =====================================

                $maxSize = 2 * 1024 * 1024;

                if ($file['size'] > $maxSize) {

                    $message = "File size must not exceed 2MB.";
                    $messageType = "danger";

                } else {


                    // =================================
                    // 2. CHECK FILE EXTENSION
                    // =================================

                    $extension = strtolower(
                        pathinfo(
                            $file['name'],
                            PATHINFO_EXTENSION
                        )
                    );

                    $allowedExtensions = [
                        'jpg',
                        'jpeg',
                        'png'
                    ];


                    if (
                        !in_array(
                            $extension,
                            $allowedExtensions,
                            true
                        )
                    ) {

                        $message = "Only JPG, JPEG and PNG files are allowed.";
                        $messageType = "danger";

                    } else {


                        // =================================
                        // 3. CHECK ACTUAL MIME TYPE
                        // =================================

                        $finfo = finfo_open(
                            FILEINFO_MIME_TYPE
                        );

                        $mimeType = finfo_file(
                            $finfo,
                            $file['tmp_name']
                        );

                        finfo_close($finfo);


                        $allowedMimeTypes = [
                            'image/jpeg',
                            'image/png'
                        ];


                        if (
                            !in_array(
                                $mimeType,
                                $allowedMimeTypes,
                                true
                            )
                        ) {

                            $message = "Invalid image file.";
                            $messageType = "danger";

                        } else {


                            // =================================
                            // 4. SECURE FILE NAME
                            // =================================

                            $newFilename =
                                uniqid(
                                    'profile_',
                                    true
                                ) . '.' . $extension;


                            // =================================
                            // 5. UPLOAD LOCATION
                            // =================================

                            $uploadDirectory =
                                __DIR__ . '/../uploads/';


                            // Pastikan folder uploads wujud
                            if (
                                !is_dir(
                                    $uploadDirectory
                                )
                            ) {

                                mkdir(
                                    $uploadDirectory,
                                    0755,
                                    true
                                );
                            }


                            $uploadPath =
                                $uploadDirectory .
                                $newFilename;


                            // =================================
                            // 6. MOVE FILE
                            // =================================

                            if (
                                move_uploaded_file(
                                    $file['tmp_name'],
                                    $uploadPath
                                )
                            ) {


                                // =================================
                                // 7. SAVE FILE NAME TO DATABASE
                                // =================================

                                $updated =
                                    $userModel->updateProfilePicture(
                                        $_SESSION['user_id'],
                                        $newFilename
                                    );


                                if ($updated) {

                                    $message =
                                        "Profile picture uploaded successfully.";

                                    $messageType =
                                        "success";

                                } else {

                                    $message =
                                        "Image uploaded but database update failed.";

                                    $messageType =
                                        "danger";
                                }

                            } else {

                                $message =
                                    "Failed to upload image.";

                                $messageType =
                                    "danger";
                            }
                        }
                    }
                }
            }
        }


        // =========================================
        // AMBIL DATA STUDENT
        // =========================================

        $student =
            $userModel->getById(
                $_SESSION['user_id']
            );


        // Paparkan profile page
        require '../views/profile/index.php';
    }
}

?>