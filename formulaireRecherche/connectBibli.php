<?php
/* Le nom de la BD et le mot de passe sont à changer en fonction des configurations de chacune */
	$host = "localhost";
	$user = "root";
	$bdd = "bibliotheque";
	$passwd = "";
	$Bibli = new mysqli($host,$user,$passwd,$bdd);
	if ($Bibli->connect_errno) {
		echo "Echec lors de la connexion à MySQL : (" . $Bibli->connect_errno . ") " . $Bibli->connect_error;
	}
?>