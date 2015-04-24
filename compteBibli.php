<!DOCTYPE html>
<html lang="fr">
	<head>
    <title>BULO - Mon compte</title>
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
				include "connectBibli.php";
			?>
			<h3><a href="#" class="couleur cache">Ajouter un livre</a></h3><br />
			<form class="form-horizontal hidden" method="post" action="ajoutLivre.php">
				<div class="form-group">
					<label for="titre" class="col-sm-1 control-label">Titre</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="titre" placeholder="Titre du livre">
					</div>
				</div>
				<div class="form-group">
					<label for="auteur1" class="col-sm-1 control-label">Auteur 1</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="nomAuteur1" placeholder="Nom de l'auteur">
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="prenomAuteur1" placeholder="Prénom de l'auteur">
					</div>
				</div>
				<div class="form-group">
					<label for="auteur2" class="col-sm-1 control-label">Auteur 2</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="nomAuteur2" placeholder="Nom de l'auteur">
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="prenomAuteur2" placeholder="Prénom de l'auteur">
					</div>
				</div>
				<div class="form-group">
					<label for="auteur3" class="col-sm-1 control-label">Auteur 3</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="nomAuteur3" placeholder="Nom de l'auteur">
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="prenomAuteur3" placeholder="Prénom de l'auteur">
					</div>
				</div>
				<div class="form-group">
					<label for="collection" class="col-sm-1 control-label">Collection</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="collection" placeholder="Nom de la collection">
					</div>
				</div>
				<div class="form-group">
					<label for="editeur1" class="col-sm-1 control-label">Editeur 1</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="editeur1" placeholder="Nom de l'éditeur">
					</div>
				</div>
				<div class="form-group">
					<label for="editeur2" class="col-sm-1 control-label">Editeur 2</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="editeur2" placeholder="Nom de l'éditeur">
					</div>
				</div>
				<div class="form-group">
					<label for="annee" class="col-sm-1 control-label">Année d'édition</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="annee" placeholder="Année d'édition">
					</div>
				</div>
				<div class="form-group">
					<label for="nbPages" class="col-sm-1 control-label">Nombre de pages</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="nbPages" placeholder="Nombre de pages">
					</div>
				</div>
				<div class="form-group">
					<label for="genre" class="col-sm-1 control-label">Genre</label>
					<div class="col-xs-6">
						<select class="form-control" id="genre" name="genre">
							<option value="">-- Indéfini --</option>
							<?php
									$result = $Bibli->query("SELECT numGenre, libelleGenre FROM genre");
									while($row = $result->fetch_assoc()){
										echo "<option value='".$row['numGenre']."'>".$row['libelleGenre']."</option>";
									}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="description" class="col-sm-1 control-label">Description</label>
					<div class="col-sm-6">
						<textarea class="form-control" rows="3" name="description" placeholder="Entrez un descriptif"></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-1 col-sm-offset-1">
						<button type="submit" class="btn btn-violet">Ajouter</button>
					</div>
				</div>
			</form>
		</div>
		
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script src="script.js" ></script>
	</body>
</html>