<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
 <html lang="fr" xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
		<title> moteur de recherche </title>
	</head>
	<body>

<?php
	$host = "localhost";
	$user = "root";
	$bdd = "bibliotheque";
	$passwd = "root";
	$Bibli = new mysqli($host,$user,$passwd,$bdd);
		if ($Bibli->connect_errno) {
		echo "Echec lors de la connexion à MySQL : (" . $Bibli->connect_errno . ") " . $Bibli->connect_error;
	}

	$Bibli->set_charset('utf8');

?>


<form method="POST" >
<label for="author"> Auteur : </label> <input type="text" name="author"> <br /> 
<label for="title"> Titre : </label>  <input type="text" name="title"><br /> 
<label for="genre"> Genre : </label> <select name="genre"> 
<option> </option>
<option value="histoire"> Histoire </option>
<option value="roman"> Roman </option>
<option value="essai"> Essai </option>
<option value="poesie"> Poesie </option>
<option value="comte"> Conte </option>
<option value="dictionnaire"> Dictionnaire </option>
<option value="biographie"> Biographie </option>
<option value="auto-biographie"> Auto-biographie </option>
<option value="theatre"> theatre </option>
<br/>
<input type="submit" value="rechercher" name="submit">
</form>


<?php


if (isset($_POST['title'], $_POST['author']) && (!empty($_POST['title'])) && (!empty($_POST['author'])) )
{
	$stmt = $Bibli->prepare('SELECT nomAuteur, prenomAuteur, titre
							 FROM livre NATURAL JOIN ecrit NATURAL JOIN auteur 
							 UNION
						     SELECT nomAuteur, prenomAuteur, titre
							 FROM livre_electronique NATURAL JOIN livre NATURAL JOIN ecrit NATURAL JOIN auteur
							 WHERE lower(titre) LIKE lower(?) AND lower(nomAuteur) = ? ');
	
	$tit= "%".$_POST['title']."%";
	$auteur= $_POST['author'];
	$stmt->bind_param("ss", $tit, $auteur);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($nomAuteur, $prenomAuteur, $titre);
	
	if($stmt->num_rows== 0)
			{
				echo "aucune réponse pour Titre : ".$tit."et pour Auteur : ".$auteur;
				echo "<br />";
			}

	while ($stmt->fetch())
	{
			echo "Auteur : ".$nomAuteur." ".$prenomAuteur;
            echo "<br /> Titre :  ".$titre;
            echo "<br>";
          
	}
	

}
else if (isset($_POST['title']) && (!empty($_POST['title'])) )
{
	if ($stmt = $Bibli->prepare('SELECT nomAuteur, prenomAuteur, titre 
								 FROM livre NATURAL JOIN ecrit NATURAL JOIN auteur 
								 UNION
								 SELECT nomAuteur, prenomAuteur, titre
								 FROM livre_electronique NATURAL JOIN livre NATURAL JOIN ecrit NATURAL JOIN auteur
								 WHERE lower(titre) LIKE lower(?)'))
	{
		$titre = "%".$_POST['title']."%";
		$stmt->bind_param("s", $titre);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($nomAuteur, $prenomAuteur, $titre);

			if($stmt->num_rows== 0)
			{
				echo "aucune réponse pour le Titre : ".$titre;
				echo "<br />";
			}

			while ($stmt->fetch())
			{
				 echo "Auteur : ".$nomAuteur." ".$prenomAuteur;
                 echo "<br /> Titre :  ".$titre;
                 echo "<br />";
			}
	}
}
else if (isset($_POST['genre'], $_POST['author']) && (!empty($_POST['genre'])) && (!empty($_POST['author'])) )
{
		$stmt = $Bibli->prepare('SELECT nomAuteur, prenomAuteur, titre 
							 	FROM genre NATURAL JOIN livre NATURAL JOIN ecrit NATURAL JOIN auteur 
							 	WHERE lower(libelleGenre) LIKE lower(?) AND lower(nomAuteur) = ? ');
		$genre=$_POST['genre'];
		$auteur= $_POST['author'];
		$stmt->bind_param("ss", $genre, $auteur);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($nomAuteur, $prenomAuteur, $titre);

			if($stmt->num_rows== 0)
			{
				echo "aucune réponse pour Genre : ".$genre." et Auteur : ".$auteur;
				echo "<br />";
			}
	
			while ($stmt->fetch())
			{
				 echo "Auteur : ".$nomAuteur." ".$prenomAuteur;
                 echo "<br /> Titre :  ".$titre;
                 echo "<br />";
			}
}	
else if (isset($_POST['author']) && (!empty($_POST['author'])) )
{

		$stmt = $Bibli->prepare('SELECT nomAuteur, prenomAuteur, titre 
								 FROM livre NATURAL JOIN ecrit NATURAL JOIN auteur 
								 WHERE lower(nomAuteur) = ?');
		
		$auteur =  $_POST['author'];
		$stmt->bind_param("s", $_POST['author']);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($nomAuteur, $prenomAuteur, $titre);

			if($stmt->num_rows== 0)
			{
				echo "aucune réponse pour Auteur : ".$auteur;
				echo "<br />";
			}

			while ($stmt->fetch())
			{
				echo "Auteur : ".$nomAuteur." ".$prenomAuteur;
        		echo "<br /> Titre :  ".$titre;
        		echo "<br />";
			}

}	
else if (isset($_POST['genre']) && (!empty($_POST['genre'])) )
{
	//  var_dump($_POST);
		$stmt = $Bibli->prepare ('SELECT nomAuteur, prenomAuteur, titre, anneeEdition 
								   FROM genre NATURAL JOIN livre NATURAL JOIN ecrit NATURAL JOIN auteur 
								   WHERE lower(libelleGenre) LIKE lower(?) ');
		
		$genre=$_POST['genre'];
		$stmt->bind_param("s", $genre);
		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows == 0)
		{
			echo "aucune réponse pour Genre : ".$genre;
			echo "<br />";
		}

		$stmt->bind_result($nomAuteur, $prenomAuteur, $titre, $anneeEdition);

		while($stmt->fetch())
		{
			echo "Auteur : ".$nomAuteur." ".$prenomAuteur;
			echo "<br /> Titre :  ".$titre;
			echo "<br />";
		}
			
				
}
else
{
	echo "Veuillez saisir votre recherche.";
}

?>

</body>
</html>


