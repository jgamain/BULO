<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>BULO - Catalogue</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<?php
				include "header.php";
				$_SESSION = array();
				session_destroy();
			?>
			<p>Vous êtes maintenant déconnecté.</p>
		</div>
		<?php
			include "piedDePage.php";
		?>
		<script> headerActive('#compte'); </script>
	</body>
 </html>