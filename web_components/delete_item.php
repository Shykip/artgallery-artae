<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        $username = $_SESSION['user'];
    }else {
        header('Location: ../login_page.php');
    }

    include('../database/Database.php');
    $database = new Database();

    $id = $_GET['id'];
    $destination = $_GET['destination'];

    $isAdmin = $database->userUserRole($username);
    $uploader = $database->getUploader($id);

    if($isAdmin || $username == $uploader) {
        if (is_file("../".$destination)) {
            unlink("../".$destination);
        }
        $database->itemDelete($id);
        header('Location: ../admin_panel.php');
    } else {
       header('Location: ../index.php');
    }

?>