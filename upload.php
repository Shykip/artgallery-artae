<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['user']) && empty($_SESSION['user'])) {
        header('Location: ./login_page.php');
    }

    include('./database/Database.php');
    $database = new Database();

    if (isset($_POST['submit'])) {
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 10000000) {
                    $uploaderName = $_SESSION['user'];
                    $fileNameNew = uniqid('', true).$fileName."-".$uploaderName.".".$fileActualExt;
                    $fileDestination = "database/uploads/".$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $date = $_POST['date'];

                    $database->imageInsert($title, $description, $date, $uploaderName, $fileDestination);
                    header('Location: ./collection_page.php', true, 303);
                    exit;
                } else {
                    echo '<script type="text/javascript"> alert("Image is too large")</script>';
                }
            }else {
                echo '<script type="text/javascript"> alert("There was an error uploading you file")</script>';
            }
        }else {
            echo '<script type="text/javascript"> alert("This type of file is not supported")</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>artae - profile</title>
    <!-- linking css -->
    <link rel="stylesheet" href="./css/upload/upload.css">
    <!-- linking custom font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://www.dafontfree.net/embed/aW1wcmludC1tdC1zaGFkb3ctcmVndWxhciZkYXRhLzI1L2kvMTI5NjcxL0ltcHJpbnRNVFNoYWRvdy50dGY" rel="stylesheet" type="text/css"/>
</head>
<body>
    <sectiom class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title" required autofocus autocomplete="off" maxlength="30">
            <textarea name="description" placeholder="Description" class="description" required autocomplete="off" maxlength="5000"></textarea>
            <input type="date" name="date" required autocomplete="off" class="date">
            <input type="file" name="file" required class="file">
            <input type="submit" class="submit" name="submit" value="submit">
        </form>
    </sectiom>
</body>
</html>