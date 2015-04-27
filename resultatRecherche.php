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
								echo "aucune réponse pour Titre : ".$tit."et pour Auteur : ".$auteur;
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
						$titre = "%".$_POST['title']."%";
						$stmt->bind_param("s", $titre);
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($numero, $nomAuteur, $prenomAuteur, $titre, $anneeEdition);

							if($stmt->num_rows== 0)
							{
								echo "aucune réponse pour le Titre : ".$titre;
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
												WHERE lower(libelleGenre) LIKE lower(?) AND lower(nomAuteur) = ? ');
						$genre=$_POST['genre'];
						$auteur= $_POST['author'];
						$stmt->bind_param("ss", $genre, $auteur);
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($numero, $nomAuteur, $prenomAuteur, $titre, $anneeEdition);

							if($stmt->num_rows== 0)
							{
								echo "aucune réponse pour Genre : ".$genre." et Auteur : ".$auteur;
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
								echo "aucune réponse pour Auteur : ".$auteur;
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