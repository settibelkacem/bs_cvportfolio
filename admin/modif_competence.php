<?php require 'inc/init.inc.php';
    require 'inc/acces_admin.php'; 

//gestion mise à jour d'une information
if(isset($_POST['competence'])){

    $competence = addslashes($_POST['competence']);
    $niveau = addslashes($_POST['niveau']);
    $categorie = addslashes($_POST['categorie']);
    $id_competence = $_POST['id_competence'];

    $pdoCV->exec(" UPDATE t_competences SET competence='$competence', niveau='$niveau', categorie='$categorie' WHERE id_competence='$id_competence' ");
    header('location: ../admin/competences.php');
    exit();
}

//je récupère l'id de ce que je mets à jour
$id_competence = $_GET['id_competence']; // par son id et avec GET
$sql = $pdoCV->query(" SELECT * FROM t_competences WHERE id_competence='$id_competence' ");
$ligne_competence = $sql->fetch();//va chercher ! va !
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
        
        <title>Admin : mise à jour competence</title>
        <?php require 'inc/head.php'; ?>
    </head>
    <body class="text-center">
        <?php require 'inc/navigation.php'; ?>
        <div class="container">
            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-4">Mise à jour d'une compétence</h1>
                    <p class="lead">Mise à jour de mon CV.</p>
                </div>
            </div>
           
            <!-- mise à jour formulaire -->
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="modif_competence.php" method="post">
                        <input type="hidden" name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
                        <div class="form-group">
                                <label for="competence">Competence</label>
                                <input type="text" name="competence"class="form-control"  value="<?php echo $ligne_competence['competence']; ?>" required>
                        </div>
                        <div class="form-group">
                                <label for="niveau">Niveau</label>
                                <input type="text" name="niveau" class="form-control" value="<?php echo $ligne_competence['niveau']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="categorie">Catégorie <?php echo $ligne_competence['categorie']; ?></label>
                            <select name="categorie" class="form-control">
                                <option value="Back" <?php // pour ajouter selected="selected" à la balise option si c'est la cat. de la compétence
                                    if (!(strcmp("Back", $ligne_competence['categorie']))) {//strcmp compare deux chaînes de caractères
                                        echo "selected=\"selected\"";
                                    }
                                ?>>Back</option>
                                <option value="CMS" <?php
                                    if (!(strcmp("CMS", $ligne_competence['categorie']))) {
                                        echo "selected=\"selected\"";   
                                    }
                                ?>>CMS</option>
                                <option value="Frameworks" <?php
                                    if (!(strcmp("Frameworks", $ligne_competence['categorie']))) {
                                        echo "selected=\"selected\"";
                                    }
                                ?>>Frameworks</option>
                                <option value="Front" <?php
                                    if (!(strcmp("Front", $ligne_competence['categorie']))) {
                                        echo "selected=\"selected\"";
                                    }
                                ?>>Front</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn-primary">MAJ</button>
                        </div>
                    </form>
                </div>
            </div>
       

<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises
