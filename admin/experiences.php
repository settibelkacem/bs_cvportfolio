<?php
require 'inc/init.inc.php';
require 'inc/acces_admin.php';  

//pour le tri des colonnes 
$ordre = ''; // on vide la variable 

if (isset($_GET['ordre']) && isset($_GET['colonne'])) {

    if ($_GET['colonne'] == 'titre_exp') {
        $ordre = ' ORDER BY titre_exp';
    } elseif ($_GET['colonne'] == 'stitre_exp') {
        $order = ' ORDER BY stitre_exp';
    } elseif ($_GET['colonne'] == 'dates_exp') {
        $order = ' ORDER BY dates_exp';
    } elseif ($_GET['colonne'] == 'description_exp') {
        $order = ' ORDER BY descrition_exp';
    }

    if ($_GET['ordre'] == 'asc') {
        $ordre .= ' ASC';
    } elseif ($_GET['ordre'] == 'desc') {
        $ordre .= ' DESC';
    }
}

// insertion d'un élément dans la base 
if (isset($_POST['titre_exp'])) {//si on a reçu une nouvelle experience

    if ($_POST['titre_exp'] != '' && $_POST['stitre_exp'] != '' && $_POST['dates_exp'] != '' && $_POST['description_exp'] != '') {

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
//------------------------------------AFFICHAGE----------------
?>
<!doctype html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
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
                        <h1 class="display-4"><i class="fas fa-book-reader"></i> - Les experiences</h1>
                        <p class="lead">Gestion des données de mon CV.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 bg-secondary">
                    <?php 
                        //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                    $sql = $pdoCV->prepare(" SELECT * FROM t_experiences" . $ordre);
                    $sql->execute();
                    $nbr_experiences = $sql->rowCount();
                    ?>

                    <div class="table-responsive">
                        <div class="card-header">
                            La liste des experiences : <?php echo $nbr_experiences; ?>
                        </div>
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>
                                        <a href="experiences.php?colonne=titre_exp&ordre=desc">
                                            <i class="fas fa-chevron-circle-down"></i>
                                        </a>
                                        - Experiences  - 
                                        <a href="experiences.php?colonne=titre_exp&ordre=asc">
                                            <i class="fas fa-chevron-circle-up"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="experiences.php?colonne=stitre_exp&ordre=desc">
                                            <i class="fas fa-chevron-circle-down"></i>
                                        </a>
                                        - Sous titre  - 
                                        <a href="experiences.php?colonne=stitre_exp&ordre=asc">
                                            <i class="fas fa-chevron-circle-up"></i>
                                        </a>
                                    </th>

                                    <th>
                                        <a href="experiences.php?colonne=dates_exp&ordre=desc">
                                            <i class="fas fa-chevron-circle-down"></i>
                                        </a>
                                        - La date -
                                        <a href="experiences.php?colonne=dates_exp&ordre=asc">
                                            <i class="fas fa-chevron-circle-up"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="experiences.php?colonne=description_exp&ordre=desc">
                                            <i class="fas fa-chevron-circle-down"></i>
                                        </a>
                                        - Description  - 
                                        <a href="experiences.php?colonne=description_exp&ordre=asc">
                                            <i class="fas fa-chevron-circle-up"></i>
                                        </a>
                                    </th>
                                    <th>Modification</th>
                                    <th>Suppression</th>
                                </tr>
                            </thead>
                            <tbody class="thead-light">
                                <?php while ($ligne_experience = $sql->fetch()) {

                                    echo '<tr>';

                                    echo '<td>' . $ligne_experience['titre_exp'] . '</td><td>' . $ligne_experience['stitre_exp'] . '</td><td>' . $ligne_experience['dates_exp'] . '</td><td>' . $ligne_experience['description_exp'] . '</td><td> <a href="modif_experience.php?id_experience=' . $ligne_experience['id_experience'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir modifier cette experience ?\'))"><i class="fas fa-edit"></i></a></td>';

                                    echo '<td> <a href="?id_experience=' . $ligne_experience['id_experience'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir supprimer cette experience ?\'))" ><i class="far fa-trash-alt"></i></a></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- fin .resposive -->
                </div><!-- fin .col-lg-8 -->

                <div class="col-lg-4">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-header">
                            Insertion d'une nouvelle experience :
                        </div>
                        <div class="card-body">
                            <form action="experiences.php" method="post">

                                <div class="form-group">
                                    <label for="titre_exp">Titre experience</label>
                                    <input type="text" name="titre_exp" class="form-control" placeholder="titre de la competence" required>
                                </div>
                                <div class="form-group">
                                    <label for="stitre_exp">Sous-titre</label>
                                    <input type="text" class="form-control" name="stitre_exp" placeholder="sous-titre">
                                </div>
                                <div class="form-group">
                                    <label for="dates_exp">Dates</label>
                                    <input type="text" name="dates_exp" class="form-control"  placeholder="ex. 2018/2019">
                                </div>
                            
                                <div class="form-group">
                                    <label for="description_exp">Description </label>
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
                        </div><!-- fin div .card-body -->
                    </div><!-- fin div .card -->
                </div><!-- fin div .col-lg-4 -->
            </div><!-- fin div .row -->
        

<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises
