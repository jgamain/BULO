<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
		<title> Ajouter un livre </title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<?php
				include "header.php";
				include "connectBibli.php";
				
				if (isset($_POST['titre']) && (!empty($_POST['titre'])) && ($_POST['editeur']!=="" || (isset($_POST['newEditeur']) && (!empty($_POST['newEditeur']))))){
					if($_POST['typeLivre']=='papier' && (!isset($_POST['isbn']) || empty($_POST['isbn']) || filter_var($_POST['isbn'], FILTER_VALIDATE_FLOAT)==false || !isset($_POST['cote']) || empty($_POST['cote']))){
						echo "Pour les ouvrages papier, vous devez indiquer un numéro d'ISBN et une côte.";
					}
					else{
						$titre = $_POST['titre'];
						if(isset($_POST['nbPages']) && (!empty($_POST['nbPages'])) && filter_var($_POST['nbPages'], FILTER_VALIDATE_INT)!==false)
						// filter_var($_POST['nbPages'], FILTER_VALIDATE_INT) renvoie false si la variable n'est pas un nombre, sinon renvoie le nombre
							$nbPages = $_POST['nbPages'];
						else
							$nbPages = NULL;
						if(isset($_POST['annee']) && (!empty($_POST['annee'])) && filter_var($_POST['annee'],FILTER_VALIDATE_INT)!==false)
							$annee = $_POST['annee'];
						else
							$annee = NULL;
						if(isset($_POST['description']) && (!empty($_POST['description'])))
							$description = $_POST['description'];
						else
							$description = NULL;
						if($_POST['genre']!=="")
							$numGenre = $_POST['genre'];
						else
							$numGenre = NULL;
						//COLLECTION						
						if($_POST['collection']!=="")
							$numCollection = $_POST['collection'];
						//insertion si nouvelle collection
						else if(isset($_POST['newCollection']) && (!empty($_POST['newCollection']))){
							$newCollection=$_POST['newCollection'];
							$stmt = $Bibli->prepare('INSERT INTO collection(nomCollection) VALUES (?)');
							$stmt->bind_param('s', $newCollection);
							$stmt->execute();
							//Récupération du numéro de la nouvelle collection
							$result = $Bibli->query('SELECT max(numCollection) as numCollection FROM collection');
							$row = $result->fetch_assoc();
							$numCollection = $row['numCollection'];
						}
						else
							$numCollection = NULL;
						//EDITEURS
						if($_POST['editeur']!=="")
							$numEditeur = $_POST['editeur'];
						else{
							$newEditeur=$_POST['newEditeur'];
							$stmt = $Bibli->prepare('INSERT INTO editeur(nomEditeur) VALUES (?)');
							$stmt->bind_param('s', $newEditeur);
							$stmt->execute();
							$result = $Bibli->query('SELECT max(numEditeur) as numEditeur FROM editeur');
							$row = $result->fetch_assoc();
							$numEditeur = $row['numEditeur'];
						}
						if($_POST['coediteur']!=="")
							$numEditeur2 = $_POST['coediteur'];
						else{
							if(isset($_POST['newEditeur2']) && (!empty($_POST['newEditeur2']))){
								$newEditeur2=$_POST['newEditeur2'];
								$stmt = $Bibli->prepare('INSERT INTO editeur(nomEditeur) VALUES (?)');
								$stmt->bind_param('s', $newEditeur2);
								$stmt->execute();
								$result = $Bibli->query('SELECT max(numEditeur) as numEditeur FROM editeur');
								$row = $result->fetch_assoc();
								$numEditeur2 = $row['numEditeur'];
							}
							else
								$numEditeur2 = NULL;
						}
						//AUTEURS
						if($_POST['auteur1']!=="")
							$numAuteur1 = $_POST['auteur1'];
						else if(isset($_POST['nomAuteur1'],$_POST['prenomAuteur1'])&&(!empty($_POST['nomAuteur1'])&&(!empty($_POST['prenomAuteur1'])))){
							$nomAuteur1=$_POST['nomAuteur1'];
							$prenomAuteur1=$_POST['prenomAuteur1'];
							$stmt = $Bibli->prepare('INSERT INTO auteur(nomAuteur, prenomAuteur) VALUES (?,?)');
							$stmt->bind_param('ss', $nomAuteur1, $prenomAuteur1);
							$stmt->execute();
							$result = $Bibli->query('SELECT max(numAuteur) as numAuteur FROM auteur');
							$row = $result->fetch_assoc();
							$numAuteur1 = $row['numAuteur'];
						}
						else
							$numAuteur1 = NULL;
						if($_POST['auteur2']!=="")
							$numAuteur2 = $_POST['auteur2'];
						else if(isset($_POST['nomAuteur2'],$_POST['prenomAuteur2'])&&(!empty($_POST['nomAuteur2'])&&(!empty($_POST['prenomAuteur2'])))){
							$nomAuteur2=$_POST['nomAuteur2'];
							$prenomAuteur2=$_POST['prenomAuteur2'];
							$stmt = $Bibli->prepare('INSERT INTO auteur(nomAuteur, prenomAuteur) VALUES (?,?)');
							$stmt->bind_param('ss', $nomAuteur2, $prenomAuteur2);
							$stmt->execute();
							$result = $Bibli->query('SELECT max(numAuteur) as numAuteur FROM auteur');
							$row = $result->fetch_assoc();
							$numAuteur2 = $row['numAuteur'];
						}
						else
							$numAuteur2 = NULL;
						if($_POST['auteur3']!=="")
							$numAuteur3 = $_POST['auteur3'];
						else if(isset($_POST['nomAuteur3'],$_POST['prenomAuteur3'])&&(!empty($_POST['nomAuteur3'])&&(!empty($_POST['prenomAuteur3'])))){
							$nomAuteur3=$_POST['nomAuteur3'];
							$prenomAuteur3=$_POST['prenomAuteur3'];
							$stmt = $Bibli->prepare('INSERT INTO auteur(nomAuteur, prenomAuteur) VALUES (?,?)');
							$stmt->bind_param('ss', $nomAuteur3, $prenomAuteur3);
							$stmt->execute();
							$result = $Bibli->query('SELECT max(numAuteur) as numAuteur FROM auteur');
							$row = $result->fetch_assoc();
							$numAuteur3 = $row['numAuteur'];
						}
						else
							$numAuteur3 = NULL;
						
						//Ajout à la base de données
						$stmt = $Bibli->prepare('INSERT INTO livre (titre, nbPage, description, numGenre, numCollection, anneeEdition) VALUES(?,?,?,?,?,?)');
						$stmt->bind_param('sisiii', $titre, $nbPages, $description, $numGenre, $numCollection, $annee);
						$stmt->execute();
						//Récupération du numéro du livre
						$result = $Bibli->query('SELECT max(numLivre) as numLivre FROM livre');
						$row = $result->fetch_assoc();
						$numLivre = $row['numLivre'];
						
						//ajouts des éditeurs, auteurs...
						$stmt = $Bibli->prepare('INSERT INTO edite VALUES(?,?)');
						$stmt->bind_param('ii', $numEditeur, $numLivre);
						$stmt->execute();
						if($numEditeur2 !== NULL){
							$stmt = $Bibli->prepare('INSERT INTO edite VALUES(?,?)');
							$stmt->bind_param('ii', $numEditeur2, $numLivre);
							$stmt->execute();
						}
						if($numAuteur1==NULL && $numAuteur2==NULL && $numAuteur3==NULL){
							$stmt = $Bibli->prepare('INSERT INTO ecrit VALUES(1,?)');
							$stmt->bind_param('i', $numLivre);
							$stmt->execute();
						}
						else{
							if($numAuteur1!==NULL){
								$stmt = $Bibli->prepare('INSERT INTO ecrit VALUES(?,?)');
								$stmt->bind_param('ii', $numAuteur1, $numLivre);
								$stmt->execute();
							}
							if($numAuteur2!==NULL){
								$stmt = $Bibli->prepare('INSERT INTO ecrit VALUES(?,?)');
								$stmt->bind_param('ii', $numAuteur2, $numLivre);
								$stmt->execute();
							}
							if($numAuteur3!==NULL){
								$stmt = $Bibli->prepare('INSERT INTO ecrit VALUES(?,?)');
								$stmt->bind_param('ii', $numAuteur3, $numLivre);
								$stmt->execute();
							}
						}
						//Traducteurs
						if($_POST['trad1']!==""){
							$stmt = $Bibli->prepare('INSERT INTO traduit VALUES(?,?)');
							$stmt->bind_param('ii', $_POST['trad1'], $numLivre);
							$stmt->execute();
						}
						else if(isset($_POST['nomTrad1'],$_POST['prenomTrad1'])&&(!empty($_POST['nomTrad1'])&&(!empty($_POST['prenomTrad1'])))){
							$stmt = $Bibli->prepare('INSERT INTO traducteur(nomTraducteur, prenomTraducteur) VALUES (?,?)');
							$stmt->bind_param('ss', $_POST['nomTrad1'], $_POST['prenomTrad1']);
							$stmt->execute();
							$result = $Bibli->query('SELECT max(numTraducteur) as numTraducteur FROM traducteur');
							$row = $result->fetch_assoc();
							$stmt = $Bibli->prepare('INSERT INTO traduit VALUES(?,?)');
							$stmt->bind_param('ii', $row['numTraducteur'], $numLivre);
							$stmt->execute();
						}
						if($_POST['trad2']!==""){
							$stmt = $Bibli->prepare('INSERT INTO traduit VALUES(?,?)');
							$stmt->bind_param('ii', $_POST['trad2'], $numLivre);
							$stmt->execute();
						}
						else if(isset($_POST['nomTrad2'],$_POST['prenomTrad2'])&&(!empty($_POST['nomTrad2'])&&(!empty($_POST['prenomTrad2'])))){
							$stmt = $Bibli->prepare('INSERT INTO traducteur(nomTraducteur, prenomTraducteur) VALUES (?,?)');
							$stmt->bind_param('ss', $_POST['nomTrad2'], $_POST['prenomTrad2']);
							$stmt->execute();
							$result = $Bibli->query('SELECT max(numTraducteur) as numTraducteur FROM traducteur');
							$row = $result->fetch_assoc();
							$stmt = $Bibli->prepare('INSERT INTO traduit VALUES(?,?)');
							$stmt->bind_param('ii', $row['numTraducteur'], $numLivre);
							$stmt->execute();
						}
						//Langues
						if($_POST['langue1']!==""){
							$stmt = $Bibli->prepare('INSERT INTO est_ecrit_en VALUES(?,?)');
							$stmt->bind_param('ii', $numLivre, $_POST['langue1']);
							$stmt->execute();
						}
						if($_POST['langue2']!==""){
							$stmt = $Bibli->prepare('INSERT INTO est_ecrit_en VALUES(?,?)');
							$stmt->bind_param('ii', $numLivre, $_POST['langue2']);
							$stmt->execute();
						}
						//Livres papier / électroniques
						if($_POST['typeLivre']=='papier'){
							$stmt = $Bibli->prepare('INSERT INTO livre_papier VALUES(?,?,?)');
							$stmt->bind_param('iis', $numLivre, $_POST['isbn'], $_POST['cote']);
							$stmt->execute();
						}
						else if(isset($_POST['pdf']) && (!empty($_POST['pdf']))){
							$stmt = $Bibli->prepare('INSERT INTO livre_electronique(numLivre, lienPDF) VALUES(?,?)');
							$stmt->bind_param('is', $numLivre, $_POST['pdf']);
							$stmt->execute();
						}
						else{
							$stmt = $Bibli->prepare('INSERT INTO livre_electronique(numLivre) VALUES(?)');
							$stmt->bind_param('i', $numLivre);
							$stmt->execute();
						}	
				?>
					<p>Le livre a bien été ajouté.</p>
					<a href="pageLivre.php?numero=<?php echo $numLivre; ?>">Voir le livre dans le catalogue.</a>
				<?php
					}
				}
				else{
					echo "Vous devez au moins indiquer un titre et un éditeur.";
				}
			?>
		</div>
		
		<?php
			include "piedDePage.php";
		?>
		<script> headerActive('#compte'); </script>
	</body>
</html>