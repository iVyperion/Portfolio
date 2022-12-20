<?php

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'kwinten');
define('DB_PASS', 'kDed6Ws82004*');
define('DB_NAME', 'kwinten_dedeyn_');


date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' .  $e->getMessage();
    exit;
}

// Opvragen van alle taken uit de tabel tasks
$stmt = $db->prepare('SELECT * FROM messages ORDER BY added_on DESC');
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <title>Mijn berichten</title>
    <link href="https://unpkg.com/@csstools/normalize.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link rel="stylesheet" href="../css/reset.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/716d612898.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/master.css">
</head>

<body>
    <header id="navbar">
        <a href="./">Kwinten De Deyn</a>
        <ul>
            <li><a href="../">Home</a></li>
            <li><a href="../">Projects</a></li>
            <li><a href="../about/">About</a></li>
            <li><a href="../blog/">Blog</a></li>
            <li><a href="../contact/">Contact</a></li>
        </ul>
    </header>
    <main>
        <section class="intro-default">
            <h1>My Messages</h1>
        </section>
        <section>
            <?php if (sizeof($items) > 0) { ?>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Message</th>
                        <th>Email</th>
                        <th>Gate</th>
                        <th>Date</th>
                    </tr>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td><?php echo htmlentities($item['sender']); ?></td>
                            <td><?php echo htmlentities($item['message']); ?></td>
                            <td><?php echo htmlentities($item['email']); ?></td>
                            <td><?php echo htmlentities(str_replace(',', '', $item['gate'])); ?></td>
                            <td><?php echo (new Datetime($item['added_on']))->format('d-m-Y H:i:s'); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php
            } else {
                echo '<p>Nog geen berichten ontvangen.</p>' . PHP_EOL;
            }
            ?>
        </section>
    </main>

    <footer>&copy; Copyright 2022 - Kwinten De Deyn</footer>
    <script src="../js/header.js"></script>
</body>

</html>