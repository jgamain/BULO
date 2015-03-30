<?php
	$host = "localhost";
	$user = "root";
	$bdd = "bibliotheque";
	$passwd = "root";
	$Bibli = new mysqli($host,$user,$passwd,$bdd);
	if ($Bibli->connect_errno) {
		echo "Echec lors de la connexion à MySQL : (" . $Bibli->connect_errno . ") " . $Bibli->connect_error;
	}
?>

<form method="POST" >
<label for="author"> Auteur : </label> <input type="text" name="author"> <br /> 
<label for="title"> Titre : </label>  <input type="text" name="title"><br /> 
<input type="submit" value="chercher" name="submit">
</form>


<?php

if (isset($_POST['title'], $_POST['author']) && (!empty($_POST['title'])) && (!empty($_POST['author'])) )
{
	if ($stmt = $Bibli->prepare('SELECT nomAuteur, prenomAuteur, titre FROM livre NATURAL JOIN auteur WHERE lower(titre) LIKE lower(?) AND lower(nomAuteur) = ? '))
	{
	$tit= "%".$_POST['title']."%";
	$aut= $_POST['author'];
	$stmt->bind_param("ss", $tit, $aut);
	$stmt->execute();
	$stmt->bind_result($nomAuteur, $prenomAuteur, $titre);
	
	while ($stmt->fetch())
	{
		printf("%s %s %s\n", $nomAuteur, $prenomAuteur, $titre);
		echo "<br/>";
	}
	}

}

else if (isset($_POST['author']) && (!empty($_POST['author'])) )
{

$stmt = $Bibli->prepare('SELECT nomAuteur, prenomAuteur, titre FROM livre NATURAL JOIN auteur WHERE lower(nomAuteur) = ?');
$stmt->bind_param("s", $_POST['author']);
$stmt->execute();
$stmt->bind_result($nomAuteur, $prenomAuteur, $titre);

	while ($stmt->fetch())
	{
		printf("%s %s %s\n", $nomAuteur, $prenomAuteur, $titre);
		echo "<br/>";
	}

}
else 
{
	if (isset($_POST['title']) && (!empty($_POST['title'])) )
	{
		if ($stmt = $Bibli->prepare('SELECT nomAuteur, prenomAuteur, titre FROM livre NATURAL JOIN auteur WHERE lower(titre) LIKE lower(?)'))
		{
		$titre = "%".$_POST['title']."%";
		$stmt->bind_param("s", $titre);
		$stmt->execute();
		$stmt->bind_result($nomAuteur, $prenomAuteur, $titre);
			while ($stmt->fetch())
			{
				printf(" %s %s %s\n", $nomAuteur, $prenomAuteur, $titre);
				echo "<br/>";
			}
		}
	}
}



?>


