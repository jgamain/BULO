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
				include "connectBibli.php";
				$log = $_POST['login'];
				$salt = '$5$buloprotectpwd$';
				$mdp = crypt($_POST['pwd'],$salt);
				$stmt = $Bibli->prepare('SELECT numLecteur, nomLecteur, prenomLecteur FROM lecteur WHERE lower(login)=lower(?) AND lower(mdp)=lower(?)');
				$stmt->bind_param("ss", $log, $mdp);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($numLecteur, $nomLecteur, $prenomLecteur);
				if($stmt->num_rows!= 0){
					$stmt->fetch();
					$_SESSION['numLecteur']=$numLecteur;
					$_SESSION['nomLecteur']=ucfirst(strtolower($nomLecteur));
					$_SESSION['prenomLecteur']=ucfirst(strtolower($prenomLecteur));
					header("Location: compteLecteur.php");
					exit();
					
				
				}	
				else{
					$stmt=$Bibli->prepare('SELECT numBibliothecaire, nomBibliothecaire, prenomBibliothecaire FROM bibliothecaire WHERE lower(login)=lower(?) AND lower(mdp)=lower(?)');
					$stmt->bind_param("ss", $log, $mdp);
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($numBibliothecaire, $nomBibliothecaire, $prenomBibliothecaire);
					if($stmt->num_rows!= 0){
						$stmt->fetch();
						$_SESSION['numBibliothecaire']=$numBibliothecaire;
						$_SESSION['nomBibliothecaire']=ucfirst(strtolower($nomBibliothecaire));
						$_SESSION['prenomBibliothecaire']=ucfirst(strtolower($prenomBibliothecaire));
						header("Location: compteBibli.php");
						exit();
					
					
					}
					else{
						echo "<p>Erreur sur le login ou de mot de passe.</p>";
					}
				}
			?>
		</div>
		
		<?php
			include "piedDePage.php";
		?>
		<script> headerActive('#compte'); </script>
	</body>
 </html>