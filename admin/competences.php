<?php 
require 'inc/init.inc.php';
require 'inc/acces_admin.php';

//pour le tri des colonnes 
$ordre = ''; // on vide la variable 

if (isset($_GET['ordre']) && isset($_GET['colonne'])) {

    if ($_GET['colonne'] == 'competences') {
        $ordre = ' ORDER BY competence';
    } elseif ($_GET['colonne'] == 'niveau') {
        $order = ' ORDER BY niveau';
    } elseif ($_GET['colonne'] == 'categorie') {
        $order = ' ORDER BY categorie';
    }

    if ($_GET['ordre'] == 'asc') {
        $ordre .= ' ASC';
    } elseif ($_GET['ordre'] == 'desc') {
        $ordre .= ' DESC';
    }
}

// insertion d'un élément dans la base 
if (isset($_POST['competence'])) {//si on a reçu une nouvelle compétence

    if ($_POST['competence'] != '' && $_POST['niveau'] != '' && $_POST['categorie'] != '') {

        $competence = addslashes($_POST['competence']);
        $niveau = addslashes($_POST['niveau']);
        $categorie = addslashes($_POST['categorie']);

        $pdoCV->exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$niveau', '$categorie', '1') ");

        header("location: ../admin/competences.php");
        exit();

    }//ferme le if n'est pas vide
}//ferme le if isset

//suppression d'un élément de la BDD
if (isset($_GET['id_competence'])) {// on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_competence'];// je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_competences WHERE id_competence = '$efface' ";//delete de la base

    $pdoCV->query($sql);// on peut le faire avec exec également

    header("location: ../admin/competences.php");

}//ferme le if isset pour la suppression
//-------------------AFFICHAGE------------------------------
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php
        //requête pour une seule info avec la condition de la variable $id_utilisateur
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
                    <h1 class="display-4"><i class="fas fa-book-reader"></i> - Les compétences</h1>
                    <p class="lead">Gestion des données de mon CV.</p>
                </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-lg-8 bg-secondary">
                <?php 
                    //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                $sql = $pdoCV->prepare(" SELECT * FROM t_competences" . $ordre);
                $sql->execute();
                $nbr_competences = $sql->rowCount();
                ?>
                    <div class="table-responsive">
                        <div class="card-header">
                            La liste des compétences : <?php echo $nbr_competences; ?>
                        </div>
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>
                                        <a href="competences.php?colonne=competences&ordre=desc">
                                            <i class="fas fa-chevron-circle-down"></i>
                                        </a>
                                            - Compétences  - 
                                        <a href="competences.php?colonne=competences&ordre=asc"><i class="fas fa-chevron-circle-up"></i>
                                        </a>
                                    </th>

                                    <th>
                                        <a href="competences.php?colonne=competences&ordre=desc">
                                            <i class="fas fa-chevron-circle-down"></i>
                                        </a>
                                        - Niveau -
                                        <a href="competences.php?colonne=competences&ordre=asc">
                                            <i class="fas fa-chevron-circle-up"></i>
                                        </a>
                                    </th>

                                    <th>
                                        <a href="competences.php?colonne=competences&ordre=desc">
                                            <i class="fas fa-chevron-circle-down"></i>
                                        </a>
                                        - Catégorie - 
                                        <a href="competences.php?colonne=competences&ordre=asc">
                                            <i class="fas fa-chevron-circle-up"></i>
                                        </a>
                                    </th>
                                    <th>Modification</th>
                                    <th>Suppression</th>
                                </tr>
                            </thead>
                            <tbody class="thead-light">
                            <?php while ($ligne_competence = $sql->fetch()) {

                                echo '<tr>';

                                echo '<td>' . $ligne_competence['competence'] . '</td><td>' . $ligne_competence['niveau'] . '</td><td>' . $ligne_competence['categorie'] . '</td><td> <a href="modif_competence.php?id_competence=' . $ligne_competence['id_competence'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir modifier cette competence?\'))"><i class="fas fa-edit"></i></a></td>';

                                echo '<td> <a href="?id_competence=' . $ligne_competence['id_competence'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir supprimer cette competence?\'))" ><i class="far fa-trash-alt"></i></a></td>';
                                echo '</tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div><!-- fin resposive -->
                </div><!-- fin .col-lg-8 -->
                
                <div class="col-lg-4">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-header">Insertion d'une nouvelle compétences :
                        </div>
                        <div class="card-body">
                            <form action="competences.php" method="post">
                
                                <div class="form-group">
                                    <label for="competence">Compétence</label>
                                    <input type="text" name="competence" class="form-control" placeholder="nouvelle compétence" required>
                                </div>
                                <div class="form-group">
                                    <label for="niveau">Niveau</label>
                                    <input type="text" name="niveau" class="form-control" placeholder="niveau en chiffre" required>
                                </div>
                                <div class="form-group">
                                    <label for="categorie">Catégorie</label>
                                    <select name="categorie" class="form-control">
                                            <option value="Back">Back</option>
                                            <option value="CMS">CMS</option>
                                            <option value="Frameworks">Frameworks</option>
                                            <option value="Front">Front</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Insérer une compétence</button>
                                </div>
                            </form>
                        </div><!-- fin div .card-body -->
                    </div> <!-- fin div .card -->
                </div><!-- fin div .col-lg-4 -->
            </div><!-- fin .row -->
        
    
      
  
<?php

require_once 'inc/bas.inc.php'; // footer et fermeture des balises
