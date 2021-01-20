<?php

require('inc/config.php');

session_start();
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>AFLMW Home Page</title>
	<link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/index2.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script defer src="assets/js/index.js"></script>
</head>

<body>
	<main>
		<div class="banner">
			<img src="assets/images/logo.png" alt="logo">
		</div>

		<div class="head-img-1">
			<div class="caption">
				<span class="border">AFLMW STORE</span>
			</div>
		</div>

		<div style="color: #777;background-color:white;padding:50px 80px;text-align: justify;">
			<div class="slogan"><br>
				<h3>Mission and Vision</h3><br>
				<p>Providing satisfactory on customer need to ease your shopping experience</p>
			</div>
		</div>

		<div class="head-img-2">

		</div>

		<div class="img-container">

			<div class="imgslider">
				<slider>
					<slide>
						<p>&nbsp;</p>
					</slide>
					<slide>
						<p>&nbsp;</p>
					</slide>
					<slide>
						<p>&nbsp;</p>
					</slide>
					<slide>
						<p>&nbsp;</p>
					</slide>
				</slider>
			</div>

		</div>

		<!--put the auto slider inside this class here?-->


		<div class="head-img-1">
			<div class="caption">
				<span class="border">AFLMW STORE</span>
			</div>
		</div>

		<div class="moving-letters">
			<h1 class="ml15">
				<span class="word">Every shot </span><br>
				<span class="word">is </span><br>
				<span class="word">priceless</span>
			</h1>
		</div>
	</main>

	<?php require('inc/navBar.php'); ?>

</body>

</html>