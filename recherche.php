	<?php
		include "connectBibli.php";		
	?>
		<h3><a href="#" class="couleur cache">Recherche</a></h3><br />
		<form class="form-horizontal hidden cache" method="post" action="resultatRecherche.php">
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
								$result = $Bibli->query("SELECT numGenre, libelleGenre FROM genre");
								while($row = $result->fetch_assoc()){
									echo "<option value='".$row['numGenre']."'>".$row['libelleGenre']."</option>";
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