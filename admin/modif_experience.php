<?php require 'inc/init.inc.php';
require 'inc/acces_admin.php'; 

//gestion mise à jour d'une experience
if (isset($_POST['titre_exp'])) {
    $id_experience = $_POST['id_experience'];
    $titre_exp = addslashes($_POST['titre_exp']);
    $stitre_exp = addslashes($_POST['stitre_exp']);
    $dates_exp = $_POST['dates_exp'];
    $description_exp = $_POST['description_exp'];
  

    $pdoCV->exec(" UPDATE t_experiences SET titre_exp='$titre_exp', stitre_exp='$stitre_exp', dates_exp='$dates_exp', description_exp='$description_exp' WHERE id_experience='$id_experience' ");
    header('location: ../admin/experiences.php');
    exit();
}

//je récupère l'id de ce que je mets à jour
$id_experience = $_GET['id_experience']; // par son id et avec GET
$sql = $pdoCV->query(" SELECT * FROM t_experiences WHERE id_experience='$id_experience' ");
$ligne_experience = $sql->fetch();//va chercher ! va !
//--------------------AFFICHAGE-----------------------------
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php
      //requête pour une seule info avec la condition de la variable $id_utilisateur
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur='$id_utilisateur' ");
        $ligne_utilisateur = $sql->fetch();
        ?>
        
        <title>Admin : mise à jour experience</title>
        <?php require 'inc/head.php'; ?>
    </head>
    <body class="text-center">
        <?php require 'inc/navigation.php'; ?>
        <div class="container">
            <div class="jumbotron">
                <div>
                    <h1 class="display-4">Mise à jour d'une experience</h1>
                    <p class="lead">Mise à jour de mon CV.</p>
                </div>
            </div>
           
           
            <!-- mise à jour formulaire -->
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="modif_experience.php" method="post">
                    
                        <input type="hidden" name="id_experience" value="<?php echo $ligne_experience['id_experience']; ?>">
                        <div class="form-group">
                            <label for="titre_exp">Titre experience</label>
                            <input type="text" name="titre_exp" class="form-control"  value="<?php echo $ligne_experience['titre_exp']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="stitre_exp">Sous titre</label>
                            <input type="text" name="stitre_exp" class="form-control"  value="<?php echo $ligne_experience['stitre_exp']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="dates_exp">Dates d'experience</label>
                            <input type="text" name="dates_exp" class="form-control"  value="<?php echo $ligne_experience['dates_exp']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description_exp">Déscription d' experience</label>
                            <input type="text" name="description_exp" class="form-control"  value="<?php echo $ligne_experience['description_exp']; ?>" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn-primary">MAJ</button>
                        </div>
                    </form>
                </div>
            </div>
       

<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises
