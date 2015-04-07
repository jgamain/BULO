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
		<!-- HEADER -->
		<div class="header row">
			<div class="navbar navbar-default navbar-fixed-top">
				<div class="navbar-inner">
					<h1 class="navbar-header">
						<a class="navbar-brand" href="index.html">
							<img src="images/logo.jpg" alt="BULO" class="logo">
						</a>
					</h1>
					<ul class="nav navbar-nav pull-right">
						<li>
							<a href="index.html">
								<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
								<br />Accueil
							</a>
						</li>
						<li class="active">
							<a href="catalogue.php">
								<span class="glyphicon glyphicon-book" aria-hidden="true"></span>
								<br />Catalogue
							</a>
						</li>
						<li class="popover-markup">
							<a href="#" class="trigger" data-placement="bottom">
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
								<br />Se connecter
								<div class="content hide">
									<form method="post" class="form-popover">
										<div class="form-group">
											<label for="login">Login</label>
											<input type="text" class="form-control" id="login" placeholder="Entrez votre login">
										</div>
										<div class="form-group">
											<label for="pwd">Mot de passe</label>
											<input type="text" class="form-control" id="pwd" placeholder="Entrez votre mot de passe">
										</div>
										<div class="form-group">
											<button type="button" class="btn btn-info">Connexion</button>
										</div>
									</form>
									<a href="#">Vous n'êtes pas encore inscrit ?</a>
								</div>
							</a>
						</li>
						<li class="dropdown">
							<a data-toggle="dropdown">
								<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
								<br />Infos pratiques<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">Horaires et accès</a></li>
								<li><a href="#">Règlement intérieur et tarifs</a></li>
								<li><a href="#">Nous contacter</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
		
		<!-- INFORMATIONS SUR LE LIVRE -->
		
			<?php

	include "connectBibli.php";
	$stmt = $Bibli->prepare('SELECT titre, nomAuteur, prenomAuteur, nomTraducteur, prenomTraducteur, nomEditeur, nomCollection, anneeEdition, libelleLangue, libelleGenre, nbPage, description
							 FROM livre NATURAL JOIN ecrit NATURAL JOIN auteur NATURAL LEFT JOIN traduit NATURAL LEFT JOIN traducteur NATURAL JOIN edite NATURAL JOIN editeur NATURAL LEFT JOIN collection NATURAL JOIN est_ecrit_en NATURAL JOIN langue NATURAL LEFT JOIN genre
							  WHERE numLivre= ?');
	
	$stmt->bind_param("i", $_GET['numero']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($titre, $nomAuteur, $prenomAuteur, $nomTraducteur, $prenomTraducteur, $nomEditeur, $nomCollection, $anneeEdition, $libelleLangue, $libelleGenre, $nbPage, $description);
	
		if($stmt->num_rows == 0)
		{
			echo "Livre introuvable";
		}
	
	while ($stmt->fetch())
	{
			echo "Auteur : ".$nomAuteur." ".$prenomAuteur;
            echo "<br /> Titre :  ".$titre;
            echo "<br /> Traducteur : ".$nomTraducteur." ".$prenomTraducteur;
            echo "<br /> Collection : ".$nomCollection;
            echo "<br /> Editeur : ".$nomEditeur." Année d'édition : ".$anneeEdition;
            echo "<br>";
          
	}
	?>
		
		
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script>
			$('.popover-markup>.trigger').popover({
				html: true,
				/*
				title: function () {
					return $(this).parent().find('.head').html();
				},
				*/
				content: function () {
					return $(this).parent().find('.content').html();
				}
			});
			$( 'ul.navbar-nav li' ).on('mouseenter mouseleave', function(){
				$(this).toggleClass('btn-violet');
			});
			$( 'h3 a' ).click( function(){
				$('form').toggleClass('hidden').toggleClass('show');
			});
			
		</script>
		
	</body>
</html>