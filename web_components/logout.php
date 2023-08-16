<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include('../database/Database.php');
    $database = new Database();

    $username = $_SESSION['user'];
    $database->setUserOffline($username);
    session_destroy();
    header('Location: ../login_page.php');
?>