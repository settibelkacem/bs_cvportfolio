<?php require 'inc/init.inc.php'; ?>
<?php require 'inc/acces_admin.php';

  //pour le tri des colonnes 
  $ordre = ''; // on vide la variable 

  if(isset($_GET['ordre']) && isset($_GET['colonne'])){
    
    if($_GET['colonne'] == 'realisations'){
      $ordre = ' ORDER BY titre_realisation';
    }
    
    if($_GET['ordre'] == 'asc'){
      $ordre.= ' ASC';
    }
    elseif($_GET['ordre'] == 'desc'){
      $ordre.= ' DESC';
    }
  }


  // insertion d'un élément dans la base 
  if(isset($_POST['titre_real'])){//si on a reçu une nouvelle formation

    if($_POST['titre_real']!='' && $_POST['dates_real']!='' && $_POST['titre_real']!='' && $_POST['description_real']!=''){

      $titre_real = addslashes($_POST['titre_real']);
      $stitre_real = addslashes($_POST['stitre_real']);
      $dates_real = addslashes($_POST['dates_real']);
      $description_real = addslashes($_POST['description_real']);

      $pdoCV->exec(" INSERT INTO t_realisations VALUES (NULL, '$titre_real', '$stitre_real', '$dates_real', '$description_real', '1') "); 

      header("location: ../admin/realisations.php");
      exit();

    }//ferme le if n'est pas vide
  }//ferme le if isset

  //suppression d'un élément de la BDD
  if(isset($_GET['id_realisation'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_realisation'];// je passe l'id dans une variable $efface

    $sql =" DELETE FROM t_realisations WHERE id_realisation = '$efface' ";//delete de la base
    $pdoCV->query($sql);// on peut le faire avec exec également

    header("location: ../admin/realisations.php");
  }//ferme le if isset pour la suppression
//---------------------AFFICHAGE-----------------------------
?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS en CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
    <?php
      //requête pour une seule info
      $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs ");
      $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Admin :  <?php echo $ligne_utilisateur['pseudo']; ?></title>
    <?php require 'inc/head.php'; ?>
  </head>
  <body>
	  <div class="container">
		  <?php require 'inc/navigation.php'; ?>
    <div class="row">
      <div class="jumbotron">
        <h1 class="display-4"><i class="fas fa-school"></i> - Les realisations</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <a class="btn btn-primary btn-lg" href="#" role="button">VOIR</a>
      </div>
    </div>
  <div class="row">
    <div class="col-sm-12 col-md-12 col-xl-5 fondbleu">
		 <?php 
            //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_realisations ");
            $sql->execute();
            $nbr_realisations = $sql->rowCount();
    ?>
    
        <?php while($ligne_realisation=$sql->fetch(	)) 
            {
        ?>
		 <div class="card mb-4">
  <div class="card-header">
      <?php echo $ligne_realisation['dates_real'].' // '.$ligne_realisation['titre_real'].' <span class="badge badge-secondary"># '.$ligne_realisation['id_realisation']; ?></span>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $ligne_realisation['stitre_real']; ?></h5>
    <p class="card-text"><?php echo $ligne_realisation['description_real']; ?></p>
      <div class="btn-group btn-group-sm" role="group"><a href="modif_realisation.php?id_realisation=<?php echo $ligne_realisation['id_realisation']; ?>" class="btn btn-primary">Mise à jour</a><a href="realisations.php?id_realisation=<?php echo $ligne_realisation['id_realisation']; ?>" class="btn btn-danger">Suppr.</a></div>
    </div>
    </div>
            <?php 
                }
            ?>
    </div>
    <div class="col-sm-12 col-md-12 col-xl-7 rose">
      <form action="realisations.php" method="post">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="titre_real">Titre realisation</label>
            <input type="titre_real" class="form-control" name="titre_real" placeholder="titre">
          </div>
	        <div class="form-group col-md-6">
		        <label for="dates_real">Dates</label>
		        <input type="text" class="form-control" name="dates_real" placeholder="ex. 2018/2019">
	        </div>
   
        </div>
        <div class="form-group">
          <label for="stritre_real">Sous-titre</label>
          <input type="text" class="form-control" name="stritre_real" placeholder="sous-titre">
        </div>
        <div class="form-group">
          <label for="description_real">Description VOIR</label>
          <textarea type="text" class="form-control" name="description_real" id="description_real">text</textarea>
          <script>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace( 'description_real' );
          </script>
        </div>
        <button type="submit" class="btn btn-primary">Insérer</button>
      </form>
    </div>
 
  
<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises