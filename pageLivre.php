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
			include "header.html";
			include "recherche.php";
		?>
		
		<!-- INFORMATIONS SUR LE LIVRE -->
		<div class="row">
			<div class="col-md-12">
			<?php
			if(isset($_GET['numero'])){
				$_GET['numero'] = (int)$_GET['numero'];
				if($_GET['numero'] != 0){
					include "connectBibli.php";
					
					$stmt = $Bibli->prepare('SELECT titre, anneeEdition, nomCollection, libelleGenre, nbPage, description
											 FROM livre NATURAL LEFT JOIN collection NATURAL LEFT JOIN genre
											  WHERE numLivre= ?');
					$stmt->bind_param("i", $_GET['numero']);
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($titre, $anneeEdition, $nomCollection, $libelleGenre, $nbPage, $description);
					if($stmt->num_rows != 0)
					{
						$stmt->fetch();
						
						echo "<h2>".$titre."</h2>";
					?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<table class="table">
					<tbody class="th-fixe">
				<?php
					// Récupération de la liste d'auteurs
					$stmtA = $Bibli->prepare('SELECT nomAuteur, prenomAuteur
												FROM ecrit NATURAL JOIN auteur
												WHERE numLivre = ?');
					$stmtA->bind_param("i", $_GET['numero']);
					$stmtA->execute();
					$stmtA->bind_result($nomAuteur, $prenomAuteur);
					$stmtA->fetch();
					echo "<tr><th>Auteur(s) :</th><td>".$nomAuteur." ".$prenomAuteur;
					while($stmtA->fetch()){
						echo " / ".$nomAuteur." ".$prenomAuteur;
					}
					echo "</td></tr>";
					// Récupération de la liste de traducteurs
					$stmtT = $Bibli->prepare('SELECT nomTraducteur, prenomTraducteur
												FROM traduit NATURAL JOIN traducteur
												WHERE numLivre = ?');
					$stmtT->bind_param("i", $_GET['numero']);
					$stmtT->execute();
					$stmtT->store_result();
					$stmtT->bind_result($nomTraducteur, $prenomTraducteur);
					if($stmtT->num_rows != 0){
						$stmtT->fetch();
						echo "<tr><th>Traducteur(s) :</th><td>".$nomTraducteur." ".$prenomTraducteur;
						while($stmtT->fetch()){
							echo " / ".$nomTraducteur." ".$prenomTraducteur;
						}
						echo "</td></tr>";
					}				
					//Récupération de la liste de langues
					$stmtL = $Bibli->prepare('SELECT libelleLangue
												FROM est_ecrit_en NATURAL JOIN langue
												WHERE numLivre = ?');
					$stmtL->bind_param("i", $_GET['numero']);
					$stmtL->execute();
					$stmtL->bind_result($libelleLangue);
					$stmtL->fetch();
					echo "<tr><th>Ecrit en :</th><td>".$libelleLangue;
					while($stmtL->fetch()){
						echo " / ".$libelleLangue;
					}
					echo "</td></tr>";
					if(isset($nomCollection)){
						echo "<tr><th>Collection :</th><td>".$nomCollection."</td></tr>";
					}
					//Récupération de la liste d'éditeurs
					$stmtE = $Bibli->prepare('SELECT nomEditeur
												FROM edite NATURAL JOIN editeur
												WHERE numLivre = ?');
					$stmtE->bind_param("i", $_GET['numero']);
					$stmtE->execute();
					$stmtE->bind_result($nomEditeur);
					$stmtE->fetch();
					echo "<tr><th>Editeur(s) :</th><td>".$nomEditeur;
					while($stmtE->fetch()){
						echo " / ".$nomEditeur;
					}
					echo "</td></tr>";
					if(isset($anneeEdition)){
						echo "<tr><th>Année d'édition :</th><td>".$anneeEdition."</td></tr>";
					}
					if(isset($libelleGenre)){
						echo "<tr><th>Genre :</th><td>".$libelleGenre."</td></tr>";
					}
					if(isset($nbPage)){
						echo "<tr><th>Nombre de pages :</th><td>".$nbPage."</td></tr>";
					}
					if(isset($description)){
						echo "<tr><th>Description :</th><td>".$description."</td></tr>";
					}
				?>
					</tbody>
				</table>
			</div>
					<?php
					}
					else{
						echo "<p>Livre introuvable.</p>";
					}
				}
				else{
					echo "<p>Livre introuvable.</p>";
				}
			}
		?>
		</div>
	</div>
		
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script src="script.js"></script>
		<script> headerActive('#catalogue'); </script>
	</body>
</html>