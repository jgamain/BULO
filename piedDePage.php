<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="script.js"></script>
<?php
	if(isset($_SESSION['numLecteur'])){
		?>
		<script>compteLecteur();</script>
		<?php
	}
	else if(isset($_SESSION['numBibliothecaire'])){
		?>
		<script>compteBibliothecaire();</script>
		<?php
	}
	else{
		?>
		<script>connexionPopover();</script>
		<?php
	}
?>