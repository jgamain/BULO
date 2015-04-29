
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
    <title> Contact </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      
      <h1 class="couleur">Formulaire de contact avec la Bibliotheque BULO</h1>
      
      <form class="form-horizontal" method="POST" >
        <div class="form-group">
          <label for="nomLecteur" class="col-sm-2 control-label"> Nom : </label>
          <div class="col-sm-4"><input type="text" class="form-control" name="nom" placeholder="Votre nom"></div>
        </div>
        <div class="form-group">
          <label for="prenomLecteur" class="col-sm-2 control-label"> Prenom : </label>
          <div class="col-sm-4"><input type="text" class="form-control" name="prenom" placeholder="Votre prenom"></div>
        </div>
        <div class="form-group">
          <label for="mailLecteur" class="col-sm-2 control-label"> telephone : </label>
          <div class="col-sm-4"><input type="text" class="form-control" name="telephone" placeholder="Votre numero de telephone"></div>
        </div>
        <div class="form-group">
          <label for="mailLecteur" class="col-sm-2 control-label"> e-mail : </label>
          <div class="col-sm-4"><input type="text" class="form-control" name="mail" placeholder="Votre adresse email"></div>
        </div>
        <div class="form-group">
          <label for="textarea">Votre question :</label> </br>
          <textarea id="textarea" name="question" cols="47" rows="10"></textarea>
        </div>
        <div class="form-group">
          <div class="col-sm-1 col-sm-offset-2"><button type="submit" class="btn btn-violet" name="submit">Valider</button></div>
        </div>
      </form>
    </div>
  
  <?php

if (isset($_POST['nom'], $_POST['prenom'], $_POST['telephone'],$_POST['mail'],$_POST['question']) 
      && (!empty($_POST['nom'])) && (!empty($_POST['prenom'])) && (!empty($_POST['telephone'])) && (!empty($_POST['mail'])) && (!empty($_POST['question'])))

  {

      $message = "je m'apelle : ".$_POST['prenom']." ".$_POST['nom']."\nMon téléphone : ".$_POST['telephone']."\nMon Mail : ".$_POST['mail']."\nMa question : ".$_POST['question']; 

      mail('liloug.0873@gmail.com', 'le sujet', $message, null,
     '-fliloug.0873@gmail.com');
  }
?>