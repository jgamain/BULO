<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
		<title> Ajouter un livre </title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<?php
				include "header.html";
				include "connectBibli.php";
				
				if (isset($_POST['titre']) && (!empty($_POST['titre']))){
					$titre = $_POST['titre'];
					if(isset($_POST['nbPages']) && (!empty($_POST['nbPages'])) && filter_var($_POST['nbPages'], FILTER_VALIDATE_INT)!==false)
					// filter_var($_POST['nbPages'], FILTER_VALIDATE_INT) renvoie false si la variable n'est pas un nombre, sinon renvoie le nombre
						$nbPages = $_POST['nbPages'];
					else
						$nbPages = NULL;
					if(isset($_POST['annee']) && (!empty($_POST['annee'])) && filter_var($_POST['nbPages'], FILTER_VALIDATE_INT)!==false)
						$annee = $_POST['annee'];
					else
						$annee = NULL;
					if(isset($_POST['description']) && (!empty($_POST['description'])))
						$description = $_POST['description'];
					else
						$description = NULL;
					if($_POST['genre']!=="")
						$numGenre = $_POST['genre'];
					else
						$numGenre = NULL;
					if($_POST['collection']!=="")
						$numCollection = $_POST['collection'];
					else{
						//insertion si nouvelle collection
						if(isset($_POST['newCollection']) && (!empty($_POST['newCollection']))){
							$newCollection=$_POST['newCollection'];
							$stmt = $Bibli->prepare('INSERT INTO collection(nomCollection) VALUES (?)');
							$stmt->bind_param('s', $newCollection);
							$stmt->execute();
							//Récupération du numéro de la nouvelle collection
							$stmt = $Bibli->prepare('SELECT numCollection FROM collection WHERE nomCollection=?');
							$stmt->bind_param('s', $newCollection);
							$stmt->execute();
							$stmt->store_result();
							$stmt->bind_result($numCollection);
							$stmt->fetch();
						}
						else
							$numCollection = NULL;
					}
						
					//Ajout à la base de données
					$stmt = $Bibli->prepare('INSERT INTO livre (titre, nbPage, description, numGenre, numCollection, anneeEdition) VALUES(?,?,?,?,?,?)');
					$stmt->bind_param('sisiii', $titre, $nbPages, $description, $numGenre, $numCollection, $annee);
					$stmt->execute();
					
				}
			?>
		</div>
	</body>
</html>