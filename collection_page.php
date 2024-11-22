<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $username = $_SESSION['user'];
} else {
    $username = "SignIn";
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "artae";

$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Search logic
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchResults = [];
if ($searchQuery !== '') {
    $query = "SELECT * FROM images WHERE title LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%'";
    $result = $connection->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
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
    <title>artae - Collection</title>

    <link rel="stylesheet" href="./css/collection/collection.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:ital@0;1&display=swap">
</head>
<body>
    <section class="navigation">
        <?php include "./web_components/nav_bar.php"; ?>
    </section>

    <div class="search-bar-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search for art..." value="<?= htmlspecialchars($searchQuery) ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    
    
    <section class="items-container">
        <?php if (!empty($searchQuery)): ?>
            <?php if (!empty($searchResults)): ?>
                <?php foreach ($searchResults as $row): ?>
                    <a href="./item_view_page.php?id=<?= $row['id'] ?>" class="item-card">
                        <div class="image-box">
                            <img src="<?= $row['destination'] ?>" alt="<?= htmlspecialchars($row['title']) ?>" loading="lazy">
                        </div>
                        <p><?= htmlspecialchars($row['title']) ?></p>
                        <p><?= htmlspecialchars($row['description']) ?></p>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <h2>No results found for "<?= htmlspecialchars($searchQuery) ?>"</h2>
            <?php endif; ?>
        <?php else: ?>  
            <?php
            $query = "SELECT * FROM images ORDER BY date DESC";
            $result = $connection->query($query);
            while ($row = $result->fetch_assoc()): ?>
                <a href="./item_view_page.php?id=<?= $row['id'] ?>" class="item-card">
                    <div class="image-box">
                        <img src="<?= $row['destination'] ?>" alt="<?= htmlspecialchars($row['title']) ?>" loading="lazy">
                    </div>
                    <p class="item-info"><?= htmlspecialchars($row['title']) ?></p>
                    <p class="item-info"><?= htmlspecialchars($row['description']) ?></p>
                </a>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>
</body>
</html>
