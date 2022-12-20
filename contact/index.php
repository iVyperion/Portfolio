<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/@csstools/normalize.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link rel="stylesheet" href="../css/reset.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/716d612898.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/master.css">
    <link rel="stylesheet" href="../css/contact.css">
    <title>Contact</title>
</head>

<body>
    <header id="navbar">
        <a href="./">Kwinten De Deyn</a>
        <ul>
            <li><a href="../">Home</a></li>
            <li><a href="">Projects</a></li>
            <li><a href="../about/">About</a></li>
            <li><a href="../blog/">Blog</a></li>
            <li><a href="../contact/">Contact</a></li>
        </ul>
    </header>
    <main>
        <section class="intro-default">
            <h1>Contact me</h1>
            <p>You have a question or want to work toghether ... get in contact!</p>
        </section>
        <section class="container">
            <?php

            // Show all errors (for educational purposes)
            ini_set('error_reporting', E_ALL);
            ini_set('display_errors', 1);

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
                echo 'Verbindingsfout: ' . $e->getMessage();
                exit;
            }

            $name = isset($_POST['name']) ? (string)$_POST['name'] : '';
            $message = isset($_POST['message']) ? (string)$_POST['message'] : '';
            $email = isset($_POST['email']) ? (string)$_POST['email'] : '';
            $friends = isset($_POST['friends']) ? "friends," : '';
            $socialmedia = isset($_POST['socialmedia']) ? "socialmedia," : '';
            $google = isset($_POST['google']) ? "google," : '';
            $other = isset($_POST['other']) ? "other," : '';
            $gate = '';
            $gate .= $friends;
            $gate .= $socialmedia;
            $gate .= $google;
            $gate .= $other;
            $msgName = '';
            $msgMessage = '';
            $msgEmail = '';
            $msgGate = '';

            // form is sent: perform formchecking!
            if (isset($_POST['btnSubmit'])) {

                $allOk = true;

                // name not empty
                if (trim($name) === '') {
                    $msgName = 'Please enter a name';
                    $allOk = false;
                }

                if (trim($message) === '') {
                    $msgMessage = 'Please enter a message';
                    $allOk = false;
                }

                if (trim($email) === '') {
                    $msgEmail = 'Please enter a email';
                    $allOk = false;
                }

                if ($gate === '') {
                    $msgGate = 'Please choose an option';
                    $allOk = false;
                }

                // end of form check. If $allOk still is true, then the form was sent in correctly
                if ($allOk) {
                    // build & execute prepared statement
                    $stmt = $db->prepare('INSERT INTO messages (sender, email, message, added_on, gate) VALUES (?, ?, ?, ?, ?)');
                    $stmt->execute(array($name, $email, $message, (new DateTime())->format('Y-m-d H:i:s'), $gate));

                    // the query succeeded, redirect to this very same page
                    if ($db->lastInsertId() !== 0) {
                        header('Location: formchecking_thanks.php?name=' . urlencode($name));
                        exit();
                    } // the query failed
                    else {
                        echo 'Databankfout.';
                        exit;
                    }
                }
            } ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <h1>ContactForm</h1>
                <p class="message">All fields are required, unless declared otherwise</p>

                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlentities($name); ?>" class="input-text" />
                    <span class="message error"><?php echo $msgName; ?></span>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" rows="5" cols="40"><?php echo htmlentities($email); ?></textarea>
                    <span class="message error"><?php echo $msgEmail; ?></span>
                </div>
                <div>
                    <label for="message">Message</label>
                    <textarea name="message" id="message" rows="5" cols="40"><?php echo htmlentities($message); ?></textarea>
                    <span class="message error"><?php echo $msgMessage; ?></span>
                </div>
                <div class="form-checkbox">
                    <div>
                        <label for="Gate">How did you find me?</label>
                        <span class="message error"><?php echo $msgMessage; ?></span>
                    </div>

                    <div>
                        <input type="checkbox" name="friends" id="friends" value="friends">
                        <label for="friends">Friends</label>
                    </div>

                    <div>
                        <input type="checkbox" name="social-media" id="social-media" value="social-media">
                        <label for="social-media">Social Media</label>
                    </div>
                    <div>
                        <input type="checkbox" name="google" id="google" value="google">
                        <label for="google">Google</label>
                    </div>
                    <div>
                        <input type="checkbox" name="other" id="other" value="other">
                        <label for="other">Other</label>
                    </div>
                    <span class="message error"><?php echo $msgGate; ?></span>
                </div>
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Send" />
            </form>
        </section>
    </main>
    <footer>&copy; Copyright 2022 - Kwinten De Deyn</footer>
    <script src="../js/header.js"></script>
</body>

</html>