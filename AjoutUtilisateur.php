<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
 <html lang="fr" xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
		<title> AjoutUtilisateur </title>
	</head>
	<body>

	<?php
		$host = "localhost";
		$user = "root";
		$bdd = "BULO";
		$passwd = "root";
		$Bibli = new mysqli($host,$user,$passwd,$bdd);
			if ($Bibli->connect_errno) {
			echo "Echec lors de la connexion à MySQL : (" . $Bibli->connect_errno . ") " . $Bibli->connect_error;
		}
		$Bibli->set_charset('utf8');

	?>

	<form method="POST" >
	<label for="nomLecteur"> Nom : </label> <input type="text" name="nomLecteur"> <br /> 
	<label for="prenomLecteur"> Prenom : </label> <input type="text" name="prenomLecteur"> <br /> 
	<label for="numCategorie"> Categorie Lecteur : </label>
	<select name= "numCategorie" id="numCategorie">  <option value="">  </option>
			
				<?php
					$result = $Bibli->query("SELECT numCategorie, libelleCategorie FROM categorie");
					
					while($row = $result->fetch_assoc())
					{
						echo "<option value='".$row['numCategorie']."'>".$row['libelleCategorie']."</option>";
					}
				?>
	</select><br>
	<label for="mailLecteur"> e-mail : </label> <input type="email" name="mailLecteur"> <br /> 
	<label for="date"> Date inscription : </label> <input type="text" name="date" value="<?php  echo date('Y-m-d')?>" <br />
	<br>
	<label for="login"> Login : </label> <input type="text" name="login"> <br /> 
	<label for="pwd"> password : </label> <input type="text" name="pwd"> <br />
	<input type="submit" value="valider" name="submit"> <br/>
	</form>

	<?php

		if (isset($_POST['nomLecteur'], $_POST['prenomLecteur'], $_POST['numCategorie'], $_POST['mailLecteur'], $_POST['date'], $_POST['login'], $_POST['pwd']) 
			&& (!empty($_POST['nomLecteur'])) && (!empty($_POST['prenomLecteur'])) && (!empty($_POST['numCategorie'])) && (!empty($_POST['mailLecteur'])) 
			&& (!empty($_POST['date'])) && (!empty($_POST['login'])) && (!empty($_POST['pwd'])))
		{
			$result = var_dump($_POST);
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
				$stmt = $Bibli->prepare("INSERT INTO lecteur VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param('ississss', $num, $log, $mdp, $cat, $nom, $prenom, $mail, $dat);

				$num = '';
				$log = $_POST['login'];
				$mdp = $_POST['pwd'];
				$cat = $_POST['numCategorie'];
				$nom =$_POST['nomLecteur'];
				$prenom = $_POST['prenomLecteur'];
				$mail = $_POST['mailLecteur'];
				$dat = $_POST['date'];

		       	mysqli_stmt_execute($stmt);
	        }  
	        else 
	        {
	             	echo "vous êtes déjà inscrit";
	        }     
        }  


	?>

	</body>
	</html>