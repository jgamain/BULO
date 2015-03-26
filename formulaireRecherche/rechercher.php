<?php
	include('connectBibli.php');

	//Aucune saisie
	if(!isset($_POST['titre'], $_POST['auteur']) || (empty($_POST['titre']) && empty($_POST['auteur']))){
		echo "Veuillez saisir une recherche.";
	}
	//Saisie du titre et de l'auteur
	else if(isset($_POST['titre'], $_POST['auteur']) && !empty($_POST['titre']) && !empty($_POST['auteur'])){
		$titre = "%".$_POST['titre']."%";
		$query="SELECT * FROM livre NATURAL JOIN ecrit WHERE upper(titre) LIKE upper(?) AND numAuteur = (SELECT numAuteur FROM auteur WHERE upper(nomAuteur)=upper(?))";
		$stmt = $Bibli->prepare($query);
		$stmt->bind_param('ss', $titre, $_POST['auteur']);
		$stmt->execute();
		$res = $stmt->get_result();
		$nbLignes=$res->num_rows;
		echo $nbLignes;
		if($nbLignes!=0){
			while($row=$res->fetch_assoc()){
				echo "numLivre= ".$row['numLivre']."<br />";
				echo "titre : ".$row['titre']."<br />";
			}
		}
		else{
			echo "Pas de résultat trouvé pour votre recherche ".$_POST['titre']." ".$_POST['auteur']."<br \>";
		}
	}
	// On a que l'auteur
	else if(!isset($_POST['titre']) || empty($_POST['titre'])){
		$query="SELECT * FROM livre NATURAL JOIN ecrit WHERE numAuteur = (SELECT numAuteur FROM auteur WHERE upper(nomAuteur)=upper(?))";
		$stmt = $Bibli->prepare($query);
		$stmt->bind_param('s', $_POST['auteur']);
		$stmt->execute();
		$res = $stmt->get_result();
		$nbLignes=$res->num_rows;
		echo $nbLignes;
		if($nbLignes!=0){
			while($row=$res->fetch_assoc()){
				echo "numLivre= ".$row['numLivre']."<br />";
				echo "titre : ".$row['titre']."<br />";
			}
		}
		else{
			echo "Pas de résultat trouvé pour votre recherche ".$_POST['auteur']."<br \>";
		}
	}
	// On a que le titre
	else {
		$titre = "%".$_POST['titre']."%";
		$query="SELECT * FROM livre WHERE upper(titre) LIKE upper(?)";
		$stmt = $Bibli->prepare($query);
		$stmt->bind_param('s', $titre);
		$stmt->execute();
		$res = $stmt->get_result();
		$nbLignes=$res->num_rows;
		echo $nbLignes;
		if($nbLignes!=0){
			while($row=$res->fetch_assoc()){
				echo "numLivre= ".$row['numLivre']."<br />";
				echo "titre : ".$row['titre']."<br />";
			}
		}
		else{
			echo "Pas de résultat trouvé pour votre recherche ".$_POST['titre']."<br \>";
		}
	}
	


?>