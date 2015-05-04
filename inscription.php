<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
		<title> Inscription </title>
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
			?>
			<h1 class="couleur">Inscription</h1>
			
			<form class="form-horizontal" method="POST" >
				<div class="form-group">
					<label for="nomLecteur" class="col-sm-2 control-label"> Nom : </label>
					<div class="col-sm-4"><input type="text" class="form-control" name="nomLecteur" placeholder="Votre nom"></div>
				</div>
				<div class="form-group">
					<label for="prenomLecteur" class="col-sm-2 control-label"> Prenom : </label>
					<div class="col-sm-4"><input type="text" class="form-control" name="prenomLecteur" placeholder="Votre prénom"></div>
				</div>
				<div class="form-group">
					<label for="numCategorie" class="col-sm-2 control-label"> Categorie Lecteur : </label>
					<div class="col-sm-4">
						<select class="form-control" name= "numCategorie" id="numCategorie">  <option value="">  </option>
								
									<?php
										$result = $Bibli->query("SELECT numCategorie, libelleCategorie FROM categorie");
										
										while($row = $result->fetch_assoc())
										{
											echo "<option value='".$row['numCategorie']."'>".$row['libelleCategorie']."</option>";
										}
									?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="mailLecteur" class="col-sm-2 control-label"> e-mail : </label>
					<div class="col-sm-4"><input type="email" class="form-control" name="mailLecteur" placeholder="Votre adresse email"></div>
				</div>
				<div class="form-group">
					<label for="date" class="col-sm-2 control-label"> Date inscription : </label>
					<div class="col-sm-4"><p class="form-control-static"><?php  echo date('Y-m-d')?></p></div>
				</div>
				<div class="form-group">
					<label for="login" class="col-sm-2 control-label"> Login : </label>
					<div class="col-sm-4"><input type="text" class="form-control" name="login" placeholder="Votre identifiant"></div>
				</div>
				<div class="form-group">
					<label for="pwd" class="col-sm-2 control-label"> password : </label>
					<div class="col-sm-4"><input type="text" class="form-control" name="pwd" placeholder="Votre mot de passe"></div>
				</div>
				<div class="form-group">
					<div class="col-sm-1 col-sm-offset-2"><button type="submit" class="btn btn-violet" name="submit">Valider</button></div>
				</div>
			</form>
	
	<?php

		if (isset($_POST['nomLecteur'], $_POST['prenomLecteur'], $_POST['numCategorie'], $_POST['mailLecteur'], $_POST['login'], $_POST['pwd']) 
			&& (!empty($_POST['nomLecteur'])) && (!empty($_POST['prenomLecteur'])) && (!empty($_POST['numCategorie'])) && (!empty($_POST['mailLecteur'])) 
			&& (!empty($_POST['login'])) && (!empty($_POST['pwd'])))
			{

			$stmt = $Bibli->prepare('SELECT nomLecteur, prenomLecteur, numCategorie, mailLecteur, dateInscription, login, mdp
									 FROM lecteur
				 					 WHERE lower(nomLecteur) = ? AND lower(prenomLecteur) = ?');

			$nom = $_POST['nomLecteur'];
			$prenom = $_POST['prenomLecteur'];
			$stmt -> bind_param('ss', $nom, $prenom);
			$stmt -> execute();
			$stmt -> store_result();
			$stmt -> bind_result($nom, $prenom, $cat, $mail, $dat, $log, $mdp);

			if($stmt -> num_rows == 0)
			{
				$stmtLog = $Bibli->prepare("SELECT '...' FROM dual WHERE lower(?) IN (SELECT lower(login)FROM lecteur) OR lower(?) IN (SELECT lower(login)FROM lecteur)");
				$stmtLog->bind_param('ss',$_POST['login'],$_POST['login']);
				$stmtLog->execute();
				/*
				$stmtL = $Bibli->prepare("SELECT numLecteur FROM lecteur WHERE lower(login)=lower(?)");
				$stmtL->bind_param('s',$_POST['login']);
				$stmtL->execute();
				$stmtB = $Bibli->prepare("SELECT numBibliothecaire FROM bibliothecaire WHERE lower(login)=lower(?)");
				$stmtB->bind_param('s',$_POST['login']);
				$stmtB->execute();
				*/
				if($stmtLog->fetch()){
					echo "Ce login est déjà pris.";
				}
				else{
					$stmt = $Bibli->prepare("INSERT INTO lecteur VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
					$stmt->bind_param('ississss', $num, $log, $mdp, $cat, $nom, $prenom, $mail, $dat);

					$num = '';
					$log = $_POST['login'];
					$salt = '$5$buloprotectpwd$';
					$mdp = crypt($_POST['pwd'],$salt);
					$cat = $_POST['numCategorie'];
					$nom =$_POST['nomLecteur'];
					$prenom = $_POST['prenomLecteur'];
					$mail = $_POST['mailLecteur'];
					$dat = date('y/m/d');

					$stmt->execute();
				
				
					echo "vous êtes inscrit ! ";
					echo "<br/> Votre login de connexion est : ".$log;
					echo "<br> votre mot de passe est : ".$_POST['pwd'];
				}
	        }  
	        else{
	             	echo "vous êtes déjà inscrit";
	        }     
	    }
		else if($_SERVER['REQUEST_METHOD'] == "POST"){
			echo "Veuillez remplir tous les champs.";
		}
	?>
		</div>
		<?php
			include "piedDePage.php";
		?>
		<script> headerActive('#compte'); </script>
	</body>
</html>