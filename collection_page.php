<?php
    if (!isset($_SESSION)) {
        session_start();
    }
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
    <title>artae - Collection</title>

    <!-- linking css -->
    <link rel="stylesheet" href="./css/collection/collection.css">

    <!-- linking custom font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://www.dafontfree.net/embed/aW1wcmludC1tdC1zaGFkb3ctcmVndWxhciZkYXRhLzI1L2kvMTI5NjcxL0ltcHJpbnRNVFNoYWRvdy50dGY" rel="stylesheet" type="text/css"/>

    <script src="./javascript/collection.js"></script>
</head>
<body>

    <section class="navigation">
        <?php include "./web_components/nav_bar.php"; ?>
    </section>

    <div class="sort-bar-container">
        <img src="./assets/images/star.png" alt="" class="star">
        <div class="sort-bar">
            <div class="trending">
                <p>Trending</p>
            </div>
            <div class="latest">
                <p>Latest</p>
            </div>
        </div>
        
    </div>
    
    <section class="items-container">

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "artae";
    
            // Create connection
            $connection = new mysqli($servername, $username, $password, $database);
    
            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
            $query = "SELECT * FROM images ORDER BY id DESC;";
            $result = $connection->query($query); 

            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    ?>

                    <a href="./item_view_page.php?id=<?= $row['id'] ?>" class="item-card">
                        <img src="./assets/images/ring.png" alt="" class="ring">
                        <div class="image-box">
                            <img src="<?= $row['destination'] ?>">
                        </div>
                    </a>

                    <?php
                }
            }
        ?>

    </section>

</body>
</html>