<?php require 'inc/init.inc.php';
require 'inc/acces_admin.php';

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
    <?php
      //requête pour une seule info
      $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs ");
      $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Admin :  <?php echo $ligne_utilisateur['pseudo']; ?></title>
    <?php require 'inc/head.php'; ?>
  </head>
  <body class="text-center">
    <div class="container-fluid">
      <?php require 'inc/navigation.php'; ?>
  
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4"><i class="fas fa-book-reader"></i> - Les realisations :</h1>
          <p class="lead">Gestion des données de mon CV.</p>
        </div>
      </div><!-- fin jumbotron -->

      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-xl-12 fondbleu">
            <?php 
              //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
              $sql = $pdoCV->prepare(" SELECT * FROM t_realisations ".$ordre);
              $sql->execute();
              $nbr_realisations = $sql->rowCount();
            ?>
            <div class="table-responsive">
              <div class="card-header">
                  La liste des realisations : <?php echo $nbr_realisations; ?>
              </div>
              <table class="table table-striped table-sm">
                <thead class="thead-dark">
                  <tr>
                    <th><a href="realisations.php?colonne=realisations&ordre=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>Réalisation<a href="realisations.php?colonne=realisation&ordre=asc"><i class="fas fa-arrow-alt-circle-up"></i></a></th>
                    <th>titre realisations</th>
                    <th>sous titre realisation</th>
                    <th>dates realisation</th>
                    <th>dates realisation</th>
                    <th>description realisation</th>
                    <th>Modification</th>
                    <th>Suppression</th>
                  </tr>
                </thead>
                <tbody class="thead-light">
                  <?php while ($ligne_realisation = $sql->fetch()) {
                      echo '<tr>';

                        echo '<td>' . $ligne_realisation['titre_real'] . '</td><td>' . $ligne_realisation['stitre_real'] . '</td><td>' . $ligne_realisation['dates_real'] . '</td><td>' . $ligne_realisation['description_real'] .'</td><td> <a href="modif_realisation.php?id_realisation=' . $ligne_realisation['id_realisation'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir modifier cette realisation?\'))"><i class="fas fa-edit"></i></a></td>';

                        echo '<td> <a href="?id_realisation=' . $ligne_realisation['id_realisation'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir supprimer cette realisation?\'))" ><i class="far fa-trash-alt"></i></a></td>';
                      echo '</tr>';
                      }
                  ?>
                </tbody>
              </table>
            </div><!-- fin div .table-responsible -->
          </div><!-- fin div .col -->

          <div class="col-sm-12 col-md-12 col-xl-12 rose">
            <div class="card text-white bg-secondary mb-3">
              <div class="card-header">
                  Insertion d'une nouvelle realisation :
              </div>
              <div class="card-body">
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
                </div> <!-- fin div .card-body --> 
            </div> <!-- fin div .card --> 
          </div><!-- fin div .col-sm-12 col-md-12 col-xl-7 rose -->
      
  
<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises