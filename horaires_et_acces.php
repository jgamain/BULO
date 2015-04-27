<?php
session_start();
// On inclut la classe de Google Maps pour générer ensuite la carte.
require('GoogleMapAPI.class-2.php');

//On crée une nouvelle carte; Ici, notre carte sera $map.
$map = new GoogleMapAPI('map');

//On ajoute la clef de Google Maps.
$map->setAPIKey('AIzaSyCMSKEunH5Z9VdlkK6iuz7PwzSC75_e4H0');
    
//les caractéristiques de la carte.
$map->setWidth("500px");
$map->setHeight("500px");
$map->setCenterCoords ('2', '48');
$map->setZoomLevel (100);

$map-> enableOverviewControl();
$map->setMapType('hybrid');
$map->disableDirections();

$map->addMarkerByCoords( 2.40, 48.865, "BULO", "<em>BULO : Bibliotheque de litterature japonnaise</em>", "BULO"); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
 <html lang="fr" xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title> Horaire et accès </title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
		<?php $map->printHeaderJS(); ?>
		<?php $map->printMapJS(); ?>
	</head>
	<body onload="onLoad();">
		<div class="container">
			<!-- HEADER -->
			<?php
				include "header.php";
			?>
			
			<h1 class="couleur centre"> Horaire et accès à la bibliothèque </h1>

			<h2 class="couleur">Horaires d'ouvertures</h2>

			<p> <strong> La bibibliothèque est ouverte :</strong> du lundi au samedi de 10h00 à 22H00</p>

			<h2 class="couleur">Fermetures de l'établissement en 2015 </h2>

			<ul> 
				<li>Jeudi 1er janvier</li>
				<li>Lundi 6 avril</li>
				<li>vendredi 1er mai</li>
				<li>vendredi 8 mai</li>
				<li>jeudi 14 mai</li>
				<li>lundi 25 mai</li>
				<li>mardi 14 juillet</li>
				<li>samedi 15 Août</li>
				<li>mercredi 11 novemebre</li>
			</ul>

			<h2 class="couleur">Fermetures annuelles</h2>

			<ul>
				<li><strong>Eté : </strong> du samedi 8 août 2015 au lundi 31 août 2015</li>
				<li><strong>Hiver : </strong> du jeudi 24 décembre 2015 au lundi 4 janvier 2015</li>

			</ul>	

			<h1 class="couleur">Accès</h1>
			<ul>
			<li> <strong> Métro : </strong> Ligne 3 (Gambetta) </li>
			<li> <strong> Bus : </strong> 27, 62, 64, 89, 132, 325, N131. </li>
			</ul>
			<?php $map->printMap(); ?>
			
		</div>
		
		<?php
			include "piedDePage.php";
		?>
		<script> headerActive('#infos'); </script>
	</body>
</html>