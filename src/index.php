<?php
	if (isset($_GET['q'])) {
		$urls = file_get_contents('php/urls.json');
		$urls = json_decode($urls, true);

		if (in_array($_GET['q'], $urls)) {
			header('Location: '.array_search($_GET['q'], $urls));
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Simple URL shortener; Make your links short and readable!</title>

		<!--CSS Sources-->
		<link rel="stylesheet" href="css/Main.css">

		<!--JS Sources-->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<script src="js/Main.js"></script>

		<!--Properties-->
		<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body>
		<div class="content">
			<h1><span><</span><span>/></span> URL shortener</h1>

			<!--Input-->
			<div class="input"><input type="text" id="url" inputmode="url" placeholder="Input your URL" autocomplete="off"></div>
			<button onclick="ShortIt();">Make it short!</button>
		</div>
	</body>
</html>