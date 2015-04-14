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
		<!-- HEADER -->
		<?php
			include "header.html";
		?>
		<!-- RECHERCHE -->
		<?php
			include "connectBibli.php";
			
		?>
		<h3><a href="#" class="couleur">Recherche</a></h3><br />
		<form class="form-horizontal hidden" method="post" action="resultatRecherche.php">
			<div class="form-group">
				<label for="author" class="col-sm-1 control-label">Auteur</label>
				<div class="col-xs-6">
					<input type="text" class="form-control" id="author" name="author" placeholder="Nom de l'auteur">
				</div>
			</div>
			<div class="form-group">
				<label for="title" class="col-sm-1 control-label">Titre</label>
				<div class="col-xs-6">
					<input type="text" class="form-control" id="title" name="title" placeholder="Titre du livre">
				</div>
			</div>
			<div class="form-group">
				<label for="genre" class="col-sm-1 control-label">Genre</label>
				<div class="col-xs-6">
					<select class="form-control" id="genre" name="genre">
						<option value="">-- Indéfini --</option>
						<?php
								$result = $Bibli->query("SELECT libelleGenre FROM genre");
								while($row = $result->fetch_assoc()){
									echo "<option value='".$row['libelleGenre']."'>".$row['libelleGenre']."</option>";
								}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-1 col-sm-offset-1">
				<button type="submit" class="btn btn-violet">Rechercher</button>
				</div>
			</div>
		</form>
		
		
		<!-- INFORMATIONS SUR LE LIVRE -->
		<div>
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
					
					echo "<h2>Titre :  ".$titre."</h2>";
					
					// Récupération de la liste d'auteurs
					$stmtA = $Bibli->prepare('SELECT nomAuteur, prenomAuteur
												FROM ecrit NATURAL JOIN auteur
												WHERE numLivre = ?');
					$stmtA->bind_param("i", $_GET['numero']);
					$stmtA->execute();
					$stmtA->bind_result($nomAuteur, $prenomAuteur);
					$stmtA->fetch();
					echo "<br /><strong>Auteur(s) : </strong>".$nomAuteur." ".$prenomAuteur;
					while($stmtA->fetch()){
						echo " / ".$nomAuteur." ".$prenomAuteur;
					}
					
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
						echo "<br />Traducteur(s) : ".$nomTraducteur." ".$prenomTraducteur;
						while($stmtT->fetch()){
							echo " / ".$nomTraducteur." ".$prenomTraducteur;
						}
					}
					
					//Récupération de la liste de langues
					$stmtL = $Bibli->prepare('SELECT libelleLangue
												FROM est_ecrit_en NATURAL JOIN langue
												WHERE numLivre = ?');
					$stmtL->bind_param("i", $_GET['numero']);
					$stmtL->execute();
					$stmtL->bind_result($libelleLangue);
					$stmtL->fetch();
					echo "<br />Ecrit en : ".$libelleLangue;
					while($stmtL->fetch()){
						echo " / ".$libelleLangue;
					}
					
					if(isset($nomCollection)){
						echo "<br /> Collection : ".$nomCollection;
					}
					//Récupération de la liste d'éditeurs
					$stmtE = $Bibli->prepare('SELECT nomEditeur
												FROM edite NATURAL JOIN editeur
												WHERE numLivre = ?');
					$stmtE->bind_param("i", $_GET['numero']);
					$stmtE->execute();
					$stmtE->bind_result($nomEditeur);
					$stmtE->fetch();
					echo "<br />Editeur(s) : ".$nomEditeur;
					while($stmtE->fetch()){
						echo " / ".$nomEditeur;
					}
					
					echo "<br />Année d'édition : ".$anneeEdition."<br />";
				}
				else{
					echo "Livre introuvable";
				}
			}
			else{
				echo "Livre introuvable.";
			}
		}

	?>
		</div>
		
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script>
			$('.popover-markup>.trigger').popover({
				html: true,
				/*
				title: function () {
					return $(this).parent().find('.head').html();
				},
				*/
				content: function () {
					return $(this).parent().find('.content').html();
				}
			});
			$( 'ul.navbar-nav li' ).on('mouseenter mouseleave', function(){
				$(this).toggleClass('btn-violet');
			});
			$( 'h3 a' ).click( function(){
				$('form').toggleClass('hidden').toggleClass('show');
			});
			
		</script>
		
	</body>
</html>