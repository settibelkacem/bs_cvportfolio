<?php 
require 'inc/init.inc.php'; 
require 'inc/acces_admin.php';

//pour le tri des colonnes 
$ordre = ''; // on vide la variable 

if(isset($_GET['ordre']) && isset($_GET['colonne'])){

  if ($_GET['colonne'] == 'titre_form') {
    $ordre = ' ORDER BY titre_form';
  } elseif ($_GET['colonne'] == 'stitre_form') {
    $order = ' ORDER BY stitre_form';
  } elseif ($_GET['colonne'] == 'dates_form') {
    $order = ' ORDER BY dates_form';
  } elseif ($_GET['colonne'] == 'description_form') {
    $order = ' ORDER BY descrition_form';
  }

  if ($_GET['ordre'] == 'asc') {
    $ordre .= ' ASC';
  } elseif ($_GET['ordre'] == 'desc') {
    $ordre .= ' DESC';
  }
}


// insertion d'un élément dans la base 
if(isset($_POST['titre_form'])){//si on a reçu une nouvelle formation

  if($_POST['titre_form']!='' && $_POST['dates_form']!='' && $_POST['titre_form']!='' && $_POST['description_form']!=''){

    $titre_form = addslashes($_POST['titre_form']);
    $stitre_form = addslashes($_POST['stitre_form']);
    $dates_form = addslashes($_POST['dates_form']);
  $description_form = addslashes($_POST['description_form']);

    $pdoCV->exec(" INSERT INTO t_formations VALUES (NULL, '$titre_form', '$stitre_form', '$dates_form', '$description_form', '1') "); 

    header("location: ../admin/formations.php");
    exit();

  }//ferme le if n'est pas vide
}//ferme le if isset

//suppression d'un élément de la BDD
if(isset($_GET['id_formation'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_formation'];// je passe l'id dans une variable $efface

    $sql =" DELETE FROM t_formations WHERE id_formation = '$efface' ";//delete de la base
    $pdoCV->query($sql);// on peut le faire avec exec également

    header("location: ../admin/formations.php");
}//ferme le if isset pour la suppression

//---------------------------AFFICHAGE-------------------------
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
      //requête pour une seule info
      $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur='$id_utilisateur' ");
      $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Admin :  <?php echo $ligne_utilisateur['pseudo']; ?></title>
  <?php require 'inc/head.php'; ?>
  </head>

  <body class="text-center">
    <div class="container-fluid">
      <?php require 'inc/navigation.php'; ?>

      <div class="row">
        <div class=" col-12 jumbotron jumbotron-fluid">
          <div class="container">
            <h1 class="display-4"><i class="fas fa-school"></i> - Les formations</h1>
            <p class="lead">Gestion des données de mon CV.</p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8 bg-secondary">
          <?php 
          //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
          $sql = $pdoCV->prepare(" SELECT * FROM t_formations ".$ordre);
          $sql->execute();
          $nbr_formations = $sql->rowCount();
          ?>

          <div class="table-responsive">
            <div class="card-header">
              La liste des formations : <?php echo $nbr_formations; ?>
            </div>
            <table class="table table-striped table-sm">
              <thead class="thead-dark">
                <tr>
                  <th>
                    <a href="formations.php?colonne=formations&ordre=desc">
                      <i class="fas fa-chevron-circle-down"></i>
                    </a>
                    Titre de formations 
                    <a href="formations.php?colonne=formations&ordre=asc">
                      <i class="fas fa-chevron-circle-up"></i>
                    </a>
                  </th>

                  <th>
                    <a href="formations.php?colonne=formations&ordre=desc">
                      <i class="fas fa-chevron-circle-down"></i>
                    </a>
                    Sous titre de formations 
                    <a href="formations.php?colonne=formations&ordre=asc">
                      <i class="fas fa-chevron-circle-up"></i>
                    </a>
                  </th>

                  <th>
                    <a href="formations.php?colonne=formations&ordre=desc">
                      <i class="fas fa-chevron-circle-down"></i>
                    </a>
                    Dates de formations 
                    <a href="formations.php?colonne=formations&ordre=asc">
                      <i class="fas fa-chevron-circle-up"></i>
                    </a>
                  </th>

                  <th>
                    <a href="formations.php?colonne=formations&ordre=desc">
                      <i class="fas fa-chevron-circle-down"></i>
                    </a>
                    Description de la formations 
                    <a href="formations.php?colonne=formations&ordre=asc">
                      <i class="fas fa-chevron-circle-up"></i>
                    </a>
                  </th>
                  <th>Modification</th>
                  <th>Suppression</th>
                </tr>
              </thead>
              <tbody class="thead-light">
                <?php while ($ligne_formation = $sql->fetch()){

                  echo '<tr>';

                  echo '<td>' . $ligne_formation['titre_form'] . '</td><td>' . $ligne_formation['stitre_form'] . '</td><td>' . $ligne_formation['dates_form'] . '</td><td> <a href="modif_formation.php?id_formation=' . $ligne_formation['id_formation'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir modifier cette formation?\'))"><i class="fas fa-edit"></i></a></td>';

                  echo '<td> <a href="?id_formation=' . $ligne_formation['id_formation'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir supprimer cette formation?\'))" ><i class="far fa-trash-alt"></i></a></td>';
                  echo '</tr>';

                }
                ?>
              </tbody>
            </table>
          </div><!-- fin div .resposive -->
        </div><!-- fin div .col-lg-8 bg-secondary -->

        <div class="col-lg-4">
          <div class="card text-white bg-secondary mb-3">
            <div class="card-header">
              Insertion d'une nouvelle experience :
            </div>
            <div class="card-body">
              <form action="formations.php" method="post">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="titre_form">Titre formation</label>
                    <input type="titre_form" class="form-control" name="titre_form" placeholder="titre">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="dates_form">Dates</label>
                    <input type="text" class="form-control" name="dates_form" placeholder="ex. 2018/2019">
                  </div>
      
                </div>
                <div class="form-group">
                  <label for="stritre_form">Sous-titre</label>
                  <input type="text" class="form-control" name="stritre_form" placeholder="sous-titre">
                </div>
                <div class="form-group">
                  <label for="description_form">Description VOIR</label>
                  <textarea type="text" class="form-control" name="description_form" id="description_form">text</textarea>
                  <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description_form' );
                  </script>
                </div>
                <button type="submit" class="btn btn-primary">Insérer</button>
              </form><!-- fin formulaire -->
            </div><!-- fin div .card-body -->
          </div><!-- fin div .card -->
        </div><!-- fin div .col-lg-4 -->
      </div><!-- fin div .row -->
      
<?php

require_once 'inc/bas.inc.php';
