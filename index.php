<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>BULO - Accueil</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div class="container">
		<!-- HEADER -->
		<?php
			include "header.php";
		?>
		<!--CAROUSEL-->
		<div class="row">
			<h1 class="header couleur">Nouveautés</h1>
			<div id="carousel-news" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-news" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-news" data-slide-to="1"></li>
					<li data-target="#carousel-news" data-slide-to="2"></li>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="images/LePontFlottantDesSonges.jpg" alt="Le Pont flottant des songes">
						<div class="carousel-caption">
							<p>Le Pont flottant des songes - Junichirô Tanizaki</p>
						</div>
					</div>
					<div class="item">
						<img src="images/JeSuisUnChat.jpg" alt="Je suis un chat">
						<div class="carousel-caption">
							<p>Je suis un chat - Natsume Sôseki</p>
						</div>
					</div>
					<div class="item">
						<img src="images/LeCoupeurDeRoseaux.jpg" alt="Le Coupeur de roseaux">
						<div class="carousel-caption">
							<p>Le Coupeur de roseaux - Junichirô Tanizaki</p>
						</div>
					</div>
				</div>
				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-news" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-news" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
    </div>
	
	<?php
		include "piedDePage.php";
	?>
	<script> headerActive('#accueil'); </script>
  </body>
</html>