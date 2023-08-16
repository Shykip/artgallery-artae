<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        $username = $_SESSION['user'];
    }else {
        header('Location: ./login_page.php');
    }

    include('./database/Database.php');
    $database = new Database();

    $isAdmin = $database->userUserRole($username);
    if(!$isAdmin) {
        header('Location: ./login_page.php');
        exit(1);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>artae - admin</title>

    <!-- linking css -->
    <link rel="stylesheet" href="./css/admin/admin.css">

    <!-- linking custom font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://www.dafontfree.net/embed/aW1wcmludC1tdC1zaGFkb3ctcmVndWxhciZkYXRhLzI1L2kvMTI5NjcxL0ltcHJpbnRNVFNoYWRvdy50dGY" rel="stylesheet" type="text/css"/>

</head>
<body>
    
    <secttion class="container">
        <div class="header">
            <a href="./index.php"><img src="./assets/images/star.png" alt=""></a>
            <p class="heading">Admin Panel</p>
        </div>
        <div class="uploads-container">

            <?php
            $servername = "localhost";
            $dbusername = "root";
            $password = "";
            $database = "artae";
    
            // Create connection
            $connection = new mysqli($servername, $dbusername, $password, $database);
    
            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }
            $query = "SELECT * FROM images ORDER BY id DESC";
            $result = $connection->query($query); 

            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    ?>

                    <div class="item-container">
                        <a href="./item_view_page.php?id=<?= $row['id'] ?>" class="item">
                            <div class="image-box">
                                <img src="<?= $row['destination'] ?>">
                            </div>
                            <div class="info">
                                <p class="title"><span>Title : </span><?= $row['title'] ?></p>
                                <p class="user"><span>Uploader : </span><?= $row['user'] ?></p>
                            </div>
                        </a>
                        <a href="./web_components/delete_item.php?id=<?= $row['id'] ?>&destination=<?= $row['destination'] ?>" class="delete">
                            <img src="./assets/images/delete-icon-gold.png" alt="">
                        </a>
                    </div>

                    <?php
                }
            }
        ?>

        </div>

    </secttion>

</body>
</html>