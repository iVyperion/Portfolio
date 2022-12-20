<?php

$name = isset($_GET['name']) ? $_GET['name'] : false;
$age = isset($_GET['age']) ? $_GET['age'] : false;

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Thank You</title>
	<meta charset="UTF-8" />
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
			<h1><?php echo '<p>Thank you ' . htmlentities($name) . '</p>'; ?></h1>
			<p>Thanks for getting in contact!</p>
		</section>
		<section>

		</section>
	</main>

	<footer>&copy; Copyright 2022 - Kwinten De Deyn</footer>
	<script src="../js/header.js"></script>
</body>

</html>