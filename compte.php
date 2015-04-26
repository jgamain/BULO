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
				include "connectBibli.php";
				$log = $_POST['login'];
				$mdp = $_POST['pwd'];
				$stmt = $Bibli->prepare('SELECT numLecteur FROM lecteur WHERE lower(login)=lower(?) AND lower(mdp)=lower(?)');
				$stmt->bind_param("ss", $log, $mdp);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($numUtilisateur);
				if($stmt->num_rows!= 0){
					$stmt->fetch();
					header("Location: compteLecteur.php?numUtilisateur=$numUtilisateur");
					exit();
					
				
				}	
				else{
					$stmt=$Bibli->prepare('SELECT numBibliothecaire FROM bibliothecaire WHERE lower(login)=lower(?) AND lower(mdp)=lower(?)');
					$stmt->bind_param("ss", $log, $mdp);
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($numUtilisateur);
					if($stmt->num_rows!= 0){
						$stmt->fetch();
						header("Location: compteBibli.php?numUtilisateur=$numUtilisateur");
						exit();
					
					
					}
					else{
						echo "Erreur sur le login ou mdp";
					}
				}
			?>
		</div>
		
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script src="script.js" ></script>
		<script> headerActive('#compte'); </script>
	</body>
 </html>