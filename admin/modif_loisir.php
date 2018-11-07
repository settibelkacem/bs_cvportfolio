<?php require 'inc/init.inc.php'; 
 require 'inc/acces_admin.php'; 

    //gestion mise à jour d'une information
    if(isset($_POST['loisir'])){

        $loisir = addslashes($_POST['loisir']);
        $id_loisir = $_POST['id_loisir'];
        $pdoCV->exec(" UPDATE t_loisirs SET loisir='$loisir' WHERE id_loisir='$id_loisir' ");
        header('location: ../admin/loisirs.php');
        exit();
    }

    //je récupère l'id de ce que je mets à jour
    $id_loisir = $_GET['id_loisir']; // par son id et avec GET
    $sql = $pdoCV->query(" SELECT * FROM t_loisirs WHERE id_loisir='$id_loisir' ");
    $ligne_loisir = $sql->fetch();//va chercher !
//-----------------------AFFICHAGE-----------------------------
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
        
    <title>Admin : mise à jour loisir</title>
    <?php require 'inc/head.php'; ?>
</head>
<body class="text-center">
 <?php require 'inc/navigation.php'; ?>
    <div class="container">
            <div class="jumbotron">
                <div>
                    <h1 class="display-4">Mise à jour de loisir</h1>
                    <p class="lead">Mise à jour de mon CV.</p>
                </div>
            </div>

            <!-- mise à jour formulaire -->
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="modif_loisir.php" method="post">

                        <input type="hidden" name="id_loisir" class="form-control" value="<?php echo $ligne_loisir['id_loisir']; ?>">
                        <div class="form-group">
                            <label for="loisir">Loisir</label>
                            <input type="text" name="loisir" class="form-control" value="<?php echo $ligne_loisir['loisir']; ?>" required>
                        </div>
                        <div class="form-group">
                            
                            <button type="submit" class="form-control btn-primary">MAJ</button>
                        </div>

                    </form>
                </div>    
            </div>
            

<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises
