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
			<form class="form-horizontal hidden cache" method="post" action="ajoutLivre.php">
				<div class="form-group">
					<label for="titre" class="col-sm-2 control-label">Titre</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="titre" placeholder="Titre du livre">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6 col-sm-offset-2">
						<label class="radio-inline"><input type="radio" name="typeLivre" value="papier" checked> ouvrage papier</label>
						<label class="radio-inline"><input type="radio" name="typeLivre" value="electronique"> livre électronique</label>
					</div>
				</div>
				<div class="form-group show" id="ISBN">
					<label for="isbn" class="col-sm-2 control-label">N°ISBN</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="isbn" placeholder="Numéro ISBN du livre">
					</div>
				</div>
				<div class="form-group show" id="coteLivre">
					<label for="cote" class="col-sm-2 control-label">Côte</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="cote" placeholder="Côte du livre">
					</div>
				</div>
				<div class="form-group hidden" id="lienPDF">
					<label for="pdf" class="col-sm-2 control-label">lien PDF</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="pdf" placeholder="Lien pour lire le livre au format PDF">
					</div>
				</div>
				<div class="form-group">
					<label for="nbPages" class="col-sm-2 control-label">Nombre de pages</label>
					<div class="col-sm-6"><input type="text" class="form-control" name="nbPages" placeholder="Nombre de pages"></div>
				</div>
				<div class="form-group">
					<label for="annee" class="col-sm-2 control-label">Année d'édition</label>
					<div class="col-sm-6"><input type="text" class="form-control" name="annee" placeholder="Année d'édition"></div>
				</div>
				<!--Collection-->
				<div class="form-group">
					<label for="collection" class="col-sm-2 control-label">Collection</label>
					<div class="col-sm-4">
						<select class="form-control" id="collection" name="collection">
							<option value="">-- Indéfini --</option>
							<?php
									$result = $Bibli->query("SELECT numCollection, nomCollection FROM collection");
									while($row = $result->fetch_assoc()){
										echo "<option value='".$row['numCollection']."'>".$row['nomCollection']."</option>";
									}
							?>
						</select>
					</div>
					<label for="newCollection" class="col-sm-1 control-label">Autre</label>
					<div class="col-sm-4"><input type="text" class="form-control" name="newCollection" placeholder="Nouvelle collection"></div>
				</div>
				<!-- EDITEURS -->
				<div class="form-group">
					<label for="editeur" class="col-sm-2 control-label">Editeur</label>
					<div class="col-sm-4">
						<select class="form-control" id="editeur" name="editeur">
							<option value="">-- Indéfini --</option>
							<?php
									$result = $Bibli->query("SELECT numEditeur, nomEditeur FROM editeur");
									while($row = $result->fetch_assoc()){
										echo "<option value='".$row['numEditeur']."'>".$row['nomEditeur']."</option>";
									}
							?>
						</select>
					</div>
					<label for="newEditeur" class="col-sm-1 control-label">Autre</label>
					<div class="col-sm-4"><input type="text" class="form-control" name="newEditeur" placeholder="Nouvel éditeur"></div>
				</div>
				<div class="form-group">
					<label for="coediteur" class="col-sm-2 control-label">Coéditeur</label>
					<div class="col-sm-4">
						<select class="form-control" id="coediteur" name="coediteur">
							<option value="">-- Indéfini --</option>
							<?php
									$result = $Bibli->query("SELECT numEditeur, nomEditeur FROM editeur");
									while($row = $result->fetch_assoc()){
										echo "<option value='".$row['numEditeur']."'>".$row['nomEditeur']."</option>";
									}
							?>
						</select>
					</div>
					<label for="newEditeur2" class="col-sm-1 control-label">Autre</label>
					<div class="col-sm-4"><input type="text" class="form-control" name="newEditeur2" placeholder="Nouvel éditeur"></div>
				</div>
				<!-- AUTEURS -->
				<div class="form-group">
					<label for="auteur1" class="col-sm-2 control-label">Auteur 1</label>
					<div class="col-sm-3">
						<select class="form-control" id="auteur1" name="auteur1">
							<option value="">-- Indéfini --</option>
							<?php
									$result = $Bibli->query("SELECT numAuteur, nomAuteur, prenomAuteur FROM auteur WHERE lower(nomAuteur)!='anonyme'");
									while($row = $result->fetch_assoc()){
										echo "<option value='".$row['numAuteur']."'>".$row['prenomAuteur']." ".$row['nomAuteur']."</option>";
									}
							?>
						</select>
					</div>
					<label for="newAuteur1" class="col-sm-1 control-label">Autre</label>
					<div class="col-xs-3"><input type="text" class="form-control" name="nomAuteur1" placeholder="Nom de l'auteur"></div>
					<div class="col-xs-3"><input type="text" class="form-control" name="prenomAuteur1" placeholder="Prénom de l'auteur"></div>
				</div>
				<div class="form-group">
					<label for="auteur2" class="col-sm-2 control-label">Auteur 2</label>
					<div class="col-sm-3">
						<select class="form-control" id="auteur2" name="auteur2">
							<option value="">-- Indéfini --</option>
							<?php
									$result = $Bibli->query("SELECT numAuteur, nomAuteur, prenomAuteur FROM auteur WHERE lower(nomAuteur)!='anonyme'");
									while($row = $result->fetch_assoc()){
										echo "<option value='".$row['numAuteur']."'>".$row['prenomAuteur']." ".$row['nomAuteur']."</option>";
									}
							?>
						</select>
					</div>
					<label for="newAuteur2" class="col-sm-1 control-label">Autre</label>
					<div class="col-xs-3"><input type="text" class="form-control" name="nomAuteur2" placeholder="Nom de l'auteur"></div>
					<div class="col-xs-3"><input type="text" class="form-control" name="prenomAuteur2" placeholder="Prénom de l'auteur"></div>
				</div>
				<div class="form-group">
					<label for="auteur3" class="col-sm-2 control-label">Auteur 3</label>
					<div class="col-sm-3">
						<select class="form-control" id="auteur3" name="auteur3">
							<option value="">-- Indéfini --</option>
							<?php
									$result = $Bibli->query("SELECT numAuteur, nomAuteur, prenomAuteur FROM auteur WHERE lower(nomAuteur)!='anonyme'");
									while($row = $result->fetch_assoc()){
										echo "<option value='".$row['numAuteur']."'>".$row['prenomAuteur']." ".$row['nomAuteur']."</option>";
									}
							?>
						</select>
					</div>
					<label for="newAuteur3" class="col-sm-1 control-label">Autre</label>
					<div class="col-xs-3"><input type="text" class="form-control" name="nomAuteur3" placeholder="Nom de l'auteur"></div>
					<div class="col-xs-3"><input type="text" class="form-control" name="prenomAuteur3" placeholder="Prénom de l'auteur"></div>
				</div>
				<!-- Langue -->
				<div class="form-group">
					<label for="langue1" class="col-sm-2 control-label">Ecrit en</label>
					<div class="col-sm-3">
						<select class="form-control" id="langue1" name="langue1">
							<option value="">-- Indéfini --</option>
							<?php
									$result = $Bibli->query("SELECT numLangue, libelleLangue FROM langue");
									while($row = $result->fetch_assoc()){
										echo "<option value='".$row['numLangue']."'>".$row['libelleLangue']."</option>";
									}
							?>
						</select>
					</div>
					<label for="langue2" class="col-sm-1 control-label">(et)</label>
					<div class="col-sm-3">
						<select class="form-control" id="langue2" name="langue2">
							<option value="">-- Indéfini --</option>
							<?php
									$result = $Bibli->query("SELECT numLangue, libelleLangue FROM langue");
									while($row = $result->fetch_assoc()){
										echo "<option value='".$row['numLangue']."'>".$row['libelleLangue']."</option>";
									}
							?>
						</select>
					</div>
				</div>
				<!-- Genre -->
				<div class="form-group">
					<label for="genre" class="col-sm-2 control-label">Genre</label>
					<div class="col-sm-6">
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
					<label for="description" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-6"><textarea class="form-control" rows="3" name="description" placeholder="Entrez un descriptif"></textarea></div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-2 col-sm-offset-2"><button type="submit" class="btn btn-violet">Ajouter</button></div>
				</div>
			</form>
		</div>
		
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script src="script.js" ></script>
	</body>
</html>