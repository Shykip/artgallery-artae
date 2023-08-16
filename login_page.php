<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include('./database/Database.php');
    $database = new Database();
    
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        header('Location: ./index.php');
        exit(1);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(!empty($_POST)) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($_POST['loginBtn'] == "Signup") {
                
                $confirmPass = $_POST['confirmPass'];

                if ($password == $confirmPass) {
                    $database->userRegister($username, $password);
                }else {
                    echo '<script type="text/javascript"> alert("Password doesnt match")</script>';
                }

            }else {
                $authValid = $database->userAuthentication($username, $password);

                if ($authValid) {
                    $_SESSION['user'] = $username;
                    $isAdmin = $database->userUserRole($username);

                    if($isAdmin) {
                        header('Location: ./admin_panel.php');
                        exit(1);
                    }else {
                        header('Location: ./index.php');
                        exit(1);
                    }
                }
                else {
                    echo '<script type="text/javascript"> alert("Invalid username or password")</script>';
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>artae - login</title>

    <!-- linking css -->
    <link rel="stylesheet" href="./css/login/login.css">

    <!-- linking custom font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://www.dafontfree.net/embed/aW1wcmludC1tdC1zaGFkb3ctcmVndWxhciZkYXRhLzI1L2kvMTI5NjcxL0ltcHJpbnRNVFNoYWRvdy50dGY" rel="stylesheet" type="text/css"/>

    <script src="./javascript/login.js"></script>

</head>
<body>

    <div class="left-container">

        <div class="login-box">
            <p class="heading">artae</p>
            <form action="login_page.php" method="post" class="form">
                <input type="text" placeholder="Username" name="username" required autofocus autocomplete="off">
                <input type="password" placeholder="Password" name="password" required autocomplete="off">
                <input type="password" placeholder="Confirm Password" name="confirmPass" class="confirm-pass" autocomplete="off">
                <div><input type="submit" class="submit" name="loginBtn" value="Login"></div>
                <p class="create-acc">Create new account?</p>
            </form>
        </div>
    </div>
    <div class="right-container">
        <!-- <img src="./assets/images/login_banner_bright.jpg" alt="" class="login-banner" value = "0"> -->
        <video class="login-banner" autoplay muted loop>
            <source src="./assets/videos/the-wedding.mp4" type="video/mp4">
        </video>
    </div>

</body>
</html>

