<?php require 'inc/init.inc.php'; ?>
<?php require 'inc/acces_admin.php'; 

// insertion d'un élément dans la base 
if (isset($_POST['nom'])) {//si on a reçu un nouveau message

    if ($_POST['nom'] != '' && $_POST['email'] != '' && $_POST['sujet'] != '' && $_POST['message'] != '') {

        $nom = addslashes($_POST['nom']);
        $email = addslashes($_POST['email']);
        $sujet = addslashes($_POST['sujet']);
        $message = addslashes($_POST['message']);

        $pdoCV->exec(" INSERT INTO t_messages VALUES (NULL, '$nom', '$email', '$sujet', '$message', '1') ");

        header("location: ../admin/messages.php");
        exit();

    }//ferme le if n'est pas vide
}//ferme le if isset

//suppression d'un élément de la BDD
if (isset($_GET['id_message'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_message'];// je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_message WHERE id_message = '$efface' ";//delete de la base
    $pdoCV->query($sql);// on peut le faire avec exec également

    header("location: ../admin/messages.php");
}//ferme le if isset pour la suppression
//----------------------------AFFICHAGE--------------------------
?>
<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	  <?php
        //requête pour une seule info
    $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs ");
    $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Admin :  <?php echo $ligne_utilisateur['pseudo']; ?></title>
	<?php require 'inc/head.php'; ?>
</head>
  <body><?php require 'inc/navigation.php'; ?>

	  <div class="container">
		   
        <div class="row">
	        <div class="jumbotron">
  <h1 class="display-4"><i class="fas fa-school"></i> - Les messages</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  
</div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 col-xl-5 fondbleu">
		 <?php 
            //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
    $sql = $pdoCV->prepare(" SELECT * FROM t_messages ");
    $sql->execute();
    $nbr_messages = $sql->rowCount();
    ?>
    
        <?php while ($ligne_message = $sql->fetch()) {
            ?>
		 <div class="card mb-4">
  <div class="card-header">
      <?php echo $ligne_message['nom'] . ' // ' . $ligne_message['titre_form'] . ' <span class="badge badge-secondary"># ' . $ligne_message['id_message']; ?></span>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $ligne_message['email']; ?></h5>
    <p class="card-text"><?php echo $ligne_message['sujet']; ?></p>
    <div class="btn-group btn-group-sm" role="group"><a href="modif_message.php?id_message=<?php echo $ligne_message['id_message']; ?>" class="btn btn-primary">Mise à jour</a><a href="messages.php?id_message=<?php echo $ligne_message['id_message']; ?>" class="btn btn-danger">Suppr.</a></div>
  </div>
</div>
            <?php 
        }
        ?>
    </div>
    <div class="col-sm-12 col-md-12 col-xl-7 rose">
     <form action="messages.php" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nom">Titre message</label>
      <input type="text" class="form-control" name="nom" placeholder="titre">
    </div>
	  <div class="form-group col-md-6">
		<label for="email">Email</label>
		<input type="text" class="form-control" name="email" placeholder="@exemple">
	  </div>
   
  </div>
	 <div class="form-group">
      <label for="stritre_form">Sous-titre</label>
      <input type="text" class="form-control" name="stritre_form" placeholder="sous-titre">
    </div>
  <div class="form-group">
    <label for="message">message </label>
    <textarea type="text" class="form-control" name="message" id="editor">text</textarea>
	 <script>
			ClassicEditor
				.create( document.querySelector( '#editor' ) )
				.then( editor => {
					console.log( editor );
				} )
				.catch( error => {
					console.error( error );
				} );
		</script>
  </div>
  
 
  <button type="submit" class="btn btn-primary">Insérer</button>

   <?php

  require_once 'inc/bas.inc.php'; // footer et fermeture des balises