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
		<!-- HEADER & RECHERCHE -->
		<?php
			include "header.php";
			include "recherche.php";
		?>
				
		<!-- RESULTAT RECHERCHE : LISTE DE LIVRES -->
		<table class="table table-striped table-hover">
			<caption>
				<h3 class="couleur">Résultats</h3>
			</caption>
			<tbody>
			<?php
				include "connectBibli.php";
				if (isset($_POST['title'], $_POST['author']) && (!empty($_POST['title'])) && (!empty($_POST['author'])) )
				{
					$stmt = $Bibli->prepare('SELECT numLivre, nomAuteur, prenomAuteur, titre, anneeEdition
											 FROM livre NATURAL JOIN ecrit NATURAL JOIN auteur 
											 WHERE lower(titre) LIKE lower(?) AND lower(nomAuteur) = ? ');
					
					$tit= "%".$_POST['title']."%";
					$auteur= $_POST['author'];
					$stmt->bind_param("ss", $tit, $auteur);
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($numero, $nomAuteur, $prenomAuteur, $titre, $anneeEdition);
					
					if($stmt->num_rows== 0)
							{
								echo "Aucune réponse pour Titre : ".$_POST['title']."et pour Auteur : ".$_POST['author'];
								echo "<br />";
							}

					while ($stmt->fetch())
					{
							echo "<tr onclick=\"document.location.href='pageLivre.php?numero=".$numero."'\"><td>".$titre;
							echo "<br />Par ".$nomAuteur." ".$prenomAuteur;
							echo "<br />Edité en ".$anneeEdition;
							echo "<br /></td></tr>";
						  
					}
					

				}
				else if (isset($_POST['title']) && (!empty($_POST['title'])) )
				{
					if ($stmt = $Bibli->prepare('SELECT numLivre, nomAuteur, prenomAuteur, titre, anneeEdition
												 FROM livre NATURAL JOIN ecrit NATURAL JOIN auteur 
												 WHERE lower(titre) LIKE lower(?)'))
					{
						$tit = "%".$_POST['title']."%";
						$stmt->bind_param("s", $tit);
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($numero, $nomAuteur, $prenomAuteur, $titre, $anneeEdition);

							if($stmt->num_rows== 0)
							{
								echo "Aucune réponse pour le Titre : ".$_POST['title'];
								echo "<br />";
							}

							while ($stmt->fetch())
							{
								echo "<tr onclick=\"document.location.href='pageLivre.php?numero=".$numero."'\"><td>".$titre;
								echo "<br />Par ".$nomAuteur." ".$prenomAuteur;
								echo "<br />Edité en ".$anneeEdition;
								echo "<br /></td></tr>";
							}
					}
				}
				else if (isset($_POST['genre'], $_POST['author']) && (!empty($_POST['genre'])) && (!empty($_POST['author'])) )
				{
						$stmt = $Bibli->prepare('SELECT numLivre, nomAuteur, prenomAuteur, titre, anneeEdition
												FROM genre NATURAL JOIN livre NATURAL JOIN ecrit NATURAL JOIN auteur 
												WHERE numGenre = ? AND lower(nomAuteur) = ? ');
						$genre=$_POST['genre'];
						$auteur= $_POST['author'];
						$stmt->bind_param("is", $genre, $auteur);
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($numero, $nomAuteur, $prenomAuteur, $titre, $anneeEdition);

							if($stmt->num_rows== 0)
							{
								echo "Aucune réponse ce genre et Auteur : ".$_POST['author'];
								echo "<br />";
							}
					
							while ($stmt->fetch())
							{
								echo "<tr onclick=\"document.location.href='pageLivre.php?numero=".$numero."'\"><td>".$titre;
								echo "<br />Par ".$nomAuteur." ".$prenomAuteur;
								echo "<br />Edité en ".$anneeEdition;
								echo "<br /></td></tr>";
							}
				}	
				else if (isset($_POST['author']) && (!empty($_POST['author'])) )
				{

						$stmt = $Bibli->prepare('SELECT numLivre, nomAuteur, prenomAuteur, titre, anneeEdition
												 FROM livre NATURAL JOIN ecrit NATURAL JOIN auteur 
												 WHERE lower(nomAuteur) = ?');
						
						$auteur =  $_POST['author'];
						$stmt->bind_param("s", $_POST['author']);
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($numero, $nomAuteur, $prenomAuteur, $titre, $anneeEdition);

							if($stmt->num_rows== 0)
							{
								echo "Aucune réponse pour Auteur : ".$_POST['author'];
								echo "<br />";
							}

							while ($stmt->fetch())
							{
								echo "<tr onclick=\"document.location.href='pageLivre.php?numero=".$numero."'\"><td>".$titre;
								echo "<br />Par ".$nomAuteur." ".$prenomAuteur;
								echo "<br />Edité en ".$anneeEdition;
								echo "<br /></td></tr>";
							}

				}	
				else if (isset($_POST['genre']) && (!empty($_POST['genre'])) )
				{
					
						$stmt = $Bibli->prepare ('SELECT numLivre, nomAuteur, prenomAuteur, titre, anneeEdition 
												   FROM genre NATURAL JOIN livre NATURAL JOIN ecrit NATURAL JOIN auteur 
												   WHERE numGenre = ? ');
						
						$genre=$_POST['genre'];
						$stmt->bind_param("i", $genre);
						$stmt->execute();
						$stmt->store_result();

						if($stmt->num_rows == 0)
						{
							echo "Aucune réponse pour ce genre.";
							echo "<br />";
						}

						$stmt->bind_result($numero, $nomAuteur, $prenomAuteur, $titre, $anneeEdition);

						while($stmt->fetch())
						{
							echo "<tr onclick=\"document.location.href='pageLivre.php?numero=".$numero."'\"><td>".$titre;
							echo "<br />Par ".$nomAuteur." ".$prenomAuteur;
							echo "<br />Edité en ".$anneeEdition;
							echo "<br /></td></tr>";
						}
							
								
				}
				else
				{
					echo "Veuillez saisir votre recherche.";
				}

			?>
			</tbody>
		</table>
		</div>
		
		<?php
			include "piedDePage.php";
		?>
		<script> headerActive('#catalogue'); </script>
	</body>
</html>