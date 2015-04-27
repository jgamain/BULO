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
		<!-- HEADER $ RECHERCHE -->
		<?php
			include "header.php";
			include "recherche.php";
		?>
		
		<!-- LISTE DES LIVRES -->
		<table class="table table-striped table-hover">
			<caption>
				<h3 class="couleur">Catalogue</h3>
			</caption>
			<tbody>
			
			<?php
				$result = $Bibli->query('SELECT numLivre, titre, nomAuteur, prenomAuteur, anneeEdition FROM livre NATURAL JOIN ecrit NATURAL JOIN auteur');
				while ($row = $result->fetch_assoc()) {
			?>
				<tr onclick="document.location.href='pageLivre.php?numero=<?php echo $row['numLivre'];?>'">
					<td><?php echo $row['titre']; ?><br />
					<?php echo "par ".$row['nomAuteur']." ".$row['prenomAuteur']; ?><br />
					<?php echo "Edité en ".$row['anneeEdition']; ?><br /></td>
				</tr>
			<?php
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