<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include('./database/Database.php');
    $database = new Database();
    
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        $username = $_SESSION['user'];
    }else {
        $username = "SignIn";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>artae</title>
    
    <!-- linking css -->
    <link rel="stylesheet" href="./css/index/style.css">

    <!-- linking custom font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://www.dafontfree.net/embed/aW1wcmludC1tdC1zaGFkb3ctcmVndWxhciZkYXRhLzI1L2kvMTI5NjcxL0ltcHJpbnRNVFNoYWRvdy50dGY" rel="stylesheet" type="text/css"/>

    <script src="./javascript/index.js"></script>
</head>
<body>

    <div class="background-light">
        <img src="./assets/images/background-light.png" alt="">
    </div>

    <section class="navigation">
        <?php include "./web_components/nav_bar.php"; ?>
    </section>
    
    <section class="home">
        <?php include "./web_components/home_view.php"; ?>
    </section>

    <footer></footer>

</body>
</html>