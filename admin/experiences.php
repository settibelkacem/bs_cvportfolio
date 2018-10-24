<?php require 'inc/init.inc.php'; 
     require 'inc/acces_admin.php';  

//pour le tri des colonnes 
$ordre = ''; // on vide la variable 

if(isset($_GET['ordre']) && isset($_GET['colonne'])){
	
	if($_GET['colonne'] == 'experiences'){
		$ordre = ' ORDER BY experience';
	}
	
	if($_GET['ordre'] == 'asc'){
		$ordre.= ' ASC';
	}
	elseif($_GET['ordre'] == 'desc'){
		$ordre.= ' DESC';
	}
}

// insertion d'un élément dans la base 
if (isset($_POST['titre_exp'])) {//si on a reçu une nouvelle experience

    if ($_POST['titre_exp'] != '' && $_POST['dates_exp'] != '' && $_POST['stitre_exp'] != '' && $_POST['description_exp'] != '') {

        $titre_exp = addslashes($_POST['titre_exp']);
        $stitre_exp = addslashes($_POST['stitre_exp']);
        $dates_exp = addslashes($_POST['dates_exp']);
        $description_exp = addslashes($_POST['description_exp']);

        $pdoCV->exec(" INSERT INTO t_experiences VALUES (NULL, '$titre_exp', '$stitre_exp', '$dates_exp', '$description_exp', '1') ");

        header("location: ../admin/experiences.php");
        exit();

    }//ferme le if n'est pas vide
}//ferme le if isset

//suppression d'un élément de la BDD
if (isset($_GET['id_experience'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_experience'];// je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_experiences WHERE id_experience = '$efface' ";//delete de la base
    $pdoCV->query($sql);// on peut le faire avec exec également

    header("location: ../admin/experiences.php");
}//ferme le if isset pour la suppression
//------------------------------------AFFICHAGE----------------------
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
                    <h1 class="display-4"><i class="fas fa-school"></i> - Les experiences</h1>
                    <p class="lead">Gestion des données de mon CV.</p>
                </div>
            </div> <!-- fin jumbotron --> 

            <div class="container">   
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-xl-4 fondbleu">
                        <div class="card">
                            <?php 
                            //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                            $sql = $pdoCV->prepare(" SELECT * FROM t_experiences $ordre ");
                            $sql->execute();
                            $nbr_experiences = $sql->rowCount();
                            
                            while ($ligne_experience = $sql->fetch()) {
                            ?>
                        
                            <div class="card-header">
                                <?php echo $ligne_experience['dates_exp'] . ' // ' . $ligne_experience['titre_exp'] . ' <span class="badge badge-secondary"># ' . $ligne_experience['id_experience']; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $ligne_experience['stitre_exp']; ?></h5>
                                <p class="card-text"><?php echo $ligne_experience['description_exp']; ?></p>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>" class="btn btn-primary">Mise à jour</a><a href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>" class="btn btn-danger">Suppr.</a>
                                </div>
                            </div><!-- fin div .card-body -->
                        </div><!-- fin div .card mb-4  -->
                        <?php 
                        }
                        ?>
                    </div><!-- fin div .col-sm-12 col-md-6 col-xl-6 fondbleu -->
                    <div class="col-sm-12 col-md-4 col-xl-4 rose">
                        <form action="formations.php" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="titre_exp">Titre experience</label>
                                    <input type="titre_exp" class="form-control" name="titre_exp" placeholder="titre">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="dates_exp">Dates</label>
                                    <input type="text" class="form-control" name="dates_exp" placeholder="ex. 2018/2019">
                                </div>
        
                            </div>
                            <div class="form-group">
                                <label for="stritre_exp">Sous-titre</label>
                                <input type="text" class="form-control" name="stritre_exp" placeholder="sous-titre">
                            </div>
                            <div class="form-group">
                                <label for="description_exp">Description VOIR</label>
                                <textarea type="text" class="form-control" name="description_exp" id="editor">text</textarea>
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
                        </form><!-- fin formulaire -->
                    </div><!-- fin div .col-sm-12 col-md-6 col-xl-6 rose -->
                </div><!-- fin div .row -->
            </div><!-- fin div .container -->
        

<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises
