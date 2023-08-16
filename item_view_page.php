<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        $username = $_SESSION['user'];
    }else {
        $username = "SignIn";
    }

    $id = $_GET['id'];

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

    $query = "SELECT * FROM images WHERE id = '$id'";
    $result = $connection->query($query); 
     if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $title = $row['title'];
            $user = $row['user'];
            $description = $row['description'];
            $ImageLocation = $row['destination'];

            $date = $row['date'];
            $dateArray = explode('-', $date);
            $month = $dateArray[1];
            switch ($month) {
                case '01':
                    $monthString = 'Jan';
                    break;
                case '02':
                    $monthString = 'Feb';
                    break;
                case '03':
                    $monthString = 'Mar';
                    break;
                case '04':
                    $monthString = 'Apr';
                    break;
                case '05':
                    $monthString = 'May';
                    break;
                case '06':
                    $monthString = 'Jun';
                    break;
                case '07':
                    $monthString = 'Jul';
                    break;
                case '08':
                    $monthString = 'Aug';
                    break;
                case '09':
                    $monthString = 'Sept';
                    break;
                case '10':
                    $monthString = 'Oct';
                    break;
                case '11':
                    $monthString = 'Nov';
                    break;
                case '12':
                    $monthString = 'Dec';
                    break;
                default:
                    $monthString = 'Invalid month';
            }
            $day = $dateArray[0];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>artae - view</title>

    <!-- linking css -->
    <link rel="stylesheet" href="./css/item_view/item_view.css">

    <!-- linking custom font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://www.dafontfree.net/embed/aW1wcmludC1tdC1zaGFkb3ctcmVndWxhciZkYXRhLzI1L2kvMTI5NjcxL0ltcHJpbnRNVFNoYWRvdy50dGY" rel="stylesheet" type="text/css"/>

    <script src="./javascript/item_view.js"></script>
</head>
<body>

    <section class="navigation">
        <?php include "./web_components/nav_bar.php"; ?>
    </section>

    <section class="item-view-container">

        <div class="image-view-box">
            <div class="image">
                <img src="<?= $ImageLocation ?>" alt="">
            </div>
            <div class="info-container">
                <div class="item-header">
                    <p class="title"><?= $title ?></p>
                    <p class="artist">By <?= $user ?></p>
                </div>
                <p class="item-description">
                    <?= $description ?>
                </p>
                <div class="date">
                    <div class="delete-button">
                    <?php
                        $mquery = "SELECT * FROM images WHERE id = '$id'";
                        $mresult = $connection->query($mquery);
                        if ($result) {
                            while ($row = mysqli_fetch_array($mresult)) {
                                $uploader = $row['user'];
                            }
                        }else {
                            $uploader = null;
                        }
                        if ($username == $uploader) {
                            ?>
                            <a href="./web_components/delete_item.php?id=<?= $id ?>&destination=<?= $ImageLocation ?>" class="delete">
                                <img src="./assets/images/delete-icon-gold.png" alt="">
                            </a>
                            <?php
                        }
                    ?>
                    </div>
                    <p><?= $monthString ?><span> '<?= $day ?></span></p>
                </div>
            </div>
        </div>

    </section>

</body>
</html>