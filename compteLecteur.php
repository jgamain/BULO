<?php session_start(); ?>
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
				include "header.php";
				include "connectBibli.php";
				
			?>
			<div class="row">
				<h2>Bonjour <?php echo $_SESSION['prenomLecteur']." ".$_SESSION['nomLecteur']; ?></h2>
			</div>
			<div class="row">
				<h3><a href="deconnexion.php" class="couleur">Déconnexion</a></h3>
			</div>

			<div class="row">
			<div class="col-md-8">
				<table class="table">
					<tbody class="th-fixe">

						<div class="row">
							<h4> <?php echo "Situation de vos emprunts au : "; echo date("d-m-Y"); ?></h4>
						</div>
					
					<?php
					//on récupère les livres papier empruntés et non rendus
					$stmtLP = $Bibli->prepare('SELECT ISBN, titre, coteLivre,dateEmprunt
											FROM livre natural join livre_papier natural join exemplaire natural join emprunt natural join emprunt_exemplaire
											WHERE exempRendu=false and numLecteur = ?');
					$stmtLP->bind_param("i", $_SESSION['numLecteur']);
					$stmtLP->execute();
					$stmtLP->store_result();
					$stmtLP->bind_result($isbn, $titre, $cote, $date);
					if($stmtLP->num_rows != 0)
					{
						$stmtLP->fetch();
						echo "<tr><th>Livre :</th><td>".$titre;
						echo "<tr><th>ISBN :</th><td>".$isbn;
						echo "<tr><th>Cote :</th><td>".$cote;
						echo "<tr><th>Date Emprunt :</th><td>".$date;
						while($stmtLP->fetch())
						{
						echo $titre;
						echo $isbn;
						echo $cote;
						echo $date;
						}
					
					echo "</td></tr>";
					}


					//on récupère les livres_électroniques en cours d'emprunt

					$stmtLE = $Bibli->prepare('SELECT titre, lienPDF, dateEmprunt
											   FROM livre natural join livre_electronique natural join emprunt natural join emprunt_electronique
											   WHERE numLecteur = ?');
					$stmtLE->bind_param("i", $_SESSION['numLecteur']);
					$stmtLE->execute();
					$stmtLE->store_result();
					$stmtLE->bind_result($titre, $lien , $date);
					if($stmtLE->num_rows != 0)
					{
						while ($stmtLE->fetch())
						{
						echo "<tr><th>livre électronique :</th><td>".$titre;
						echo "<tr><th>Lien PDF :</th><td>".$lien;
						echo "<tr><th>Date Emprunt :</th><td>".$date;
						}
					
					echo "</td></tr>";
						
					}
	
					//on récupère les tablettes en cours d'emprunt

					$stmtT = $Bibli->prepare('SELECT numTablette, dateEmprunt
											  FROM emprunt natural join emprunt_tablette
											  WHERE tablRendu = false and numLecteur = ?');
					$stmtT->bind_param("i", $_SESSION['numLecteur']);
					$stmtT->execute();
					$stmtT->store_result();
					$stmtT->bind_result($tablette, $date);
					if($stmtT->num_rows != 0)
					{
						while ($stmtT->fetch())
						{
						echo "<tr><th>Tablette n° :</th><td>".$tablette;
						echo "<tr><th>Date Emprunt :</th><td>".$date;
						}
					
					echo "</td></tr>";
						
					}

					?>
			</div>
			</div>
		
				</tbody>
			</table>
			</div>
			<?php
			include "piedDePage.php";
			?>
		<script> headerActive('#catalogue'); </script>
	</body>
</html>



